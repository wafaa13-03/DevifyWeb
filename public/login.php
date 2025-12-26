<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TEMP SUCCESS LOGIN
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Demo User';
    header("Location: /admin/dashboard.php");
    exit;
}

require_once __DIR__ . "/partials/header.php";
?>

<section class="section-spacing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="glass-card p-5">
                    <h2 class="fw-bold mb-2">Login</h2>
                    <p class="text-muted mb-4">Access your account</p>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" required>
                        </div>

                        <button class="btn btn-accent w-100" type="submit">
                            Login
                        </button>
                    </form>

                    <p class="text-muted mt-3 mb-0">
                        Don’t have an account?
                        <a href="register.php">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>

