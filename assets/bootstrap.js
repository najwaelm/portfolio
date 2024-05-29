//  HEADER active nav-link 
const navLinks = document.querySelectorAll('.nav-link');
const windowPathname = window.location.pathname;

navLinks.forEach(link => {
    const navLinkPathname = new URL(link.href).pathname; 
    if (windowPathname === navLinkPathname) {
        link.classList.add('active'); 
    }
});

