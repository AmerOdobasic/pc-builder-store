<head>
    <?php require_once 'other/db.php'; ?>
    <?php require_once 'other/header.php'; ?>
</head>

<body>
    <h1>Our Products</h1>

    <?php
        // Fetch all categories
        $categories = $pdo->query("SELECT * FROM categories")->fetchAll();

        foreach ($categories as $category):
        ?>
            <h2 style="margin-top: 1rem;"><?php echo htmlspecialchars($category['name']); ?></h2>
            <div class="product-grid">
                <?php
                // Fetch products for this category. Do a prepared statement to prevent SQL injection
                $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ?");
                $stmt->execute([$category['id']]);

                // Display products for this category and wrap it in a product card. This will dynamically populate every product meaning less code 
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
        <?php
        endforeach;?>

    <footer><?php require_once 'other/footer.php'; ?></footer>
</body>