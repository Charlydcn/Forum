// Get references to the elements
var sidenav = document.getElementById("sidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

// Attach event listeners to the buttons
openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

// Define the functions
function openNav() {
  sidenav.classList.add("active");
  openBtn.classList.add("hidden");
}

function closeNav() {
  sidenav.classList.remove("active");
  openBtn.classList.remove("hidden");
}
