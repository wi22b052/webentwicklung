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
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h1 class="text-center mb-4">Ihr Profil</h1>
                    <p class="text-center">Um ihre Daten zu ändern, bitte die neuen Daten eingeben und auf Speichern drücken. Aus Sicherheitsgründen muss dies mit der Eingabe des Passwortes bestätigt werden.</p>
                    <form action="profil.php" method="post">
                        <div class="mb-3">  
                            <label for="anrede"  class="form-label">Geschlecht</label>
                            <select id="anrede" name="anrede" class="form-control" required>
                                <option>männlich</option>
                                <option>weiblich</option>
                                <option>divers</option>
                                </select>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Email-Adresse</label>
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" value=<?php echo $_SESSION["uMail"]?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Vorname</label>
                                <input type="text" class="form-control" id="vorname"  name="vorname" placeholder="Vorname" value=<?php echo $_SESSION["uVorname"]?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Nachname</label>
                                <input type="text" class="form-control" id="nachname" name="nachname" placeholder="Nachname" value=<?php echo $_SESSION["uNachname"]?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Benutzername</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername" value=<?php echo $_SESSION["Benutzer"]?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Passwort</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Passwort wiederholen</label>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Passwort wiederholen" required>
                        </div>

                        <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Daten ändern</button>
                                <button type="reset" class="btn btn-secondary">Änderungen verwerfen</button>
                        </div>

</body>