<?php
session_start();
// Make sure that only authenticated admin users should see this page.
// In case they are not, redirect them to the login page.

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['redirect_after_login'] = 'admin/dashboard.php';
    header("Location: ../login.php");
    exit;
}
require_once '../other/db.php';
require_once '../other/header.php';
// Retrieve all products in order by id descending
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY id DESC');
$stmt->execute(); 
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Showcase the admin dashboard -->
    <div class="admin-layout cart-table">
        <h1>Admin Dashboard</h1>
        <!-- Add a link to the add-product.php page to add a new product or orders.php to view orders -->
        <a class="button" style="margin-top: -1rem" href="add-product.php">Add Product</a>
        <a class="button" style="margin-top: -1rem" href="orders.php">View Orders</a><br>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
            </tr>
            <!-- Display all products by looping through the $products array -->
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td>$<?= number_format($product['price'], 2) ?></td>
                <td><?= $product['stock'] ?></td>
                <td><?= $product['category_id'] ?></td>
                <td>
                    <a button="button" href="edit-product.php?id=<?= $product['id'] ?>">Edit</a> 
                    <!-- Confirm with the user before deleting a product -->
                    <a button="button" href="delete-product.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>

    <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
</body>
</html>
