<?php
session_start();
include '../../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist und Administratorberechtigungen hat
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Nur Administratoren haben Zugriff auf diese Funktion";
    exit;
}

// Produkt bearbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    // Beispiel: SQL-Befehl vorbereiten
    $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id='$productId'";

    // Beispiel: SQL-Befehl ausführen
    if ($conn->query($sql) === TRUE) {
        echo "Produkt wurde erfolgreich bearbeitet";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
