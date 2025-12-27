<?php

// Detect local environment (Mac using php -S)
if (
    php_sapi_name() === 'cli-server' ||
    getenv('APP_ENV') === 'local'
) {
    // Local dev: skip DB connection entirely
    return;
}



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

$useSSL = filter_var($_ENV['DB_SSL'] ?? getenv('DB_SSL') ?? 'false', FILTER_VALIDATE_BOOLEAN);

if ($dbname === '' || $username === '' || $password === '') {
    http_response_code(500);
    echo "Database configuration error: missing DB_NAME, DB_USER/DB_USERNAME, or DB_PASS/DB_PASSWORD.";
    exit;
}

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
    http_response_code(500);
    echo "Database connection failed: " . mysqli_connect_error();
    exit;
}

$conn->set_charset("utf8mb4");
