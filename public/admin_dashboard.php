<?php
require_once __DIR__ . "/partials/auth.php";
require_admin();
require_once __DIR__ . "/../config/db.php";

$pageTitle = "Admin Dashboard | Devify";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["request_id"], $_POST["status"])) {
    $requestId = (int) $_POST["request_id"];
    $status = trim($_POST["status"]);
    $stmt = $conn->prepare("UPDATE project_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $requestId);
    if ($stmt->execute()) {
        $message = "Status updated.";
    }
    $stmt->close();
}

$result = $conn->query("SELECT project_requests.id, project_requests.title, project_requests.budget, project_requests.timeline, project_requests.status, project_requests.created_at, users.name, users.email FROM project_requests JOIN users ON project_requests.user_id = users.id ORDER BY project_requests.created_at DESC");
$requests = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Admin overview</h2>
                <p class="text-muted mb-0">Manage every incoming request across the portfolio.</p>
            </div>
            <span class="badge-status"><?= count($requests) ?> total requests</span>
        </div>

        <?php if ($message) : ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="glass-card p-4">
            <div class="table-responsive">
                <table class="table table-dark table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-muted">
                            <th scope="col">Client</th>
                            <th scope="col">Project</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Timeline</th>
                            <th scope="col">Status</th>
                            <th scope="col">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($requests)) : ?>
                            <tr>
                                <td colspan="6" class="text-muted">No project requests yet.</td>
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
                                    <td><span class="badge-status"><?= htmlspecialchars($request["status"]) ?></span></td>
                                    <td>
                                        <form method="post" class="d-flex gap-2 align-items-center">
                                            <input type="hidden" name="request_id" value="<?= (int) $request["id"] ?>">
                                            <select class="form-select form-select-sm" name="status">
                                                <?php foreach (["Submitted", "Reviewing", "In Progress", "Completed"] as $status) : ?>
                                                    <option value="<?= $status ?>" <?= $status === $request["status"] ? "selected" : "" ?>>
                                                        <?= $status ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button class="btn btn-accent btn-sm" type="submit">Save</button>
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
