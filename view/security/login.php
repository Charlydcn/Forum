<form action="index.php?ctrl=security&action=login" method="POST" autocomplete="off">
    <h1>Log in</h1>
    <label>E-Mail
        <input type="email" name="email" required>
    </label>
    <label>Password
        <input type="password" name="password" required>
    </label>
    <input type="submit" name="submit" value="Log in">
</form>
<p>Not registered yet ? <a href="index.php?ctrl=security&action=displayRegister">Register</a></p>

<?php
$css = 'login.css'
?>