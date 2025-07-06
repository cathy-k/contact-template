<!-- ERROR PAGE WITH REASON TEXT. SENT FROM contact.php -->

<!-- ERRORS FOR:
spam - Invisible field "referral" is only filled by bots. Human users can't see it.
missing - required fields not filled in.
invalid email - email address not formatted correctly.
nocaptcha - recaptcha not passed
recaptcha - recaptcha not validated
tooquick - fields filled more quickly than humans can type
badchars - Non-standard non-western characters (this error check not recommended or needed for some international users who use non-English characters)
link not allowed - no website addresses allowed so spammers can't advertise their websites
method, default - other undefined errors -->


<!-- HEADER -->
<?php require_once("header.php");

// Map reason codes to user‐friendly messages
$reason  = $_GET['reason'] ?? 'unknown';
switch ($reason) {
    case 'method':
        $msg = 'Invalid submission method.';
        break;
    case 'spam':
        $msg = 'Spam filter triggered. If you’re human, please try again.';
        break;
    case 'missing':
        $msg = 'Please fill out all required fields.';
        break;
    case 'invalid_email':
        $msg = 'Please format your email address correctly.';
        break;
    case 'nocaptcha':
        $msg = 'Please complete the reCAPTCHA to continue.';
        break;
    case 'recaptcha':
        $msg = 'reCAPTCHA validation failed.';
        break;
    case 'tooquick':
        $msg = 'Form submitted too quickly — possible bot.';
        break;
    case 'badchars':
        $msg = 'Your message contains invalid characters. Please try again.';
        break;
    case 'linknotallowed':
        $msg = 'Website links are not allowed. Please try again.';
        break;
    default:
        $msg = 'Unfortunately, an unexpected error occurred. Please try again.';
        break;
}
?>

<div class="container mt-5 pt-5">
    <h2>Error</h2>
    <p class="text-gold"><?php echo htmlspecialchars($msg); ?></p>
    <p class="pt-5 text-center"><a href="index.php#contact-section">Back to form</a></p>
</div>

<!-- FOOTER -->
<?php require_once("footer.php"); ?>

</body>

</html>