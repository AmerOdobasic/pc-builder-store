<?php
session_start();
require_once 'other/db.php';
require_once 'other/header.php';

// Setup error message
$error = '';

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    // Set up variables for the email and password from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Get the user from the database so we can check if the email and password match the ones in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // If the user exists and the password matches, set the session variables 
    if ($user && password_verify($password, $user["password_hash"])){
        $_SESSION["user"] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'], // To check if admin or user

        ];
        // Now, Re-direct the user to the originally intended page (or home page if none is set)
        $redirect = $_SESSION['redirect_after_login'] ?? 'index.php';
        // Remove the redirect from the session variable
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirect");
        exit;
    }else{
        $error = 'Invalid email or password!';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Error message in case of an error -->
    <?php if ($error): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <!-- Login form using the post method -->
    <form action="login.php" method="post">
        <h1>Log In</h1>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">

    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>

    <footer>
        <?php require_once 'other/footer.php'; ?>
    </footer>
</body>
</html>
