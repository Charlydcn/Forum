<?php 
$posts = $result['data']['posts'];
$topic = $result['data']['topic'];

$css = 'posts.css';
?>

<h1><?= $topic->getTitle(); ?></h1>

<?php
foreach ($posts as $post) {
?>

    <div class="forumPost">
        <div class="post-header"> <!-- POST HEADER -->
            <a href="index.php?ctrl=forum&action=userDetails&id=<?=$post->getUser()->getId()?>">
                <?= $post->getUser()->getUsername()?>
            </a>
    
            <?= $post->getCreationDate() ?>
            
            <?php
            if(App\Session::getUser() && App\Session::getUser()->getBan() == 0) {
                if($post->getUser()->getId() === $_SESSION['user']->getId() || App\Session::isAdmin()) {        
            ?>
    
            <a href="index.php?ctrl=security&action=deletePost&id=<?=$post->getId()?>" class="delete-btn">
                <i class="fa-solid fa-trash-can"></i>
            </a>
            <i class="fa-solid fa-pencil" data-post-id="<?= $post->getId() ?>"></i>
            
            <?php }} ?>
        </div>
    
        <div class="post-content"> <!-- POST MAIN -->
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
if(App\Session::getUser() && App\Session::getUser()->getBan() == 0) {
?>

<form action="index.php?ctrl=security&action=createPost&id=<?=$post->getTopic()->getId()?>" method="POST">

    <textarea class="post" name="newPost"></textarea>

    <input type="submit" name="submit" value="Send post">

</form>

<?php } ?>

<script src="<?= PUBLIC_DIR ?>/js/post.js"></script>