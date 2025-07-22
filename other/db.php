<?php
$host = 'localhost:3307/';
$db   = 'pcbuilder';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;";

try {
     $pdo = new PDO($dsn, $user, $pass);
     echo "omg no way this worked bro fffff";
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
