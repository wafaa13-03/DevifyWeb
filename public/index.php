<?php
$configPath = __DIR__ . "/../config/config.php";
if (file_exists($configPath)) {
    require_once $configPath;
}
if (!isset($lang) || $lang === "") {
    $lang = "en";
}
if (!isset($dir) || $dir === "") {
    $dir = $lang === "ar" ? "rtl" : "ltr";
}
if (!function_exists("t")) {
    function t(string $key, array $replace = []): string
    {
        foreach ($replace as $placeholder => $value) {
            $key = str_replace("{" . $placeholder . "}", (string) $value, $key);
        }
        return $key;
    }
}
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
                <div class="glass-card p-4 h-100 portfolio-card">
                    <div class="portfolio-media">
                        <img src="/assets/mockups/bean-brew-website.png" alt="<?= htmlspecialchars(t("portfolio_bean_title")) ?>">
                    </div>
                    <h5 class="fw-semibold mt-3"><?= htmlspecialchars(t("portfolio_bean_title")) ?></h5>
                    <p class="text-muted mb-3"><?= htmlspecialchars(t("portfolio_bean_preview_desc")) ?></p>
                    <button class="btn btn-outline-light w-100 portfolio-preview-btn" type="button" data-preview-title="<?= htmlspecialchars(t("portfolio_bean_title")) ?>" data-preview-url="https://www.figma.com/make/34vknHr54iMJIxmrObD6Cr/Coffee-Shop-Website?p=f&t=K4Q3WnZdPdVXF0DQ-0&fullscreen=1">
                        <?= htmlspecialchars(t("portfolio_preview_button")) ?>
                    </button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100 portfolio-card">
                    <div class="portfolio-media">
                        <img src="/assets/mockups/evoevents-website.png" alt="<?= htmlspecialchars(t("portfolio_evo_title")) ?>">
                    </div>
                    <h5 class="fw-semibold mt-3"><?= htmlspecialchars(t("portfolio_evo_title")) ?></h5>
                    <p class="text-muted mb-3"><?= htmlspecialchars(t("portfolio_evo_preview_desc")) ?></p>
                    <button class="btn btn-outline-light w-100 portfolio-preview-btn" type="button" data-preview-title="<?= htmlspecialchars(t("portfolio_evo_title")) ?>" data-preview-url="https://www.figma.com/make/4xqCtqlTI2p1n10GJJpviH/Coffee-Shop-Website?p=f&t=C7VrUezB1UQgRJ3r-0&fullscreen=1">
                        <?= htmlspecialchars(t("portfolio_preview_button")) ?>
                    </button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100 portfolio-card">
                    <div class="portfolio-media">
                        <img src="/assets/mockups/estateflow-website.png" alt="<?= htmlspecialchars(t("portfolio_estate_title")) ?>">
                    </div>
                    <h5 class="fw-semibold mt-3"><?= htmlspecialchars(t("portfolio_estate_title")) ?></h5>
                    <p class="text-muted mb-3"><?= htmlspecialchars(t("portfolio_estate_preview_desc")) ?></p>
                    <button class="btn btn-outline-light w-100 portfolio-preview-btn" type="button" data-preview-title="<?= htmlspecialchars(t("portfolio_estate_title")) ?>" data-preview-url="https://www.figma.com/make/uMpoZgf9oY5cKL5U5saUbX/EstateFlow-Management-Hub?p=f&t=i4SO8lhXpt9xPw1A-0&fullscreen=1">
                        <?= htmlspecialchars(t("portfolio_preview_button")) ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="portfolio-modal" id="portfolio-preview" aria-hidden="true">
    <div class="portfolio-modal__dialog">
        <div class="portfolio-modal__header">
            <h4 class="mb-0" id="portfolio-preview-title"></h4>
            <button class="portfolio-modal__close" type="button" aria-label="<?= htmlspecialchars(t("portfolio_preview_close")) ?>">×</button>
        </div>
        <div class="portfolio-modal__body">
            <p class="text-muted mb-3"><?= htmlspecialchars(t("portfolio_preview_message")) ?></p>
            <a class="btn btn-accent" id="portfolio-preview-link" href="#" target="_blank" rel="noopener">
                <?= htmlspecialchars(t("portfolio_preview_open")) ?>
            </a>
        </div>
    </div>
</div>

<section id="contact" class="section-spacing">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <h2 class="fw-bold"><?= htmlspecialchars(t("contact_heading")) ?></h2>
                <p class="text-muted mt-3"><?= htmlspecialchars(t("contact_subheading")) ?></p>
            </div>
            <div class="col-lg-7">
                <div class="glass-card p-4 p-lg-5">
                    <form action="https://formspree.io/f/xjgvwqrj" method="POST" data-captcha="false" data-success-message="<?= htmlspecialchars(t("contact_success")) ?>" data-error-message="<?= htmlspecialchars(t("contact_error")) ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><?= htmlspecialchars(t("contact_name_label")) ?></label>
                                <input class="form-control" name="name" type="text" placeholder="<?= htmlspecialchars(t("contact_name_placeholder")) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><?= htmlspecialchars(t("contact_email_label")) ?></label>
                                <input class="form-control" name="email" type="email" placeholder="<?= htmlspecialchars(t("contact_email_placeholder")) ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label"><?= htmlspecialchars(t("contact_message_label")) ?></label>
                                <textarea class="form-control" name="message" rows="5" placeholder="<?= htmlspecialchars(t("contact_message_placeholder")) ?>" required></textarea>
                            </div>
                            <input type="hidden" name="_subject" value="New Contact Message - DevifyWeb">
                            <div class="col-12 d-flex">
                                <button class="btn btn-accent" type="submit"><?= htmlspecialchars(t("contact_submit")) ?></button>
                            </div>
                            <div class="col-12">
                                <div class="contact-status text-muted" role="status" aria-live="polite"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
