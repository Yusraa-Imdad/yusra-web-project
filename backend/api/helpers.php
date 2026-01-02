<?php
// backend/helpers.php
session_start();

function redirect($url) {
    header("Location: $url");
    exit;
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function checkLogin() {
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
}

function checkRole($role) {
    if($_SESSION['role'] !== $role) {
        redirect('login.php');
    }
}
?>
