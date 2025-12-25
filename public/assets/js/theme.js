const KEY = "devify-theme";

function applyTheme(theme) {
  if (theme === "light") {
    document.documentElement.setAttribute("data-theme", "light");
  } else {
    document.documentElement.removeAttribute("data-theme");
  }
}

function setButtonLabel(btn, theme) {
  if (!btn) return;
  btn.textContent = theme === "light" ? "Dark mode" : "Light mode";
  btn.setAttribute("aria-pressed", theme === "light" ? "true" : "false");
}

document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("theme-toggle");
  const saved = localStorage.getItem(KEY) || "dark";

  applyTheme(saved);
  setButtonLabel(btn, saved);
  if (btn) {
    btn.addEventListener("click", () => {
      const isLight = document.documentElement.getAttribute("data-theme") === "light";
      const next = isLight ? "dark" : "light";
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