<?php

$categories = $result["data"]['categories'];

if (App\Session::isAdmin()) {

?>

<h1>Categories dashboard</h1>

    <ul>
        <?php
        foreach($categories as $category) {
        ?>

            <li>
                <a href="index.php?ctrl=security&action=categoryDashboard&id=<?=$category->getId()?>"><?=$category->getName()?></a>
            </li>
                
        <?php } ?>
    </ul>

<form action="index.php?ctrl=security&action=createCategory" method="POST" autocomplete="off">

<label>
    Add a new category : (20 characters max)
    <input type="text" name="newCategory" maxlength="20" required>
</label>

<input type="submit" name="submit" value="Create">

</form>

<?php } else { ?>

<h1>You're not allowed to be here !</h1>

<?php } ?>