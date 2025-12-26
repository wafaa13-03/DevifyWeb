const KEY = "devify-theme";
const LANG_KEY = "devify-lang";

function applyTheme(theme) {
  document.documentElement.setAttribute("data-theme", theme);
}

function setButtonLabel(btn, theme) {
  if (!btn) return;
  const isDark = theme === "dark";
  btn.textContent = isDark ? "🌙" : "☀️";
  btn.setAttribute("aria-label", isDark ? "Switch to light mode" : "Switch to dark mode");
  btn.setAttribute("aria-pressed", isDark ? "true" : "false");
}

document.addEventListener("DOMContentLoaded", () => {
  const htmlLang = document.documentElement.getAttribute("lang") || "en";
  const savedLang = localStorage.getItem(LANG_KEY);
  const targetLang = savedLang === "ar" || savedLang === "en" ? savedLang : "en";
  const langLinks = document.querySelectorAll("[data-lang]");

  if (!savedLang) {
    localStorage.setItem(LANG_KEY, targetLang);
  }

  if (targetLang !== htmlLang) {
    const targetLink = document.querySelector(`[data-lang="${targetLang}"]`);
    if (targetLink) {
      window.location.href = targetLink.getAttribute("href");
      return;
    }
  }

  langLinks.forEach((link) => {
    link.addEventListener("click", () => {
      const nextLang = link.getAttribute("data-lang");
      if (nextLang) {
        localStorage.setItem(LANG_KEY, nextLang);
      }
    });
  });

  const btn = document.getElementById("theme-toggle");
  const saved = localStorage.getItem(KEY);
  const initialTheme = saved === "light" || saved === "dark" ? saved : "dark";

  applyTheme(initialTheme);
  setButtonLabel(btn, initialTheme);
  if (btn) {
    btn.addEventListener("click", () => {
      const isDark = document.documentElement.getAttribute("data-theme") === "dark";
      const next = isDark ? "light" : "dark";
      applyTheme(next);
      localStorage.setItem(KEY, next);
      setButtonLabel(btn, next);
    });
  }

  const portfolioLinks = document.querySelectorAll("[data-portfolio-target]");
  const portfolioDetails = document.querySelectorAll(".portfolio-detail");
  const portfolioSection = document.getElementById("portfolio-details");

  if (portfolioLinks.length && portfolioDetails.length && portfolioSection) {
    portfolioDetails.forEach((detail) => detail.classList.remove("is-active"));

    portfolioLinks.forEach((link) => {
      link.addEventListener("click", (event) => {
        event.preventDefault();
        const targetId = link.getAttribute("data-portfolio-target");
        if (!targetId) return;

        const target = document.getElementById(targetId);
        if (!target) return;

        portfolioDetails.forEach((detail) => detail.classList.remove("is-active"));
        target.classList.add("is-active");
        portfolioSection.scrollIntoView({ behavior: "smooth", block: "start" });
      });
    });
  }
});
