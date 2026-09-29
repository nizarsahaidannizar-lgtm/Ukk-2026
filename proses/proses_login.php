<?php

session_start();

include "../config/koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM t_users WHERE email='$email' AND password='$password'");

$data = mysqli_fetch_array($query);

if ($data) {

    $_SESSION['id'] = $data['id'];
    $_SESSION['nama'] = $data['name'];
    $_SESSION['role'] = $data['role'];

    header("location:../dashboard.php");
    exit;

} else {

    echo "Email atau password salah";
    echo "<br>";
    echo "<a href='../login.php'>Kembali ke Login</a>";

}

?>