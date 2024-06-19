<!DOCTYPE html>
<html lang="en">
  <head>
<?php include '../components/head.php' ?>
    <title>Shop</title>
  

<body>
<?php
include '../pages/header.php'
?>

<input type="text" class="form-control" id="kategorie" placeholder="Kategorie eingeben">
<button type="button" class="btn btn-success" id="btn_Kat">Produkte laden</button>
<br>
<form id="searchForm">
    <input type="text" id="searchInput" placeholder="Produktsuche...">
</form>
<div id="searchResults"></div>


<div id="products">  
</div>

<?php include '../components/footer.php' ?>
</body>
</html>