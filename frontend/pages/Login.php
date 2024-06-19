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


<h1>LogIn</h1>
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Du hast schon ein Konto?</h5>
      <p class="card-text"><fieldset>
        <form id="login">
            <label for="username">Benutzername</label><br>
            <input class="form-control" required type="text" id="username" name="username"><br>
            <label for="pword1">Passwort</label><br>
            <input type="password" id="pword" name="pword" /> <br><br>
            <button type="submit" class="btn btn-primary">Anmelden</b>
        </form>
    </fieldset></p>
      
    </div>
  </div>
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Du bist noch nicht registriert?</h5>
      <p class="card-text">
        Übersicht über deine Bestellungen
        Deine Wunschliste auf allen Geräten
        Schnellerer, simpler Checkout
    </p>
    <br>
    <br>
      <a href="reg.php" class="btn btn-primary">registrieren</a>
    </div>
  </div>

    
</body>
</html>