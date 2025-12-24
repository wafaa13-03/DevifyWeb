<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . "/partials/auth.php";
require_login();
require_once __DIR__ . "/../config/db.php";

$pageTitle = "Client Dashboard | Devify";

$stmt = $conn->prepare("SELECT id, title, budget, timeline, status, created_at FROM project_requests WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

require_once __DIR__ . "/partials/headera<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/partials/auth.php";
require_login();
require_once __DIR__ . "/../config/db.php";

$pageTitle = t("page_title_dashboard");

$stmt = $conn->prepare("SELECT id, title, budget, timeline, status, created_at FROM project_requests WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$statusLabels = [
    "Submitted" => t("status_submitted"),
    "Reviewing" => t("status_reviewing"),
    "In Progress" => t("status_in_progress"),
    "Completed" => t("status_completed")
];

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1"><?= htmlspecialchars(t("dashboard_welcome", ["name" => $_SESSION["user_name"] ?? "Client"])) ?></h2>
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
                                <tr>
                                    <td><?= htmlspecialchars($request["title"]) ?></td>
                                    <td><?= htmlspecialchars($request["budget"]) ?></td>
                                    <td><?= htmlspecialchars($request["timeline"]) ?></td>
                                    <td>
                                        <span class="badge-status"><?= htmlspecialchars($statusLabels[$request["status"]] ?? $request["status"]) ?></span>
                                    </td>
                                    <td class="text-muted"><?= htmlspecialchars(date("M d, Y", strtotime($request["created_at"]))) ?></td>
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
.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Welcome, <?= htmlspecialchars($_SESSION["user_name"] ?? "Client") ?>.</h2>
                <p class="text-muted mb-0">Track your project requests and current status.</p>
            </div>
            <a class="btn btn-accent" href="request_project.php">New request</a>
        </div>

        <div class="glass-card p-4">
            <div class="table-responsive">
                <table class="table table-dark table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-muted">
                            <th scope="col">Project</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Timeline</th>
                            <th scope="col">Status</th>
                            <th scope="col">Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($requests)) : ?>
                            <tr>
                                <td colspan="5" class="text-muted">No requests yet. Submit your first project brief.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($requests as $request) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($request["title"]) ?></td>
                                    <td><?= htmlspecialchars($request["budget"]) ?></td>
                                    <td><?= htmlspecialchars($request["timeline"]) ?></td>
                                    <td><span class="badge-status"><?= htmlspecialchars($request["status"]) ?></span></td>
                                    <td class="text-muted"><?= htmlspecialchars(date("M d, Y", strtotime($request["created_at"]))) ?></td>
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
