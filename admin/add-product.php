<?php
session_start();

require_once '../other/db.php';
require_once '../other/header.php';
// Reject the access if the user isn't logged in or if they aren't an admin
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin"){
    die("Access Denied");
}

// Set up the error and success messages to notify admin if there are any errors or if the product was added successfully
$error = '';
$success = '';

// Now, we handle what happens when the admin submits the new product 
// Convert to float or trim text before inserting into the database 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $price = floatval($_POST['price']); 
    $description = trim($_POST['description']);
    $stock = intval($_POST['stock']);
    $image_url = $_POST['image_url'];
    $category_id = intval($_POST['category_id']);

    // Check if values exists before adding it to the database
    if ($name && $price && $description && $image_url){
        $stmt = $pdo->prepare('INSERT INTO products (name, price, description, stock, image_url, category_id) VALUES (?, ?, ?, ?, ?, ?)'); 
        $stmt->execute([$name, $price, $description, $stock, $image_url, $category_id]);
        $success = "Product added successfully.";
    }else{
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <body>
        <!-- Check if there was an error or success message -->
        <h2 style="text-align: center;">Add Product</h2>
        <?php if ($error){
            echo "<p style='color:red;'>$error</p>";
        }?>
        <?php if ($success){
            echo "<p style='color:green;'>$success</p>";
        }?>

        <!-- Add a new product form -->
        <!-- Make sure the form method is set to "post" -->
        <form method="post" class="buying-guide-container">
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>

            <label>Price:</label><br>
            <input type="number" name="price" step="0.01" required><br><br>

            <label>Description:</label><br>
            <textarea name="description" required></textarea><br><br>

            <label>Stock:</label><br>
            <input type="number" name="stock" required><br><br>

            <label>Image URL:</label><br>
            <input type="text" name="image_url" required><br><br>

            <label>Category ID:</label><br>
            <input type="number" name="category_id" required>
            <br>
            <!-- Display a list of categories to help the admin select a category -->
            <i>1=CPU, 2=GPU, 3=RAM, 4=SSD, 5=PSU, 6=MOTHERBOARD, 7=CASE</i>
            <br><br>

            <button class="button" type="submit">Add Product</button>
        </form>

        <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
    </body>