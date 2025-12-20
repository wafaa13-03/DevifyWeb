<?php
session_start();
require __DIR__ . '/../config/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        if (hash("sha256", $password) === $admin["password"]) {
            $_SESSION["admin_id"] = $admin["id"];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "Admin not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Devify</title>
</head>
<body>
    <h2>Admin Login</h2>

    <p style="color:red;"><?= $message ?></p>

    <form method="POST">
        <input type="text" name="username" placeholder="Admin Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
