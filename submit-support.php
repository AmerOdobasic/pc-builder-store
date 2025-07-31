<?php
session_start();
require_once '../pc-builder-store/other/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Check if all the required felids are inputted when the admin is done with their response
    if ($name && $email && $subject && $message) {
        $stmt = $pdo->prepare("INSERT INTO support_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $subject, $message]);
        header("Location: support-thank-you.php");
        exit;
    } else {
        echo "Please fill out all fields.";
    }
}
?>
