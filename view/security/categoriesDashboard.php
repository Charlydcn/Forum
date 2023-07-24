<?php

$categories = $result["data"]['categories'];

if (App\Session::isAdmin()) {

?>

<h1>Categories dashboard</h1>

<form action="index.php?ctrl=security&action=editCategories" method="POST" autocomplete="off">

<?php
$i = 1;
foreach($categories as $category) {
?>

    <input type="text" name="category<?=$i?>" value="<?=$category->getName()?>">
    <a href="index.php?ctrl=security&action=deleteCategory&id=<?= $category->getId() ?>">
        <i class="fa-solid fa-trash-can"></i>
    </a>
    <br>

<?php
$i++;
}
?>

<input type="submit" name="submitEdit" value="Edit">
<br>

<label>
    Add a new category :
    <input type="text">
</label>

<input type="submit" name="submitCreate" value="Create">

</form>

<?php } else { ?>

<h1>You're not allowed to be here !</h1>

<?php } ?>