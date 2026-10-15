<?php
session_start();

// Hubungkan ke file koneksi di folder config/
include '../config/koneksi.php';

// Pengecekan session login
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit();
}

// Proses Hapus Penempatan Siswa
if (isset($_GET['hapus'])) {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query_hapus = "DELETE FROM t_kelas_siswa WHERE id = '$id_hapus'";
    if (mysqli_query($koneksi, $query_hapus)) {
        echo "<script>
                alert('Data penempatan berhasil dihapus!');
                window.location.href = 'penempatan_siswa.php';
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
    <title>Penempatan Siswa</title>
    <!-- Framework Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: #d1e7dd;">

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        
        <!-- HEADER & TOMBOL AKSI -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-success mb-0">Penempatan Siswa</h3>
            <div>
                <a href="../dashboard.php" class="btn btn-outline-secondary btn-sm me-2 fw-semibold">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
                <a href="tambah_penempatan.php" class="btn btn-success fw-semibold px-3 py-2 rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Penempatan
                </a>
            </div>
        </div>

        <!-- TABEL DATA PENEMPATAN SISWA -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center mb-0">
                <thead style="background-color: #ffffff;">
                    <tr class="fw-bold text-dark">
                        <th style="width: 50px;">No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th style="width: 110px;">Status</th>
                        <th style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    // Mengambil data t_kelas_siswa terlebih dahulu agar aman dari nama kolom JOIN
                    $query_ks = mysqli_query($koneksi, "SELECT * FROM t_kelas_siswa ORDER BY id DESC");

                    if ($query_ks && mysqli_num_rows($query_ks) > 0) {
                        while ($data = mysqli_fetch_assoc($query_ks)) {
                            $id            = $data['id'];
                            $siswa_id      = $data['siswa_id'] ?? $data['id_siswa'] ?? 0;
                            $kelas_id      = $data['kelas_id'] ?? $data['id_kelas'] ?? 0;
                            $thn_id        = $data['tahun_ajaran_id'] ?? $data['thn_ajaran_id'] ?? $data['tahun_id'] ?? $data['id_tahun_ajaran'] ?? 0;
                            $status_aktif  = $data['status_aktif'] ?? 1;

                            // 1. Ambil data siswa dari t_siswa
                            $q_siswa = mysqli_query($koneksi, "SELECT * FROM t_siswa WHERE id = '$siswa_id' LIMIT 1");
                            $d_siswa = ($q_siswa && mysqli_num_rows($q_siswa) > 0) ? mysqli_fetch_assoc($q_siswa) : [];
                            $nisn = $d_siswa['nisn'] ?? '-';
                            $nama_siswa = $d_siswa['nama'] ?? '-';

                            // 2. Ambil data kelas dari t_kelas (kolom 'nama')
                            $q_kelas = mysqli_query($koneksi, "SELECT * FROM t_kelas WHERE id = '$kelas_id' LIMIT 1");
                            $d_kelas = ($q_kelas && mysqli_num_rows($q_kelas) > 0) ? mysqli_fetch_assoc($q_kelas) : [];
                            $nama_kelas = $d_kelas['nama'] ?? $d_kelas['nama_kelas'] ?? $d_kelas['kelas'] ?? '-';

                            // 3. Ambil data tahun ajaran dari t_tahun_ajaran
                            $q_thn = mysqli_query($koneksi, "SELECT * FROM t_tahun_ajaran WHERE id = '$thn_id' LIMIT 1");
                            $d_thn = ($q_thn && mysqli_num_rows($q_thn) > 0) ? mysqli_fetch_assoc($q_thn) : [];
                            $nama_thn = $d_thn['nama'] ?? $d_thn['tahun_ajaran'] ?? '-';
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($nisn); ?></td>
                                <td class="fw-bold text-start px-3"><?= htmlspecialchars($nama_siswa); ?></td>
                                <td><?= htmlspecialchars($nama_kelas); ?></td>
                                <td><?= htmlspecialchars($nama_thn); ?></td>
                                <td>
                                    <?php if ($status_aktif == 1 || $status_aktif == '1'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">Non-Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="edit_penempatan.php?id=<?= $id; ?>" class="btn btn-warning btn-sm text-white fw-bold px-2">
                                            <i class="bi bi-pencil-square"></i> Ubah
                                        </a>
                                        <a href="penempatan_siswa.php?hapus=<?= $id; ?>" 
                                           class="btn btn-danger btn-sm fw-bold px-2" 
                                           onclick="return confirm('Yakin ingin menghapus data penempatan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center text-muted py-4'>Belum ada data penempatan siswa tersimpan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Framework Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>