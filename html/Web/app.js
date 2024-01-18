const white = document.querySelector('#white');
const menu = document.querySelector('#menu');

white.addEventListener('click', () => {
    menu.classList.toggle('disp');
});

