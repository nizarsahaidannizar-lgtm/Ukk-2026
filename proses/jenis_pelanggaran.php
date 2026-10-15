<?php
session_start();

// Hubungkan ke file koneksi
include '../config/koneksi.php';

// Pengecekan session
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jenis Pelanggaran</title>
    <!-- Framework Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-white">

<div class="card border">
    <!-- Header Hijau dengan Tombol Putih -->
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Data Jenis Pelanggaran</h5>
        <a href="../dashboard.php" class="btn btn-light btn-sm text-success fw-bold">Kembali ke Dashboard</a>
    </div>

    <!-- Tabel Data Berwarna Putih -->
    <div class="card-body p-0">
        <table class="table table-hover align-middle m-0 bg-white">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" style="width: 60px;">No</th>
                    <th>Nama Pelanggaran</th>
                    <th class="text-center" style="width: 100px;">Poin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM t_pelanggaran ORDER BY id DESC");

                if ($query && mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                ?>
                        <tr class="bg-white">
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['nama_pelanggaran'] ?? $data['jenis_pelanggaran'] ?? $data['nama'] ?? '-'); ?></td>
                            <td class="text-center">
                                <span class="badge bg-danger fs-6">
                                    <?= htmlspecialchars($data['poin'] ?? 0); ?>
                                </span>
                            </td>
                        </tr>
                <?php 
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3 bg-white">Belum ada data jenis pelanggaran tersimpan.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>