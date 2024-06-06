<?php
session_start();
include '../config/db_connection.php';

// Benutzeranmeldung
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL-Befehl vorbereiten
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    
    // SQL-Befehl ausführen
    $result = $conn->query($sql);

    // Benutzer existiert
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        echo "Login erfolgreich";
    } else {
        echo "Falscher Benutzername oder Passwort";
    }
}

$conn->close();
