<?php
require_once __DIR__ . "/config.php";
$pageTitle = t("page_title_services");
require_once __DIR__ . "/partials/header.php";

$packages = [
    [
        "name" => t("services_package_basic_name"),
        "desc" => t("services_package_basic_desc"),
        "price" => t("services_package_basic_price"),
        "features" => [
            t("services_package_basic_feature_1"),
            t("services_package_basic_feature_2"),
            t("services_package_basic_feature_3"),
        ],
    ],
    [
        "name" => t("services_package_pro_name"),
        "desc" => t("services_package_pro_desc"),
        "price" => t("services_package_pro_price"),
        "features" => [
            t("services_package_pro_feature_1"),
            t("services_package_pro_feature_2"),
            t("services_package_pro_feature_3"),
        ],
    ],
    [
        "name" => t("services_package_premium_name"),
        "desc" => t("services_package_premium_desc"),
        "price" => t("services_package_premium_price"),
        "features" => [
            t("services_package_premium_feature_1"),
            t("services_package_premium_feature_2"),
            t("services_package_premium_feature_3"),
        ],
    ],
];
?>

<section class="section-spacing">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold"><?= htmlspecialchars(t("services_page_heading")) ?></h1>
            <p class="text-muted mt-3"><?= htmlspecialchars(t("services_page_subheading")) ?></p>
        </div>

        <div class="row g-4">
            <?php foreach ($packages as $package) : ?>
                <div class="col-lg-4">
                    <div class="glass-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h3 class="fw-semibold mb-2"><?= htmlspecialchars($package["name"]) ?></h3>
                                <p class="text-muted mb-0"><?= htmlspecialchars($package["desc"]) ?></p>
                            </div>
                        </div>
                        <div class="my-4">
                            <span class="badge-status"><?= htmlspecialchars($package["price"]) ?></span>
                        </div>
                        <ul class="list-unstyled mb-0 package-features">
                            <?php foreach ($package["features"] as $feature) : ?>
                                <li class="d-flex align-items-start gap-2 mb-2">
                                    <span aria-hidden="true">•</span>
                                    <span><?= htmlspecialchars($feature) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . "/partials/footer.php"; ?>
