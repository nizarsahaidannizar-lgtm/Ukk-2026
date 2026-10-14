<?php
session_start();
// Koneksi ke database dari folder config/
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Pelanggaran</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Jenis Pelanggaran</h4>
            <a href="../dashboard.php" class="btn btn-sm btn-light text-primary fw-bold">Kembali ke Dashboard</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover border">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Pelanggaran</th>
                            <th width="100">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Query mengambil data dari tabel t_pelanggaran
                        $query = mysqli_query($koneksi, "SELECT * FROM t_pelanggaran ORDER BY id_pelanggaran ASC");

                        if ($query && mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['nama_pelanggaran']); ?></td>
                                    <td><span class="badge bg-danger fs-6"><?= htmlspecialchars($data['poin']); ?></span></td>
                                </tr>
                        <?php 
                            }
                        } else { 
                        ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data jenis pelanggaran.</td>
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