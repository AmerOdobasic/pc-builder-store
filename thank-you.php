<?php
require_once 'other/header.php';
require_once 'other/footer.php';
$order_id = $_GET['order_id'] ?? '';
?>
<h2>Thank you!</h2>
<p>Your order #<?php echo htmlspecialchars($order_id); ?> has been placed successfully.</p>
<a href="index.php" class="button">Back to home page</a>