<?php
// Panggil file session dan koneksi
include "../include/cek_session.php";
include "../config/koneksi.php";

// Pengecekan role admin
if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) != "admin") {
    header("Location: ../dashboard.php");
    exit();
}

// Proses Hapus Data (Jika tombol hapus diklik)
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query_hapus = "DELETE FROM t_siswa WHERE id = '$id'";
    if (mysqli_query($koneksi, $query_hapus)) {
        echo "<script>
                alert('Data siswa berhasil dihapus!');
                window.location.href = 'siswa.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - SMK Muhammadiyah</title>
    <!-- Framework Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-success-subtle">

<div class="container-fluid">
    <div class="row min-vh-100">

        <!-- SIDEBAR HIJAU -->
        <div class="col-md-3 col-lg-2 bg-success text-white p-3">
            <div class="d-flex align-items-center gap-2 mb-4 px-1">
                <img src="../logo smk muhamadiyah.png" alt="Logo SMK" class="img-fluid" style="width: 42px; height: 42px; object-fit: contain;">
                <h5 class="fw-bold fs-6 mb-0 text-white lh-sm">
                    SMK<br>Muhammadiyah
                </h5>
            </div>

            <div class="nav nav-pills flex-column gap-2">
                <a href="../dashboard.php" class="nav-link text-white bg-success-emphasis">Dashboard</a>
                <a href="siswa.php" class="nav-link active bg-dark fw-bold">Data Siswa</a>
                <a href="../guru/tambah_data_guru.php" class="nav-link text-white bg-success-emphasis">Data Guru</a>
                <a href="menu2.php" class="nav-link text-white bg-success-emphasis">Jenis Pelanggaran</a>
                <a href="menu3.php" class="nav-link text-white bg-success-emphasis">Kelas</a>
                <a href="menu4.php" class="nav-link text-white bg-success-emphasis">Laporan</a>
                
                <hr class="text-white my-2">
                <a href="logout.php" class="nav-link text-primary fw-semibold px-2">Logout</a>
            </div>
        </div>

        <!-- KONTEN UTAMA (Tabel Data Siswa) -->
        <div class="col-md-9 col-lg-10 p-4 p-md-5">
            <div class="card border-0 shadow-sm bg-white rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Header Card & Tombol Tambah Data -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold text-success mb-0">Daftar Data Siswa</h3>
                        <!-- LINK DIUBAH KE tambah_data_siswa.php -->
                        <a href="tambah_data_siswa.php" class="btn btn-success fw-semibold">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Data Siswa
                        </a>
                    </div>

                    <!-- Tabel Responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-success text-center">
                                <tr>
                                    <th scope="col" style="width: 50px;">No</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col" style="width: 60px;">JK</th>
                                    <th scope="col">Tgl Lahir</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col" style="width: 100px;">Status</th>
                                    <th scope="col" style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM t_siswa ORDER BY id DESC");
                                
                                if (mysqli_num_rows($query) > 0) {
                                    while ($data = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td class="text-center fw-semibold"><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($data['nis']); ?></td>
                                            <td><?= htmlspecialchars($data['nisn']); ?></td>
                                            <td class="fw-bold text-dark"><?= htmlspecialchars($data['nama']); ?></td>
                                            <td class="text-center"><?= htmlspecialchars($data['jenis_kelamin']); ?></td>
                                            <td class="text-nowrap"><?= date('d-m-Y', strtotime($data['tgl_lahir'])); ?></td>
                                            <td><?= htmlspecialchars($data['alamat']); ?></td>
                                            <td class="text-center">
                                                <?php if ($data['status_aktif'] == 1 || $data['status_aktif'] == '1'): ?>
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Aktif</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">Non-Aktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="edit_siswa.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm text-white fw-semibold">
                                                        <i class="bi bi-pencil-square"></i> Ubah
                                                    </a>
                                                    <a href="siswa.php?hapus=<?= $data['id']; ?>" 
                                                       class="btn btn-danger btn-sm fw-semibold" 
                                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php 
                                    }
                                } else {
                                    echo "<tr><td colspan='9' class='text-center py-4 text-muted'>Belum ada data siswa.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>