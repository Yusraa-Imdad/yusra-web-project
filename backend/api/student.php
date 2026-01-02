<?php
// backend/student_dashboard.php
include 'helpers.php';
checkLogin();
checkRole('Student');
?>

<!DOCTYPE html>
<html>
<head><title>Student Dashboard</title></head>
<body>
<h1>Welcome, <?php echo $_SESSION['name']; ?> (Student)</h1>
<a href="logout.php">Logout</a>
</body>
</html>
