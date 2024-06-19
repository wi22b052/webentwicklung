<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include '../components/head.php' ?>
    <title>Einkaufskorb</title>
<script src="../js/stammdaten.js"></script>
</head>

<body>
<?php
include '../pages/header.php'
?>

    
<h1>Stammdaten</h1>
<div id="stammdaten" class="card">
    <div class="card-body">
      <h5 class="card-title">Möchtest du ein Fun4Fans Konto anlegen?</h5>
      <p class="card-text">
        <form id="changeData">
            <div class="form-check">
            <label for="anrede"  class="form-label">Geschlecht</label>
                  <select id="anrede" name="anrede" class="form-control" required>
                                <option>männlich</option>
                                <option>weiblich</option>
                                <option>divers</option>
                  </select><br>
            <label for="fname">Vorname</label><br>
            <input type="text" id="fname" name="fname" required /><br><br>
            <label for="lname">Nachname</label><br>
            <input type="text" id="lname" name="lname" required /><br><br>
            <label for="lname">Adresse</label><br>
            <input type="text" id="adresse" name="adresse" required /><br><br>
            <label for="lname">PLZ</label><br>
            <input type="text" id="plz" name="plz" required /><br><br>
            <label for="lname">Ort</label><br>
            <input type="text" id="ort" name="ort" required /><br><br>
            <label for="lname">Benutzername</label><br>
            <input type="text" id="username" name="username" required /><br><br>
            <label for="email">E-Mail-Adresse</label><br>
            <input class="form-control" id="email" required type="email" name="email" placeholder="E-Mail-Adresse" ><br>
             <!-- Eingabe des Passworts -->
             <label for="pword">Passwort*<br>Das Passwort muss aus 5-16 Zeichen bestehen.</label><br>
             <input type="password" id="pword" name="pword1" minlength="5" maxlength="16" required placeholder="Passwort"><br><br>
             <!-- Wiederholung der Passworteingabe -->
             <label for="pword">Passwort wiederholen*</label><br>
             <input type="password" id="pword2" name="pword2" minlength="5" maxlength="16" required placeholder="Passwort wiederholen">
             <br>
             <br>
             <button id="update" type="submit">Änderungen bestätigen</button>
            </form>
    </p>
    </div>
  </div>
<?php include '../components/footer.php' ?>
</body>