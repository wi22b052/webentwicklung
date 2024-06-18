<?php
// Einbinden der Datei "requestHandler.php", die die Klasse SimpleLogic definiert
include("logic/requestHandler.php");

// Initialisierung der Parameter
$param = "";
$method = "";

// Überprüfen, ob "method" und "param" in den GET-Parameter übergeben wurden und Zuweisung der Werte
isset($_GET["method"]) ? $method = $_GET["method"] : false;
isset($_GET["param"]) ? $param = $_GET["param"] : false;

// Überprüfen, ob "method" und "param" in den POST-Parameter übergeben wurden und Zuweisung der Werte
isset($_POST["method"]) ? $method = $_POST["method"] : false;
isset($_POST["param"]) ? $param = $_POST["param"] : false;

// Erstellung einer neuen Instanz der Klasse SimpleLogic
$logic = new SimpleLogic();

// Aufruf der Methode handleRequest mit den übergebenen Parametern und Speichern des Ergebnisses
$result = $logic->handleRequest($method, $param);

// Überprüfen, ob das Ergebnis null ist
if ($result == null) {
    // Wenn das Ergebnis null ist, wird eine Antwort mit dem Status 400 (Bad Request) zurückgegeben
    response("GET", 400, null);
} else {
    // Andernfalls wird eine Antwort mit dem Status 200 (OK) und dem Ergebnis zurückgegeben
    response("GET", 200, $result);
}

// Funktion zur Erstellung einer JSON-Antwort
function response($method, $httpStatus, $data)
{
    // Setzen des Content-Typs auf JSON
    header('Content-Type: application/json');
    // Switch-Case zur Verarbeitung verschiedener HTTP-Methoden
    switch ($method) {
        case "GET":
            // Setzen des HTTP-Statuscodes
            http_response_code($httpStatus);
            // Ausgabe der Daten als JSON
            echo (json_encode($data));
            break;
        default:
            // Bei nicht unterstützten Methoden wird der Statuscode 405 (Method Not Allowed) gesetzt
            http_response_code(405);
            echo ("Method not supported yet!");
    }   
}
