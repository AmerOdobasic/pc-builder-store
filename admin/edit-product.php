<?php
session_start();
require_once '../other/db.php';
require_once '../other/header.php';

// Check if the id of the product is set in the URL
if (!isset($_GET['id'])) {
    echo "Product ID not specified.";
    exit;
}

// Grab the id using GET since the ID is in the URL
$id = (int) $_GET['id'];

// Fetch the specified product from the DB
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found.";
    exit;
}
// Set up the error and success messages to notify admin if there are any errors or if the product was added successfully
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];
    $stock = intval($_POST['stock']);
    $image_url = $_POST['image_url'];
    $category_id = intval($_POST['category_id']);

    // Check to see the name, price, description, stock, and image_url are not empty before updating the product
    if ($name && $price && $description && $image_url) {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ?, stock = ?, image_url = ?, category_id = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $stock, $image_url, $category_id, $id]);
        $success = "Product updated.";
        // Refresh product data
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
    } else {
        $error = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <body>
        <main class="buying-guide-container">
            <h2>Edit Product</h2>

            <!-- Check to see if there is an error or success message to display-->
            <?php if ($error){
                echo "<p style='color:red;'>$error</p>";
            }?>
            <?php if ($success){
                echo "<p style='color:green;'>$success</p>";
            }?>

            <!-- Display the form to edit the product -->
            <form method="post">
                <label>Name:</label><br>
                <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>

                <label>Price:</label><br>
                <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required><br><br>

                <label>Description:</label><br>
                <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br><br>

                <label>Stock:</label><br>
                <input type="number" name="stock" value="<?php echo (int)$product['stock']; ?>" required><br><br>

                <label>Image URL:</label><br>
                <input type="text" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>" required><br><br>

                <label>Category ID:</label><br>
                <input type="number" name="category_id" value="<?php echo (int)$product['category_id']; ?>" required><br>
                <!-- Display a list of categories to help the admin select a category -->
                <i>1=CPU, 2=GPU, 3=RAM, 4=SSD, 5=PSU, 6=MOTHERBOARD, 7=CASE</i>
                <br><br>

                <button class="button" type="submit">Update Product</button>
            </form>
        </main>
        <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
    </body>
</html>

