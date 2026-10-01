<?php
session_start();

// Pengecekan session login (diarahkan ke folder 'proses/login.php')
if (!isset($_SESSION['id'])) {
    header("location: proses/login.php");
    exit();
}

// Ambil role dari session, jika tidak ada default-nya adalah 'admin'
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'admin';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelanggaran Siswa</title>
    <!-- Framework Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3">

                <div class="d-flex align-items-center gap-2 mb-4 px-1">
                    <img src="logo smk muhamadiyah.png" alt="Logo SMK" class="img-fluid" style="width: 36px; height: 36px; object-fit: contain;">
                    <h4 class="text-white fs-6 fw-bold mb-0 lh-sm">
                        SMK<br>Muhammadiyah
                    </h4>
                </div>

                <ul class="nav nav-pills flex-column">

                    <!-- DASHBOARD -->
                    <li class="nav-item mb-2">
                        <a href="dashboard.php" class="nav-link active fw-bold">
                            Dashboard
                        </a>
                    </li>

                    <!-- MENU DATA SISWA & SUB-MENU TAMBAH DATA SISWA -->
                    <li class="nav-item mb-2">
                        <!-- Mengarah ke proses/siswa.php -->
                        <a href="proses/siswa.php" class="nav-link text-white fw-semibold">
                            Data Siswa
                        </a>
                        <ul class="nav flex-column ms-3 mt-1">
                            <li class="nav-item">
                                <!-- Mengarah ke proses/tambah_data_siswa.php -->
                                <a href="proses/tambah_data_siswa.php" class="nav-link text-white-50 small py-1 px-2">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Siswa
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- MENU DATA GURU (Mengarah ke folder guru/tambah_data_guru.php) -->
                    <li class="nav-item mb-2">
                        <a href="guru/tambah_data_guru.php" class="nav-link text-white">
                            Data Guru
                        </a>
                    </li>

                    <!-- MENU KELAS (Mengarah ke proses/menu3.php) -->
                    <li class="nav-item mb-2">
                        <a href="proses/menu3.php" class="nav-link text-white">
                            Kelas
                        </a>
                    </li>

                    <!-- MENU LAPORAN (Mengarah ke proses/menu4.php) -->
                    <li class="nav-item mb-2">
                        <a href="proses/menu4.php" class="nav-link text-white">
                            Laporan
                        </a>
                    </li>

                    <hr class="text-secondary">

                    <!-- LOGOUT (Mengarah ke proses/logout.php) -->
                    <li class="nav-item">
                        <a href="proses/logout.php" class="nav-link text-danger fw-semibold">
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
                    <p>Selamat datang di halaman Guru. Anda Login Sebagai Guru</p>
                <?php else: ?>
                    <p>Selamat datang di halaman Administrasi. Anda Login Sebagai Admin</p>
                <?php endif; ?>

                <div class="row mt-4">
                    <!-- CARD DATA SISWA -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted">Data Siswa</h5>
                                <h2 class="fw-bold text-success">120</h2>
                            </div>
                        </div>
                    </div>

                    <!-- CARD DATA GURU -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted">Data Guru</h5>
                                <h2 class="fw-bold text-success">25</h2>
                            </div>
                        </div>
                    </div>

                    <!-- CARD KELAS -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted">Kelas</h5>
                                <h2 class="fw-bold text-success">12</h2>
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