(function () {
    window.addEventListener('load', () => {
        let searchBar = document.querySelector("#search-bar");
        let searchBarToggler = document.querySelector('#search-bar-toggler');

        searchBarToggler.addEventListener('click', () => {
            searchBarToggler.classList.toggle('pressed');
            searchBar.classList.toggle('opened');
        });

        let burgerButton = document.querySelector("#burger-menu");
        let responsiveHeader = document.querySelector("#responsive-header");

        burgerButton.addEventListener('click', (event) => {
            responsiveHeader.classList.toggle('opened');
            burgerButton.classList.toggle('opened');
        });
    });
}) ();