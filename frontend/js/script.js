document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("menu-btn");
    const searchBtn = document.getElementById("search-btn");
    const searchForm = document.querySelector(".search-form");
    const searchBox = document.getElementById("search-box");

    menuBtn.addEventListener("click", toggleMenu);
    searchBtn.addEventListener("click", toggleSearch);

    function toggleMenu() {
        const navbar = document.querySelector(".navbar");
        navbar.classList.toggle("active");
    }

    function toggleSearch() {
        searchForm.classList.toggle("active");
        searchBox.focus();
    }
    function openLogin() {
        document.getElementById("konto-btn").addEventListener("click", function() {
            window.location.href = "../pages/Login.html";
        });
    }
    

});
