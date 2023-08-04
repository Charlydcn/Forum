var openBtn = document.getElementById("openBtn");
var overlay = document.getElementById("nav-menu");
openBtn.addEventListener("click", function () {
	this.classList.toggle("close");
	overlay.classList.toggle("overlay");
});
