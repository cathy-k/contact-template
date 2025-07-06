<!-- HOME PAGE LOADS HEADER, FOOTER, content-home, FORM, content-about AND FOOTER WITH "REQUIRE" STATEMENTS -->

<!DOCTYPE html>
<html lang="en">

<!-- HEADER -->
<section>
    <?php require("header.php"); ?>
</section>

<body>
    <!-- CONTENT -->
    <section>

        <div class="container-fluid"
            style="position: relative; z-index: 97;">

            <button onclick="topFunction()" id="myBtn" title="Go to top">
                <img src="assets/images/btn-triangle.svg" />
            </button>

            <script>
                var mybutton = document.getElementById('myBtn');

                window.onload = function() {
                    var mybutton = document.getElementById('myBtn');
                    window.onscroll = function() {
                        scrollFunction();
                    };
                };
            </script>
        </div>

        <!-- HOME CONTENT -->
        <div class="container" data-aos="fade-in">
            <?php require("content-home.php") ?>
        </div>

        <!-- FORM SECTION -->
        <div class="container" data-aos="fade-in">
            <hr>
            <?php require("form.php") ?>
        </div>

        <!-- ABOUT CONTENT -->
        <div class="container" data-aos="fade-in">
            <hr class="pb-5">
            <?php require("content-about.php") ?>
        </div>

    </section>

    <!-- FOOTER -->
    <section>
        <?php require_once("footer.php"); ?>
    </section>

    <!-- JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" defer></script>

    <!--AOS SCROLLING ANIMATIONS-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            delay: 250,
            once: false,
        });
    </script>

    <!-- ADDS WARNING FOR WEBSITE LINKS AND NON-STANDARD CHARACTER USED IN MESSAGE FIELD -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const messageField = document.querySelector("textarea[name='message']");
            const warning = document.getElementById("message-warning");

            if (!form || !messageField || !warning) return;

            form.addEventListener("submit", function(e) {
                const message = messageField.value;
                const urlPattern = /(https?:\/\/|www\.)/i;
                const asciiPattern = /^[\x00-\x7F]*$/;

                if (urlPattern.test(message)) {
                    e.preventDefault();
                    warning.textContent = "Please remove links from your message before submitting.";
                    warning.style.display = "block";
                    messageField.focus();
                } else if (!asciiPattern.test(message)) {
                    e.preventDefault();
                    warning.textContent = "Please use plain standard keyboard characters only (no special characters or emojis).";
                    warning.style.display = "block";
                    messageField.focus();
                } else {
                    warning.style.display = "none";
                }
            });

            messageField.addEventListener("input", function() {
                warning.style.display = "none";
            });
        });
    </script>

</body>

</html>