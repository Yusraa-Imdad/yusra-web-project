<?php
// backend/register.php
include 'db.php';
include 'helpers.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = sanitizeInput($_POST['role']); // Student or Warden

    $sql = "INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$password','$role')";

    if($conn->query($sql)) {
        redirect('login.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
