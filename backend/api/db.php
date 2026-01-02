<?php
// backend/db.php
$host = "localhost";
$user = "root"; // tumhara DB username
$pass = "";     // tumhara DB password
$db   = "hostel_system"; // database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
