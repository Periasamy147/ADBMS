<?php
$host = 'localhost';
$dbname = 'mydb';
$user = 'myuser';
$password = 'mypassword';

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
