

<?php



$pageTitle = "Devify | Premium Digital Studio";
require_once __DIR__ . "/partials/header.php";
?>

<header class="hero">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <p class="text-uppercase text-muted fw-semibold mb-3"></p>
                <h1 class="display-4 fw-bold mb-4">Where design meets smart technology.</h1>
                <p class="lead text-muted mb-4">
                    We help brands turn ideas into engaging digital products through clean UX, modern web design, and innovative solutions.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-accent" href="request_project.php">Request a project</a>
                    <a class="btn btn-outline-light rounded-pill px-4" href="#services">Explore services</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted">Client Portal</span>
                        <span class="badge-status">Live</span>
                    </div>
                    <h3 class="fw-semibold mb-3">Track every milestone in one place.</h3>
                    <p class="text-muted">
                        Stay aligned with real-time status updates, project highlights, and communication threads.
                    </p>
                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div class="p-3 glass-card h-100">
                                <p class="text-muted mb-1">Average delivery</p>
                                <h4 class="fw-semibold mb-0">5-7 weeks</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 glass-card h-100">
                                <p class="text-muted mb-1">Client retention</p>
                                <h4 class="fw-semibold mb-0">96%</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="services" class="section-spacing">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold">Services built for high-growth teams.</h2>
            </div>
            <div class="col-lg-6">
                <p class="text-muted">
                    From launch strategy to full-scale engineering, Devify brings boutique attention with enterprise execution.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold mb-3">Product Strategy</h5>
                    <p class="text-muted">Roadmapping, market insights, and launch planning tailored to your growth.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold mb-3">Design & UX</h5>
                    <p class="text-muted">Minimal, sophisticated interfaces with signature motion and polish.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold mb-3">Full-stack Delivery</h5>
                    <p class="text-muted">PHP 8 + MySQL architecture, built for performance, security, and scale.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="portfolio" class="section-spacing">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h2 class="fw-bold">Selected work</h2>
            <span class="text-muted">Curated for ambitious brands.</span>
        </div>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold">Lumen Labs</h5>
                    <p class="text-muted mb-0">AI-enabled experience platform for enterprise teams.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold">Astral Commerce</h5>
                    <p class="text-muted mb-0">Luxury commerce stack for premium lifestyle brands.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold">Signal Cloud</h5>
                    <p class="text-muted mb-0">Unified analytics hub for data-first organizations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
