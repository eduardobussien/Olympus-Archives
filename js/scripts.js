/*Script.js by Eduardo Bussien*/

/* ========= SLIDESHOW ========= */
let slideIndex = 0;
const slides = document.querySelectorAll(".hero-slideshow .slide");

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

/* For each section */
const sections = document.querySelectorAll("section");
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("visible");
    }
  });
}, { threshold: 0.1 });

sections.forEach(section => observer.observe(section));

/* For about preview on index */
document.addEventListener("DOMContentLoaded", () => {
  const fadeElements = document.querySelectorAll(".fade-up");

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  fadeElements.forEach(el => observer.observe(el));
});

/*For contact.php*/
document.getElementById("contactForm").addEventListener("submit", function(event) {
  event.preventDefault();

  let name = document.getElementById("name").value.trim();
  let email = document.getElementById("email").value.trim();
  let message = document.getElementById("message").value.trim();
  let response = document.getElementById("formResponse");

  if (!name || !email || !message) {
    response.style.display = "block";
    response.style.color = "red";
    response.textContent = "Please fill out all fields before sending!";
    return;
  }

  let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!email.match(emailPattern)) {
    response.style.display = "block";
    response.style.color = "red";
    response.textContent = "Please enter a valid email address!";
    return;
  }

  response.style.display = "block";
  response.style.color = "green";
  response.textContent = "Message sent to Olympus! The gods will respond soon.";

  document.getElementById("contactForm").reset();
});

// gods.php right-side scroll area
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".god-item");

    items.forEach(item => {
        item.addEventListener("click", () => {
            items.forEach(i => i.classList.remove("active"));
            item.classList.add("active");
        });
    });
});
