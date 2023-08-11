<?php 
$posts = $result['data']['posts'];
$user = $result['data']['user'];

$css = 'posts.css';
?>

<h1><?= $user->getUsername(); ?></h1>

    <?php
    if($posts !== null) {
        foreach ($posts as $post) {
            $topic = $post->getTopic();
            $user = $post->getUser();
        ?>
        
        <div class="forumPost">
                    <!-- POST HEADER -->
                    <div class="post-header">

                        <!-- topic -->
                        <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?=$topic->getId()?>">
                            <?= "<span>" . $topic->getTitle() . "</span>" ?>
                        </a>
                        <br>
                        
                        <!-- username -->
                        <a href="index.php?ctrl=forum&action=userDetails&id=<?=$user->getId()?>">
                            <?= $user->getUsername() ?>
                        </a>

                
                        <!-- creation date -->
                        <?= $post->getCreationDate() ?>
                    </div>
                
                    <!-- POST MAIN -->
                    <div class="post-content">
                        <!-- content -->
                        <?= html_entity_decode($post->getContent()) ?>
                        <!-- modification date -->
                        <?= $post->getModificationDate() !== null ? "<p>(Modified : " . $post->getModificationDate() . ")</p>" : ''; ?>
                    </div>  
                </div>
        
        <?php 
        }} else {
        ?>

            <h2>This user hasn't posted yet</h2>

        <?php } ?>

<script src="<?= PUBLIC_DIR ?>/js/post.js"></script>