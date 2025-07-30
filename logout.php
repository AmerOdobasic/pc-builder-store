<?php
// Start the session so that we can access session variables
session_start();
// Destroy the session to log the user out
session_destroy();
// Redirect the user to the homepage after logout
header("Location: index.php");
exit;