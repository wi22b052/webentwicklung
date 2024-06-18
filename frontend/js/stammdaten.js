$(document).ready(function () {
    // Lädt die Stammdaten, wenn das Dokument vollständig geladen ist
    loadStammdaten();
    
    // Event-Handler für das Absenden des Formulars mit der ID 'changeData'
    $('#changeData').on('submit', function(event) {
        event.preventDefault(); // Verhindert das Standard-Formular-Absendeverhalten
        updateUserData(); // Ruft die Funktion auf, um die Benutzerdaten zu aktualisieren
    });
});

// Funktion zum Laden der Stammdaten des Benutzers
function loadStammdaten() {
    // AJAX-GET-Anfrage zum Abrufen der Benutzerdaten
    $.ajax({
        type: "GET", // Anfragetyp GET
        url: "../../backend/serviceHandler.php", // URL des Serverskripts
        cache: false, // Caching deaktivieren
        data: { method: "getUserData" }, // Daten, die an den Server gesendet werden
        dataType: "json", // Erwarteter Datentyp der Antwort: JSON
        success: function (response) {
            // Verarbeitung der erfolgreichen Antwort
            console.log(response);
            // Füllen der Eingabefelder mit den abgerufenen Benutzerdaten
            $('#fname').val(response["fname"]);
            $('#lname').val(response["lname"]);
            $('#adresse').val(response["adresse"]);
            $('#plz').val(response["plz"]);
            $('#ort').val(response["ort"]);
            $('#username').val(response["username"]);
            $('#email').val(response["email"]);
        },
        // Fehlerbehandlung bei der Anfrage
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}

// Funktion zum Aktualisieren der Benutzerdaten
function updateUserData() {
    // Abrufen der Werte aus den Eingabefeldern
    var anrede = $('#anrede').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email = $('#email').val();
    var pword = $('#pword').val();
    var adresse = $('#adresse').val();
    var plz = $('#plz').val();
    var ort = $('#ort').val();
    var username = $('#username').val();
    
    // Erstellen eines Objekts mit den abgerufenen Daten
    var formdata = { anrede, fname, lname, email, pword, adresse, plz, ort, username };
    console.log(formdata);
    
    // AJAX-POST-Anfrage zum Aktualisieren der Benutzerdaten
    $.ajax({
        type: "POST", // Anfragetyp POST
        url: "../../backend/serviceHandler.php", // URL des Serverskripts
        cache: false, // Caching deaktivieren
        data: { method: "updateUser", param: formdata }, // Daten, die an den Server gesendet werden
        dataType: "json", // Erwarteter Datentyp der Antwort: JSON
        success: function (response) {
            // Verarbeitung der erfolgreichen Antwort
            console.log(response);
        },
        // Fehlerbehandlung bei der Anfrage
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Fehler bei der Anfrage: ", textStatus, errorThrown);
        }
    });
}
