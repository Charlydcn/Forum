<?php

$topics = $result["data"]['topics'];

?>

<h1>Topics</h1>

<ul>
    <?php
    foreach($topics as $topic ){
    ?>
        <li>
            <a href=""><?=$topic->getTitle()?></a>
        </li>

    <?php } ?> 

</ul>
  
