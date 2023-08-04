<?php

$topics = $result["data"]['topics'];
$css = 'topicsList.css';

?>

<h1>Topics</h1>

<table>
    <thead>
        <tr>
            <th>Topic</th>
            <th>Posts</th>
            <th>Last Activity</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($topics !== null) {

        foreach ($topics as $topic) {

    ?>
            <tr>
                <td>
                    <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                        <?= $topic->getTitle()?>
                    </a>
                </td>

                <td><?=$topic->getNbPosts()?></td>
                <td><?=$topic->getLastActivity()?></td>
            </tr>

        <?php
        }
    } else {
        ?>
        <h3>Nothing here.. (yet)</h3>
    <?php } ?>

    </tbody>
</table>

<?php

if (App\Session::isAdmin()) {

?>

    <a href="index.php?ctrl=security&action=topicsDashboard">
    <i class="fa-solid fa-gear"></i>
        Dashboard
    </a>

<?php } ?>