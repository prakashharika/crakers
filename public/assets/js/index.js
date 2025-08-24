document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("projectScroll");
  const totalProperties = document.querySelectorAll(".new-projects-card").length;
  const visibleProperties = 3;

  function updateScrollButtons() {
    const scrollLeft = container.scrollLeft;
    const maxScroll = container.scrollWidth - container.clientWidth;

    document.querySelector(".nlp-scroll-btn.prev").style.display =
      scrollLeft > 0 ? "flex" : "none";
    document.querySelector(".nlp-scroll-btn.next").style.display =
      scrollLeft < maxScroll ? "flex" : "none";
  }

  // Add event listeners for scroll buttons
  document
    .querySelector(".nlp-scroll-btn.next")
    .addEventListener("click", () => scrollProjects(1));
  document
    .querySelector(".nlp-scroll-btn.prev")
    .addEventListener("click", () => scrollProjects(-1));

  // Update scroll buttons on scroll
  container.addEventListener("scroll", updateScrollButtons);

  // Initial update of scroll buttons
  updateScrollButtons();
});

function scrollProjects(direction) {
  const container = document.getElementById("projectScroll");
  const scrollAmount = container.clientWidth / 3; // Adjust based on visible properties
  container.scrollBy({
    left: direction * scrollAmount,
    behavior: "smooth",
  });
}
