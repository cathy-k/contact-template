// SUPPORT FILE FOR SCROLL TO TOP BUTTON - LOCATED AT /assets/js/javascript.js

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = 'block';
  } else {
    mybutton.style.display = 'none';
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// Makes a logo with id="logoLink" into a link with hand pointer
document.addEventListener("DOMContentLoaded", function () {
  var logo = document.getElementById("logoLink");
  if (logo) {
    logo.style.cursor = "pointer";
    logo.addEventListener("click", function () {
      window.location.href = "/";
    });
  }
});