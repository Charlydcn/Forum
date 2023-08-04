<?php
$posts = $result["data"]['posts'];
$css = 'posts.css';
?>

<h2>Welcome to the forum</h2>

<h3>Latest posts :</h3>

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
                    <p><?= html_entity_decode($post->getContent()) ?></p>
                    <!-- modification date -->
                    <?= $post->getModificationDate() !== null ? "<p>(Modified : " . $post->getModificationDate() . ")</p>" : ''; ?>
                </div>  
            </div>
    
    <?php }} ?>