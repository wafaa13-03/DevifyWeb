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

  if (!btn) return;

  btn.addEventListener("click", () => {
    const isLight = document.documentElement.getAttribute("data-theme") === "light";
    const next = isLight ? "dark" : "light";
    applyTheme(next);
    localStorage.setItem(KEY, next);
    setButtonLabel(btn, next);
  });
});
