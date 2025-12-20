<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit;
}

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$db   = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $mysqli->real_escape_string($_POST['title']);
    $description = $mysqli->real_escape_string($_POST['description']);
    $client_id = $_SESSION['client_id'];

    $mysqli->query("INSERT INTO projects (client_id, title, description) VALUES ($client_id, '$title', '$description')");
    $message = "Project request submitted!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request a Project</title>
</head>
<body>
<h2>Request a New Project</h2>
<a href="dashboard.php">Back to Dashboard</a>
<?php if($message) echo "<p>$message</p>"; ?>
<form method="post" action="">
    Title: <input type="text" name="title" required><br><br>
    Description:<br>
    <textarea name="description" rows="5" cols="40" required></textarea><br><br>
    <button type="submit">Submit Request</button>
</form>
</body>
</html>
