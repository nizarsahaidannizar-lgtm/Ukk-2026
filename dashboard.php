<?php
session_start();

// Pengecekan session login (menggunakan $_SESSION['id'] sesuai dengan proses_login.php)
if (!isset($_SESSION['id'])) {
    header("location: proses/login.php");
    exit();
}

// Ambil role dari session, jika tidak ada default-nya adalah 'admin'
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'admin';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sistem Pelanggaran Siswa</title>
    <!-- Penggunaan Bootstrap CDN versi stabil -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3">

                <h4 class="text-white mb-4">
                    SMK Muhamadiyah
                </h4>

                <ul class="nav nav-pills flex-column">

                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link active">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="proses/menu1.php" class="nav-link text-white">
                            Data Siswa
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="proses/menu2.php" class="nav-link text-white">
                            Data Guru
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="proses/menu3.php" class="nav-link text-white">
                            Kelas
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a href="proses/menu4.php" class="nav-link text-white">
                            Laporan
                        </a>
                    </li>

                    <hr class="text-secondary">

                    <li class="nav-item">
                        <a href="proses/logout.php" class="nav-link text-danger">
                            Logout
                        </a>
                    </li>

                </ul>

            </div>


            <!-- KONTEN UTAMA -->
            <main class="col-md-9 col-lg-10 p-4">

                <h2>Sistem Pelanggaran Siswa</h2>

                <!-- Pengondisian Berdasarkan Role -->
                <?php if (strtolower($role) == 'guru'): ?>
                    <p>
                        Selamat datang di halaman Guru
                    </p>
                    <p>
                        Anda Login Sebagai Guru
                    </p>
                <?php else: ?>
                    <p>
                        Selamat datang di halaman Administrasi
                    </p>
                    <p>
                        Anda Login Sebagai Admin
                    </p>
                <?php endif; ?>


                <div class="row mt-4">

                    <!-- CARD DATA SISWA -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Data Siswa</h5>
                                <h2>120</h2>
                            </div>
                        </div>
                    </div>


                    <!-- CARD DATA GURU -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Data Guru</h5>
                                <h2>25</h2>
                            </div>
                        </div>
                    </div>


                    <!-- CARD KELAS -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Kelas</h5>
                                <h2>12</h2>
                            </div>
                        </div>
                    </div>

                </div>

            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>