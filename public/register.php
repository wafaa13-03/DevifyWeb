<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . "/config.php";

$envLocalPath = dirname(__DIR__) . "/.env.local";
if (!getenv("APP_ENV") && file_exists($envLocalPath)) {
    $lines = file($envLocalPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === "" || strpos($line, "#") === 0) {
                continue;
            }
            [$key, $value] = array_pad(explode("=", $line, 2), 2, "");
            $key = trim($key);
            $value = trim($value, "\"'");
            if ($key === "") {
                continue;
            }
            putenv($key . "=" . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

$isLocal = getenv("APP_ENV") === "local";

/**
 * HANDLE REGISTER SUBMISSION
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // LOCAL ENV → fake register (NO DATABASE)
    if ($isLocal) {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = trim($_POST['name'] ?? 'Local User');
        header("Location: /dashboard.php");
        exit;
    }

    // PRODUCTION → real DB register
    $conn = require __DIR__ . '/../config/db.php';

    // TODO: real registration logic later
    // For now, redirect so demo doesn't break
    header("Location: /login.php?success=1");
    exit;
}

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="glass-card p-5">
                    <h2 class="fw-bold mb-2"><?= htmlspecialchars(t("register_heading")) ?></h2>
                    <p class="text-muted mb-4"><?= htmlspecialchars(t("register_subheading")) ?></p>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label"><?= htmlspecialchars(t("label_full_name")) ?></label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?= htmlspecialchars(t("label_email")) ?></label>
                            <input class="form-control" type="email" name="email" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><?= htmlspecialchars(t("label_password")) ?></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>

                        <button class="btn btn-accent w-100" type="submit">
                            <?= htmlspecialchars(t("register_button")) ?>
                        </button>
                    </form>

                    <p class="text-muted mt-3 mb-0">
                        <?= htmlspecialchars(t("register_login_prompt")) ?>
                        <a href="login.php"><?= htmlspecialchars(t("register_login_link")) ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
