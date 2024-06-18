$(document).ready(function () {
    // Dinge, die immer ausgeführt werden, wenn das Dokument vollständig geladen ist
    loadCart(); // Warenkorb laden
    loadOrders(); // Bestellungen laden
    loadRechnung(); // Rechnung laden
    $('#order').hide(); // Bestellbereich ausblenden

    // Dinge, die ausgeführt werden, wenn ein bestimmtes Ereignis eintritt
    $("#btn_Kat").click(function (e) {
        loadProductyByCategory($("#kategorie").val()); // Produkte nach Kategorie laden
    });

    $('#registrierung').on('submit', function(event) {
        event.preventDefault(); // Standardformularübermittlung verhindern
        registerUser(); // Benutzer registrieren
    });

    $('#login').on('submit', function(event) {
        event.preventDefault(); // Standardformularübermittlung verhindern
        login(); // Benutzer einloggen
    });

    $('#logout').on('submit', function(event) {
        event.preventDefault(); // Standardformularübermittlung verhindern
        logout(); // Benutzer ausloggen
    });

    $('#searchInput').on('input', function() {
        searchProducts(); // Produkte suchen
    });
});

// Funktionen, die bei Klick auf eine ID/Klasse ausgeführt werden
$(document).on("click", ".product", addtoCart);
$(document).on("click", ".add", addOnetoCart);
$(document).on("click", ".subtract", subtractfromCard);
$(document).on("click", "#order", order);
$(document).on("click", ".rechnung", rechnung);
$(document).on("click", "#adm_product_load", loaddata);
$(document).on("click", "#adm_product_add", addproduct);
$(document).on("click", ".edit", editProduct);
$(document).on("click", ".delete", deleteProduct);
$(document).on("click", ".ed-save", editDB);
$(document).on("click", ".ad-sa", addDB);

// Funktion zur Gruppierung und Zählung der Elemente in einem Array
function groupAndCount(array) {
    // Initialisieren eines leeren Objekts für die Zählungen
    const counts = {};

    // Durchlaufen jedes Elements im Array
    array.forEach(value => {
        // Überprüfen, ob der Wert bereits im counts-Objekt existiert
        if (counts[value]) {
            // Wenn der Wert bereits existiert, die Zählung um eins erhöhen
            counts[value]++;
        } else {
            // Wenn der Wert noch nicht existiert, ihn mit einer Zählung von 1 hinzufügen
            counts[value] = 1;
        }
    });

    // Das Objekt mit den Zählungen zurückgeben
    return counts;
}


