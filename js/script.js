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
