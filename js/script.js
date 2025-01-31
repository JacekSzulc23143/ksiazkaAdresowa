// rok w footer
const footerYear = document.querySelector(".footer_year");
const handleCurrentYear = () => {
	const year = new Date().getFullYear();
	footerYear.innerText = year;
};
handleCurrentYear();

// dark mode
const button = document.getElementById("toggle-theme");
button.addEventListener("click", () => {
	document.body.classList.toggle("dark");
});
