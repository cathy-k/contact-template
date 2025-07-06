  <!-- LOADS navbar.php AS WELL AS BOOTSTRAP, ANIMATE ON SCROLL (AOS) -->
  <!-- I USE ADOBE FONTS, BUT I'VE SUBSTITUTED GOOGLE FONTS HERE. ADJUSTMENTS MAY BE NEEDED. -->

<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no" />
    <title>Contact Form Template</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="keywords" content="contact form, php, gmail, oauth2, composer">
    <meta name="description" content="A barebones template for a working PHP/Gmail API contact form">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Josefin+Slab:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  
    <link rel="stylesheet" href="assets/css/style.css" />
    <script type="text/javascript" src="assets/js/javascript.js"></script>
    <script
        src = "https://www.google.com/recaptcha/api.js"
        async defer >
    </script>
    <script>
        var mybutton = document.getElementById('myBtn');

        window.onload = function() {
            var mybutton = document.getElementById('myBtn');
            window.onscroll = function() {
                scrollFunction();
            };
        };
    </script>

    <style>
        .honeypot-wrapper {
            position: absolute;
            left: -9999px;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }
    </style>
</head>

<!-- BANNER -->
<header class="banner container-fluid d-flex justify-content-center align-content-center">
    <h5 class="banner display-5 pt-1">Contact form template</h5>
</header>

<!-- NAVBAR -->
<section>
    <?php require("navbar.php"); ?>
</section>

<!-- <body> -->