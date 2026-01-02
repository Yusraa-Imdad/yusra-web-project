<?php
// backend/admin_dashboard.php
include 'helpers.php';
checkLogin();
checkRole('Warden');
?>

<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h1>Welcome, <?php echo $_SESSION['name']; ?> (Warden)</h1>
<a href="logout.php">Logout</a>
</body>
</html>
