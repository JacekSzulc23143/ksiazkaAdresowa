const footerYear = document.querySelector(".footer_year");
// rok w footer
const handleCurrentYear = () => {
	const year = new Date().getFullYear();
	footerYear.innerText = year;
};
handleCurrentYear();

// const name_surname = document.getElementById("name_surname");
// const phone = document.getElementById("phone");
// const email = document.getElementById("email");
// const inputSubmit = document.getElementById("submit");

// inputSubmit.addEventListener("click", () => {
// 	const p = document.getElementById("error");
// 	if (name_surname !== "" || phone !== "" || email !== "") {
// 		p.classList.remove;
// 	}
// });

// const body = document.querySelector("body");
// const btn = document.querySelector(".b");

// document.getElementById("h1Text").textContent = "light mode";

// // funkcja zmieniająca kolor
// const handleDarkMode = () => {
// 	if (body.getAttribute("data-mode") === "light") {
// 		body.setAttribute("data-mode", "dark");
// 		document.getElementById("h1Text").textContent = "dark mode";
// 	} else {
// 		body.setAttribute("data-mode", "light");
// 		document.getElementById("h1Text").textContent = "light mode";
// 	}
// };

// btn.addEventListener("click", handleDarkMode);