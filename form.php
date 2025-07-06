<!-- FORM CALLS contact.php ON SUBMIT. INCLUDES GOOGLE RECAPTCHA. -->

<!-- INVISIBLE 'REFERRAL' FIELD THAT BOTS MAY FILL BUT HUMANS WILL NOT. ENTRY IN THAT FIELD RESULTS IN ERROR. -->
<!-- NOTES TIME FOR INHUMAN SPEED IN FILLING FORM. TOO FAST RESULTS IN ERROR FROM CONTACT.PHP. -->

<div id="contact-section" class="contact-section my-5 ps-0">

    <div id="contact-text" class="contact-text">
        <h2>Contact us</h2>
    </div>

    <div id="contact-form" class="contact-form">

        <form
            name="contact-us"
            method="POST"
            action="contact.php"
            onsubmit="return checkform(this);">

            <!-- Name Field -->
            <div class="form-group pb-4">
                <label for="form_name">Name</label>
                <input
                    id="form_name"
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder=""
                    required>
            </div>

            <!-- Email Field -->
            <div class="form-group pb-4">
                <label for="form_email">Email</label>
                <input
                    id="form_email"
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder=""
                    required>
            </div>

            <!-- Message Field -->
            <div class="form-group pb-4">
                <label for="form_message">Message</label>
                <textarea
                    id="form_message"
                    class="form-control"
                    name="message"
                    rows="3"
                    placeholder=""
                    required></textarea>
                <p id="message-warning" class="pt-2 pb-0 mb-0" style="display:none; color: red;">
                </p>
            </div>

            <!-- Honeypot Field (Spam Trap) -->
            <div class="honeypot-wrapper">
                <label for="form_referral">Referral</label>
                <input
                    id="form_referral"
                    type="text"
                    name="referral"
                    autocomplete="off">
            </div>

            <!-- Timestamp (Bot Speed Trap) -->
            <input type="hidden" name="form_time" value="<?php echo time(); ?>">

            <!-- reCAPTCHA -->
            <?php $config = include __DIR__ . '/assets/inc/config.php'; ?>
            <div class="g-recaptcha my-3"
                data-sitekey="<?php echo htmlspecialchars($config['recaptcha_siteKey']); ?>"
                data-theme="light"></div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-dark mb-4">Submit</button>
        </form>
    </div>
</div>