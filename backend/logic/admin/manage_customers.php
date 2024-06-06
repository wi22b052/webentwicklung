<?php
session_start();
include '../../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist und Administratorberechtigungen hat
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Nur Administratoren haben Zugriff auf diese Funktion";
    exit;
}

// Kunden auflisten und Bestelldetails anzeigen
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Alle Kunden</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "Benutzername: " . $row["username"] . "<br>";
        // Hier können weitere Kundeninformationen angezeigt werden, je nach Bedarf
        echo "Bestelldetails:<br>";
        $userId = $row["id"];
        $ordersSql = "SELECT * FROM orders WHERE user_id='$userId'";
        $ordersResult = $conn->query($ordersSql);
        if ($ordersResult->num_rows > 0) {
            while ($orderRow = $ordersResult->fetch_assoc()) {
                echo "Bestellnummer: " . $orderRow["id"] . ", Produkt-ID: " . $orderRow["product_id"] . ", Menge: " . $orderRow["quantity"] . "<br>";
                // Hier können weitere Bestelldetails angezeigt werden, je nach Bedarf
            }
        } else {
            echo "Keine Bestellungen gefunden<br>";
        }
        echo "<br>";
    }
} else {
    echo "Keine Kunden gefunden";
}

$conn->close();
