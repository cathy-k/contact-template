<!-- LOADS config.php CONTAINING OAUTH2 AND RECAPTCHA CREDENTIALS -->

<?php
// Enable debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload dependencies
require_once __DIR__ . '/vendor/autoload.php';

use Google\Client             as Google_Client;
use Google\Service\Gmail      as Google_Service_Gmail;
use Google\Service\Gmail\Message as Google_Service_Gmail_Message;

// Load config
$config = include __DIR__ . '/assets/inc/config.php';

// Extract values
$secretKey          = $config['recaptcha_secretKey'];
$googleEmail        = $config['google_email'];
$oauth2ClientId     = $config['oauth2_clientId'];
$oauth2ClientSecret = $config['oauth2_clientSecret'];
$oauth2RefreshToken = $config['oauth2_refreshToken'];
$senderEmail        = $config['senderEmail'];
$recipientEmail     = $config['recipientEmail'];
$subject            = 'Message from your website';
$recipientCopySubject = 'A copy of your message to website contact form';

// Allowed fields
$fields = [
    'name'    => 'Name',
    'email'   => 'Email',
    'referral' => 'Referral',
    'message' => 'Message'
];

try {
    file_put_contents(__DIR__ . '/form_debug.txt', print_r($_POST, true));

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: error.php?reason=method');
        exit;
    }

    if (!empty($_POST['referral'])) {
        header('Location: error.php?reason=spam');
        exit;
    }

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        header('Location: error.php?reason=missing');
        exit;
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        header('Location: error.php?reason=invalid_email');
        exit;
    }

    if (empty($_POST['g-recaptcha-response'])) {
        header('Location: error.php?reason=nocaptcha');
        exit;
    }

    // reCAPTCHA
    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, stream_context_create([
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query([
                'secret'   => $secretKey,
                'response' => $_POST['g-recaptcha-response'],
            ]),
        ]
    ]));
    $resp = json_decode($response, true);
    error_log('Recaptcha debug: ' . print_r($resp, true));

    if (!isset($resp['success']) || $resp['success'] !== true) {
        header('Location: error.php?reason=recaptcha');
        exit;
    }

    // Too-quick
    if (empty($_POST['form_time']) || (time() - (int)$_POST['form_time']) < 5) {
        header('Location: error.php?reason=tooquick');
        exit;
    }

    // ASCII-only
    $msg = $_POST['message'];
    if (preg_match('/[^\x00-\x7F]/', $msg)) {
        header('Location: error.php?reason=badchars');
        exit;
    }
    
    if (preg_match('/https?:\/\/|www\./i', $_POST['message'])) {
        header('Location: error.php?reason=linknotallowed');
        exit;
    }


    // Build body
    $body = "Message from your website:\n\n";
    foreach ($fields as $key => $label) {
        if (!empty($_POST[$key])) {
            $body .= "{$label}:\n{$_POST[$key]}\n\n";
        }
    }

    // Gmail API
    $client = new Google_Client();
    $client->setApplicationName('Gmail API Mailer');
    $client->setClientId($oauth2ClientId);
    $client->setClientSecret($oauth2ClientSecret);
    $client->setAccessType('offline');
    $client->setScopes(Google_Service_Gmail::GMAIL_SEND);
    $client->setAccessToken([
        'access_token'  => '',
        'expires_in'    => 0,
        'created'       => time(),
        'refresh_token' => $oauth2RefreshToken
    ]);
    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($oauth2RefreshToken);
    }
    $service = new Google_Service_Gmail($client);

    // Send to owner
    $hdrs = "From: {$senderEmail}\r\n"
        . "To: {$recipientEmail}\r\n"
        . "Subject: {$subject}\r\n"
        . "Content-Type: text/plain; charset=utf-8\r\n\r\n";
    $msgObj = new Google_Service_Gmail_Message();
    $msgObj->setRaw(rtrim(strtr(base64_encode($hdrs . $body), '+/', '-_'), '='));
    $service->users_messages->send('me', $msgObj);

    // Send copy to user
    $userHdrs = "From: {$senderEmail}\r\n"
        . "To: {$_POST['email']}\r\n"
        . "Subject: {$recipientCopySubject}\r\n"
        . "Content-Type: text/plain; charset=utf-8\r\n\r\n";
    $copyObj = new Google_Service_Gmail_Message();
    $copyObj->setRaw(rtrim(strtr(base64_encode($userHdrs . $body), '+/', '-_'), '='));
    $service->users_messages->send('me', $copyObj);

    header('Location: success.php');
    exit;
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    header('Location: error.php?reason=unknown');
    exit;
}
