const footerYear = document.querySelector(".footer_year");
// rok w footer
const handleCurrentYear = () => {
	const year = new Date().getFullYear();
	footerYear.innerText = year;
};
handleCurrentYear();