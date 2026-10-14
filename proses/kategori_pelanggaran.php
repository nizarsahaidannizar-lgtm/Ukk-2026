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
    <title>Kategori Pelanggaran</title>
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
            <h3 class="fw-bold text-success m-0">Kategori Pelanggaran</h3>
            <div>
                <a href="../dashboard.php" class="btn btn-outline-secondary btn-sm me-2 fw-semibold">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
                <a href="tambah_kategori_pelanggaran.php" class="btn btn-custom-add px-3 py-2 rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
                </a>
            </div>
        </div>

        <!-- TABEL DATA KATEGORI PELANGGARAN -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead style="background-color: #d1e7dd;">
                    <tr class="fw-semibold">
                        <th width="50">No</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan / Deskripsi</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    
                    // Query mengambil data dari tabel t_pelanggaran_kategori
                    $query = mysqli_query($koneksi, "SELECT * FROM t_pelanggaran_kategori ORDER BY id DESC");

                    // Fallback jika nama tabel menggunakan id_kategori atau struktur berbeda
                    if (!$query) {
                        $query = mysqli_query($koneksi, "SELECT * FROM t_pelanggaran_kategori ORDER BY 1 DESC");
                    }

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            $id            = $data['id'] ?? $data['id_kategori'] ?? $data['id_pelanggaran_kategori'] ?? 0;
                            $nama_kategori = $data['nama_kategori'] ?? $data['kategori'] ?? $data['nama'] ?? '-';
                            $keterangan    = $data['keterangan'] ?? $data['deskripsi'] ?? '-';
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td class="fw-semibold text-start px-3"><?= htmlspecialchars($nama_kategori); ?></td>
                                <td class="text-start"><?= htmlspecialchars($keterangan); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="edit_kategori_pelanggaran.php?id=<?= $id; ?>" class="btn btn-warning btn-sm text-white fw-bold px-2">
                                            <i class="bi bi-pencil-square"></i> Ubah
                                        </a>
                                        <a href="hapus_kategori_pelanggaran.php?id=<?= $id; ?>" class="btn btn-danger btn-sm fw-bold px-2" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
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
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data kategori pelanggaran.</td>
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