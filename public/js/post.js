// DOMContentLoaded = le script sera exécuté lorsque l'ensemble du document HTML sera chargé et prêt
document.addEventListener("DOMContentLoaded", function () {
	// Sélectionnez tous les icônes 'fa-pencil' avec la classe '.edit-icon'
	const editIcons = document.querySelectorAll(".fa-pencil");

	editIcons.forEach(function (editIcon) {
		// Pour chaque icône, ajoutez un gestionnaire d'événement au clic
		editIcon.addEventListener("click", function () {
			// postId = l'id stocké dans le bouton edit <i> : data-post-id="$post->getId()" sur lequel on clique
			// 'this.' permet de cibler l'élément sur lequel on clique donc on récupère le data-post-id stocké dans le <i>
			// sur lequel on clique pour ensuite l'utiliser sur const editForm qui permet de récupérer chaque form correspondant
			// pour leur ajouter/retirer la classe hidden/visible
			const postId = this.getAttribute("data-post-id");
			const editForm = document.getElementById("editForm-" + postId);

			if (editForm.classList.contains("visible")) {
				editForm.classList.add("hidden");
				editForm.classList.remove("visible");
			} else {
				editForm.classList.add("visible");
				editForm.classList.remove("hidden");
			}
		});
	});
});
