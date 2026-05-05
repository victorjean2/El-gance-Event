const burger = document.querySelector('.burger');
const mainNav = document.querySelector('.main-nav');
const navLinks = document.querySelectorAll('.main-nav a');

if (burger && mainNav) {
    burger.addEventListener('click', function () {
        mainNav.classList.toggle('active');
    });

    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            mainNav.classList.remove('active');
        });
    });
}