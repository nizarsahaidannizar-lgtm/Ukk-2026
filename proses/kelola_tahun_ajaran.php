<?php
session_start();


// Hubungkan ke koneksi database dari folder config/
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tahun Ajaran</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .btn-custom-add {
            background-color: #198754;
            color: white;
            font-weight: 600;
        }
        .btn-custom-add:hover {
            background-color: #146c43;
            color: white;
        }
    </style>
</head>
<body style="background-color: #d1e7dd;">

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        
        <!-- HEADER DENGAN JUDUL DAN TOMBOL TAMBAH -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-success m-0">Daftar Tahun Ajaran</h3>
            <div>
                <a href="../dashboard.php" class="btn btn-outline-secondary btn-sm me-2 fw-semibold">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
                <a href="tambah_tahun_ajaran.php" class="btn btn-custom-add px-3 py-2 rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Tahun Ajaran
                </a>
            </div>
        </div>

        <!-- TABEL DATA TAHUN AJARAN -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead style="background-color: #d1e7dd;">
                    <tr class="fw-semibold">
                        <th width="50">No</th>
                        <th>Tahun Ajaran</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Query mengambil data dari tabel t_tahun_ajaran
                    $query = mysqli_query($koneksi, "SELECT * FROM t_tahun_ajaran ORDER BY id ASC");

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            // Penyesuaian nama kolom persis dengan database
                            $id          = $data['id'];
                            $nama        = $data['nama'];
                            $tgl_mulai   = date('d-m-Y', strtotime($data['tgl_mulai']));
                            $tgl_selesai = date('d-m-Y', strtotime($data['tgl_selesai']));
                            $status_aktif = $data['status_aktif'];
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td class="fw-semibold text-start px-3"><?= htmlspecialchars($nama); ?></td>
                                <td><?= htmlspecialchars($tgl_mulai); ?></td>
                                <td><?= htmlspecialchars($tgl_selesai); ?></td>
                                <td>
                                    <?php if ($status_aktif == 1): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">Non-Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="edit_tahun_ajaran.php?id=<?= $id; ?>" class="btn btn-warning btn-sm text-white fw-bold px-2">
                                            <i class="bi bi-pencil-square"></i> Ubah
                                        </a>
                                        <a href="hapus_tahun_ajaran.php?id=<?= $id; ?>" class="btn btn-danger btn-sm fw-bold px-2" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    <?php 
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data tahun ajaran.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>