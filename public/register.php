<?php
require_once __DIR__ . "/../config/db.php";

$pageTitle = "Register | Devify";
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name === "" || $email === "" || $password === "") {
        $error = "All fields are required.";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        if ($check->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'client')");
            $stmt->bind_param("sss", $name, $email, $hashed);
            if ($stmt->execute()) {
                $success = "Registration complete. You can now log in.";
            } else {
                $error = "Registration failed. Please try again.";
            }
            $stmt->close();
        }
        $check->close();
    }
}

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="glass-card p-5">
                    <h2 class="fw-bold mb-2">Create your client portal.</h2>
                    <p class="text-muted mb-4">Join Devify to start submitting project requests.</p>
                    <?php if ($success) : ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php elseif ($error) : ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Full name</label>
                            <input class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" name="email" type="email" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input class="form-control" name="password" type="password" required>
                        </div>
                        <button class="btn btn-accent w-100" type="submit">Register</button>
                    </form>
                    <p class="text-muted mt-3 mb-0">Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
