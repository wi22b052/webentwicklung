$(document).ready(function () {

    //Dinge die immer ausgeführt werden
    loadCart();
    loadOrders();
    loadRechnung();
    $('#order').hide();

    //Dinge, die ausgeführt werden, wenn etwas zutritt/passiert
    $("#btn_Kat").click(function (e) {
        loadProductyByCategory($("#kategorie").val());
     });
    

    $('#registrierung').on('submit', function(event) {
        event.preventDefault();
        registerUser();
    });

    $('#login').on('submit', function(event) {
        event.preventDefault();
        login();
    });

    $('#logout').on('submit', function(event) {
        event.preventDefault();
        logout();
    });

    $('#adm_product').click(function (e) {
        loaddata();
    });

    $('#searchInput').on('input', function() {
        searchProducts();
    })
});

//Funktionen, die bei Klick auf eine ID/Klasse ausgeführt werden.
$(document).on("click",".product",addtoCart);
$(document).on("click",".edit",editProduct);
$(document).on("click",".add",addOnetoCart);
$(document).on("click",".subtract",subtractfromCard);
$(document).on("click","#order",order);
$(document).on("click",".rechnung",rechnung);

function groupAndCount(array) {
    const counts = {};

    array.forEach(value => {
        if (counts[value]) {
            counts[value]++;
        } else {
            counts[value] = 1;
        }
    });

    return counts;
}

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
                $("#adm_products").append("<div id='"+id+"'<h2>"+name+"</h2> </div>");
                $("#"+id).append("<br>insert foto"+"<br>")
                $("#"+id).append("ID: "+id)
                $("#"+id).append("<h3>Preis: "+price+"</h3>")
                $("#"+id).append("aktueller Lagerstand: "+stock+"<br>")
                $("#"+id).append("Beschreibung: "+desc+"<br>")
                $("#"+id).append("<p id="+id+" class='edit'>Bearbeiten</p>")
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
                $("#"+id).append("<img src='../res/img/"+id+".jpg'>"+"<br>")
                $("#"+id).append("ID: "+id)
                $("#"+id).append("<h3>Preis: "+price+"</h3>")
                $("#"+id).append("aktueller Lagerstand: "+stock+"<br>")
                $("#"+id).append("Beschreibung: "+desc+"<br>")
                $("#"+id).append("<p id="+id+" class='product'>In den Warenkorb legen</p>")
                $("#"+id).append("<br>")
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    });
}

function addtoCart(){
    console.log("Zum Warenkorb hinzufügen aufgerufen");
    var triggerElement = $(this).attr("id");
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "addtoCart", param: triggerElement},
        dataType: "json",
        success: function (response) {
            $('#currentAmount').text(response)
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    })
}

function loadCart(){
    $("#cartproducts").empty();
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "loadCart"},
        dataType: "json",
        success: function (response) {
            var total_cost = 0;
            amountperItem = groupAndCount(response)
            console.log(amountperItem)
            $.each(amountperItem, function(key, value){
                $.ajax({
                    type: "GET",
                    url: "../../backend/serviceHandler.php",
                    cache: false,
                    data: {method: "loadProductByID", param: key},
                    dataType: "json",
                    success: function (response) {
                        $.each(response, function( ky, val ) {  
                            var name = val["name"];
                            var id = val["id"];
                            var price = val["price"];
                            var amount = value;
                            console.log(name)
                            console.log(amount)
                            $("#cartproducts").append("<br><div id="+id+"> <h2>"+name+"</h2> </div>");
                            $("#"+id).append("<h3>Preis: "+price+"</h3>")
                            $("#"+id).append("<h3>Stück: "+amount+"</h3>")
                            $("#"+id).append("<button id='"+id+"' class='add'>Anzahl um 1 erhöhen</button><br>")
                            $("#"+id).append("<button id='"+id+"' class='subtract'>Anzahl um 1 reduzieren</button>")
                            total_cost += price*amount
                            $('#total').text("Gesamtkosten: "+total_cost)
                            $('#order').show();
                        })
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
                    }  
                })

            })
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }  
    })
    
}

function registerUser(){
    console.log("Funktion aufgerufen")
    anrede = $('#anrede').val();
    fname = $('#fname').val();
    lname = $('#lname').val();
    email = $('#email').val();
    pword = $('#pword').val();
    adresse = $('#adresse').val();
    plz = $('#plz').val();
    ort = $('#ort').val();
    username = $('#username').val();
    formdata = {anrede,fname,lname,email,pword,adresse,plz,ort,username}
    console.log(formdata)
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "addUser", param:formdata},
        dataType: "json",
        success: function (response) {
                console.log(response)
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    })
}

function login(){
    username = $('#username').val()
    pword = $('#pword').val()
    data = {username, pword}
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "login", param: data},
        dataType: "json",
        success: function (response) {
                console.log(response)
                window.location.href = "logout.php";
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    })
}

function logout(){
    console.log("aufgerufen");
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "logout"},
        dataType: "json",
        success: function (response) {
            if (response.success) {
                console.log(response)
            }else {
                // Logout war nicht erfolgreich
                console.log("Logout fehlgeschlagen");
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log("Fehler")
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    })
    location.href = "login.php";
}

