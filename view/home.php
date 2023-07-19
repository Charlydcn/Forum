<h1>Welcome to the Forum</h1>

<form action="index.php?ctrl=security&action=login" method="POST" autocomplete="off">
    <h1>Log in</h1>
    <label>Username
        <input type="text" name="username" required>
    </label>
    <label>Password
        <input type="password" name="password" required>
    </label>
    <input type="submit" name="submit" value="Log in">
</form>
<p>Not registered yet ? <a href="index.php?ctrl=security&action=displayRegister">Register</a></p>