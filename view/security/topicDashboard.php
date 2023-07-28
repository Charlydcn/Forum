<?php

$topic = $result['data']['topic'];

if (App\Session::isAdmin()) {

?>

<h1>Edit topic (<?= $topic->getTitle() ?>)</h1>

<form action="index.php?ctrl=security&action=editTopic&id=<?=$topic->getId()?>" method="POST" autocomplete="off">

    <input type="text" name="topicTitle" value="<?=$topic->getTitle()?>" maxlength="20" required>

    <input type="submit" name="submit" value="Edit">
    <p>20 characters max</p>

</form>

<a href="index.php?ctrl=security&action=deleteTopic&id=<?=$topic->getId()?>" class="delete-btn">
    <i class="fa-solid fa-trash-can"></i>
</a>
<br>

<a href="index.php?ctrl=security&action=topicsDashboard">Return</a>

<?php } else { ?>

    <h1>You're not allowed to be here !</h1>

<?php } ?>