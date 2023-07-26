<?php 
$posts = $result['data']['posts'];
$topic = $result['data']['topic'];

$css = 'postsByTopic.css';
?>

<h1><?= $topic->getTitle(); ?></h1>

<?php
foreach ($posts as $post) {
?>

    <div class="forumPost">
        <div class="postHeader"> <!-- POST HEADER -->
            <a href="index.php?ctrl=forum&action=userDetails&id=<?=$post->getUser()->getId()?>">
                <?= $post->getUser()->getUsername()?>
            </a>
    
            <?= $post->getCreationDate() ?>
            
            <?php
            if(App\Session::getUser()) {
                if($post->getUser()->getId() === $_SESSION['user']->getId() || App\Session::isAdmin()) {        
            ?>
    
            <a href="index.php?ctrl=security&action=deletePost&id=<?=$post->getId()?>" class="delete-btn">
                <i class="fa-solid fa-trash-can"></i>
            </a>
            <i class="fa-solid fa-pencil" data-post-id="<?= $post->getId() ?>"></i>
            
            <?php }} ?>
        </div>
    
        <div class="postMain"> <!-- POST MAIN -->
            <p><?= html_entity_decode($post->getContent()) ?></p>
            <?= $post->getModificationDate() !== null ? "<p>(Modified : " . $post->getModificationDate() . ")</p>" : ''; ?>
        </div>
    
        <!-- EDIT FORM (HIDDEN PAR DEFAUT) -->
        <form class="editForm hidden" id="editForm-<?= $post->getId() ?>" action="index.php?ctrl=security&action=editPost&id=<?=$post->getId()?>" method="POST">
            <textarea class="post" name="post" cols="30" rows="5"><?=$post->getContent()?></textarea>
            <input type="submit" name="submit" value="Edit post">
        </form>
        <!----------------------------------->    
    </div>

<?php
}
if(App\Session::getUser()) {
?>

<form action="index.php?ctrl=security&action=createPost&id=<?=$post->getTopic()->getId()?>" method="POST">

    <textarea class="post" name="newPost"></textarea>

    <input type="submit" name="submit" value="Send post">

</form>

<?php } ?>

<script>
    // DOMContentLoaded = le script sera exécuté lorsque l'ensemble du document HTML sera chargé et prêt
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez tous les icônes 'fa-pencil' avec la classe '.edit-icon'
    const editIcons = document.querySelectorAll('.fa-pencil');

    editIcons.forEach(function(editIcon) {
        // Pour chaque icône, ajoutez un gestionnaire d'événement au clic
        editIcon.addEventListener('click', function() {
            // postId = l'id stocké dans le bouton edit <i> : data-post-id="$post->getId()" sur lequel on clique
            // 'this.' permet de cibler l'élément sur lequel on clique donc on récupère le data-post-id stocké dans le <i>
            // sur lequel on clique pour ensuite l'utiliser sur const editForm qui permet de récupérer chaque form correspondant
            // pour leur ajouter/retirer la classe hidden/visible
            const postId = this.getAttribute('data-post-id');
            const editForm = document.getElementById('editForm-' + postId);

            if (editForm.classList.contains('visible')) {
                editForm.classList.add('hidden');
                editForm.classList.remove('visible');
            } else {
                editForm.classList.add('visible');
                editForm.classList.remove('hidden');
            }
        });
    });
});
</script>