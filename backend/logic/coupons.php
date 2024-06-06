<?php
session_start();
include '../config/db_connection.php';

// Überprüfen, ob ein Benutzer angemeldet ist
if (!isset($_SESSION['username'])) {
    echo "Benutzer nicht angemeldet";
    exit;
}

// Administratorberechtigung überprüfen
if ($_SESSION['role'] !== 'admin') {
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

// Weitere Logik für andere Aktionen im Zusammenhang mit Gutscheinen

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
