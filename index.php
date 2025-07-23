<head>
    <?php require_once 'other/db.php'; ?>
    <?php require_once 'other/header.php'; ?>
</head>

<body>
    <h1>Welcome to PC Builder Store</h1>

    <h2>Featured Products</h2>
    <div class="product-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM products LIMIT 3");
        while ($product = $stmt->fetch()):
        ?>
            <div class="product-card">
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <a href="product-detail.php?id=<?php echo $product['id']; ?>">View</a>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="video-container">
        <h2 style="margin-bottom:5px">Check out our review on the brand new RTX 5090!</h2>
        <!-- The video will be displayed inside the iframe element. The src attribute is set to the YouTube video URL -->
        <iframe width="560" height="315" src="https://www.youtube.com/embed/oXM_7dSlbv0?si=pmMLNCc3ek__WX1v" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <footer><?php require_once 'other/footer.php'; ?></footer>
</body>
