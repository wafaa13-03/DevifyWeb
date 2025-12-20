<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Devify</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>

    <a href="admin_view_clients.php">View Clients</a><br><br>
    <a href="admin_view_projects.php">View Project Requests</a><br><br>
    <a href="admin_logout.php">Logout</a>
</body>
</html>
