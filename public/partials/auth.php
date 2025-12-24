<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function require_login(): void
{
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }
}

function require_admin(): void
{
    if (!isset($_SESSION["user_id"]) || ($_SESSION["user_role"] ?? "") !== "admin") {
        header("Location: admin_login.php");
        exit;
    }
}
