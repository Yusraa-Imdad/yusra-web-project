<?php
$host = "localhost";       // ya server ka IP
$dbname = "hostel_db";     // database ka naam
$user = "root";            // DB user
$pass = "";                // DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
