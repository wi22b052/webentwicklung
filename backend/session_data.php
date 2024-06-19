<?php
// Überprüfen, ob keine Sitzung existiert, und starten einer neuen Sitzung
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Überprüfen, ob der Warenkorb (cart) in der Sitzung existiert, wenn nicht, initialisieren wir ihn als leeres Array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Lesen der Rohdaten der Anfrage und Dekodieren von JSON in ein assoziatives Array
$data = json_decode(file_get_contents('php://input'), true);

// Extrahieren des Produkts aus den empfangenen Daten
$product = $data['product'];

// Hinzufügen des Produkts zum Warenkorb in der Sitzung
$_SESSION['cart'][] = $product;

// Rückgabe einer JSON-Antwort, die den Status und den aktuellen Warenkorb enthält
echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);

