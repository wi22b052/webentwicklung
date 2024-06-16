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
        <?php if (isset($_SESSION['rolle']) && $_SESSION['rolle'] == 1){
         ?>
                <li><a href="admin_produkte.php">Produkte bearbeiten</a></li>
                <li><a href="admin_kunden.php">Kunden bearbeiten</a></li>
        <?php } elseif(isset($_SESSION['rolle']) && $_SESSION['rolle'] == 2) {
            ?>
                <li><a href="logout.php">Logout</a></li>
            <?php
        }else{
        ?>
                <li><a href="login.php">Login</a></li>
            <?php
            }
        ?>
            
        <a href="../pages">Home</a>
        <a href="../pages/impressum.php">Impressum</a>
        <a href="../pages/shop.php">Shop</a>

    </nav>
    <div class="icons">
        <a href="../pages/cart.php">
            <i class="fas fa-shopping-cart" id="card-btn"></i>
            <h1 id="currentAmount">
            <?php echo $elemente_in_Warenkorb ?> 
            </h1>
        </a>    
        <i class="fas fa-search" id="search-btn"></i>
        <i class="fa-solid fa-bars" id="menu-btn"></i>
    </div>
    <div class="search-form">
        <input type="search" id="search-box" placeholder="Suche">
        <label for="search-box" class="fas fa-search"></label>
    </div>
</header>