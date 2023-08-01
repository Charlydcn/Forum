<?php
$css = 'auth.css';
?>

<form action="index.php?ctrl=security&action=login" method="POST" autocomplete="off">
    <h2>Log in</h2>
    
    <label>E-Mail : 
    <input type="email" name="email" required>
    </label>

    <label>Password : 
    <input type="password" name="password" required>
    </label>

    <input type="submit" name="submit" value="Log in">
    
    <p>Not registered yet ? <a href="index.php?ctrl=security&action=displayRegister">Register</a></p>
</form>