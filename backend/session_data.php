<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$data = json_decode(file_get_contents('php://input'), true);
$product = $data['product'];


$_SESSION['cart'][] = $product;

echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);

?>