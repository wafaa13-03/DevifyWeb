<?php
// Show all PHP errors (helps fix HTTP 500 errors)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$supportedLanguages = ["en", "ar"];
$langParam = $_GET["lang"] ?? "";
if ($langParam && in_array($langParam, $supportedLanguages, true)) {
    $_SESSION["lang"] = $langParam;
}

$lang = $_SESSION["lang"] ?? "en";
if (!in_array($lang, $supportedLanguages, true)) {
    $lang = "en";
}

$isRtl = $lang === "ar";
$dir = $isRtl ? "rtl" : "ltr";

$translations = [
    "en" => [
        "page_title_default" => "Devify",
        "page_title_home" => "Devify | Premium Digital Studio",
        "page_title_login" => "Client Login | Devify",
        "page_title_register" => "Register | Devify",
        "page_title_request" => "Request a Project | Devify",
        "page_title_dashboard" => "Client Dashboard | Devify",
        "page_title_admin_login" => "Admin Login | Devify",
        "page_title_admin_dashboard" => "Admin Dashboard | Devify",
        "nav_services" => "Services",
        "nav_portfolio" => "Portfolio",
        "nav_request" => "Request",
        "nav_admin" => "Admin",
        "nav_dashboard" => "Dashboard",
        "nav_logout" => "Logout",
        "nav_register" => "Register",
        "nav_login" => "Login",
        "lang_toggle_label" => "Language",
        "hero_kicker" => "Cuberto-inspired digital partner",
        "hero_title" => "Dark, modern, and unforgettable digital experiences.",
        "hero_lead" => "Devify blends strategy, design, and engineering to launch premium products with a lasting presence.",
        "hero_request_cta" => "Request a project",
        "hero_services_cta" => "Explore services",
        "client_portal" => "Client Portal",
        "client_portal_status" => "Live",
        "client_portal_title" => "Track every milestone in one place.",
        "client_portal_desc" => "Stay aligned with real-time status updates, project highlights, and communication threads.",
        "average_delivery_label" => "Average delivery",
        "client_retention_label" => "Client retention",
        "services_heading" => "Services built for high-growth teams.",
        "services_desc" => "From launch strategy to full-scale engineering, Devify brings boutique attention with enterprise execution.",
        "service_strategy_title" => "Product Strategy",
        "service_strategy_desc" => "Roadmapping, market insights, and launch planning tailored to your growth.",
        "service_design_title" => "Design & UX",
        "service_design_desc" => "Minimal, sophisticated interfaces with signature motion and polish.",
        "service_delivery_title" => "Full-stack Delivery",
        "service_delivery_desc" => "PHP 8 + MySQL architecture, built for performance, security, and scale.",
        "portfolio_heading" => "Selected work",
        "portfolio_kicker" => "Curated for ambitious brands.",
        "work_lumen_desc" => "AI-enabled experience platform for enterprise teams.",
        "work_astral_desc" => "Luxury commerce stack for premium lifestyle brands.",
        "work_signal_desc" => "Unified analytics hub for data-first organizations.",
        "footer_heading" => "Ready to build your next release?",
        "footer_desc" => "Partner with Devify for a premium digital experience.",
        "footer_cta" => "Start a project",
        "label_email" => "Email",
        "label_password" => "Password",
        "label_full_name" => "Full name",
        "login_heading" => "Welcome back.",
        "login_subheading" => "Sign in to access your client portal.",
        "login_button" => "Login",
        "login_new_prompt" => "New to Devify?",
        "login_new_link" => "Create account",
        "error_invalid_credentials" => "Invalid credentials.",
        "register_heading" => "Create your client portal.",
        "register_subheading" => "Join Devify to start submitting project requests.",
        "register_success" => "Registration complete. You can now log in.",
        "register_error_required" => "All fields are required.",
        "register_error_exists" => "An account with this email already exists.",
        "register_error_failed" => "Registration failed. Please try again.",
        "register_button" => "Register",
        "register_login_prompt" => "Already have an account?",
        "register_login_link" => "Login",
        "request_heading" => "Start your next build.",
        "request_subheading" => "Tell us about your product vision and we will respond within 24 hours.",
        "request_success" => "Project request submitted successfully.",
        "request_error" => "Please provide a project title and details.",
        "request_error_failed" => "Unable to submit your request. Please try again.",
        "request_title_label" => "Project name",
        "request_title_placeholder" => "e.g. Premium SaaS redesign",
        "request_budget_label" => "Estimated budget",
        "request_budget_placeholder" => "$10k - $30k",
        "request_timeline_label" => "Ideal timeline",
        "request_timeline_placeholder" => "6-8 weeks",
        "request_details_label" => "Project details",
        "request_details_placeholder" => "Describe your goals, features, and expectations.",
        "request_submit_button" => "Submit request",
        "dashboard_welcome" => "Welcome, {name}.",
        "dashboard_subheading" => "Track your project requests and current status.",
        "dashboard_new_request" => "New request",
        "dashboard_table_project" => "Project",
        "dashboard_table_budget" => "Budget",
        "dashboard_table_timeline" => "Timeline",
        "dashboard_table_status" => "Status",
        "dashboard_table_submitted" => "Submitted",
        "dashboard_empty" => "No requests yet. Submit your first project brief.",
        "admin_login_heading" => "Admin access",
        "admin_login_subheading" => "Manage incoming project requests.",
        "admin_login_button" => "Login",
        "admin_dashboard_heading" => "Admin overview",
        "admin_dashboard_subheading" => "Manage every incoming request across the portfolio.",
        "admin_total_requests" => "{count} total requests",
        "admin_status_updated" => "Status updated.",
        "admin_table_client" => "Client",
        "admin_table_project" => "Project",
        "admin_table_budget" => "Budget",
        "admin_table_timeline" => "Timeline",
        "admin_table_status" => "Status",
        "admin_table_update" => "Update",
        "admin_empty" => "No project requests yet.",
        "admin_save_button" => "Save",
        "status_submitted" => "Submitted",
        "status_reviewing" => "Reviewing",
        "status_in_progress" => "In Progress",
        "status_completed" => "Completed"
    ],
    "ar" => [
        "page_title_default" => "ديفاي",
        "page_title_home" => "ديفاي | استوديو رقمي فاخر",
        "page_title_login" => "تسجيل دخول العملاء | ديفاي",
        "page_title_register" => "إنشاء حساب | ديفاي",
        "page_title_request" => "طلب مشروع | ديفاي",
        "page_title_dashboard" => "لوحة تحكم العميل | ديفاي",
        "page_title_admin_login" => "تسجيل دخول الإدارة | ديفاي",
        "page_title_admin_dashboard" => "لوحة تحكم الإدارة | ديفاي",
        "nav_services" => "الخدمات",
        "nav_portfolio" => "الأعمال",
        "nav_request" => "طلب مشروع",
        "nav_admin" => "الإدارة",
        "nav_dashboard" => "لوحة التحكم",
        "nav_logout" => "تسجيل الخروج",
        "nav_register" => "إنشاء حساب",
        "nav_login" => "تسجيل الدخول",
        "lang_toggle_label" => "اللغة",
        "hero_kicker" => "شريك رقمي مستوحى من Cuberto",
        "hero_title" => "تجارب رقمية داكنة وعصرية لا تُنسى.",
        "hero_lead" => "تمزج ديفاي بين الاستراتيجية والتصميم والهندسة لإطلاق منتجات فاخرة بحضور يدوم.",
        "hero_request_cta" => "اطلب مشروعًا",
        "hero_services_cta" => "استكشف الخدمات",
        "client_portal" => "بوابة العملاء",
        "client_portal_status" => "متصل الآن",
        "client_portal_title" => "تابع كل مرحلة في مكان واحد.",
        "client_portal_desc" => "ابقَ على اطلاع بتحديثات الحالة الفورية وأبرز المراحل وخيوط التواصل.",
        "average_delivery_label" => "متوسط التسليم",
        "client_retention_label" => "الاحتفاظ بالعملاء",
        "services_heading" => "خدمات مصممة لفرق النمو السريع.",
        "services_desc" => "من استراتيجية الإطلاق إلى التنفيذ الهندسي، تمنحك ديفاي اهتمامًا بوتيكيًا وتنفيذًا مؤسسيًا.",
        "service_strategy_title" => "استراتيجية المنتج",
        "service_strategy_desc" => "خارطة طريق، ورؤى سوقية، وتخطيط إطلاق مخصص لنموك.",
        "service_design_title" => "التصميم وتجربة المستخدم",
        "service_design_desc" => "واجهات بسيطة وراقية مع حركة متقنة ولمسات نهائية.",
        "service_delivery_title" => "تسليم شامل",
        "service_delivery_desc" => "هيكل PHP 8 + MySQL مبني للأداء والأمان والتوسع.",
        "portfolio_heading" => "نماذج مختارة",
        "portfolio_kicker" => "منسّقة للعلامات الطموحة.",
        "work_lumen_desc" => "منصة تجارب مدعومة بالذكاء الاصطناعي للفرق المؤسسية.",
        "work_astral_desc" => "منظومة تجارة فاخرة لعلامات أسلوب الحياة الراقية.",
        "work_signal_desc" => "مركز تحليلات موحّد للمؤسسات القائمة على البيانات.",
        "footer_heading" => "هل أنت مستعد لبناء الإصدار القادم؟",
        "footer_desc" => "تعاون مع ديفاي لتجربة رقمية فاخرة.",
        "footer_cta" => "ابدأ مشروعًا",
        "label_email" => "البريد الإلكتروني",
        "label_password" => "كلمة المرور",
        "label_full_name" => "الاسم الكامل",
        "login_heading" => "مرحبًا بعودتك.",
        "login_subheading" => "سجّل الدخول للوصول إلى بوابة العملاء.",
        "login_button" => "تسجيل الدخول",
        "login_new_prompt" => "جديد في ديفاي؟",
        "login_new_link" => "إنشاء حساب",
        "error_invalid_credentials" => "بيانات الدخول غير صحيحة.",
        "register_heading" => "أنشئ بوابة العملاء الخاصة بك.",
        "register_subheading" => "انضم إلى ديفاي لبدء إرسال طلبات المشاريع.",
        "register_success" => "تم إنشاء الحساب بنجاح. يمكنك الآن تسجيل الدخول.",
        "register_error_required" => "جميع الحقول مطلوبة.",
        "register_error_exists" => "يوجد حساب بهذا البريد الإلكتروني بالفعل.",
        "register_error_failed" => "فشل التسجيل. يرجى المحاولة مرة أخرى.",
        "register_button" => "إنشاء حساب",
        "register_login_prompt" => "لديك حساب بالفعل؟",
        "register_login_link" => "تسجيل الدخول",
        "request_heading" => "ابدأ مشروعك القادم.",
        "request_subheading" => "أخبرنا عن رؤية منتجك وسنرد خلال 24 ساعة.",
        "request_success" => "تم إرسال طلب المشروع بنجاح.",
        "request_error" => "يرجى إدخال عنوان المشروع والتفاصيل.",
        "request_error_failed" => "تعذر إرسال طلبك. يرجى المحاولة مرة أخرى.",
        "request_title_label" => "اسم المشروع",
        "request_title_placeholder" => "مثال: إعادة تصميم SaaS فاخرة",
        "request_budget_label" => "الميزانية المتوقعة",
        "request_budget_placeholder" => "$10k - $30k",
        "request_timeline_label" => "الجدول الزمني المثالي",
        "request_timeline_placeholder" => "6-8 أسابيع",
        "request_details_label" => "تفاصيل المشروع",
        "request_details_placeholder" => "صف أهدافك وميزاتك وتوقعاتك.",
        "request_submit_button" => "إرسال الطلب",
        "dashboard_welcome" => "مرحبًا، {name}.",
        "dashboard_subheading" => "تابع طلبات مشاريعك وحالتها الحالية.",
        "dashboard_new_request" => "طلب جديد",
        "dashboard_table_project" => "المشروع",
        "dashboard_table_budget" => "الميزانية",
        "dashboard_table_timeline" => "الجدول الزمني",
        "dashboard_table_status" => "الحالة",
        "dashboard_table_submitted" => "تاريخ الإرسال",
        "dashboard_empty" => "لا توجد طلبات بعد. أرسل موجز مشروعك الأول.",
        "admin_login_heading" => "دخول الإدارة",
        "admin_login_subheading" => "إدارة طلبات المشاريع الواردة.",
        "admin_login_button" => "تسجيل الدخول",
        "admin_dashboard_heading" => "نظرة الإدارة",
        "admin_dashboard_subheading" => "أدر كل الطلبات الواردة عبر المحفظة.",
        "admin_total_requests" => "{count} إجمالي الطلبات",
        "admin_status_updated" => "تم تحديث الحالة.",
        "admin_table_client" => "العميل",
        "admin_table_project" => "المشروع",
        "admin_table_budget" => "الميزانية",
        "admin_table_timeline" => "الجدول الزمني",
        "admin_table_status" => "الحالة",
        "admin_table_update" => "تحديث",
        "admin_empty" => "لا توجد طلبات مشاريع بعد.",
        "admin_save_button" => "حفظ",
        "status_submitted" => "تم الإرسال",
        "status_reviewing" => "قيد المراجعة",
        "status_in_progress" => "قيد التنفيذ",
        "status_completed" => "مكتمل"
    ]
];

function t(string $key, array $replace = []): string
{
    global $translations, $lang;
    $text = $translations[$lang][$key] ?? $translations["en"][$key] ?? $key;
    foreach ($replace as $placeholder => $value) {
        $text = str_replace("{" . $placeholder . "}", (string) $value, $text);
    }
    return $text;
}

function language_url(string $targetLang): string
{
    $uri = $_SERVER["REQUEST_URI"] ?? "index.php";
    $parts = parse_url($uri);
    $path = $parts["path"] ?? "index.php";
    $query = [];
    if (!empty($parts["query"])) {
        parse_str($parts["query"], $query);
    }
    $query["lang"] = $targetLang;
    $queryString = http_build_query($query);
    $fragment = isset($parts["fragment"]) ? "#" . $parts["fragment"] : "";
    return $path . ($queryString ? "?" . $queryString : "") . $fragment;
}
