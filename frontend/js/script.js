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

$(document).ready(function () {
    console.log("Startfunktion aufgerufen");
    loaddata();
});

function loaddata() {
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "queryProducts"},
        dataType: "json",
        success: function (response) {
            console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    });
}

