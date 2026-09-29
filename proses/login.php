<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<body>

<h2>LOGIN</h2>

<form action="proses_login.php" method="POST">

    <p>
        Email
        <br>
        <input type="text" name="email">
    </p>

    <p>
        Password
        <br>
        <input type="password" name="password">
    </p>

    <p>
        <input type="submit" name="login" value="Login">
    </p>

</form>

</body>
</html>