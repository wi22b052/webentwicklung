<?php
session_start();
include '../../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist und Administratorberechtigungen hat
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Nur Administratoren haben Zugriff auf diese Funktion";
    exit;
}

// Produkt hinzufügen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    // Beispiel: SQL-Befehl vorbereiten
    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";

    // Beispiel: SQL-Befehl ausführen
    if ($conn->query($sql) === TRUE) {
        echo "Produkt wurde erfolgreich hinzugefügt";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
