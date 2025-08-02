<?php
session_start();
require_once '../other/db.php';
require_once '../other/header.php';

// Restrict to admin only
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['redirect_after_login'] = 'admin/orders.php';
    header("Location: ../login.php");
    exit;
}

// Fetch all orders with user info
$stmt = $pdo->prepare("
    -- Select every column from orders table
    SELECT orders.*, users.username, users.email 
    FROM orders 
    -- Combine each order with the user who placed it
    JOIN users ON orders.user_id = users.id 
    -- Newest orders appear first
    ORDER BY orders.created_at DESC   
");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <body>
        <h2>All Customer Orders</h2>

        <table class="cart-table">
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Details</th>
            </tr>

            <!-- Loop through each order and display details -->
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['username']) ?> (<?= htmlspecialchars($order['email']) ?>)</td>
                    <td>$<?= number_format($order['total_price'], 2) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <!-- Add a link to the order details page by passing the order ID as a query parameter -->
                    <td>
                        <a class="button" href="order-details.php?order_id=<?= $order['id'] ?>">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
    </body>
</html>
