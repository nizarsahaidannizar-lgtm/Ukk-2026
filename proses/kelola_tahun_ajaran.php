<?php
session_start();

// Hubungkan ke file koneksi
include '../config/koneksi.php';

// Pengecekan session
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit();
}

// Proses Hapus Tahun Ajaran
if (isset($_GET['hapus'])) {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query_hapus = "DELETE FROM t_tahun_ajaran WHERE id = '$id_hapus'";
    if (mysqli_query($koneksi, $query_hapus)) {
        echo "<script>
                alert('Data tahun ajaran berhasil dihapus!');
                window.location.href = 'kelola_tahun_ajaran.php';
              </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tahun Ajaran</title>
    <!-- Framework Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: #d1e7dd;">

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        
        <!-- HEADER & TOMBOL AKSI -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-success mb-0">Daftar Tahun Ajaran</h3>
            <div>
                <a href="../dashboard.php" class="btn btn-outline-secondary btn-sm me-2 fw-semibold">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
                <a href="tambah_tahun_ajaran.php" class="btn btn-success fw-semibold px-3 py-2 rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Tahun Ajaran
                </a>
            </div>
        </div>

        <!-- TABEL DATA TAHUN AJARAN -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center mb-0">
                <thead style="background-color: #ffffff;">
                    <tr class="fw-bold text-dark">
                        <th style="width: 50px;">No</th>
                        <th>Tahun Ajaran</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th style="width: 110px;">Status</th>
                        <th style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM t_tahun_ajaran ORDER BY id DESC");

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            // 1. Deteksi nama kolom tanggal mulai & selesai secara fleksibel
                            $raw_mulai = $data['tgl_mulai'] ?? $data['tanggal_mulai'] ?? $data['mulai'] ?? '';
                            $raw_selesai = $data['tgl_selesai'] ?? $data['tanggal_selesai'] ?? $data['tgl_akhir'] ?? $data['selesai'] ?? '';

                            // 2. Format tampilan tanggal jika terisi
                            $tgl_mulai = (!empty($raw_mulai) && $raw_mulai != '0000-00-00') ? date('d-m-Y', strtotime($raw_mulai)) : '-';
                            $tgl_selesai = (!empty($raw_selesai) && $raw_selesai != '0000-00-00') ? date('d-m-Y', strtotime($raw_selesai)) : '-';

                            // 3. Nama/Tahun Ajaran dan Status
                            $tahun_ajaran = $data['nama'] ?? $data['tahun_ajaran'] ?? $data['nama_tahun_ajaran'] ?? '-';
                            $status_aktif = $data['status_aktif'] ?? $data['status'] ?? 0;
                    ?>
                            <tr class="bg-white">
                                <td><?= $no++; ?></td>
                                <td class="fw-bold text-start px-3"><?= htmlspecialchars($tahun_ajaran); ?></td>
                                <td><?= htmlspecialchars($tgl_mulai); ?></td>
                                <td><?= htmlspecialchars($tgl_selesai); ?></td>
                                <td>
                                    <?php if ($status_aktif == 1 || $status_aktif == '1' || strcasecmp($status_aktif, 'aktif') == 0): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">Non-Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="edit_tahun_ajaran.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm text-white fw-bold px-2">
                                            <i class="bi bi-pencil-square"></i> Ubah
                                        </a>
                                        <a href="kelola_tahun_ajaran.php?hapus=<?= $data['id']; ?>" 
                                           class="btn btn-danger btn-sm fw-bold px-2" 
                                           onclick="return confirm('Yakin ingin menghapus data tahun ajaran ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center text-muted py-4 bg-white'>Belum ada data tahun ajaran tersimpan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>