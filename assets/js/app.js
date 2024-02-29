const container = document.querySelector(".container-nav");
const primaryNav = document.querySelector(".nav__list");
const toggleButton22 = document.querySelector(".nav-toggle");

toggleButton22.addEventListener("click", () => {
    const isExpanded = primaryNav.getAttribute("aria-expanded");
    primaryNav.setAttribute(
        "aria-expanded",
        isExpanded === "false" ? "true" : "false"
    );
});

container.addEventListener("click", (e) => {
    if (!primaryNav.contains(e.target) && !toggleButton22.contains(e.target)) {
        primaryNav.setAttribute("aria-expanded", "false");
    }
});
