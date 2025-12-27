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

  const previewButtons = document.querySelectorAll(".portfolio-preview-btn");
  const modal = document.getElementById("portfolio-preview");
  const modalTitle = document.getElementById("portfolio-preview-title");
  const modalLink = document.getElementById("portfolio-preview-link");
  const closeButton = modal ? modal.querySelector(".portfolio-modal__close") : null;

  function closeModal() {
    if (!modal) return;
    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    if (modalLink) {
      modalLink.setAttribute("href", "#");
    }
    document.body.classList.remove("modal-open");
  }

  if (previewButtons.length && modal) {
    previewButtons.forEach((btnEl) => {
      btnEl.addEventListener("click", () => {
        const url = btnEl.getAttribute("data-preview-url");
        const title = btnEl.getAttribute("data-preview-title");
        if (!url) return;

        if (modalTitle && title) {
          modalTitle.textContent = title;
        }
        if (modalLink) {
          modalLink.setAttribute("href", url);
        }
        modal.classList.add("is-open");
        modal.setAttribute("aria-hidden", "false");
        document.body.classList.add("modal-open");
      });
    });

    if (closeButton) {
      closeButton.addEventListener("click", closeModal);
    }

    modal.addEventListener("click", (event) => {
      if (event.target === modal) {
        closeModal();
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && modal.classList.contains("is-open")) {
        closeModal();
      }
    });
  }

  const contactForm = document.querySelector("#contact form");
  if (contactForm) {
    const statusEl = contactForm.querySelector(".contact-status");
    const successMessage = contactForm.getAttribute("data-success-message") || "Thanks! Your message has been sent.";
    const errorMessage = contactForm.getAttribute("data-error-message") || "Something went wrong. Please try again.";

    contactForm.addEventListener("submit", (event) => {
      event.preventDefault();
      if (statusEl) {
        statusEl.textContent = "";
      }

      const formData = new FormData(contactForm);
      fetch(contactForm.action, {
        method: "POST",
        body: formData,
        headers: { Accept: "application/json" },
      })
        .then((response) => {
          if (response.ok) {
            contactForm.reset();
            if (statusEl) {
              statusEl.textContent = successMessage;
            }
          } else {
            throw new Error("Formspree error");
          }
        })
        .catch(() => {
          if (statusEl) {
            statusEl.textContent = errorMessage;
          }
        });
    });
  }
});
