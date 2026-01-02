<?php
include 'config.php';
session_start();

// Add Complaint
if(isset($_POST['action']) && $_POST['action'] === 'add') {
    $student_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO complaints (student_id, title, category, description, date, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    if($stmt->execute([$student_id, $title, $category, $description, $date])){
        echo json_encode(['status'=>'success']);
    } else {
        echo json_encode(['status'=>'error']);
    }
}

// Get Complaints for Student
if(isset($_GET['action']) && $_GET['action'] === 'my') {
    $student_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT c.*, u.name AS student_name FROM complaints c JOIN users u ON c.student_id=u.id WHERE student_id=? ORDER BY date DESC");
    $stmt->execute([$student_id]);
    $complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($complaints);
}

// Get All Complaints for Admin
if(isset($_GET['action']) && $_GET['action'] === 'all' && $_SESSION['user_role'] === 'Warden') {
    $stmt = $conn->query("SELECT c.*, u.name AS student_name FROM complaints c JOIN users u ON c.student_id=u.id ORDER BY date DESC");
    $complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($complaints);
}
?>
