This gist contains the files needed to create a working PHP web contact form. 

## Google Cloud, GMail API and OAuth2 Setup Checklist* ##

1. **Set up Google Cloud Project**
  - Go to [Google Cloud Console](https://console.cloud.google.com/) 
  - Create a new project (or select an existing one) 
  - Enable the **Gmail API** for your project 
  
2. **Create OAuth 2.0 Credentials** 
  - Go to **APIs & Services > Credentials** 
  - Create an OAuth 2.0 Client ID 
    - Application type: **Web application** 
    - Add any domain or localhost URIs you’ll be testing from (e.g. `http://localhost`, `https://yourdomain.com`) 
  - Note your **Client ID** and **Client Secret** 
  
3. **Obtain a Refresh Token** 
  - Visit the [OAuth 2.0 Playground](https://developers.google.com/oauthplayground/) 
  - Click the gear icon: 
    - Check **Use your own OAuth credentials** 
    - Paste your **Client ID** and **Client Secret** 
  - In Step 1 (column to the left), select or enter this scope in the field at the bottom of the list: `https://mail.google.com/` 
  - Authorize and allow Gmail access 
  - In Step 2, click **Exchange authorization code for tokens** 
  - Copy the **Refresh Token** 
    - The refresh token field disappears after a few seconds but that refresh token value is written near the bottom of the text displayed to the right.
   
4. **Set Up reCAPTCHA** 
  - Go to the [reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin) 
  - Register your domain 
  - Choose **reCAPTCHA v2** (“I’m not a robot” checkbox) 
  - Add the `recaptcha_siteKey` and `recaptcha_secretKey` values to `config.php` 
  
5. **Configure your Project** 
  - Open `config.php` (included in this Gist – use the`config.php`file with spaces for credentials.) 
  - Fill in: 
    - `recaptcha_siteKey` (see steps below)
    - `recaptcha_secretKey`
    - `google_email` 
    - `oauth2_clientId` 
    - `oauth2_clientSecret` 
    - `oauth2_refreshToken` 
    - `senderEmail` 
    - `recipientEmail`

6. Install Composer if not already installed. See instructions below if necessary.
    
7. **Deploy and Test** 
  - NOTE: COMPOSER PACKAGES NEED TO BE INSTALLED BEFORE THIS - INSTRUCTIONS BELOW IF NECESSARY
  - Upload the files to your server 
  - Ensure PHP can write to `form_debug.txt` 
  - Submit a test message (sending to your own email address is a good test)
  - Check Gmail **Sent** folder to confirm delivery </pre>

### Composer Setup Instructions ###

1. Install Composer (if not already installed):
  - Run this in your terminal: <pre>
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
</pre>

2. Navigate to your project folder: <pre>
  cd /path/to/contact-form-template</pre>
 
3. Create a composer.json file (already included in this template) 
  - If you're starting fresh<pre>
composer init</pre>

4. Require the Google API Client Library: <pre>
composer require google/apiclient:^2.0</pre>

5. Autoload in your PHP file (already done in contact.php):
  - At the top of your contact.php make sure you include (already included in this template.):<pre>
require_once __DIR__ . '/vendor/autoload.php';</pre>

#### *OAuth2 credentials require a secure https:// domain in production. http://localhost is allowed for development only. See section below.

### How to enable HTTPS with Apache Use Let's Encrypt to install an SSL certificate (This is an Ubuntu/apt installation.)
  ``` 
  sudo apt install certbot python3-certbot-apache 
  sudo certbot --apache 
  ``` 
  
  Follow the prompts to choose your domain and enable automatic redirects. More info: https://certbot.eff.org/
  

* * *


THIS IS THE FOLDER STRUCTURE. SCSS FILE AND IMAGES ARE NOT INCLUDED.
VENDOR FOLDER IS GENERATED FROM COMPOSER INSTALL

```
├── assets
│   ├── css
│   ├── images
│   ├── inc
│   ├── js
│   └── scss
├── composer.json
├── composer.lock
├── contact.php
├── error.php
├── favicon.ico
├── footer.php
├── form.php
├── header.php
├── content-home.php
├── index.php
├── navbar.php
├── success.php
└── vendor
```
