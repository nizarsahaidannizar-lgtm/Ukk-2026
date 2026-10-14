<?php
session_start();


// Hubungkan ke koneksi.php di folder config/
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pelanggaran</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Riwayat Pelanggaran</h4>
            <a href="../dashboard.php" class="btn btn-sm btn-light text-success fw-bold">Kembali ke Dashboard</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle border">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Pelanggaran</th>
                            <th>Tanggal</th>
                            <th>Poin</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        // Query langsung ke tabel t_pelanggaran_siswa
                        $query = mysqli_query($koneksi, "SELECT * FROM t_pelanggaran_siswa ORDER BY id DESC");

                        if (!$query) {
                            echo "<tr><td colspan='7' class='text-danger text-center'>Error Query: " . mysqli_error($koneksi) . "</td></tr>";
                        } elseif (mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['nama_siswa'] ?? '-'); ?></td>
                                    <td><?= htmlspecialchars($data['nama_kelas'] ?? '-'); ?></td>
                                    <td><?= htmlspecialchars($data['nama_pelanggan'] ?? '-'); ?></td>
                                    <td><?= htmlspecialchars($data['tanggal'] ?? '-'); ?></td>
                                    <td><span class="badge bg-danger fs-6"><?= htmlspecialchars($data['poin'] ?? '-'); ?></span></td>
                                    <td><?= htmlspecialchars($data['keterangan'] ?? '-'); ?></td>
                                </tr>
                        <?php 
                            } 
                        } else {
                        ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data pelanggaran.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>