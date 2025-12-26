<?php
// ===== TEMP ADMIN ACCESS (NO LOGIN REQUIRED) =====
session_start();
$_SESSION['is_admin'] = true;
$_SESSION['user_id'] = 1;
$_SESSION['user_name'] = 'Admin';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<section class="section-spacing">
    <div class="container">
        <h1 class="fw-bold mb-4">Admin Dashboard</h1>

        <div class="glass-card p-4 mb-5">
            <h3 class="fw-bold mb-3">Client Project Requests</h3>

            <?php if (empty($requests)): ?>
                <p class="text-muted">No project requests found.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($requests as $req): ?>
                            <tr>
                                <td><?= htmlspecialchars($req['id']) ?></td>
                                <td><?= htmlspecialchars($req['project_type']) ?></td>
                                <td><?= htmlspecialchars($req['description']) ?></td>
                                <td>
                                    <span class="badge">
                                        <?= htmlspecialchars($req['status']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($req['created_at']) ?></td>
                                <td>
                                    <form method="post" class="d-flex gap-2">
                                        <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="pending">Pending</option>
                                            <option value="in progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                        <button class="btn btn-accent btn-sm" type="submit">
                                            Save
                                        </button>
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
            <h3 class="fw-bold mb-2">Portfolio Management</h3>
            <p class="text-muted">
                (Demo scope) Portfolio CRUD can be extended here.
            </p>
            <ul class="text-muted">
                <li>Add new portfolio items</li>
                <li>Edit existing items</li>
                <li>Delete outdated projects</li>
            </ul>
        </div>

    </div>
</section>

</body>
</html>

