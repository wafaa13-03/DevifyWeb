<?php
require_once __DIR__ . "/config.php";
$pageTitle = t("page_title_home");
require_once __DIR__ . "/partials/header.php";
?>

<header class="hero">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <p class="text-uppercase text-muted fw-semibold mb-3"><?= htmlspecialchars(t("hero_kicker")) ?></p>
                <h1 class="display-4 fw-bold mb-4"><?= htmlspecialchars(t("hero_title")) ?></h1>
                <p class="lead text-muted mb-4">
                    <?= htmlspecialchars(t("hero_lead")) ?>
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-accent" href="request_project.php"><?= htmlspecialchars(t("hero_request_cta")) ?></a>
                    <a class="btn btn-outline-light rounded-pill px-4" href="#services"><?= htmlspecialchars(t("hero_services_cta")) ?></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted"><?= htmlspecialchars(t("client_portal")) ?></span>
                        <span class="badge-status"><?= htmlspecialchars(t("client_portal_status")) ?></span>
                    </div>
                    <h3 class="fw-semibold mb-3"><?= htmlspecialchars(t("client_portal_title")) ?></h3>
                    <p class="text-muted">
                        <?= htmlspecialchars(t("client_portal_desc")) ?>
                    </p>
                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div class="p-3 glass-card h-100">
                                <p class="text-muted mb-1"><?= htmlspecialchars(t("average_delivery_label")) ?></p>
                                <h4 class="fw-semibold mb-0">5-7 weeks</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 glass-card h-100">
                                <p class="text-muted mb-1"><?= htmlspecialchars(t("client_retention_label")) ?></p>
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
                <h2 class="fw-bold"><?= htmlspecialchars(t("services_heading")) ?></h2>
            </div>
            <div class="col-lg-6">
                <p class="text-muted">
                    <?= htmlspecialchars(t("services_desc")) ?>
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold mb-3"><?= htmlspecialchars(t("service_strategy_title")) ?></h5>
                    <p class="text-muted"><?= htmlspecialchars(t("service_strategy_desc")) ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold mb-3"><?= htmlspecialchars(t("service_design_title")) ?></h5>
                    <p class="text-muted"><?= htmlspecialchars(t("service_design_desc")) ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold mb-3"><?= htmlspecialchars(t("service_delivery_title")) ?></h5>
                    <p class="text-muted"><?= htmlspecialchars(t("service_delivery_desc")) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="portfolio" class="section-spacing">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h2 class="fw-bold"><?= htmlspecialchars(t("portfolio_heading")) ?></h2>
            <span class="text-muted"><?= htmlspecialchars(t("portfolio_kicker")) ?></span>
        </div>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold">Lumen Labs</h5>
                    <p class="text-muted mb-0"><?= htmlspecialchars(t("work_lumen_desc")) ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold">Astral Commerce</h5>
                    <p class="text-muted mb-0"><?= htmlspecialchars(t("work_astral_desc")) ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-semibold">Signal Cloud</h5>
                    <p class="text-muted mb-0"><?= htmlspecialchars(t("work_signal_desc")) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
