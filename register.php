<?php
session_start();
require_once('other/db.php');
require_once('other/header.php');

// Check if the form was submitted and the username and password fields are not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"], $_POST["password"], $_POST["email"])){
    // Get the username and password from the form
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $email = trim($_POST["email"]);
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists, if not, proceed with adding the user into the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user){
        echo "<p style='color:red;'>Sorry,Username already exists. Please choose another.</p>";
        exit;
    }else{
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, $email]);
        echo "<p style='color:green;'>Registration successful!</p>";

        // Redirect or login automatically
        $_SESSION["user"] = [
            'id' => $pdo->lastInsertId(),
            'username' => $username,
            'email' => $email
        ];
        header("Location: index.php");
        exit;
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Register Form -->
    <form action="register.php" method="post">
        <h1>Register</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="email" placeholder="person@example.com" required>
        <input type="submit" value="Register"> 
        <a href="login.php">Already have an account?</a>

    </form>

    <footer>
        <?php require_once 'other/footer.php'; ?>
    </footer>
</body>
</html>
