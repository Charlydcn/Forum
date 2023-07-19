<?php

$users = $result["data"]['users'];

?>

<h1>Users</h1>

<table>
    <thead>
        <th>Username</th>
        <th>E-Mail</th>
        <th>Role</th>
        <th>Registration date</th>
    </thead>
    <tbody>
    
    <?php
    foreach($users as $user ){
    ?>

    <td>
        <a href=""><?=$user->getUsername()?></a>
    </td>
    <td>
        <?=$user->getEmail()?>
    </td>
    <td>
        <?=$user->getRole()?>
    </td>
    <td>
        <?=$user->getRegistrationDate()?>
    </td>

    <?php } ?> 

    </tbody>
</table>

  
