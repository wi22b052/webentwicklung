<?php
include '../config/db_connection.php';
include '../models/user.class.php';

// Benutzerregistrierung
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // SQL-Befehl vorbereiten
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

    // SQL-Befehl ausführen
    if ($conn->query($sql) === TRUE) {
        echo "Benutzer registriert erfolgreich";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
