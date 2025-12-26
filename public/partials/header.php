<?php
require_once __DIR__ . "/../config.php";

$pageTitle = $pageTitle ?? t("page_title_default");
$isLoggedIn = isset($_SESSION["user_id"]);
$isAdmin = ($isLoggedIn && ($_SESSION["user_role"] ?? "") === "admin");
$currentLang = $lang;
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($currentLang) ?>" dir="<?= htmlspecialchars($dir) ?>" data-theme="dark">
<head>
    <link rel="stylesheet" href="/assets/css/theme.css">
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
            --glass-start: rgba(20, 24, 36, 0.9);
            --glass-end: rgba(11, 13, 18, 0.9);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-shadow: 0 25px 60px rgba(5, 7, 12, 0.45);
            --nav-bg: rgba(11, 13, 18, 0.85);
            --input-bg: #10131b;
            --input-border: rgba(255, 255, 255, 0.12);
        }
        html[data-theme="light"] {
            --bg-dark: #f7f7fb;
            --bg-surface: #ffffff;
            --text-primary: #1c1e24;
            --text-muted: #5a647a;
            --accent: #8b5cf6;
            --accent-soft: rgba(139, 92, 246, 0.18);
            --glass-start: rgba(0, 0, 0, 0);
            --glass-end: rgba(0, 0, 0, 0);
            --glass-border: rgba(15, 23, 42, 0.16);
            --glass-shadow: none;
            --nav-bg: rgba(247, 247, 251, 0.9);
            --input-bg: #ffffff;
            --input-border: rgba(15, 23, 42, 0.12);
            --glass-start: rgba(20, 24, 36, 0.9);
            --glass-end: rgba(11, 13, 18, 0.9);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-shadow: 0 25px 60px rgba(5, 7, 12, 0.45);
            --nav-bg: rgba(11, 13, 18, 0.85);
            --input-bg: #10131b;
            --input-border: rgba(255, 255, 255, 0.12);
        }
        html[data-theme="light"] {
            --bg-dark: #f7f7fb;
            --bg-surface: #ffffff;
            --text-primary: #1c1e24;
            --text-muted: #5a647a;
            --accent: #8b5cf6;
            --accent-soft: rgba(139, 92, 246, 0.18);
            --glass-start: rgba(255, 255, 255, 0.95);
            --glass-end: rgba(238, 241, 248, 0.9);
            --glass-border: rgba(15, 23, 42, 0.08);
            --glass-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
            --nav-bg: rgba(247, 247, 251, 0.9);
            --input-bg: #ffffff;
            --input-border: rgba(15, 23, 42, 0.12);
        }
        body {
            font-family: "Manrope", sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            letter-spacing: 0.01em;
        }
        body.rtl {
            direction: rtl;
            text-align: right;
        }
        h1, h2, h3, h4, .brand {
            font-family: "Space Grotesk", sans-serif;
        }
        .navbar {
            backdrop-filter: blur(12px);
            background: var(--nav-bg);
        }
        html[data-theme="light"] .navbar {
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }
        html[data-theme="light"] .navbar-dark .navbar-brand,
        html[data-theme="light"] .navbar-dark .navbar-nav .nav-link {
            color: var(--text-primary);
        }
        html[data-theme="light"] .navbar-dark .navbar-nav .nav-link.active,
        html[data-theme="light"] .navbar-dark .navbar-nav .nav-link:hover {
            color: #4c1d95;
        }
        .rtl .navbar-nav {
            margin-right: auto !important;
            margin-left: 0 !important;
        }
        .rtl .language-toggle {
            flex-direction: row-reverse;
        }
        .rtl .package-features li {
            flex-direction: row-reverse;
        }
        .hero {
            padding: 120px 0 80px;
        }
        .glass-card {
            background: linear-gradient(140deg, var(--glass-start), var(--glass-end));
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            box-shadow: var(--glass-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        html[data-theme="light"] .glass-card {
            background: transparent;
            box-shadow: none;
        }
        .glass-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 35px 70px rgba(5, 7, 12, 0.55);
        }
        html[data-theme="light"] .glass-card:hover {
            box-shadow: none;
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
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            color: var(--text-primary);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.15);
            background: var(--input-bg);
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
        .language-toggle {
            border: 1px solid var(--input-border);
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 0.85rem;
        }
        .language-toggle a {
            padding: 4px 8px;
            border-radius: 999px;
        }
        .language-toggle a.active {
            background: rgba(139, 92, 246, 0.2);
            color: #d9ccff;
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
        html[data-theme="light"] #what-we-do h2,
        html[data-theme="light"] #what-we-do .text-muted,
        html[data-theme="light"] #what-we-do p,
        html[data-theme="light"] .service-card h5,
        html[data-theme="light"] .service-card p {
            color: var(--text-primary);
        }
        html[data-theme="light"] .service-card {
            background: transparent;
            border-color: var(--glass-border);
            box-shadow: none;
        }
        html[data-theme="light"] footer.border-top {
            border-color: rgba(15, 23, 42, 0.1) !important;
        }
        html[data-theme="light"] .glass-card .text-muted,
        html[data-theme="light"] .glass-card p,
        html[data-theme="light"] .glass-card h3,
        html[data-theme="light"] .glass-card h5 {
            color: var(--text-primary);
        }
        html[data-theme="light"] .badge-status {
            background: rgba(139, 92, 246, 0.12);
            color: #5b21b6;
            border-color: rgba(139, 92, 246, 0.3);
        }
        html[data-theme="light"] .btn-outline-light {
            color: var(--text-primary);
            border-color: rgba(15, 23, 42, 0.2);
        }
        html[data-theme="light"] .btn-outline-light:hover {
            color: var(--text-primary);
            background: rgba(15, 23, 42, 0.05);
        }
        html[data-theme="light"] .table-dark {
            --bs-table-bg: #ffffff;
            --bs-table-striped-bg: #f1f3f7;
            --bs-table-striped-color: var(--text-primary);
            --bs-table-color: var(--text-primary);
            --bs-table-border-color: #e3e6ef;
        }
    </style>
    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/site.css" rel="stylesheet">

</head>
<body class="<?= $isRtl ? "rtl" : "" ?>">
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand brand fw-semibold" href="index.php"><?= htmlspecialchars(t("brand_name")) ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto gap-2 align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="index.php#services"><?= htmlspecialchars(t("nav_services")) ?></a></li>
                <li class="nav-item"><a class="nav-link" href="services.php"><?= htmlspecialchars(t("nav_services_page")) ?></a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#portfolio"><?= htmlspecialchars(t("nav_portfolio")) ?></a></li>
                <li class="nav-item"><a class="nav-link" href="request_project.php"><?= htmlspecialchars(t("nav_request")) ?></a></li>
                <?php if ($isLoggedIn) : ?>
                    <?php if ($isAdmin) : ?>
                        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><?= htmlspecialchars(t("nav_admin")) ?></a></li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="dashboard.php"><?= htmlspecialchars(t("nav_dashboard")) ?></a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><?= htmlspecialchars(t("nav_logout")) ?></a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link" href="register.php"><?= htmlspecialchars(t("nav_register")) ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><?= htmlspecialchars(t("nav_login")) ?></a></li>
                <?php endif; ?>
                <li class="nav-item">
                    <div class="language-toggle d-flex align-items-center gap-1">
                        <a class="<?= $currentLang === "en" ? "active" : "" ?>" data-lang="en" href="<?= htmlspecialchars(language_url("en")) ?>"><?= htmlspecialchars(t("lang_toggle_en")) ?></a>
                        <span class="text-muted">|</span>
                        <a class="<?= $currentLang === "ar" ? "active" : "" ?>" data-lang="ar" href="<?= htmlspecialchars(language_url("ar")) ?>"><?= htmlspecialchars(t("lang_toggle_ar")) ?></a>
                        <button id="theme-toggle" class="btn btn-sm btn-outline-light ms-2" type="button" aria-label="Toggle theme">
                            🌙
                        </button>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
