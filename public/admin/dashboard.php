<?php
// ===== TEMP ADMIN ACCESS (NO LOGIN REQUIRED) =====
session_start();
$_SESSION['is_admin'] = true;
$_SESSION['user_id'] = 1;
$_SESSION['user_name'] = 'Admin';

require_once __DIR__ . '/../config.php';

// ===== DATABASE CONNECTION =====
$conn = require __DIR__ . '/../../config/db.php';
if (!$conn) {
    die("Database connection failed");
}

// ===== HANDLE STATUS UPDATE =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'], $_POST['status'])) {
    $stmt = $conn->prepare("UPDATE project_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $_POST['status'], $_POST['request_id']);
    $stmt->execute();
    $stmt->close();
}

// ===== FETCH PROJECT REQUESTS =====
$requests = [];
$result = $conn->query("SELECT * FROM project_requests ORDER BY created_at DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}

$statusLabels = [
    "pending" => t("admin_status_pending"),
    "in progress" => t("admin_status_in_progress"),
    "completed" => t("admin_status_completed"),
];
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>" dir="<?= htmlspecialchars($dir) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars(t("page_title_admin_dashboard")) ?></title>
    <link rel="stylesheet" href="/assets/css/theme.css">
    <link rel="stylesheet" href="/assets/css/site.css">
</head>
<body class="<?= $dir === "rtl" ? "rtl" : "" ?>">

<section class="section-spacing">
    <div class="container">
        <h1 class="fw-bold mb-4"><?= htmlspecialchars(t("admin_dashboard_heading")) ?></h1>

        <div class="glass-card p-4 mb-5">
            <h3 class="fw-bold mb-3"><?= htmlspecialchars(t("admin_requests_heading")) ?></h3>

            <?php if (empty($requests)): ?>
                <p class="text-muted"><?= htmlspecialchars(t("admin_empty")) ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th><?= htmlspecialchars(t("admin_table_id")) ?></th>
                                <th><?= htmlspecialchars(t("admin_table_project_type")) ?></th>
                                <th><?= htmlspecialchars(t("admin_table_description")) ?></th>
                                <th><?= htmlspecialchars(t("admin_table_status")) ?></th>
                                <th><?= htmlspecialchars(t("admin_table_created")) ?></th>
                                <th><?= htmlspecialchars(t("admin_table_update")) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($requests as $req): ?>
                            <tr>
                                <td><?= htmlspecialchars($lang === "ar" ? localize_digits((string) $req['id']) : $req['id']) ?></td>
                                <td><?= htmlspecialchars($req['project_type']) ?></td>
                                <td><?= htmlspecialchars($req['description']) ?></td>
                                <td>
                                    <span class="badge">
                                        <?= htmlspecialchars($statusLabels[strtolower((string) $req['status'])] ?? $req['status']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars(format_date($req['created_at'])) ?></td>
                                <td>
                                    <form method="post" class="d-flex gap-2">
                                        <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="pending"><?= htmlspecialchars(t("admin_status_pending")) ?></option>
                                            <option value="in progress"><?= htmlspecialchars(t("admin_status_in_progress")) ?></option>
                                            <option value="completed"><?= htmlspecialchars(t("admin_status_completed")) ?></option>
                                        </select>
                                        <button class="btn btn-accent btn-sm" type="submit"><?= htmlspecialchars(t("admin_save_button")) ?></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <div class="glass-card p-4">
            <h3 class="fw-bold mb-2"><?= htmlspecialchars(t("admin_portfolio_heading")) ?></h3>
            <p class="text-muted"><?= htmlspecialchars(t("admin_portfolio_subheading")) ?></p>
            <ul class="text-muted">
                <li><?= htmlspecialchars(t("admin_portfolio_add_button")) ?></li>
                <li><?= htmlspecialchars(t("admin_portfolio_update_button")) ?></li>
                <li><?= htmlspecialchars(t("admin_portfolio_delete_button")) ?></li>
            </ul>
        </div>

    </div>
</section>

</body>
</html>
