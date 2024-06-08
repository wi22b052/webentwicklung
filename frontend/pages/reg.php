<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regestrierung</title>
<!--font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-K6uIw7i6H6I4o1mg05f7fZu0sp6/i7v9U+nhXQIR3I=" crossorigin="anonymous"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" 
integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!--css file-->
<link rel="stylesheet" href="../res/css/style.css">
<!--js file-->
<script src="frontend/js/script.js"></script>
</head>

<body>
<?php
include '../pages/header.php'
?>
<br>
<br>
<br>
<br>
<h1>Regestrierung</h1>
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Möchtest du ein Fun4Fans Konto anlegen?</h5>
      <p class="card-text"><fieldset>
        <form action="#" method="POST">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
                <label class="form-check-label" for="flexRadioDisabled">
                  Mann 
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" checked disabled>
                <label class="form-check-label" for="flexRadioCheckedDisabled">
                  Frau 
                </label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" checked disabled>
                    <label class="form-check-label" for="flexRadioCheckedDisabled">
                     Divers
                    </label>
              </div>
            <label for="fname">Vorname</label><br>
            <input type="text" id="fname" name="fname" required /><br><br>
            <label for="lname">Nachname</label><br>
            <input type="text" id="lname" name="lname" required /><br><br>
            <label for="email">E-Mail-Adresse</label><br>
            <input class="form-control" required type="email" name="email" placeholder="E-Mail-Adresse" ><br>
             <!-- Eingabe des Passworts -->
             <label for="pword">Passwort*<br>Das Passwort muss aus 5-16 Zeichen bestehen.</label><br>
             <input type="password" id="pword1" name="pword1" minlength="5" maxlength="16" required placeholder="Passwort"><br><br>
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
            </form>
    </fieldset></p>
      <a href="#" class="btn btn-primary">Regestrierung absenden</a>
    </div>
  </div>

    
</body>
</html>