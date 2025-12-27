<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/partials/auth.php";
require_login();

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

$pageTitle = t("page_title_request");
$success = "";
$error = "";

if ($isLocal && isset($_GET["success"])) {
    $success = t("request_success");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($isLocal) {
        header("Location: /dashboard.php?success=1");
        exit;
    }

    $conn = require __DIR__ . "/../config/db.php";
    $title = trim($_POST["title"] ?? "");
    $budget = trim($_POST["budget"] ?? "");
    $timeline = trim($_POST["timeline"] ?? "");
    $details = trim($_POST["details"] ?? "");

    if ($title === "" || $details === "") {
        $error = t("request_error");
    } else {
        $stmt = $conn->prepare("INSERT INTO project_requests (user_id, title, budget, timeline, details, status) VALUES (?, ?, ?, ?, ?, 'Submitted')");
        $stmt->bind_param("issss", $_SESSION["user_id"], $title, $budget, $timeline, $details);
        if ($stmt->execute()) {
            $success = t("request_success");
        } else {
            $error = t("request_error_failed");
        }
        $stmt->close();
    }
}

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="glass-card p-5">
                    <h2 class="fw-bold mb-3"><?= htmlspecialchars(t("request_heading")) ?></h2>
                    <p class="text-muted mb-4"><?= htmlspecialchars(t("request_subheading")) ?></p>
                    <?php if ($success) : ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php elseif ($error) : ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label"><?= htmlspecialchars(t("request_title_label")) ?></label>
                            <input class="form-control" name="title" placeholder="<?= htmlspecialchars(t("request_title_placeholder")) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?= htmlspecialchars(t("request_budget_label")) ?></label>
                            <input class="form-control" name="budget" placeholder="<?= htmlspecialchars(t("request_budget_placeholder")) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?= htmlspecialchars(t("request_timeline_label")) ?></label>
                            <input class="form-control" name="timeline" placeholder="<?= htmlspecialchars(t("request_timeline_placeholder")) ?>">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><?= htmlspecialchars(t("request_details_label")) ?></label>
                            <textarea class="form-control" name="details" rows="5" placeholder="<?= htmlspecialchars(t("request_details_placeholder")) ?>" required></textarea>
                        </div>
                        <button class="btn btn-accent w-100" type="submit"><?= htmlspecialchars(t("request_submit_button")) ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
