
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

// Fetch projects of the logged-in client
$client_id = $_SESSION['client_id'];
$result = $mysqli->query("SELECT * FROM projects WHERE client_id=$client_id ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Client Dashboard</title>
</head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['client_name']); ?></h2>
<a href="logout.php">Logout</a>
<h3>Your Projects</h3>
<a href="request_project.php">Request a New Project</a>
<table border="1" cellpadding="5">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created At</th>
    </tr>
    <?php while($project = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($project['title']); ?></td>
        <td><?php echo htmlspecialchars($project['description']); ?></td>
        <td><?php echo htmlspecialchars($project['status']); ?></td>
        <td><?php echo $project['created_at']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
