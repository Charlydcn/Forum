<?php

$topics = $result["data"]['topics'];

if (App\Session::isAdmin()) {

?>

<h1>Topics dashboard</h1>

    <ul>
        <?php
        foreach($topics as $topic) {
        ?>

            <li>
                <a href="index.php?ctrl=security&action=topicDashboard&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a>
            </li>
                
        <?php } ?>
    </ul>

<form action="index.php?ctrl=security&action=createTopic" method="POST" autocomplete="off">

<label>
    Add a new topic : (20 characters max)
    <input type="text" name="topicTitle" maxlength="20" required>
</label>

<input type="submit" name="submit" value="Create">

</form>

<?php } else { ?>

<h1>You're not allowed to be here !</h1>

<?php } ?>