<?php

$topics = $result["data"]['topics'];

$css = 'topicsList.css';

?>

<h1>Topics</h1>

<ul>
    <?php
    if ($topics !== null) {

        foreach ($topics as $topic) {

    ?>
            <li>
                <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                    <?= $topic->getTitle()?>
                </a>
                <span>(<?=$topic->getNbPosts()?> post(s), last activity : <?=$topic->getLastActivity()?>)</span>
            </li>

        <?php
        }
    } else {
        ?>
        <h3>Nothing here.. (yet)</h3>
    <?php } ?>

</ul>

<?php

if (App\Session::isAdmin()) {

?>

    <a href="index.php?ctrl=security&action=topicsDashboard">
    <i class="fa-solid fa-gear"></i>
        Dashboard
    </a>

<?php } ?>