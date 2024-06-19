<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include '../components/head.php' ?>
    <title>Einkaufskorb</title>
  
</head>

<body>
<?php
include '../pages/header.php'
?>


<h1>LogIn</h1>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Du hast schon ein Konto?</h5>
        <fieldset>
            <form id="login">
                <label for="username">Benutzername</label><br>
                <input class="form-control" required type="text" id="username" name="username"><br>
                <label for="pword1">Passwort</label><br>
                <input type="password" id="pword" name="pword" /><br><br>
                <button type="submit" class="btn btn-primary">Anmelden</button>
            </form>
        </fieldset>
    </div>
</div>

      
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

  <?php include '../components/footer.php' ?>  
</body>
</html>