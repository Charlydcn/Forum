<?php

$category = $result["data"]['category'];
    
?>

<h1>Topics category</h1>

<ul>
    <?php
    foreach($category as $category ){
    ?>
        <li>
            <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId()?>"><?=$category->getName()?></a>
        </li>

    <?php } ?> 

</ul>
  
