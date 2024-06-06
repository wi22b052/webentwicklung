<?php
include '../config/db_connection.php';

// Produkte anzeigen
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Produkte vorhanden
} else {
    // Keine Produkte gefunden
}

$conn->close();
