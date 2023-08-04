<?php 
$posts = $result['data']['posts'];
$topic = $result['data']['topic'];

$css = 'posts.css';
?>

<h1><?= $topic->getTitle(); ?></h1>

<?php
foreach ($posts as $post) {
    $user = $post->getUser()
?>

    <div class="forumPost">
        <!-- POST HEADER -->
        <div class="post-header">
            <!-- username -->
            <a href="index.php?ctrl=forum&action=userDetails&id=<?=$post->getUser()->getId()?>">
                <?= $post->getUser()->getUsername()?>
            </a>
    
            <!-- creationDate -->
            <?= $post->getCreationDate() ?>
            
            <?php
            if(App\Session::getUser() && App\Session::getUser()->getBan() == 0) {
                if($post->getUser()->getId() === $_SESSION['user']->getId() || App\Session::isAdmin()) {        
            ?>
    
            <!-- delete/edit btns -->
            <a href="index.php?ctrl=security&action=deletePost&id=<?=$post->getId()?>" class="delete-btn">
                <i class="fa-solid fa-trash-can"></i>
            </a>
            <i class="fa-solid fa-pencil" data-post-id="<?= $post->getId() ?>"></i>
            
            <?php }} ?>
        </div>

        <!-- POST MAIN -->
        <div class="post-content"> 
            <!-- content -->
            <?= html_entity_decode($post->getContent()) ?>
            <!-- modification date -->          
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

<!-- CREATE NEW POST FORM -->
<form action="index.php?ctrl=security&action=createPost&id=<?=$post->getTopic()->getId()?>" method="POST">

    <textarea class="post" name="newPost"></textarea>

    <input type="submit" name="submit" value="Send post">

</form>

<?php } ?>

<script src="<?= PUBLIC_DIR ?>/js/post.js"></script>