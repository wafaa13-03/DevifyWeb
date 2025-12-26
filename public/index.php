<?php
require_once __DIR__ . "/config.php";
$pageTitle = t("page_title_home");
require_once __DIR__ . "/partials/header.php";
?>

<header class="hero">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
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
                                <h4 class="fw-semibold mb-0"><?= htmlspecialchars(t("average_delivery_value")) ?></h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 glass-card h-100">
                                <p class="text-muted mb-1"><?= htmlspecialchars(t("client_retention_label")) ?></p>
                                <h4 class="fw-semibold mb-0"><?= htmlspecialchars(t("client_retention_value")) ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- What We Do -->
<section id="what-we-do" class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <span class="text-uppercase text-muted small"><?= htmlspecialchars(t("what_we_do_kicker")) ?></span>
      <h2 class="mt-2 fw-bold">
        <?= htmlspecialchars(t("what_we_do_title")) ?>
      </h2>
      <p class="mt-3 text-muted mx-auto" style="max-width: 720px;">
        <?= htmlspecialchars(t("what_we_do_desc")) ?>
      </p>
    </div>

    <div class="row g-4">
      <div class="col-12 col-md-4">
        <div class="service-card h-100">
          <h5><?= htmlspecialchars(t("what_we_do_card_design_title")) ?></h5>
          <p><?= htmlspecialchars(t("what_we_do_card_design_desc")) ?></p>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="service-card h-100">
          <h5><?= htmlspecialchars(t("what_we_do_card_dev_title")) ?></h5>
          <p><?= htmlspecialchars(t("what_we_do_card_dev_desc")) ?></p>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="service-card h-100">
          <h5><?= htmlspecialchars(t("what_we_do_card_launch_title")) ?></h5>
          <p><?= htmlspecialchars(t("what_we_do_card_launch_desc")) ?></p>
        </div>
      </div>
    </div>
  </div>
