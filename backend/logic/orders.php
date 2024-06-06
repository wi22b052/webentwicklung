<?php
session_start();
include '../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist
if (!isset($_SESSION['username'])) {
    echo "Benutzer nicht angemeldet";
    exit;
}

// Bestellungen verwalten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hier je nach Bedarf die Aktionen implementieren, z. B. Bestellungen anzeigen, Bestellung aufgeben, Bestellhistorie anzeigen
    // Beispiel: Bestellung aufgeben
    $username = $_SESSION['username'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Beispiel: SQL-Befehl vorbereiten
    $sql = "INSERT INTO orders (username, product_id, quantity) VALUES ('$username', '$productId', '$quantity')";

    // Beispiel: SQL-Befehl ausführen
    if ($conn->query($sql) === TRUE) {
        echo "Bestellung erfolgreich aufgegeben";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

// Weitere Logik für andere Aktionen im Zusammenhang mit Bestellungen

$conn->close();