// Funktion zum Laden und Anzeigen der Produktdaten
function loaddata() {
    // Leeren der HTML-Elemente mit den IDs "adm_products" und "edit_product"
    $("#adm_products").empty();
    $("#edit_product").empty();
    // Anzeigen des HTML-Elements mit der ID "adm_products"
    $("#adm_products").show();
    
    // AJAX-Anfrage zum Abrufen der Produktdaten
    $.ajax({
        // Anfrage-Typ: GET
        type: "GET",
        // URL des Serverskripts
        url: "../../backend/serviceHandler.php",
        // Cache deaktivieren
        cache: false,
        // Daten, die an den Server gesendet werden
        data: {method: "queryProducts"},
        // Erwarteter Datentyp der Antwort: JSON
        dataType: "json",
        // Funktion, die bei erfolgreicher Anfrage ausgeführt wird
        success: function (response) {
            // Ausgabe der Antwort in der Konsole
            console.log(response);
            
            // Durchlaufen der Antwortdaten und Verarbeiten jedes Produkts
            $.each(response, function(key, val) { 
                // Extrahieren der Produktdaten
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                var desc = val["description"];
                var stock = val["stock"];
                
                // Hinzufügen eines neuen Div-Elements für jedes Produkt
                $("#adm_products").append("<div id='"+id+"'><h2>"+name+"</h2> </div>");
                // Hinzufügen von Produktdetails zum neuen Div-Element
                $("#"+id).append("<br>insert foto<br>");
                $("#"+id).append("ID: " + id);
                $("#"+id).append("<h3>Preis: " + price + "</h3>");
                $("#"+id).append("aktueller Lagerstand: " + stock + "<br>");
                $("#"+id).append("Beschreibung: " + desc + "<br>");
                $("#"+id).append("<p id=" + id + " class='edit'>Bearbeiten</p>");
                $("#"+id).append("<p id=" + id + " class='delete'>Produkt löschen</p>");
                $("#"+id).append("<br>");
            });
        },
        // Funktion, die bei einem Fehler während der Anfrage ausgeführt wird
        error: function(jqXHR, textStatus, errorThrown) {
            // Ausgabe der Fehlermeldung in der Konsole
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Laden von Produkten nach Kategorie
function loadProductyByCategory(category) {
    console.log("Funktion aufgerufen")
    console.log(category)
    
    // AJAX-Anfrage zum Abrufen der Produkte einer bestimmten Kategorie
    $.ajax({
        type: "GET", // Anfragetyp GET
        url: "../../backend/serviceHandler.php", // URL des Serverskripts
        cache: false, // Caching deaktivieren
        data: {method: "queryProductsByCategory", param: category}, // Daten, die an den Server gesendet werden
        dataType: "json", // Erwarteter Datentyp der Antwort: JSON
        
        // Erfolgsfunktion, die ausgeführt wird, wenn die Anfrage erfolgreich ist
        success: function (response) {
            console.log(response)
            $("#products").empty(); // Leeren des HTML-Elements mit der ID "products"
            
            // Durchlaufen der Antwortdaten und Verarbeiten jedes Produkts
            $.each(response, function(key, val) {  
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                var desc = val["description"];
                var stock = val["stock"];
                
                // Hinzufügen eines neuen Div-Elements für jedes Produkt
                $("#products").append("<div id=" + id + "> <h2>" + name + "</h2> </div>");
                $("#"+id).append("<img src='../res/img/" + id + ".jpg'><br>")
                $("#"+id).append("ID: " + id)
                $("#"+id).append("<h3>Preis: " + price + "</h3>")
                $("#"+id).append("aktueller Lagerstand: " + stock + "<br>")
                $("#"+id).append("Beschreibung: " + desc + "<br>")
                $("#"+id).append("<p id=" + id + " class='product'>In den Warenkorb legen</p>")
                $("#"+id).append("<br>")
            });
        },
        
        // Fehlerfunktion, die ausgeführt wird, wenn die Anfrage fehlschlägt
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Hinzufügen eines Produkts zum Warenkorb
function addtoCart() {
    console.log("Zum Warenkorb hinzufügen aufgerufen");
    var triggerElement = $(this).attr("id");
    // AJAX-POST-Anfrage, um ein Produkt zum Warenkorb hinzuzufügen
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "addtoCart", param: triggerElement },
        dataType: "json",
        success: function (response) {
            $('#currentAmount').text(response); // Aktualisieren der aktuellen Anzahl im Warenkorb
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Laden und Anzeigen des Warenkorbs
function loadCart() {
    $("#cartproducts").empty(); // Leeren des Warenkorbbereichs
    // AJAX-GET-Anfrage, um den Warenkorb zu laden
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "loadCart" },
        dataType: "json",
        success: function (response) {
            var total_cost = 0;
            amountperItem = groupAndCount(response);
            console.log(amountperItem);
            // Durchlaufen der Produkte im Warenkorb
            $.each(amountperItem, function (key, value) {
                $.ajax({
                    type: "GET",
                    url: "../../backend/serviceHandler.php",
                    cache: false,
                    data: { method: "loadProductByID", param: key },
                    dataType: "json",
                    success: function (response) {
                        $.each(response, function (ky, val) {
                            var name = val["name"];
                            var id = val["id"];
                            var price = val["price"];
                            var amount = value;
                            console.log(name);
                            console.log(amount);
                            // Hinzufügen von Produktdetails zum Warenkorbbereich
                            $("#cartproducts").append("<br><div id=" + id + "> <h2>" + name + "</h2> </div>");
                            $("#" + id).append("<h3>Preis: " + price + "</h3>");
                            $("#" + id).append("<h3>Stück: " + amount + "</h3>");
                            $("#" + id).append("<button id='" + id + "' class='add'>Anzahl um 1 erhöhen</button><br>");
                            $("#" + id).append("<button id='" + id + "' class='subtract'>Anzahl um 1 reduzieren</button>");
                            total_cost += price * amount;
                            $('#total').text("Gesamtkosten: " + total_cost);
                            $('#order').show();
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
                    }
                });
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zur Benutzerregistrierung
function registerUser() {
    console.log("Funktion aufgerufen");
    var anrede = $('#anrede').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var pword = $('#pword').val();
    var adresse = $('#adresse').val();
    var plz = $('#plz').val();
    var ort = $('#ort').val();
    var username = $('#username').val();
    var formdata = { anrede, fname, lname, email, pword, adresse, plz, ort, username };
    console.log(formdata);
    // AJAX-POST-Anfrage zur Registrierung eines neuen Benutzers
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "addUser", param: formdata },
        dataType: "json",
        success: function (response) {
            console.log(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}
// Funktion zur Benutzeranmeldung
function login() {
    var username = $('#username').val();
    var pword = $('#pword').val();
    var data = { username, pword };
    // AJAX-POST-Anfrage zur Anmeldung eines Benutzers
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "login", param: data },
        dataType: "json",
        success: function (response) {
            console.log(response);
            window.location.href = "logout.php";
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Benutzer-Logout
function logout() {
    console.log("aufgerufen");
    // AJAX-POST-Anfrage zum Logout des Benutzers
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "logout" },
        dataType: "json",
        success: function (response) {
            if (response.success) {
                console.log(response);
            } else {
                console.log("Logout fehlgeschlagen");
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log("Fehler");
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
    location.href = "login.php"; // Umleiten zur Login-Seite
}


// Funktion zum Bearbeiten eines Produkts
function editProduct() {
    console.log("Edit aufgerufen");
    $("#meldungen").empty();
    var triggerElement = $(this).attr("id");
    $("#adm_products").hide();
    // AJAX-GET-Anfrage zum Abrufen der Produktdaten
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "loadProductByID", param: triggerElement },
        dataType: "json",
        success: function (response) {
            $.each(response, function (ky, val) {
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                console.log(name);
                $("#edit_product").append("<br><div id=ed" + id + "></div>");
                $("#ed" + id).append("<input type='text' id='ed-name' value='" + name + "'><br>");
                $("#ed" + id).append("<input type='text' id='ed-price' value=" + price + "><br><br>");
                $("#ed" + id).append("<p>Neues Produktbild hochladen</p>");
                $("#ed" + id).append('<input type="file" id="ed-pic"><br>');
                $("#ed" + id).append("<button class='btn btn-success ed-save' id='sa" + id + "'>Speichern</button>");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Speichern der Änderungen an einem Produkt in der Datenbank
function editDB() {
    var triggerElement = $(this).attr("id").substring(2);
    var newName = $('#ed-name').val();
    var newPrice = $('#ed-price').val();
    var newData = { triggerElement, newName, newPrice };
    console.log(newData);
    // AJAX-POST-Anfrage zum Speichern der Änderungen
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "editProduct", param: newData },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $('#edit_product').empty();
            $("#meldungen").append("<p>Änderungen erfolgreich durchgeführt!</p>");
            $("#adm_products").show();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Reduzieren der Anzahl eines Produkts im Warenkorb
function subtractfromCard() {
    console.log("Eines vom Warenkorb reduzieren aufgerufen");
    var triggerElement = $(this).attr("id");
    // AJAX-POST-Anfrage zum Reduzieren der Anzahl eines Produkts im Warenkorb
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "subtractfromCard", param: triggerElement },
        dataType: "json",
        success: function (response) {
            $('#currentAmount').text(response);
            loadCart(); // Warenkorb neu laden
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Erhöhen der Anzahl eines Produkts im Warenkorb
function addOnetoCart() {
    console.log("Eines zum Warenkorb hinzufügen aufgerufen");
    var triggerElement = $(this).attr("id");
    // AJAX-POST-Anfrage zum Erhöhen der Anzahl eines Produkts im Warenkorb
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "addtoCart", param: triggerElement },
        dataType: "json",
        success: function (response) {
            $('#currentAmount').text(response);
            loadCart(); // Warenkorb neu laden
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zur Produktsuche
function searchProducts() {
    var searchTerm = $('#searchInput').val().trim();
    console.log(searchTerm);
    // AJAX-GET-Anfrage zur Produktsuche
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "searchProducts", param: searchTerm },
        dataType: "json",
        success: function (response) {
            $("#products").empty(); // Leeren des Produktbereichs
            // Durchlaufen der Suchergebnisse
            $.each(response, function (key, val) {
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                var desc = val["description"];
                var stock = val["stock"];
                // Hinzufügen der Suchergebnisse zum Produktbereich
                $("#products").append("<div id=" + id + "> <h2>" + name + "</h2> </div>");
                $("#" + id).append("<img src='../res/img/" + id + ".jpg'><br>");
                $("#" + id).append("ID: " + id);
                $("#" + id).append("<h3>Preis: " + price + "</h3>");
                $("#" + id).append("aktueller Lagerstand: " + stock + "<br>");
                $("#" + id).append("Beschreibung: " + desc + "<br>");
                $("#" + id).append("<p id=" + id + " class='product'>In den Warenkorb legen</p>");
                $("#" + id).append("<br>");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#products").empty(); // Leeren des Produktbereichs im Fehlerfall
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Bestellen der im Warenkorb befindlichen Produkte
function order() {
    console.log("Bestellung aufgerufen");
    // AJAX-GET-Anfrage zum Erstellen einer neuen Bestellung
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "order" },
        dataType: "json",
        success: function (response) {
            console.log(response);
            var respo = response["id"];
            console.log(respo);
            // AJAX-GET-Anfrage zum Hinzufügen der Produkte des Warenkorbs zur Bestellung
            $.ajax({
                type: "GET",
                url: "../../backend/serviceHandler.php",
                cache: false,
                data: { method: "addCartToOrder", param: respo },
                dataType: "json",
                success: function (resp) {
                    console.log(resp);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
                }
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Laden und Anzeigen der Bestellungen
function loadOrders() {
    // AJAX-GET-Anfrage zum Abrufen der Bestellungen
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "loadOrders" },
        dataType: "json",
        success: function (response) {
            // Durchlaufen der Bestellungen in der Antwort
            $.each(response, function (key, val) {
                var id = val["id"];
                var order_date = val["order_date"];
                var prices = val["prices"];
                var products = val["products"];
                var quantities = val["quantities"];
                // Hinzufügen der Bestelldetails zum HTML-Element mit der ID "orders"
                $("#orders").append("<div id=or" + id + "> <h2>Bestellung Nummer " + id + "</h2> </div>");
                $("#or" + id).append("Datum: " + order_date);
                $("#or" + id).append("<p id=r" + id + " class='rechnung'>Rechnung erstellen</p>");
                $("#or" + id).append("<br>");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Erstellen einer Rechnung
function rechnung() {
    var triggerElement = $(this).attr("id").substring(1);
    console.log(triggerElement);
    // AJAX-GET-Anfrage zum Abrufen der Bestelldaten
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "loadOrderByID", param: triggerElement },
        dataType: "json",
        success: function (response) {
            console.log(response);
            localStorage.setItem('order', JSON.stringify(response)); // Speichern der Bestelldaten im lokalen Speicher
            window.open('../pages/rechnung.html', '_blank'); // Öffnen der Rechnungsseite in einem neuen Tab
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Laden und Anzeigen der Rechnung
function loadRechnung() {
    var total_price = 0;
    var order = JSON.parse(localStorage.getItem('order')); // Abrufen der gespeicherten Bestelldaten
    console.log(order);
    $('#nummer').text('Rechnungsnummer: ' + order['id']);
    $('#datum').text('Datum: ' + order['order_date']);

    // Durchlaufen der Produkte in der Bestellung
    $.each(order['products'], function (key, val) {
        pr_nm = key + 1;
        console.log(val);
        $("#rechnungsprodukte").append("<div id=pr" + val + "> <h2>Produkt Nummer " + pr_nm + "</h2> </div>");

        // AJAX-GET-Anfrage zum Abrufen der Produktdetails
        $.ajax({
            type: "GET",
            url: "../../backend/serviceHandler.php",
            cache: false,
            data: { method: "loadProductByID", param: val },
            dataType: "json",
            success: function (response) {
                $.each(response, function (key, values) {
                    nam = values["name"];
                    pri = values["price"];
                    $("#pr" + val).append("ID: " + val);
                    $("#pr" + val).append("<br>Name: " + nam);
                    $("#pr" + val).append("<br>Menge: " + order['quantities'][key]);
                    $("#pr" + val).append("<br>Preis pro Stück: " + pri);
                    $("#pr" + val).append("<br>Preis: " + order['quantities'][key] * pri);
                    $("#pr" + val).append("<br>");
                    $("#pr" + val).append("<br>");
                    total_price += order['quantities'][key] * pri;
                    console.log(total_price);
                    $("#total").text("Gesamtsumme: " + total_price);
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
            }
        });

        // AJAX-GET-Anfrage zum Abrufen der Benutzerdaten
        $.ajax({
            type: "GET",
            url: "../../backend/serviceHandler.php",
            cache: false,
            data: { method: "getUserData" },
            dataType: "json",
            success: function (response) {
                $("#anschrift").html("Anschrift:<br>" + response["adresse"] + "<br>" + response["plz"] + " " + response["ort"]);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
            }
        });
    });
}


// Funktion zum Hinzufügen eines neuen Produkts
function addproduct() {
    console.log("addProduct aufgerufen");
    // Leeren des Meldungsbereichs
    $("#meldungen").empty();
    // Verstecken des Bereichs mit den administrativen Produkten
    $("#adm_products").hide();
    // Leeren des Bearbeitungsbereichs für Produkte
    $("#edit_products").empty();
    // Leeren des Bereichs für die Produktdaten
    $("#add").empty();
    // Hinzufügen eines neuen div-Elements mit der ID 'add' zum Bearbeitungsbereich
    $("#edit_product").append("<br><div id='add'></div>");
    
    // Hinzufügen der Eingabefelder für das neue Produkt
    $("#add").append("<input type='text' id='ad-name' placeholder='Name des Produktes'><br>");
    $("#add").append("<input type='text' id='ad-price' placeholder='Preis des Produktes'><br>");
    $("#add").append("<input type='text' id='ad-desc' placeholder='Beschreibung des Produktes'><br><br>");
    $("#add").append("<input type='text' id='ad-kat' placeholder='Kategorie des Produktes'><br><br>");
    $("#add").append("<p>Produktbild hochladen</p>");
    $("#add").append('<input type="file" id="ad-pic"><br>');
    $("#add").append("<button class='btn btn-success ad-sa' id='ad-sa'>Speichern</button>");

    //AJAX-GET-Anfrage zum Abrufen der Produktdetails
    $.ajax({
        type: "GET", // Anfragetyp GET
        url: "../../backend/serviceHandler.php", // URL des Serverskripts
        cache: false, // Caching deaktivieren
        data: { method: "loadProductByID", param: triggerElement }, // Senden der Methode und des Parameters
        dataType: "json", // Erwarteter Datentyp der Antwort: JSON
        success: function (response) {
            // Verarbeitung der erfolgreichen Antwort
            $.each(response, function (ky, val) {
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                console.log(name);
                // Leeren des Bereichs 'add'
                $("#add").empty();
            });
        },
        // Fehlerbehandlung bei der Anfrage
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}



// Funktion zum Löschen eines Produkts
function deleteProduct() {
    console.log("deleteProduct aufgerufen");
    var triggerElement = $(this).attr("id");
    $('#adm_products').empty();
    $('#meldungen').empty();
    // AJAX-POST-Anfrage zum Löschen eines Produkts
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "deleteProduct", param: triggerElement },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#meldungen").append("<p>Produkt erfolgreich gelöscht</p>");
            loaddata(); // Produkte neu laden
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}


// Funktion zum Speichern eines neuen Produkts in der Datenbank
function addDB() {
    var adName = $('#ad-name').val();
    var adPrice = $('#ad-price').val();
    var adDesc = $('#ad-desc').val();
    var adKat = $('#ad-kat').val();
    var newPr = { adName, adPrice, adDesc, adKat };
    // AJAX-POST-Anfrage zum Hinzufügen eines neuen Produkts
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: { method: "addProduct", param: newPr },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#meldungen").append("<p>Produkt erfolgreich hinzugefügt!</p>");
            loaddata(); // Produkte neu laden
            $("#adm_products").show();
            $("#edit_products").empty();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}

    


