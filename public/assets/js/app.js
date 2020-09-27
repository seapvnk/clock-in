// Sidebar

(() => {
    const menuToggleButton = document.querySelector('.menu-toggle');

    menuToggleButton.addEventListener( 'click', e => {
        const body = document.querySelector('body');
        body.classList.toggle('hide-sidebar');
    });

})();


(() => {

    const addOneSecond = (hours, minutes, seconds) => {
        const d = new Date();
        d.setHours(parseInt(hours));
        d.setMinutes(parseInt(minutes));
        d.setSeconds(parseInt(seconds) + 1);

        const h = `${d.getHours()}`.padStart(2, 0);
        const m = `${d.getMinutes()}`.padStart(2, 0);
        const s = `${d.getSeconds()}`.padStart(2, 0);

        return `${h}:${m}:${s}`;
    }

    const clock = document.querySelector('[active-clock]');
    if (!clock) return;

    setInterval(() => {
        const parts = clock.innerHTML.split(':');
        clock.innerHTML = addOneSecond(...parts);    
    }, 1000);
    
})()