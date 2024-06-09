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
    $("#btn_Kat").click(function (e) {
        loadProductyByCategory($("#kategorie").val());
     });
});

function loaddata() {
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "queryProducts"},
        dataType: "json",
        success: function (response) {
                console.log(response)
            $.each(response, function( key, val ) {  
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                var desc = val["description"];
                var stock = val["stock"];
                $("#products").append("<div id="+id+"> <h2>"+name+"</h2> </div>");
                $("#"+id).append("insert foto"+"<br>")
                $("#"+id).append("ID: "+id)
                $("#"+id).append("<h3>Preis: "+price+"</h3>")
                $("#"+id).append("aktueller Lagerstand: "+stock+"<br>")
                $("#"+id).append("Beschreibung: "+desc+"<br>")
                $("#"+id).append("In den Warenkorb legen")
                $("#"+id).append("<br>")

                //$("#poi-list").append("<li id="+key+" class='poi-item list-group-item'>"+name+"</li>")
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    });
}

function loadProductyByCategory(category) {
    console.log("Funktion aufgerufen")
    console.log(category)
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "queryProductsByCategory", param: category},
        dataType: "json",
        success: function (response) {
                console.log(response)
                $("#products").empty();
            $.each(response, function( key, val ) {  
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                var desc = val["description"];
                var stock = val["stock"];
                $("#products").append("<div id="+id+"> <h2>"+name+"</h2> </div>");
                $("#"+id).append("insert foto"+"<br>")
                $("#"+id).append("ID: "+id)
                $("#"+id).append("<h3>Preis: "+price+"</h3>")
                $("#"+id).append("aktueller Lagerstand: "+stock+"<br>")
                $("#"+id).append("Beschreibung: "+desc+"<br>")
                $("#"+id).append("In den Warenkorb legen")
                $("#"+id).append("<br>")

                //$("#poi-list").append("<li id="+key+" class='poi-item list-group-item'>"+name+"</li>")
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    });
}

