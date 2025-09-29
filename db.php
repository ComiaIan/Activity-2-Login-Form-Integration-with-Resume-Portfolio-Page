<?php
$host = "127.0.0.1";
$port = "5432";
$dbname = "cv_app";
$user = "cv_user";
$password = "yourpassword";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
