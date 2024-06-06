<?php
session_start();
include '../../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist und Administratorberechtigungen hat
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Nur Administratoren haben Zugriff auf diese Funktion";
    exit;
}

// Gutscheine verwalten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hier je nach Bedarf die Aktionen implementieren, z. B. Gutscheincode generieren, Gutschein einlösen, Gutscheine anzeigen
    // Beispiel: Gutscheincode generieren
    $code = generateCouponCode();
    $value = $_POST['value'];
    $expirationDate = $_POST['expiration_date'];

    // Beispiel: SQL-Befehl vorbereiten
    $sql = "INSERT INTO coupons (code, value, expiration_date) VALUES ('$code', '$value', '$expirationDate')";

    // Beispiel: SQL-Befehl ausführen
    if ($conn->query($sql) === TRUE) {
        echo "Gutschein erfolgreich erstellt";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

// Gutscheine aus der Datenbank abrufen und anzeigen
$sql = "SELECT * FROM coupons";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Alle Gutscheine</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "Gutscheincode: " . $row["code"] . " - Wert: " . $row["value"] . " - Ablaufdatum: " . $row["expiration_date"] . "<br>";
    }
} else {
    echo "Keine Gutscheine gefunden";
}

$conn->close();

// Funktion zum Generieren eines zufälligen Gutscheincodes
function generateCouponCode() {
    $length = 5;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $couponCode = '';

    for ($i = 0; $i < $length; $i++) {
        $couponCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $couponCode;
}
