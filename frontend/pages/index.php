<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun4Fans - Home</title>
    <!-- Font Awesome CDN Link -->
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

    <!-- CSS File -->
    <link rel="stylesheet" href="../res/css/style.css">
    <!-- JS File -->
    <script src="../js/script.js"></script>
</head>

<body>
    <?php include '../pages/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container text-center">
            <h1>Willkommen bei Fun4Fans</h1>
            <p>Dein Shop für Fußball-Fanartikel</p>
            
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="fas fa-truck fa-3x"></i>
                    <h3>Schneller Versand</h3>
                    <p>Wir liefern deine Bestellung schnell und zuverlässig.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-shield-alt fa-3x"></i>
                    <h3>Sichere Bezahlung</h3>
                    <p>Deine Daten sind bei uns sicher.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-headset fa-3x"></i>
                    <h3>24/7 Support</h3>
                    <p>Unser Support-Team steht dir rund um die Uhr zur Verfügung.</p>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials Section -->
    <section class="testimonials py-5 bg-light">
        <div class="container">
            <h2 class="text-center">Was unsere Kunden sagen</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>"Großartiger Shop! Tolle Produkte und schneller Versand."</p>
                        <p><strong>- Anna M.</strong></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>"Der Support ist fantastisch. Sehr hilfsbereit und freundlich."</p>
                        <p><strong>- Lukas K.</strong></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>"Ich bin begeistert von der Qualität der Produkte."</p>
                        <p><strong>- Maria W.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer py-4 bg-dark text-white">
        <div class="container text-center">
            <p>&copy; 2024 Fun4Fans. Alle Rechte vorbehalten.</p>
            <p><a href="impressum.php" class="text-white">Impressum</a> | <a href="datenschutz.php" class="text-white">Datenschutz</a></p>
        </div>
    </footer>
</body>
</html>
