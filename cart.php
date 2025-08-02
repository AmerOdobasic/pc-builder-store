<?php
session_start();
require_once 'other/db.php';
require_once 'other/header.php';
// Use the cart session if it exists, otherwise create an empty cart
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<h2>Your cart is empty! Lets add some products!</h2>";
    require_once 'other/footer.php';
    exit;
}
// Load the products from cart
$product_ids = array_keys($cart); // Get product IDs

if (!empty($product_ids)) {
    // Create placeholders like ?,?,? to make sure the query is safe
    // Implode will create a string like '?,?,?' based on the number of product IDs
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

    // Prepare and execute safely
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($product_ids);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {  // If no product IDs, create an empty array
    $products = [];
}

$total = 0;
?>

<!-- Initialize the cart table -->
<h2>Your Shopping Cart</h2>
<table class="cart-table">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>

<!-- Loop through the products and display them in the cart table -->
<?php foreach ($products as $product):
    $pid = $product['id'];
    // A safety check to skip products no longer in the session
    if (!isset($cart[$pid])) {
        continue;
    }
    // This will retrieve Quantity and Options From Cart Session, from the 2D cart array
    $qty = $cart[$pid]['quantity']; 
    $selected_options = $cart[$pid]['options'] ?? []; // Get options from cart session

    $price = $product['price'];
    $name = $product['name'];

    // This will check if there needs to Override Product Name/Price Based on the Selected Options
    foreach ($selected_options as $opt_name => $opt_value) {
        $opt_stmt = $pdo->prepare("SELECT override_price, override_name FROM product_options WHERE product_id = ? AND option_name = ? AND option_value = ?");
        $opt_stmt->execute([$pid, $opt_name, $opt_value]);
        $override = $opt_stmt->fetch();
        // If there is an override, update the price and name accordingly
        if ($override) {
            if ($override['override_price'] !== null) {
                $price = $override['override_price'];
            }
            if ($override['override_name'] !== null) {
                $name = $override['override_name'];
            }
        }
    }

    // Calculate Subtotal and Add to Total (Will add tax later)
    $subtotal = $qty * $price;
    $total += $subtotal;

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Now, output the table row for each product in the cart -->
    <tr>
        <td>
            <?php echo htmlspecialchars($name); ?>
            <!-- If there are selected options, display them -->
            <?php if (!empty($selected_options)): ?>
                <ul class="cart-options">
                <!-- In order to go through them, foreach will loop through the key and value pairs from the option array (eg. option_name => option_value) -->
                <?php foreach ($selected_options as $key => $value): ?>
                    <li><?php echo htmlspecialchars($key . ": " . $value); ?></li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </td>
        <!-- Display price and quantity and subtotal -->
        <td>$<?php echo number_format($price, 2); ?></td>
        <td><?php echo $qty; ?></td>
        <td>$<?php echo number_format($subtotal, 2); ?></td>
        <!-- Add a button to remove the product from the cart -->
        <td>
            <form action="remove-from-cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $pid; ?>">
                <button class="button" type="submit">Remove</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    </table>
    <!-- Display the total -->
    <h3>Total: $<?php echo number_format($total, 2); ?></h3>
    <a href="checkout.php" class="button" style="margin-bottom:1rem;">Proceed to Checkout</a>

    <footer><p>&copy; 2025  Amer's PC Builder Store. All rights reserved.</p></footer>
</body>
</html>

