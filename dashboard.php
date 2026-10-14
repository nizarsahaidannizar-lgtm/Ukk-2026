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
    <title>Sistem Pelanggaran Siswa - SMK Muhammadiyah</title>
    <!-- Framework Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-success-subtle">
    <div class="container-fluid">
        <div class="row min-vh-100">

            <!-- SIDEBAR HIJAU -->
            <div class="col-md-3 col-lg-2 bg-success text-white p-3">

                <!-- HEADER LOGO + TEKS SMK MUHAMMADIYAH -->
                <div class="d-flex align-items-center gap-2 mb-4 px-1">
                    <img src="logo smk muhamadiyah.png" alt="Logo SMK" class="img-fluid" style="width: 42px; height: 42px; object-fit: contain;">
                    <h5 class="fw-bold fs-6 mb-0 text-white lh-sm">
                        SMK<br>Muhammadiyah
                    </h5>
                </div>

                <!-- NAVIGASI MENU SIDEBAR -->
                <div class="nav nav-pills flex-column gap-2">

                    <!-- DASHBOARD -->
                    <a href="dashboard.php" class="nav-link active bg-dark fw-bold">
                        Dashboard
                    </a>

                    <!-- MENU DATA SISWA (HANYA SATU LINK KE SISWA.PHP) -->
                    <a href="proses/siswa.php" class="nav-link text-white bg-success-emphasis">
                        Data Siswa
                    </a>

                    <!-- DATA GURU -->
                    <a href="guru/tambah_data_guru.php" class="nav-link text-white bg-success-emphasis">
                        Data Guru
                    </a>

                       <!-- KELAS -->
                    <a href="proses/kelas.php" class="nav-link text-white bg-success-emphasis">
                        Kelas
                    </a>

                       <!-- KELOLA TAHUN AJARAN -->
                    <a href="proses/kelola_tahun_ajaran.php" class="nav-link text-white bg-success-emphasis">
                       Tahun Ajaran
                    </a>

                    
                       <!-- KELOLA WALI KELAS -->
                    <a href="proses/kelola_wali_kelas.php" class="nav-link text-white bg-success-emphasis">
                       Wali Kelas
                    </a>

                    
                       <!-- KELOLA KATEGORI PELANGGARAN-->
                    <a href="proses/kategori_pelanggaran.php" class="nav-link text-white bg-success-emphasis">
                       Kategori Pelanggaran
                    </a>

                    <!-- JENIS PELANGGARAN -->
                    <a href="proses/jenis_pelanggaran.php" class="nav-link text-white bg-success-emphasis">
                        Jenis Pelanggaran
                    </a>

                    <!-- LAPORAN -->
                    <a href="proses/laporan.php" class="nav-link text-white bg-success-emphasis">
                        Laporan
                    </a>

                    <hr class="text-white my-2">

                    <!-- LOGOUT -->
                    <a href="proses/logout.php" class="nav-link text-primary fw-semibold px-2">
                        Logout
                    </a>

                </div>

            </div>


            <!-- KONTEN UTAMA -->
            <main class="col-md-9 col-lg-10 p-4 p-md-5">

                <div class="card border-0 shadow-sm bg-white rounded-4 p-4 mb-4">
                    <h2 class="fw-bold text-success mb-1">Sistem Pelanggaran Siswa</h2>
                    <?php if (strtolower($role) == 'guru'): ?>
                        <p class="text-muted mb-0">Selamat datang di halaman Guru. Anda Login Sebagai <strong>Guru</strong></p>
                    <?php else: ?>
                        <p class="text-muted mb-0">Selamat datang di halaman Administrasi. Anda Login Sebagai <strong>Admin</strong></p>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <!-- CARD DATA SISWA -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm bg-white rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title text-muted fw-semibold mb-2">Data Siswa</h5>
                                <h2 class="fw-bold text-success mb-0">120</h2>
                            </div>
                        </div>
                    </div>

                    <!-- CARD DATA GURU -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm bg-white rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title text-muted fw-semibold mb-2">Data Guru</h5>
                                <h2 class="fw-bold text-success mb-0">25</h2>
                            </div>
                        </div>
                    </div>

                    <!-- CARD KELAS -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm bg-white rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title text-muted fw-semibold mb-2">Kelas</h5>
                                <h2 class="fw-bold text-success mb-0">12</h2>
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