let burger = document.querySelector(".burger");
let closeMenu = document.querySelector(".close");
let nav = document.querySelector("nav ul");

burger.addEventListener("click", () => {
	nav.classList.add("open");
});

closeMenu.addEventListener("click", () => {
	nav.classList.remove("open");
});
