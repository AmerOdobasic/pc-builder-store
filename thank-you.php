<?php
require_once 'other/header.php';

$order_id = $_GET['order_id'] ?? '';
// Display the order ID to to the customer after they placed their order 
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <main>
        <div class="buying-guide-container">
        <h2>Thank you!</h2>
        <!-- Display the order ID to to the customer after they placed their order -->
        <p>Your order #<?php echo htmlspecialchars($order_id); ?> has been placed successfully.</p>
        <a href="index.php" class="button">Back to home page</a>
        </div>
    </main>
    <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
</body>

