<head>
    <?php require_once 'other/db.php'; ?>
    <?php require_once 'other/header.php'; ?>
</head>

<body>
    <h1>Our Products</h1>
    <h2>Our CPU's</h2>
    <div class="product-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM products WHERE category_id = 1");
        while ($product = $stmt->fetch()):
        ?>
            <div class="product-card">
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>$<?php echo number_format($product['price'], 2); ?></p>
                <a href="product-detail.php?id=<?php echo $product['id']; ?>">View</a>
            </div>
        <?php endwhile; ?>
    </div>

    <footer><?php require_once 'other/footer.php'; ?></footer>
</body>