<?php

$category = $result['data']['category'];

if (App\Session::isAdmin()) {

?>

<h1>Edit category (<?= $category->getName() ?>)</h1>

<form action="index.php?ctrl=security&action=editCategory&id=<?=$category->getId()?>" method="POST" autocomplete="off">

    <input type="text" name="category" value="<?=$category->getName()?>"required>

    <input type="submit" name="submit" value="Edit">

</form>

<a href="index.php?ctrl=security&action=deleteCategory&id=<?=$category->getId()?>">
    <i class="fa-solid fa-trash-can"></i>
</a>
<br>

<a href="index.php?ctrl=security&action=categoriesDashboard">Return</a>

<?php } else { ?>

    <h1>You're not allowed to be here !</h1>

<?php } ?>