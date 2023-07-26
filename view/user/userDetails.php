<?php

$user = $result['data']['user'];

// on vérifie qu'il y a un utilisateur en session
if(App\Session::getUser($id)) {
    // puis on vérifie qu'il soit bien admin ou propriétaire du compte qu'il consulte
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
            // si l'utilisateur est un admin, on affiche le menu select pour qu'il puisse changer le rôle de tout le monde
            if(App\Session::isAdmin()) {
            ?>

                <select name="role">
                    <option value="<?= $user->getRole() ?>"><?= $user->getRole() ?></option>
                    <option value="user">user</option>
                </select>

            <?php } ?>

            <p>Member since : <?= $user->getRegistrationDate() ?></p>

            <input type="submit" name="submit" value="Save changes">

            <a href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>" class="delete-btn">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </form>

<?php }} else { ?>
<!-- si l'utilisateur connecté n'est ni propriétaire du compte consulté ni admin, on affiche simplement les infos du compte -->
    <p>Username : <?= $user->getUsername() ?></p>
    <p>E-Mail : <?= $user->getEmail() ?></p>
    <p>Member since : <?= $user->getRegistrationDate() ?></p>

<?php } ?>