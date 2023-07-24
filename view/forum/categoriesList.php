<?php

$categories = $result["data"]['categories'];

?>

<h1>Topics category</h1>

<ul>
    <?php
    foreach ($categories as $category) {
    ?>
        <li>
            <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a>
        </li>

    <?php } ?>

</ul>

<?php

if (App\Session::isAdmin()) {

?>

    <a href="index.php?ctrl=security&action=categoriesDashboard">
        <i class="fa-solid fa-gear"></i>
        Dashboard
    </a>

<?php } ?>