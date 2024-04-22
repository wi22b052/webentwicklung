<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../res/includes/head.php'?>
<title>LogIn</title>
</head>
<body>
<!--Header Section-->
<header class="header">
<?php include '../res/includes/header.php' ?>
</header>
<br>
<br>
<br>
<br>
<h1>LogIn</h1>
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Du hast schon ein Konto?</h5>
      <p class="card-text"><fieldset>
        <form action="../databaselogic/selectuser.php" method="POST">
            <label for="email">E-Mail-Adresse</label><br>
            <input class="form-control" required type="email" name="email" placeholder="E-Mail-Adresse" ><br>
            <label for="pword1">Passwort</label><br>
            <input type="password" id="pword1" name="pword1" /> <br><br>
        </form>
    </fieldset></p>
      <a href="#" class="btn btn-primary">Anmelden</a>
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
      <a href="reg.html" class="btn btn-primary">Jetzt registrieren</a>
    </div>
  </div>

    
</body>
</html>