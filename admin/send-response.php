<?php
session_start();
require_once '../other/db.php';

// Check if user is logged in and has admin role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Access denied");
}

// If the request is a POST request, process the response
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $response = trim($_POST['response']);
    $adminId = $_SESSION['user']['id'];

    // If the ID and response are provided, update the response in the database
    if ($id && $response) {
        $stmt = $pdo->prepare("UPDATE support_messages SET response = ?, responded_by = ?, responded_at = NOW() WHERE id = ?");
        $stmt->execute([$response, $adminId, $id]);
        header("Location: support-responses.php");
        exit;
    } else {
        echo "Missing response or ID!";
    }
}
?>
