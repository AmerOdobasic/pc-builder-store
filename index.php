<?php require_once 'other/db.php'; ?>
<?php require_once 'other/header.php'; ?>
<!-- grab the db file to connect to the database and load in the header from header.php -->
<!DOCTYPE html>
<html lang="en">
<html>
<body>
    <h1>Welcome to Amer's PC Builder Store</h1>

    <h2>Featured Products</h2>
    <!-- Go through the first 3 product in the db, to add them onto the index page as featured products -->
    <div class="product-grid">
        <?php
        // Grab the first 3 products from the db
        $stmt = $pdo->query("SELECT * FROM products LIMIT 3");
        // Loop through each product and dyamiclly add them onto thw webpage, along with the respective image, name, and product id which will be used to access the product detail
        while ($product = $stmt->fetch()):
        ?>
            <div class="product-card">
                <!-- Use htmlspecialchars() for safety when displaying from the database  -->
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <a href="product-detail.php?id=<?php echo $product['id']; ?>">View</a>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Use a video to showcase a product and i have put it in a div to add styling easier -->
    <div class="video-container">
        <h2 style="margin-bottom:5px">Check a review on the brand new RTX 5090!</h2>
        <!-- The video will be displayed inside the iframe element. The src attribute is set to the YouTube video URL -->
        <iframe width="560" height="315" src="https://www.youtube.com/embed/oXM_7dSlbv0?si=pmMLNCc3ek__WX1v" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <footer><?php require_once 'other/footer.php'; ?></footer>
</body>
</html>
