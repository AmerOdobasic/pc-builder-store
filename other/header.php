<?php
// Check if session is not started, if not, start it
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Add all the meta tags for better SEO  -->
    <meta charset="UTF-8">
    <title>Amer's PC Builder Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Amer's PC Builder Store. It contains a wide range of high-quality PC components and accessories for people of all skill levels of PC building.">
    <meta name="keywords" content="Amer's PC Builder Store, PC Components, PC Accessories, PC Building, High-quality PC components, Affordable PC accessories, viral, tech, coding, html, JS">
    <link rel="stylesheet" href="/pc-builder-store/assets/css/styles.css">
    <script src="/pc-builder-store/assets/js/main.js" defer></script>
</head>
<body>
<header>
    <nav class="navbar">
        <a href="/pc-builder-store/index.php">Home</a>
        <a href="/pc-builder-store/products.php">All Products</a>
        <a href="/pc-builder-store/cart.php">Cart</a>
        <a href="/pc-builder-store/help-section/help-center.html">Help</a>
        <a href="/pc-builder-store/about.html">About</a>

        <!-- Admin link only for logged-in users with admin role. Check if a user is logged in, if they have an role, then if they are an admin -->
        <!-- If true, show the extra options in the nav bar -->
        <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
            <a href="/pc-builder-store/admin/dashboard.php">Admin</a>
            <a href="/pc-builder-store/admin/support-responses.php">Support Responses</a>
        <?php endif; ?>

        <!-- User links only for logged-in users -->
        <?php if (isset($_SESSION['user'])): ?>
            <a style="margin-left: 5rem;">Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></a>
            <a href="/pc-builder-store/logout.php">Logout</a>
        <?php else: ?>
            <a href="/pc-builder-store/login.php">Login</a>
            <a href="/pc-builder-store/register.php">Register</a>
        <?php endif; ?>

    </nav>
</header>
<main>