function editProduct(){
    console.log("Edit aufgerufen");
    var triggerElement = $(this).attr("id");
    document.getElementById("adm_products").style.display = "none";

    var editDiv = document.getElementById("edit_product");

    //Load from DB

    var pr_nam = document.createElement("input");
    var pr_desc = document.createElement("input");
    var pr_price = document.createElement("input");



    var saveButton = document.createElement("button");
    saveButton.innerHTML = "Speichern";

    saveButton.addEventListener("click", function() {
        editDB();
    });

    editDiv.appendChild(inputField);
    editDiv.appendChild(saveButton);
}

function editDB(){
    console.log("DB aufgerufen hahahah");
}

function subtractfromCard(){
    console.log("Eines vom Warenkorb reduzieren aufgerufen");
    var triggerElement = $(this).attr("id");
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "subtractfromCard", param: triggerElement},
        dataType: "json",
        success: function (response) {
            $('#currentAmount').text(response);
            loadCart();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    })
}

function addOnetoCart(){
    console.log("Eines vom Warenkorb reduzieren aufgerufen");
    var triggerElement = $(this).attr("id");
    $.ajax({
        type: "POST",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "addtoCart", param: triggerElement},
        dataType: "json",
        success: function (response) {
            $('#currentAmount').text(response)
            loadCart();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
        
    })
}

function searchProducts(){
    var searchTerm = $('#searchInput').val().trim();
    console.log(searchTerm);
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "searchProducts", param: searchTerm},
        dataType: "json",
        success: function (response) {
            $("#products").empty();
            $.each(response, function( key, val ) {  
                var name = val["name"];
                var id = val["id"];
                var price = val["price"];
                var desc = val["description"];
                var stock = val["stock"];
                $("#products").append("<div id="+id+"> <h2>"+name+"</h2> </div>");
                $("#"+id).append("<img src='../res/img/"+id+".jpg'>"+"<br>")
                $("#"+id).append("ID: "+id)
                $("#"+id).append("<h3>Preis: "+price+"</h3>")
                $("#"+id).append("aktueller Lagerstand: "+stock+"<br>")
                $("#"+id).append("Beschreibung: "+desc+"<br>")
                $("#"+id).append("<p id="+id+" class='product'>In den Warenkorb legen</p>")
                $("#"+id).append("<br>")
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#products").empty();
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }  
    })
}

function order(){
    console.log("Bestellung aufgerufen");
}

function loadOrders(){
    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "loadOrders"},
        dataType: "json",
        success: function (response) {
            $.each(response, function( key, val ) {  
                var id = val["id"];
                var order_date = val["order_date"];
                var prices = val["prices"];
                var products = val["products"];
                var quantities = val["quantities"];
                $("#orders").append("<div id=or"+id+"> <h2>Bestellung Nummer "+id+"</h2> </div>");
                $("#or"+id).append("Datum: "+order_date)
                $("#or"+id).append("<p id=r"+id+" class='rechnung'>Rechnung erstellen</p>")
                $("#or"+id).append("<br>")
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }  
    })
}

function rechnung(){
    var triggerElement = $(this).attr("id").substring(1);
    console.log(triggerElement);

    $.ajax({
        type: "GET",
        url: "../../backend/serviceHandler.php",
        cache: false,
        data: {method: "loadOrderByID", param: triggerElement},
        dataType: "json",
        success: function (response) {
            console.log(response)
            localStorage.setItem('order', JSON.stringify(response));
            window.open('../pages/rechnung.html', '_blank');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }  
    })
}

function loadRechnung(){
    var total_price = 0;
    var order = JSON.parse(localStorage.getItem('order'));
    console.log(order);
    $('#nummer').text('Rechnungsnummer: '+order['id']);
    $('#datum').text('Datum: '+order['order_date']);

    $.each(order['products'], function(key,val) {
        pr_nm = key+1;
        console.log(val)
    $("#rechnungsprodukte").append("<div id=pr"+val+"> <h2>Produkt Nummer "+pr_nm+"</h2> </div>");
        

        $.ajax({
            type: "GET",
            url: "../../backend/serviceHandler.php",
            cache: false,
            data: {method: "loadProductByID", param: val},
            dataType: "json",
            success: function (response) {
                $.each(response, function(key, values) {
                    nam = values["name"];
                    $("#pr"+val).append("ID: "+val)
                    $("#pr"+val).append("<br>Name: "+nam);
                    $("#pr"+val).append("<br>Menge: "+order['quantities'][key])
                    $("#pr"+val).append("<br>Preis pro Stück: "+order['prices'][key])
                    $("#pr"+val).append("<br>Preis: "+order['quantities'][key] * order['prices'][key]);
                    $("#pr"+val).append("<br>")
                    $("#pr"+val).append("<br>")
                    total_price += order['quantities'][key] * order['prices'][key];
                    console.log(total_price)
                    $("#total").text("Gesamtsumme: "+total_price)
                })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
            }  
        })

        $.ajax({
            type: "GET",
            url: "../../backend/serviceHandler.php",
            cache: false,
            data: {method: "getUserData"},
            dataType: "json",
            success: function (response) {
                $("#anschrift").html("Anschrift:<br>"+response["adresse"]+"<br>"+response["plz"]+" "+response["ort"])
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
            }  
        })

    })
}
    


