<?php
require_once __DIR__ . "/../config/db.php";

$pageTitle = "Client Login | Devify";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user && $user["role"] === "client" && password_verify($password, $user["password"])) {
        session_start();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["user_role"] = $user["role"];
        header("Location: dashboard.php");
        exit;
    }
    $error = "Invalid credentials.";
    $stmt->close();
}

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="glass-card p-5">
                    <h2 class="fw-bold mb-2">Welcome back.</h2>
                    <p class="text-muted mb-4">Sign in to access your client portal.</p>
                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" name="email" type="email" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input class="form-control" name="password" type="password" required>
                        </div>
                        <button class="btn btn-accent w-100" type="submit">Login</button>
                    </form>
                    <p class="text-muted mt-3 mb-0">New to Devify? <a href="register.php">Create account</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
