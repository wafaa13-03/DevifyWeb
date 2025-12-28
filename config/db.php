<?php

// Load .env from project root when available (no external libraries)
$projectRoot = dirname(__DIR__);
$envPath = $projectRoot . '/.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }
            [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
            $key = trim($key);
            $value = trim($value);
            if ($key === '') {
                continue;
            }
            $value = trim($value, "\"'");
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? (defined('DB_HOST') ? DB_HOST : '127.0.0.1');
$port = (int)($_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? (defined('DB_PORT') ? DB_PORT : 3306));
$dbname = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? (defined('DB_NAME') ? DB_NAME : '');
$username = $_ENV['DB_USER'] ?? $_ENV['DB_USERNAME'] ?? getenv('DB_USER') ?? getenv('DB_USERNAME') ?? (defined('DB_USER') ? DB_USER : '');
$password = $_ENV['DB_PASS'] ?? $_ENV['DB_PASSWORD'] ?? getenv('DB_PASS') ?? getenv('DB_PASSWORD') ?? (defined('DB_PASS') ? DB_PASS : (defined('DB_PASSWORD') ? DB_PASSWORD : ''));

if ($dbname === '' || $username === '' || $password === '') {
    http_response_code(500);
    echo "Database configuration error: missing DB_NAME, DB_USER/DB_USERNAME, or DB_PASS/DB_PASSWORD.";
    exit;
}

if ($host === 'localhost') {
    $host = '127.0.0.1';
}

// Create mysqli connection (force TCP over socket)
$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed: " . $conn->connect_error;
    exit;
}

$conn->set_charset("utf8mb4");

return $conn;
