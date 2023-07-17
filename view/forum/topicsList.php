<?php

$topics = $result["data"]['topics'];

?>

<h1>Topics</h1>

<ul>
    <?php
    foreach($topics as $topic ){
        var_dump($topic);die;
    ?>
        <li>
            <a href=""><?=$topic->getContent()?></a>
        </li>

    <?php } ?> 

</ul>
  
