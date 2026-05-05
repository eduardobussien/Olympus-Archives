/* scripts.js by Eduardo Bussien */

/* ========= SLIDESHOW ========= */
(function () {
  const slides = document.querySelectorAll(".hero-slideshow .slide");
  if (!slides.length) return;

  let slideIndex = 0;

  function showSlides() {
    slides.forEach((slide, i) => {
      slide.classList.toggle("active", i === slideIndex);
    });
    slideIndex = (slideIndex + 1) % slides.length;
    setTimeout(showSlides, 5000);
  }

  document.addEventListener("DOMContentLoaded", () => {
    slides[0].classList.add("active");
    setTimeout(showSlides, 5000);
  });
})();

/* ========= FADE-UP ON SCROLL ========= */
document.addEventListener("DOMContentLoaded", () => {
  const fadeElements = document.querySelectorAll(".fade-up");
  if (!fadeElements.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15 }
  );

  fadeElements.forEach((el) => observer.observe(el));
});

/* ========= MOBILE NAV (hamburger) ========= */
document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.querySelector(".nav-toggle");
  const navbar = document.querySelector(".navbar");
  if (!toggle || !navbar) return;

  toggle.addEventListener("click", () => {
    const isOpen = navbar.classList.toggle("nav-open");
    toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
  });

  /* On mobile, dropdowns open via tap (since hover doesn't work).
     Click the parent <a> once to open submenu, second click follows the link. */
  const dropdowns = document.querySelectorAll(".navbar .dropdown > a");
  dropdowns.forEach((a) => {
    a.addEventListener("click", (e) => {
      if (window.matchMedia("(max-width: 850px)").matches) {
        const li = a.parentElement;
        if (!li.classList.contains("open")) {
          e.preventDefault();
          // close siblings
          li.parentElement.querySelectorAll(".dropdown.open").forEach((other) => {
            if (other !== li) other.classList.remove("open");
          });
          li.classList.add("open");
        }
      }
    });
  });

  /* Close menu when a leaf link is clicked */
  navbar.querySelectorAll(".dropdown-content a").forEach((a) => {
    a.addEventListener("click", () => {
      navbar.classList.remove("nav-open");
      toggle.setAttribute("aria-expanded", "false");
    });
  });
});

/* ========= CONTACT FORM (only runs if the form exists) ========= */
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contactForm");
  if (!form) return;

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();
    const response = document.getElementById("formResponse");

    if (!name || !email || !message) {
      response.style.display = "block";
      response.style.color = "red";
      response.textContent = "Please fill out all fields before sending!";
      return;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
      response.style.display = "block";
      response.style.color = "red";
      response.textContent = "Please enter a valid email address!";
      return;
    }

    response.style.display = "block";
    response.style.color = "green";
    response.textContent = "Message sent to Olympus! The gods will respond soon.";

    form.reset();
  });
});

/* ========= NAV SEARCH (icon → expanding panel) ========= */
document.addEventListener("DOMContentLoaded", () => {
  const wrapper = document.querySelector(".nav-search");
  if (!wrapper) return;

  const toggle = wrapper.querySelector(".nav-search-toggle");
  const panel = wrapper.querySelector(".nav-search-panel");
  const input = panel ? panel.querySelector("input[name='q']") : null;
  if (!toggle || !panel || !input) return;

  function openPanel() {
    wrapper.classList.add("open");
    toggle.setAttribute("aria-expanded", "true");
    setTimeout(() => input.focus(), 60);
  }

  function closePanel() {
    wrapper.classList.remove("open");
    toggle.setAttribute("aria-expanded", "false");
  }

  toggle.addEventListener("click", (e) => {
    e.stopPropagation();
    if (wrapper.classList.contains("open")) {
      closePanel();
    } else {
      openPanel();
    }
  });

  // Don't close when interacting inside the panel
  panel.addEventListener("click", (e) => e.stopPropagation());

  // Close on outside click
  document.addEventListener("click", (e) => {
    if (!wrapper.contains(e.target)) closePanel();
  });

  // Close on Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && wrapper.classList.contains("open")) {
      closePanel();
      toggle.focus();
    }
  });
});

/* ========= GODS SIDEBAR ACTIVE STATE (legacy hook) ========= */
document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".god-item");
  if (!items.length) return;

  items.forEach((item) => {
    item.addEventListener("click", () => {
      items.forEach((i) => i.classList.remove("active"));
      item.classList.add("active");
    });
  });
});
