<?php
// establish database connection
$host = "localhost";
$dbname = "se_app_database";
$username = "root";
$pass = '';

try {
    $conn = new PDO(
        'mysql:host=;dbname=se_app_database;charset=utf8',
        $username,
        $pass
    );
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}