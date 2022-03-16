const activePage = window.location.pathname;
    const navLinks = document.querySelectorAll('.side-nav-links')
    navLinks.forEach(link => {
      if(link.href.includes(`${activePage}`)) {
        link.classList.add('active-link');
      }
    })