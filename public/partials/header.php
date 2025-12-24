<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$pageTitle = $pageTitle ?? "Devify";
$isLoggedIn = isset($_SESSION["user_id"]);
$isAdmin = ($isLoggedIn && ($_SESSION["user_role"] ?? "") === "admin");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0b0d12;
            --bg-surface: #141824;
            --text-primary: #f5f7ff;
            --text-muted: #9aa4bf;
            --accent: #8b5cf6;
            --accent-soft: rgba(139, 92, 246, 0.2);
        }
        body {
            font-family: "Manrope", sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            letter-spacing: 0.01em;
        }
        h1, h2, h3, h4, .brand {
            font-family: "Space Grotesk", sans-serif;
        }
        .navbar {
            backdrop-filter: blur(12px);
            background: rgba(11, 13, 18, 0.85);
        }
        .hero {
            padding: 120px 0 80px;
        }
        .glass-card {
            background: linear-gradient(140deg, rgba(20, 24, 36, 0.9), rgba(11, 13, 18, 0.9));
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(5, 7, 12, 0.45);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 35px 70px rgba(5, 7, 12, 0.55);
        }
        .btn-accent {
            background: var(--accent);
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 999px;
            transition: all 0.3s ease;
        }
        .btn-accent:hover {
            box-shadow: 0 0 20px var(--accent-soft);
            transform: translateY(-1px);
            color: #fff;
        }
        .text-muted {
            color: var(--text-muted) !important;
        }
        .form-control, .form-select {
            background: #10131b;
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: var(--text-primary);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.15);
            background: #10131b;
            color: var(--text-primary);
        }
        .badge-status {
            background: rgba(139, 92, 246, 0.15);
            color: #c4b5fd;
            border: 1px solid rgba(139, 92, 246, 0.35);
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
        }
        a {
            color: inherit;
            text-decoration: none;
        }
        a:hover {
            color: var(--accent);
        }
        .section-spacing {
            padding: 80px 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand brand fw-semibold" href="index.php">Devify</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto gap-2">
                <li class="nav-item"><a class="nav-link" href="index.php#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="request_project.php">Request</a></li>
                <?php if ($isLoggedIn) : ?>
                    <?php if ($isAdmin) : ?>
                        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Admin</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
