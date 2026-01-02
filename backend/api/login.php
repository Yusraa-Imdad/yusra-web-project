<?php
// backend/login.php
include 'db.php';
include 'helpers.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'Student') {
                redirect('student_dashboard.php');
            } else {
                redirect('admin_dashboard.php');
            }
        } else {
            echo "Wrong password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
