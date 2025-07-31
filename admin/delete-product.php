<?php
session_start();
require_once '../other/db.php';

// Check if user is admin
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    die("Access Denied");
}

// Validate and sanitize the product ID from GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  

    // Prepare the delete query
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect back to dashboard with a success message
    header("Location: dashboard.php?deleted=1");
    exit;
} else {
    echo "Invalid product ID.";
}
?>
