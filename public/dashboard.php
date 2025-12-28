<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

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

$pageTitle = t("page_title_dashboard");

$requests = [];
if (!$isLocal) {
    $conn = require __DIR__ . "/../config/db.php";
    $stmt = $conn->prepare("SELECT id, title, budget, timeline, status, created_at FROM project_requests WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $requests = [
        [
            "title" => t("dashboard_demo_project_1"),
            "budget" => t("dashboard_demo_budget_1"),
            "timeline" => t("dashboard_demo_timeline_1"),
            "status" => "Submitted",
            "created_at" => "2025-12-27",
        ],
        [
            "title" => t("dashboard_demo_project_2"),
            "budget" => t("dashboard_demo_budget_2"),
            "timeline" => t("dashboard_demo_timeline_2"),
            "status" => "In Progress",
            "created_at" => "2025-12-20",
        ],
    ];
}

$statusLabels = [
    "submitted" => t("status_submitted"),
    "reviewing" => t("status_reviewing"),
    "in progress" => t("status_in_progress"),
    "completed" => t("status_completed"),
];

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h1 class="fw-bold mb-1"><?= htmlspecialchars(t("dashboard_heading")) ?></h1>
                <h2 class="fw-bold mb-1"><?= htmlspecialchars(t("dashboard_welcome", ["name" => $_SESSION["user_name"] ?? t("dashboard_client_fallback")])) ?></h2>
                <p class="text-muted mb-0"><?= htmlspecialchars(t("dashboard_subheading")) ?></p>
            </div>
            <a class="btn btn-accent" href="request_project.php"><?= htmlspecialchars(t("dashboard_new_request")) ?></a>
        </div>

        <div class="glass-card p-4">
            <div class="table-responsive">
                <table class="table table-dark table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-muted">
                            <th scope="col"><?= htmlspecialchars(t("dashboard_table_project")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("dashboard_table_budget")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("dashboard_table_timeline")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("dashboard_table_status")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("dashboard_table_submitted")) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($requests)) : ?>
                            <tr>
                                <td colspan="5" class="text-muted"><?= htmlspecialchars(t("dashboard_empty")) ?></td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($requests as $request) : ?>
                                <?php
                                $budget = $request["budget"];
                                $timeline = $request["timeline"];
                                if ($lang === "ar") {
                                    $budget = localize_digits((string) $budget);
                                    $timeline = localize_digits((string) $timeline);
                                }
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($request["title"]) ?></td>
                                    <td><?= htmlspecialchars($budget) ?></td>
                                    <td><?= htmlspecialchars($timeline) ?></td>
                                    <td>
                                        <?php
                                        $statusKey = strtolower((string) $request["status"]);
                                        $statusLabel = $statusLabels[$statusKey] ?? $request["status"];
                                        ?>
                                        <span class="badge-status"><?= htmlspecialchars($statusLabel) ?></span>
                                    </td>
                                    <td class="text-muted"><?= htmlspecialchars(format_date($request["created_at"])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
