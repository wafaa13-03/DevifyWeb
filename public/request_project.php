<?php
require_once __DIR__ . "/partials/auth.php";
require_login();
require_once __DIR__ . "/../config/db.php";

$pageTitle = "Request a Project | Devify";
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $budget = trim($_POST["budget"] ?? "");
    $timeline = trim($_POST["timeline"] ?? "");
    $details = trim($_POST["details"] ?? "");

    if ($title === "" || $details === "") {
        $error = "Please provide a project title and details.";
    } else {
        $stmt = $conn->prepare("INSERT INTO project_requests (user_id, title, budget, timeline, details, status) VALUES (?, ?, ?, ?, ?, 'Submitted')");
        $stmt->bind_param("issss", $_SESSION["user_id"], $title, $budget, $timeline, $details);
        if ($stmt->execute()) {
            $success = "Project request submitted successfully.";
        } else {
            $error = "Unable to submit your request. Please try again.";
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
                    <h2 class="fw-bold mb-3">Start your next build.</h2>
                    <p class="text-muted mb-4">Tell us about your product vision and we will respond within 24 hours.</p>
                    <?php if ($success) : ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php elseif ($error) : ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Project name</label>
                            <input class="form-control" name="title" placeholder="e.g. Premium SaaS redesign" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estimated budget</label>
                            <input class="form-control" name="budget" placeholder="$10k - $30k">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ideal timeline</label>
                            <input class="form-control" name="timeline" placeholder="6-8 weeks">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Project details</label>
                            <textarea class="form-control" name="details" rows="5" placeholder="Describe your goals, features, and expectations." required></textarea>
                        </div>
                        <button class="btn btn-accent w-100" type="submit">Submit request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
