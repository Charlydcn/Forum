<?php

$users = $result["data"]['users'];
$css = 'usersList.css';

?>

<h1>Users</h1>

<?php

if ($users !== null) {

?>

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
    if ($users !== null) {
        foreach ($users as $user) {
            
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
    <?php }} ?>

    </tbody>
</table>