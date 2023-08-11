<?php
$css = 'auth.css';
?>

<form action="index.php?ctrl=security&action=register" method="POST" autocomplete="off">
    <h2>Join us</h2>

    <div>
        <label>Username : 
            <input type="text" name="username" required>
        </label>
        <label>E-Mail : 
            <input type="email" name="email" required>
        </label>
        <label>Password  : 
            <input type="password" name="pass1" required>
        </label>
        <label>Confirm password : 
            <input type="password" name="pass2" required>
        </label>
    </div>
    
    <input type="submit" name="submit" value="Register">

    <p>Already registered ? <a href="index.php?ctrl=security&action=displayLogin">Log in</a></p>
</form>