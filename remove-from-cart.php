<?php
session_start();
// Check if the request was made via POST and if the product ID is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = (int) $_POST['product_id'];
    // Remove the product from the cart by deleting it from the session if there is one
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}
// Redirect to the cart page
header('Location: cart.php');
exit;