</section>


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
                <a class="portfolio-link h-100" href="#portfolio-details" data-portfolio-target="bean-brew">
                    <div class="glass-card p-4 h-100">
                        <h5 class="fw-semibold"><?= htmlspecialchars(t("portfolio_bean_title")) ?></h5>
                        <p class="text-muted mb-0"><?= htmlspecialchars(t("work_lumen_desc")) ?></p>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a class="portfolio-link h-100" href="#portfolio-details" data-portfolio-target="evoevents">
                    <div class="glass-card p-4 h-100">
                        <h5 class="fw-semibold"><?= htmlspecialchars(t("portfolio_evo_title")) ?></h5>
                        <p class="text-muted mb-0"><?= htmlspecialchars(t("work_astral_desc")) ?></p>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a class="portfolio-link h-100" href="#portfolio-details" data-portfolio-target="estateflow">
                    <div class="glass-card p-4 h-100">
                        <h5 class="fw-semibold"><?= htmlspecialchars(t("portfolio_estate_title")) ?></h5>
                        <p class="text-muted mb-0"><?= htmlspecialchars(t("work_signal_desc")) ?></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="portfolio-details" class="section-spacing">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-uppercase text-muted small"><?= htmlspecialchars(t("portfolio_details_heading")) ?></span>
            <h2 class="mt-2 fw-bold"><?= htmlspecialchars(t("portfolio_details_intro")) ?></h2>
        </div>

        <div id="bean-brew" class="glass-card p-4 p-lg-5 mb-4 portfolio-detail">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3"><?= htmlspecialchars(t("portfolio_bean_title")) ?></h3>
                    <p class="text-muted mb-4"><?= htmlspecialchars(t("portfolio_bean_summary")) ?></p>
                    <div class="portfolio-meta">
                        <p class="text-uppercase text-muted small mb-2"><?= htmlspecialchars(t("portfolio_build_label")) ?></p>
                        <p class="text-muted mb-4"><?= htmlspecialchars(t("portfolio_bean_build")) ?></p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-uppercase text-muted small mb-1"><?= htmlspecialchars(t("portfolio_timeline_label")) ?></p>
                                <p class="fw-semibold mb-0"><?= htmlspecialchars(t("portfolio_bean_timeline")) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase text-muted small mb-1"><?= htmlspecialchars(t("portfolio_satisfaction_label")) ?></p>
                                <p class="fw-semibold mb-0"><?= htmlspecialchars(t("portfolio_bean_satisfaction")) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="text-uppercase text-muted small mb-3"><?= htmlspecialchars(t("portfolio_gallery_label")) ?></p>
                    <div class="row g-3">
                        <div class="col-12">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/bean-brew-01.png" alt="<?= htmlspecialchars(t("portfolio_alt_builder", ["brand" => t("portfolio_bean_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_builder")) ?></figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/bean-brew-02.png" alt="<?= htmlspecialchars(t("portfolio_alt_timeline", ["brand" => t("portfolio_bean_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_timeline")) ?></figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/bean-brew-03.png" alt="<?= htmlspecialchars(t("portfolio_alt_overview", ["brand" => t("portfolio_bean_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_overview")) ?></figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="evoevents" class="glass-card p-4 p-lg-5 mb-4 portfolio-detail">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3"><?= htmlspecialchars(t("portfolio_evo_title")) ?></h3>
                    <p class="text-muted mb-4"><?= htmlspecialchars(t("portfolio_evo_summary")) ?></p>
                    <div class="portfolio-meta">
                        <p class="text-uppercase text-muted small mb-2"><?= htmlspecialchars(t("portfolio_build_label")) ?></p>
                        <p class="text-muted mb-4"><?= htmlspecialchars(t("portfolio_evo_build")) ?></p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-uppercase text-muted small mb-1"><?= htmlspecialchars(t("portfolio_timeline_label")) ?></p>
                                <p class="fw-semibold mb-0"><?= htmlspecialchars(t("portfolio_evo_timeline")) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase text-muted small mb-1"><?= htmlspecialchars(t("portfolio_satisfaction_label")) ?></p>
                                <p class="fw-semibold mb-0"><?= htmlspecialchars(t("portfolio_evo_satisfaction")) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="text-uppercase text-muted small mb-3"><?= htmlspecialchars(t("portfolio_gallery_label")) ?></p>
                    <div class="row g-3">
                        <div class="col-12">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/evoevents-01.png" alt="<?= htmlspecialchars(t("portfolio_alt_builder", ["brand" => t("portfolio_evo_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_builder")) ?></figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/evoevents-02.png" alt="<?= htmlspecialchars(t("portfolio_alt_timeline", ["brand" => t("portfolio_evo_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_timeline")) ?></figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/evoevents-03.png" alt="<?= htmlspecialchars(t("portfolio_alt_overview", ["brand" => t("portfolio_evo_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_overview")) ?></figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="estateflow" class="glass-card p-4 p-lg-5 portfolio-detail">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3"><?= htmlspecialchars(t("portfolio_estate_title")) ?></h3>
                    <p class="text-muted mb-4"><?= htmlspecialchars(t("portfolio_estate_summary")) ?></p>
                    <div class="portfolio-meta">
                        <p class="text-uppercase text-muted small mb-2"><?= htmlspecialchars(t("portfolio_build_label")) ?></p>
                        <p class="text-muted mb-4"><?= htmlspecialchars(t("portfolio_estate_build")) ?></p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-uppercase text-muted small mb-1"><?= htmlspecialchars(t("portfolio_timeline_label")) ?></p>
                                <p class="fw-semibold mb-0"><?= htmlspecialchars(t("portfolio_estate_timeline")) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase text-muted small mb-1"><?= htmlspecialchars(t("portfolio_satisfaction_label")) ?></p>
                                <p class="fw-semibold mb-0"><?= htmlspecialchars(t("portfolio_estate_satisfaction")) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="text-uppercase text-muted small mb-3"><?= htmlspecialchars(t("portfolio_gallery_label")) ?></p>
                    <div class="row g-3">
                        <div class="col-12">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/estateflow-01.png" alt="<?= htmlspecialchars(t("portfolio_alt_builder", ["brand" => t("portfolio_estate_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_builder")) ?></figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/estateflow-02.png" alt="<?= htmlspecialchars(t("portfolio_alt_timeline", ["brand" => t("portfolio_estate_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_timeline")) ?></figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="portfolio-shot">
                                <img src="/assets/images/portfolio/estateflow-03.png" alt="<?= htmlspecialchars(t("portfolio_alt_overview", ["brand" => t("portfolio_estate_title")])) ?>">
                                <figcaption><?= htmlspecialchars(t("portfolio_caption_overview")) ?></figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="section-spacing">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <h2 class="fw-bold"><?= htmlspecialchars(t("contact_heading")) ?></h2>
                <p class="text-muted mt-3"><?= htmlspecialchars(t("contact_subheading")) ?></p>
            </div>
            <div class="col-lg-7">
                <div class="glass-card p-4 p-lg-5">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><?= htmlspecialchars(t("contact_name_label")) ?></label>
                                <input class="form-control" name="contact_name" type="text" placeholder="<?= htmlspecialchars(t("contact_name_placeholder")) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?= htmlspecialchars(t("contact_email_label")) ?></label>
                                <input class="form-control" name="contact_email" type="email" placeholder="<?= htmlspecialchars(t("contact_email_placeholder")) ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label"><?= htmlspecialchars(t("contact_message_label")) ?></label>
                                <textarea class="form-control" name="contact_message" rows="5" placeholder="<?= htmlspecialchars(t("contact_message_placeholder")) ?>" required></textarea>
                            </div>
                            <div class="col-12 d-flex">
                                <button class="btn btn-accent" type="submit"><?= htmlspecialchars(t("contact_submit")) ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
