<?php 
$posts = $result['data']['posts'];
?>

<?php
foreach ($posts as $post) {
?>

<a href=""><?=$post->getContent()?></a>

<?php } ?>
