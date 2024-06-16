<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einkaufskorb</title>
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" 
integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!--css file-->
<link rel="stylesheet" href="../res/css/style.css">
<!--js file-->

<script src="../js/script.js"></script>
</head>

<body>
<?php
include '../pages/header.php'
?>

Folgendes muss noch gelöscht werden und davor in CSS überarbeitet werden, damit es schön aussieht.
  <p>a</p>
  <p>a</p>
  <p>a</p>
  <p>a</p>
  <p>a</p>
  <p>a</p>
  <p>a</p>
<br>
<br>
<br>
<br>
<h1>Regestrierung</h1>
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Möchtest du ein Fun4Fans Konto anlegen?</h5>
      <p class="card-text">
        <form id="registrierung">
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
             <input type="text" id="pword" name="pword1" minlength="5" maxlength="16" required placeholder="Passwort"><br><br>
             <!-- Wiederholung der Passworteingabe -->
             <label for="pword">Passwort wiederholen*</label><br>
             <input type="password" id="pword2" name="pword2" minlength="5" maxlength="16" required placeholder="Passwort wiederholen">

             <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Ich möchte regelmäßig den Fun4Fans Newsletter über Trends und Neuigkeiten erhalten.
                </label>
              </div>
              <p> Wir nutzen die E-Mail-Adresse für die Zusendung von Informationen rund um deine Bestellung. Eine Abmeldung ist jederzeit möglich</p>
              <p>Mit der Absendung meiner Registrierung stimme ich Datenschutzrichtlinien zu.</p>
              <button type="submit">Registrierung absenden</button>
            </form>
    </p>
    </div>
  </div>

    
</body>
</html>