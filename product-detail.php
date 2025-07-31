<?php
require_once 'other/db.php';
require_once 'other/header.php';
// Get the product ID from the URL
$id = (int) $_GET['id'];

// Fetch base product
// A prepare and execute statement is used to prevent SQL injection
// The question mark (?) is a placeholder for the parameter that will be set
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "<p>Product not found!</p>";
    require_once 'other/footer.php';
    exit;
}

// Fetch all options and their extended fields
$stmtOptions = $pdo->prepare("
    SELECT option_name, option_value, image_url, override_price, override_name
    FROM product_options
    WHERE product_id = ?
");
$stmtOptions->execute([$product['id']]);
// This will return an array of associative arrays, each containing the option details
$optionsRaw = $stmtOptions->fetchAll(PDO::FETCH_ASSOC);

// We'll now group the options by their names (ex. "Color", "Size", etc.)
$groupedOptions = [];
foreach ($optionsRaw as $opt) {
    $groupedOptions[$opt['option_name']][] = $opt;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>

    <h1 style="text-align: center;" id="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>

    <div class="product-detail">
        <img id="product-image" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
        
        <!-- A class for the whole product information. PHP will be added to display from the DB -->
        <div class="product-info">
            <!-- Using number_format for better display of price and nl2br for better line breaks-->
            <p><strong>Price:</strong> $<span id="product-price"><?php echo number_format($product['price'], 2); ?></span></p>
            <p><strong>Description:</strong><br> <?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            <p><strong>Stock:</strong> <?php echo (int)$product['stock']; ?></p>

            <form action="add-to-cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                
                <label>Options:</label>
                <!-- For each option, we'll create a select box with the options for each product -->
                <!-- Loop through the names of the grouped options -->
                <?php foreach ($groupedOptions as $name => $optionSet): ?>
                    <!-- Display a Label for the Option Group-->
                    <label><?php echo htmlspecialchars($name); ?>:</label>
                    <!-- This will create a <select> Dropdown to display the options for the current option group -->
                    <select name="options[<?php echo $name; ?>]" class="option-select">
                        <!-- Loop through the options for the current option group -->
                        <?php foreach ($optionSet as $opt): ?>
                            <option
                                value="<?php echo htmlspecialchars($opt['option_value']); ?>"
                                data-img="<?php echo $opt['image_url']; ?>"
                                data-price="<?php echo $opt['override_price']; ?>"
                                data-name="<?php echo htmlspecialchars($opt['override_name']); ?>"
                            >
                                <?php echo htmlspecialchars($opt['option_value']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                <?php endforeach; ?>

                <!-- Quantity field. I set the Default values to start with 1 product -->
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="<?php echo (int)$product['stock']; ?>" required>
                <br><br>

                <button type="submit">Add to Cart</button>
            </form>
        </div>
    </div>
</body>

<footer><?php require_once 'other/footer.php'; ?></footer>
</html>
