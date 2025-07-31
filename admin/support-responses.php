<?php
session_start();
require_once '../other/db.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
$error = '';
$success = '';
// Load all of the support messages from the database
$messages = $pdo->query("SELECT * FROM support_messages ORDER BY created_at DESC")->fetchAll();

// Checks to confirm if the admin wants to clear the support messages
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_data'])) {
    $pdo->exec("DELETE FROM support_messages");
    header("Location: ".$_SERVER['PHP_SELF']); // Redirect back to the same page after clearing the data
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php require_once '../other/header.php'; ?>

    <main class="admin-layout">

        <h1>User Support Messages</h1>

        <!-- Display the layout for each support message by going through the array of messages -->
        <?php foreach ($messages as $msg): ?>
            <div class="support-msg-container">
                <p><strong>Name:</strong> <?= htmlspecialchars($msg['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($msg['email']) ?></p>
                <p><strong>Subject:</strong> <?= htmlspecialchars($msg['subject']) ?></p>
                <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($msg['message'])) ?></p>

                <!-- Display the admin response if it exists, otherwise display a form for the admin to respond -->
                <?php if ($msg['response']): ?>
                    <p><strong>Admin Response:</strong><br><?= nl2br(htmlspecialchars($msg['response'])) ?></p>
                    <p><em>Responded at <?= $msg['responded_at'] ?></em></p>
                <?php else: ?>
                    <form method="post" action="send-response.php">
                        <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                        <label>Reply:<br>
                            <textarea name="response" required></textarea>
                        </label><br>
                        <button type="submit">Send Response</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Show a button to clear the support messages -->
        <form method="post" onsubmit="return confirm('Clear all support messages?')">
            <button type="submit" class="button" name="clear_data">Clear Table Contents</button>
        </form>
    </main>

<?php require_once '../other/footer.php'; ?>
</body>
</html>
