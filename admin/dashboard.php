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
    <div class="admin-layout">
        <h1>Admin Dashboard</h1>

        <!-- Add a link to the add-product.php page to add a new product -->
        <a href="add-product.php">Add Product</a>
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
                    <a href="edit-product.php?id=<?= $product['id'] ?>">Edit</a> 
                    <!-- Confirm with the user before deleting a product -->
                    <a href="delete-product.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>

    <footer>
        <?php require_once '../other/footer.php'; ?>
    </footer>
</body>
</html>
