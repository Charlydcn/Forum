<?php 
$posts = $result['data']['posts'];

?>

<?php
foreach ($posts as $post) {
?>

    <div> <!-- POST HEADER -->
        <a href="index.php?ctrl=forum&action=postDetails&id=<?=$post->getId()?>"><?= $post->getTitle() ?></a>
        <a href="index.php?ctrl=forum&action=userDetails&id=<?=$post->getUser()->getId()?>">
            <?= $post->getUser()->getUsername()?>
        </a>

        <?= $post->getCreationDate() ?>
        <?php
        if($post->getUser()->getId() === $_SESSION['user']->getId() || App\Session::isAdmin()) {        
        ?>

        <a href="index.php?ctrl=security&action=deletePost&id=<?=$post->getId()?>" class="delete-btn">
            <i class="fa-solid fa-trash-can"></i>
        </a>
        
        <?php } ?>
    </div>

    <div> <!-- POST MAIN -->
        <?= html_entity_decode($post->getContent()) ?>
    </div>
    <br>

<?php
}
if(isset($_SESSION['user'])) {
?>

<form action="index.php?ctrl=security&action=createPost&id=<?=$post->getTopic()->getId()?>" method="POST">

    <textarea class="post" name="newPost"></textarea>

    <input type="submit" name="submit" value="Send post">

</form>

<?php } ?>