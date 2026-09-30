<?php
session_start();

// Panggil koneksi dari folder config/
include "../config/koneksi.php";

if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Cari data user
    $query = mysqli_query($koneksi, "SELECT * FROM t_users WHERE email='$email' AND password='$password'");
    $data  = mysqli_fetch_array($query);

    if ($data) {
        // Simpan data login ke Session
        $_SESSION['id']   = $data['id'];
        $_SESSION['nama'] = $data['name'];
        $_SESSION['role'] = $data['role'];

        // Pastikan session tersimpan sebelum pindah halaman
        session_write_close();

        // Pindah ke dashboard.php di root folder
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Jika email / password tidak cocok
        echo "<script>
                alert('Email atau Password salah!');
                window.location.href = 'login.php';
              </script>";
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>