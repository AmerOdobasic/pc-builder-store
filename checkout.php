<?php
session_start();
require_once 'other/db.php';
require_once 'other/header.php';
// Make it such that only logged in users can access this page
if (!isset($_SESSION['user']['id']) || !isset($_SESSION['user'])) {
    $_SESSION['redirect_after_login'] = 'checkout.php';
    header("location:login.php");
    exit;
}
// Retrieve an existing 'cart' from the user's session 
// Make sure that the cart always has an array to catch errors or if empty
$cart = $_SESSION['cart'] ?? [];

if (!isset($cart)){
    echo "<h2>Your cart is empty! Lets add some stuff to it!</h2>";
    exit;
}
// Get the id's of each product in the users cart so we can grab the specific products from the database 
$product_ids = array_keys($cart);
if (!empty($product_ids)) {
    // Prepare the placeholders so we can safely execute the sql query 
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

    // Prepare and execute safely
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($product_ids);

    // Products now gives you the entire row of product info, indexed by product ID
    $products = $stmt->fetchAll(PDO::FETCH_UNIQUE);
} else {  // If no product IDs, create an empty array
    $products = [];
}

// Check if the form was submitted by the POST method from the user and if user specifically clicked the "Place Order" button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Set up variables for the user and address
    $user_id = $_SESSION['user']['id'];
    $address = trim($_POST['address']);
    $total_price = 0;

    // Calculate the total price of all products in the cart
    // Go through each item in the cart and sum up the total price
    foreach ($cart as $pid => $item) {
        $product = $products[$pid];
        $price = $product['price'];

        if (!isset($products[$pid])) {
            echo "<p>Product not found.</p>";
            exit;
        }

        // Check if enough stock is available
        if ($product['stock'] < $item['quantity']) {
            echo "<p>Sorry, not enough stock for " . htmlspecialchars($product['name']) . ". {$product['stock']} left.</p>";
            exit;
        }

        // Check to see if a product has extra options
        if (!empty($item['options'])) {
            // Check each option and see if there is a override price
            foreach ($item['options'] as $name => $value) {
                $optStmt = $pdo->prepare("SELECT override_price FROM product_options WHERE product_id = ? AND option_name = ? AND option_value = ?");
                $optStmt->execute([$pid, $name, $value]);
                $opt = $optStmt->fetch();
                // Change the price of the product here
                if ($opt && $opt['override_price']) {
                    $price = $opt['override_price'];
                }
            }
        }

        // Calculate the subtotal for this item
        $subtotal = $price * $item['quantity'];
        $total_price += $subtotal;
    }

    // Insert order into the database
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, status, created_at) VALUES (?, ?, 'Pending', NOW())");
    $stmt->execute([$user_id, $total_price]);
    $order_id = $pdo->lastInsertId();

    // Insert the order items to order_items table
    // Go through each of the items in the cart
    foreach ($cart as $pid => $item) {
        $product = $products[$pid];
        $price = $product['price'];

        // Check if there are any options for this product
        foreach ($item['options'] ?? [] as $name => $value) {
            $optStmt = $pdo->prepare("SELECT override_price FROM product_options WHERE product_id = ? AND option_name = ? AND option_value = ?");
            $optStmt->execute([$pid, $name, $value]);
            $opt = $optStmt->fetch();
            if ($opt && $opt['override_price']) {
                $price = $opt['override_price'];
            }
        }

        //This will be used for updating the stock later
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $pid, $item['quantity'], $price]);

        // Reduce the stock of the product
        $updateStockStmt = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
        $updateStockStmt->execute([$item['quantity'], $pid]);

    }

    // Clear the cart
    $_SESSION['cart'] = [];

    // Redirect to thank you page
    header("Location: thank-you.php?order_id=$order_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <main class="buying-guide-container">
        <!-- Set up the form to place an order -->
        <form method="post">
        <label>Shipping Address:</label><br>
        <textarea name="address" required></textarea><br><br>
        <button type="submit" class="button" name="place_order">Place Order</button>
        </form>
    </main>
    <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
</body>