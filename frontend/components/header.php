<!--Header Section-->
<?php
session_start();
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$elemente_in_Warenkorb = count($_SESSION['cart']);
?>

<header class="header">
    <a href="#" class="logo">
        <img href="../pages" src="../res/img/logo.png" alt="">
    </a>
    <nav class="navbar">
        <a href="../pages">Home</a>
        <a href="../pages/shop.php">Shop</a>
        <?php if (isset($_SESSION['rolle']) && $_SESSION['rolle'] == 1): ?>
            <a href="admin_produkte.php">Produkte bearbeiten</a>
            <a href="admin_kunden.php">Kunden bearbeiten</a>
            <a href="logout.php">Logout</a>
        <?php elseif (isset($_SESSION['rolle']) && $_SESSION['rolle'] == 2): ?>
            <a href="bestellungen.php">Bestellungen</a>
            <a href="konto.php">Profil</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="reg.php">Registrierung</a>
        <?php endif; ?>
        <a href="../pages/impressum.php">Impressum</a>
    </nav>
    <div class="icons">
        <a href="../pages/cart.php" class="cart-icon">
            <i class="fas fa-shopping-cart" id="card-btn"></i>
            <h1 id="currentAmount"><?php echo $elemente_in_Warenkorb ?></h1>
        </a>
        <i class="fa-solid fa-bars" id="menu-btn"></i>
    </div>
</header>
