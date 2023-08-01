<?php

$user = $result['data']['user'];

$css = 'userDetails.css';

// on vérifie qu'il y a un utilisateur en session
if(App\Session::getUser($id)) {
    // puis on vérifie qu'il soit bien admin ou propriétaire du compte qu'il consulte
    if (App\Session::isAdmin() || $user->getId() === $_SESSION['user']->getId()) {
?>

        <h2>User details</h2>

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
                        $v = $user->getRole() == 'user' ? 'admin' : 'user';
                        ?>
                        <option value="<?= $user->getRole() ?>"><?= $user->getRole() ?></option>
                        <option value="<?= $v ?>"><?= $v ?></option>
                    </select>
    
                    <label>
                        Banned : 
                        <input type="checkbox" name="ban" <?= $user->getBan() == 1 ? 'checked' : '' ?>>
                    </label>
                <?php } else { ?>
    
                    <p>Banned : <?= $user->getBan() === '1' ? 'Yes' : 'No' ?></p>
    
                <?php } ?>

            
            <input type="submit" name="submit" value="Save changes">
            
            <a href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>" class="delete-btn">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </form>

        <p>Member since : <?= $user->getRegistrationDate() ?></p>

        <a href="index.php?ctrl=forum&action=listPostsByUser&id=<?=$user->getId()?>">User's Posts</a>

<?php }} else { ?>
<!-- si l'utilisateur connecté n'est ni propriétaire du compte consulté ni admin, on affiche simplement les infos du compte -->
    <p>Username : <?= $user->getUsername() ?></p>
    <p>E-Mail : <?= $user->getEmail() ?></p>
    <p>Member since : <?= $user->getRegistrationDate() ?></p>
    <a href="index.php?ctrl=forum&action=listPostsByUser&id=<?=$user->getId()?>">Posts</a>

<?php } ?>