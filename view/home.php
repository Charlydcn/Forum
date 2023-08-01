<?php
$posts = $result["data"]['posts'];
$css = 'posts.css';
?>

<h2>Welcome to the forum</h2>

<h3>Latest posts :</h3>

<?php
foreach ($posts as $post) {
    $topic = $post->getTopic();
?>

<div class="forumPost">
            <div class="post-header"> <!-- POST HEADER -->
                <a href="index.php?ctrl=forum&action=userDetails&id=<?=$post->getUser()->getId()?>">
                    <?= "(Topic : " . $post->getTopic()->getTitle() . ") " . $post->getUser()->getUsername()?>
                </a>
        
                <?= $post->getCreationDate() ?>
                
                <?php
                if(App\Session::getUser() && App\Session::getUser()->getBan() == 0) {
                    if($post->getUser()->getId() === $_SESSION['user']->getId() || App\Session::isAdmin()) {        
                ?>
                
                <?php }} ?>
            </div>
        
            <div class="post-content"> <!-- POST MAIN -->
                <p><?= html_entity_decode($post->getContent()) ?></p>
                <?= $post->getModificationDate() !== null ? "<p>(Modified : " . $post->getModificationDate() . ")</p>" : ''; ?>
            </div>  
        </div>

<?php } ?>