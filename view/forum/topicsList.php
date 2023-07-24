<?php

$topics = $result["data"]['topics'];

?>

<h1>Topics</h1>

<ul>
    <?php
    if ($topics !== null) {

        foreach ($topics as $topic) {
    ?>
            <li>
                <a href=""><?= $topic->getTitle() ?></a>
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

    <a href="index.php?ctrl=security&action=topicsDashboard">Dashboard</a>

<?php } ?>