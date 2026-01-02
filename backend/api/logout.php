<?php
// backend/logout.php
include 'helpers.php'; // session start aur redirect function available hoga

session_destroy(); // saari session info clear ho jaye
redirect('login.php'); // login page pe wapis bhej do
?>
