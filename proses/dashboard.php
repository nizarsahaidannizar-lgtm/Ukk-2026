<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("location:login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

<h1>Dashboard</h1>

<p>
    Selamat datang,
    <?php echo $_SESSION['nama']; ?>
</p>

<p>
    Role:
    <?php echo $_SESSION['role']; ?>
</p>

<hr>

<h2>Menu</h2>

<?php

if ($_SESSION['role'] == 'admin') {
?>

    <p><a href="menu1.php">menu 1</a></p>
    <p><a href="menu2.php">menu 2</a></p>
    <p><a href="menu3.php">menu 3</a></p>
    <p><a href="menu4.php">menu 4</a></p>


<?php



} else if ($_SESSION['role'] == 'guru') {
?>
    <p><a href="menu1.php">menu 1</a></p>
    <p><a href="menu2.php">menu 2</a></p>
    <p><a href="menu3.php">Menu 3</a></p>
    <p><a href="menu4.php">Menu 4</a></p>

<?php
}

?>

<hr>

<a href="logout.php">Logout</a>

</body>

</html>