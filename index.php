<?php require_once 'other/db.php'; ?>
<?php require_once 'other/header.php'; ?>

<h1>Welcome to PC Builder Store</h1>

<h2>Featured Products</h2>
<div class="product-grid">
<?php
$stmt = $pdo->query("SELECT * FROM products LIMIT 4");
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

<?php require_once 'other/footer.php'; ?>
