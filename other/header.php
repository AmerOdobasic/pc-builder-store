<?php
// Check if session is not started, if not, start it
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PC Builder Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Build your dream PC with quality parts.">
    <link rel="stylesheet" href="/pc-builder-store/assets/css/styles.css">
    <script src="/pc-builder-store/assets/js/main.js" defer></script>
</head>
<body>
<header>
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">All Products</a>
        <a href="cart.php">Cart</a>
        <a href="help-section/help-center.html">Help</a>
        <a href="admin/dashboard.php">Admin</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a style="margin-left: 50px;">Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<main>
