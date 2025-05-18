var typed = new Typed('.multiple-text', {
  strings: ['FRONTEND DEVELOPER', 'UI/UX DESIGNER', 'PROGRAMER', 'GAMER'],
  typeSpeed: 100,
  backSpeed: 100,
  backDelay: 1000,
  loop: true
})

// Example: highlight based on scroll position
const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".navbar a");

window.onscroll = () => {
  let current = "";

  sections.forEach((section) => {
    const sectionTop = section.offsetTop - 100;
    if (window.scrollY >= sectionTop) {
      current = section.getAttribute("id");
    }
  });

  navLinks.forEach((link) => {
    link.classList.remove("active");
    if (link.getAttribute("href") === `#${current}`) {
      link.classList.add("active");
    }
  });
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-slide-right');
      entry.target.classList.remove('hidden'); // optional
      observer.unobserve(entry.target); // optional, if you want to animate only once
    }
  });
}, {
  threshold: 0.1 // Trigger when 10% is visible
});

// Target all elements you want to animate
document.querySelectorAll('.slide-section').forEach(section => {
  section.classList.add('hidden'); // set initial hidden style
  observer.observe(section);
});

