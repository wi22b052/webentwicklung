<?php
session_start();
include '../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist
if (!isset($_SESSION['username'])) {
    echo "Benutzer nicht angemeldet";
    exit;
}

// Benutzername aus der Session erhalten
$username = $_SESSION['username'];

// Warenkorb bearbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hier je nach Bedarf die Aktionen implementieren, z. B. Produkt hinzufügen, entfernen oder Menge ändern
    // Beispiel: Produkt zum Warenkorb hinzufügen
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Beispiel: SQL-Befehl vorbereiten
    $sql = "INSERT INTO cart (username, product_id, quantity) VALUES ('$username', '$productId', '$quantity')";

    // Beispiel: SQL-Befehl ausführen
    if ($conn->query($sql) === TRUE) {
        echo "Produkt wurde dem Warenkorb hinzugefügt";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

// Weitere Logik für andere Aktionen im Warenkorb

$conn->close();
