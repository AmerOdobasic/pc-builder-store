<?php
session_start();
require_once '../other/db.php';
require_once '../other/header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
// Check if the there even is an order to look at the details for
// If not, terminate 
$order_id = intval($_GET['order_id'] ?? 0);
if ($order_id === 0) {
    die("Invalid order.");
}
// See if there is a status for the order, if so, update the status of it to a new one
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    $new_status = $_POST['status'];
    $update = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $update->execute([$new_status, $order_id]);

    // Refresh to show new status
    header("Location: order-details.php?order_id=" . $order_id);
    exit;
}

// Fetch the order by its ID along with the associated user's username and email
// .* Selects all of the columns from the orders table 
$stmt = $pdo->prepare("
    -- Select order details and user info
    SELECT orders.*, users.username, users.email 
    FROM orders 
    -- Match each order to its user
    JOIN users ON orders.user_id = users.id 
    -- Only get one specific order
    WHERE orders.id = ?
");
$stmt->execute([$order_id]);
$order = $stmt->fetch();

// Check if there is an order before proceeding
if (!$order) {
    die("Order not found.");
}

// Fetch all of the order items for a specific order along with the product name for each item
$itemStmt = $pdo->prepare("
    -- Select the item details and product name
    SELECT order_items.*, products.name 
    FROM order_items
    -- Match each item to its product
    JOIN products ON order_items.product_id = products.id
    -- Only get items from this order
    WHERE order_items.order_id = ?
");
$itemStmt->execute([$order_id]);
$items = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <body>
        <main class="buying-guide-container">
            <!-- Grab the id from the URL and use it to grab the order details -->
            <h2>Order #<?= $order['id'] ?> Details</h2>
            <p><strong>Customer:</strong> <?= htmlspecialchars($order['username']) ?> (<?= htmlspecialchars($order['email']) ?>)</p>
            <p><strong>Total:</strong> $<?= number_format($order['total_price'], 2) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>
            <p><strong>Ordered On:</strong> <?= $order['created_at'] ?></p>

            <!-- Display all of the items in the order -->
            <table class="cart-table">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
                <!-- Loop through each item in the order -->
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <!-- Update Order Status -->
            <h3>Update Order Status</h3>
            <form method="post">
                <select name="status" required>
                    <!-- Add an option for each status. If the current status matches the option, then it should be selected -->
                    <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Processing" <?= $order['status'] === 'Processing' ? 'selected' : '' ?>>Processing</option>
                    <option value="Shipped" <?= $order['status'] === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                    <option value="Delivered" <?= $order['status'] === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                    <option value="Cancelled" <?= $order['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
                <button class="button" type="submit" name="update_status">Update Status</button>
            </form>

        </main>
        <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
    </body>
</html>
