// Sidebar

(() => {
    const menuToggleButton = document.querySelector('.menu-toggle');

    menuToggleButton.addEventListener( 'click', e => {
        const body = document.querySelector('body');
        body.classList.toggle('hide-sidebar');
    });

})();