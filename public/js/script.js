var openBtn = document.getElementById("openBtn");
var overlay = document.getElementById("menu");
openBtn.addEventListener("click", function () {
	this.classList.toggle("close");
	overlay.classList.toggle("overlay");
});
