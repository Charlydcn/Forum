<?php

$user = $result['data']['user'];

if (App\Session::isAdmin() || $user->getId() === $_SESSION['user']->getId()) {
?>

    <form action="index.php?ctrl=security&action=editUser&id=<?= $user->getId() ?>" method="POST" autocomplete="off">
        <label>
            Username :
            <input type="text" name="username" value="<?= $user->getUsername() ?>">
        </label>

        <label>
            E-Mail :
            <input type="email" name="email" value="<?= $user->getEmail() ?>">
        </label>

        <label>
            Password :
            <input type="password" name="pass1" value="">
        </label>
        <label>
            Confirm password :
            <input type="password" name="pass2" value="">
        </label>

        <?php
        if(App\Session::isAdmin()) {
        ?>
        <select name="role">
            <?php

            // si l'utilisateur connecté est un admin, alors la deuxième <option> sera user, et inversement
            $v = App\Session::isAdmin() ? 'user' : 'admin';

            ?>
            <option value="<?= $user->getRole() ?>"><?= $user->getRole() ?></option>
            <option value="<?= $v ?>"><?= $v ?></option>
        </select>

        <?php } ?>

        <p>Member since : <?= $user->getRegistrationDate() ?></p>

        <input type="submit" name="submit" value="Save changes">

        <a href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>" class="delete-btn">
            <i class="fa-solid fa-trash-can"></i>
        </a>
    </form>

<?php } else { ?>

    <p>Username : <?= $user->getUsername() ?></p>
    <p>E-Mail : <?= $user->getEmail() ?></p>
    <p>Member since : <?= $user->getRegistrationDate() ?></p>


<?php } ?>