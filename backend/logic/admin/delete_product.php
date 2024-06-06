<?php
session_start();
include '../../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist und Administratorberechtigungen hat
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Nur Administratoren haben Zugriff auf diese Funktion";
    exit;
}

// Produkt löschen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['product_id'];

    // Beispiel: SQL-Befehl vorbereiten
    $sql = "DELETE FROM products WHERE id='$productId'";

    // Beispiel: SQL-Befehl ausführen
    if ($conn->query($sql) === TRUE) {
        echo "Produkt wurde erfolgreich gelöscht";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
