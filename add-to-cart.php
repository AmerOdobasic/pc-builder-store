<?php
session_start();

// Get product ID and quantity from the form 
$product_id = (int) $_POST['product_id'] ?? 0; // If no product ID is provided, set it to 0
$quantity = (int) $_POST['quantity'] ?? 1;  // Set to 1 if no quantity is provided
$options = $_POST['options'] ?? [];

if ($product_id <= 0 || $quantity <= 0) {
    die("Invalid product or quantity.");  // Return error message if product or quantity is invalid
}

// Add or update cart item
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][$product_id] = [
    'quantity' => $quantity,
    'options' => $options
];

header('Location: cart.php');
exit;
?>
