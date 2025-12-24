<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/partials/auth.php";
require_admin();
require_once __DIR__ . "/../config/db.php";

$pageTitle = t("page_title_admin_dashboard");
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["request_id"], $_POST["status"])) {
    $requestId = (int) $_POST["request_id"];
    $status = trim($_POST["status"]);
    $stmt = $conn->prepare("UPDATE project_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $requestId);
    if ($stmt->execute()) {
        $message = t("admin_status_updated");
    }
    $stmt->close();
}

$result = $conn->query("SELECT project_requests.id, project_requests.title, project_requests.budget, project_requests.timeline, project_requests.status, project_requests.created_at, users.name, users.email FROM project_requests JOIN users ON project_requests.user_id = users.id ORDER BY project_requests.created_at DESC");
$requests = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

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
                <h2 class="fw-bold mb-1"><?= htmlspecialchars(t("admin_dashboard_heading")) ?></h2>
                <p class="text-muted mb-0"><?= htmlspecialchars(t("admin_dashboard_subheading")) ?></p>
            </div>
            <span class="badge-status"><?= htmlspecialchars(t("admin_total_requests", ["count" => count($requests)])) ?></span>
        </div>

        <?php if ($message) : ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="glass-card p-4">
            <div class="table-responsive">
                <table class="table table-dark table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-muted">
                            <th scope="col"><?= htmlspecialchars(t("admin_table_client")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("admin_table_project")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("admin_table_budget")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("admin_table_timeline")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("admin_table_status")) ?></th>
                            <th scope="col"><?= htmlspecialchars(t("admin_table_update")) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($requests)) : ?>
                            <tr>
                                <td colspan="6" class="text-muted"><?= htmlspecialchars(t("admin_empty")) ?></td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($requests as $request) : ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold"><?= htmlspecialchars($request["name"]) ?></div>
                                        <div class="text-muted small"><?= htmlspecialchars($request["email"]) ?></div>
                                    </td>
                                    <td><?= htmlspecialchars($request["title"]) ?></td>
                                    <td><?= htmlspecialchars($request["budget"]) ?></td>
                                    <td><?= htmlspecialchars($request["timeline"]) ?></td>
                                    <td><span class="badge-status"><?= htmlspecialchars($statusLabels[$request["status"]] ?? $request["status"]) ?></span></td>
                                    <td>
                                        <form method="post" class="d-flex gap-2 align-items-center">
                                            <input type="hidden" name="request_id" value="<?= (int) $request["id"] ?>">
                                            <select class="form-select form-select-sm" name="status">
                                                <?php foreach (["Submitted", "Reviewing", "In Progress", "Completed"] as $status) : ?>
                                                    <option value="<?= $status ?>" <?= $status === $request["status"] ? "selected" : "" ?>>
                                                        <?= htmlspecialchars($statusLabels[$status] ?? $status) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button class="btn btn-accent btn-sm" type="submit"><?= htmlspecialchars(t("admin_save_button")) ?></button>
                                        </form>
                                    </td>
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
