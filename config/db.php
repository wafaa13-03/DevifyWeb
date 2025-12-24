<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env from project root
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$port = (int)($_ENV['DB_PORT'] ?? 3306);
$dbname = $_ENV['DB_NAME'] ?? '';
$username = $_ENV['DB_USER'] ?? '';
$password = $_ENV['DB_PASS'] ?? '';

$useSSL = filter_var($_ENV['DB_SSL'] ?? 'false', FILTER_VALIDATE_BOOLEAN);

// Create mysqli connection
$conn = mysqli_init();
mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 15);

$flags = 0;

if ($useSSL) {
    $caFile = __DIR__ . '/certs/do-ca.crt';

    if (!file_exists($caFile)) {
        die("Connection failed: CA file not found at $caFile");
    }

    // Use DigitalOcean CA
    mysqli_ssl_set($conn, null, null, $caFile, null, null);

    // Avoid verify issues on older macOS/PHP stacks
    mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

    $flags = MYSQLI_CLIENT_SSL;
}

if (!mysqli_real_connect($conn, $host, $username, $password, $dbname, $port, null, $flags)) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");
