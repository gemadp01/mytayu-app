// Navbar
const navbar = document.querySelector('nav');
// const navbarNav = document.querySelectorAll('nav .navbar-nav .nav-link');
const defaultActive = document.querySelector('nav .navbar-nav').firstElementChild;
defaultActive.classList.add('active');
let removeActive = defaultActive;
// console.log(removeActive);

navbar.addEventListener('click', function (e) {
  if (e.target.className == 'nav-link') {
    // console.log(e);
    // setTimeout(function () {
    //   e.target.classList.remove('active');
    // }, 500);
    if (removeActive != null) {
      removeActive.classList.remove('active');
    }
    e.target.classList.add('active');
    removeActive = e.target;
  }
});

