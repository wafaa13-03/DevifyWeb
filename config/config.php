<?php
// Defensive config loader for templates that expect translations.
$publicConfig = dirname(__DIR__) . "/public/config.php";
if (file_exists($publicConfig)) {
    require_once $publicConfig;
}

if (!isset($lang) || $lang === "") {
    $lang = "en";
}

if (!isset($dir) || $dir === "") {
    $dir = $lang === "ar" ? "rtl" : "ltr";
}

if (!isset($translations) || !is_array($translations)) {
    $translations = [];
}

if (!function_exists("t")) {
    function t(string $key, array $replace = []): string
    {
        global $translations, $lang;
        $text = $translations[$lang][$key] ?? $translations["en"][$key] ?? "";
        if ($text === "") {
            $text = ucwords(str_replace("_", " ", $key));
        }
        foreach ($replace as $placeholder => $value) {
            $text = str_replace("{" . $placeholder . "}", (string) $value, $text);
        }
        return $text;
    }
}

if (!function_exists("language_url")) {
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
}
