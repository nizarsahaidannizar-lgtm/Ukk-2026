<?php
session_start();

// Hubungkan ke koneksi database
include '../config/koneksi.php';
include 'data_siswa.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data Guru</title>
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
        
        <!-- HEADER DENGAN JUDUL DAN TOMBOL TAMBAH DATA GURU -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-success m-0">Daftar Data Guru</h3>
            <a href="tambah_data_guru.php" class="btn btn-custom-add px-3 py-2 rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah Data Guru
            </a>
        </div>

        <!-- TABEL DATA GURU -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead style="background-color: #d1e7dd;">
                    <tr class="fw-semibold">
                        <th>No</th>
                        <th>NIP / NUPTK</th>
                        <th>Nama Guru</th>
                        <th>JK</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM t_guru ORDER BY id_guru DESC");

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            // Penyesuaian variabel nama kolom
                            $nip    = $data['nip'] ?? $data['nuptk'] ?? '-';
                            $nama   = $data['nama_guru'] ?? $data['nama'] ?? '-';
                            $jk     = $data['jk'] ?? $data['jenis_kelamin'] ?? '-';
                            $no_hp  = $data['no_hp'] ?? $data['no_telepon'] ?? '-';
                            $alamat = $data['alamat'] ?? '-';
                            $id     = $data['id_guru'] ?? $data['id'] ?? 0;
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($nip); ?></td>
                                <td class="text-start fw-semibold"><?= htmlspecialchars($nama); ?></td>
                                <td><?= htmlspecialchars($jk); ?></td>
                                <td><?= htmlspecialchars($no_hp); ?></td>
                                <td class="text-start"><?= htmlspecialchars($alamat); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="edit_guru.php?id=<?= $id; ?>" class="btn btn-warning btn-sm text-white fw-bold px-2">
                                            <i class="bi bi-pencil-square"></i> Ubah
                                        </a>
                                        <a href="hapus_guru.php?id=<?= $id; ?>" class="btn btn-danger btn-sm fw-bold px-2" onclick="return confirm('Yakin ingin menghapus data ini?')">
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
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data guru.</td>
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