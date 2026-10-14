<?php
session_start();


// Hubungkan ke file koneksi di folder config/
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Wali Kelas</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="background-color: #d1e7dd;">

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        
        <!-- HEADER & TOMBOL TAMBAH -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-success mb-0">Kelola Wali Kelas</h3>
            <div>
                <a href="../dashboard.php" class="btn btn-outline-secondary btn-sm me-2 fw-semibold">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
                <a href="tambah_wali_kelas.php" class="btn btn-success fw-semibold px-3 py-2 rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Wali Kelas
                </a>
            </div>
        </div>

        <!-- TABEL DATA WALI KELAS -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead style="background-color: #d1e7dd;">
                    <tr class="fw-semibold">
                        <th width="50">No</th>
                        <th>Tahun Ajaran</th>
                        <th>Kelas</th>
                        <th>Nama Guru</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Status</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Ambil data langsung dari tabel t_wali_kelas (kolom: id, thn_ajaran_id, kelas_id, guru_id, tgl_mulai, tgl_selesai, status_aktif)
                    $query = mysqli_query($koneksi, "SELECT * FROM t_wali_kelas ORDER BY id DESC");

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            $id           = $data['id'];
                            $thn_id       = $data['thn_ajaran_id'] ?? 0;
                            $kelas_id     = $data['kelas_id'] ?? 0;
                            $guru_id      = $data['guru_id'] ?? 0;
                            $tgl_mulai    = !empty($data['tgl_mulai']) ? date('d-m-Y', strtotime($data['tgl_mulai'])) : '-';
                            $tgl_selesai  = !empty($data['tgl_selesai']) ? date('d-m-Y', strtotime($data['tgl_selesai'])) : '-';
                            $status_aktif = $data['status_aktif'] ?? 0;

                            // 1. Ambil Nama Tahun Ajaran dari t_tahun_ajaran
                            $q_thn = mysqli_query($koneksi, "SELECT * FROM t_tahun_ajaran WHERE id = '$thn_id' LIMIT 1");
                            $d_thn = ($q_thn && mysqli_num_rows($q_thn) > 0) ? mysqli_fetch_assoc($q_thn) : [];
                            $nama_thn = $d_thn['nama'] ?? $d_thn['tahun_ajaran'] ?? '-';

                            // 2. Ambil Nama Kelas dari t_kelas (tanpa memicu error kolom)
                            $q_kls = mysqli_query($koneksi, "SELECT * FROM t_kelas WHERE id = '$kelas_id' LIMIT 1");
                            $d_kls = ($q_kls && mysqli_num_rows($q_kls) > 0) ? mysqli_fetch_assoc($q_kls) : [];
                            $nama_kls = $d_kls['nama_kelas'] ?? $d_kls['nama'] ?? $d_kls['kelas'] ?? '-';

                            // 3. Ambil Nama Guru dari t_guru
                            $q_gru = mysqli_query($koneksi, "SELECT * FROM t_guru WHERE id = '$guru_id' OR id_guru = '$guru_id' LIMIT 1");
                            $d_gru = ($q_gru && mysqli_num_rows($q_gru) > 0) ? mysqli_fetch_assoc($q_gru) : [];
                            $nama_gru = $d_gru['nama_guru'] ?? $d_gru['nama'] ?? '-';
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($nama_thn); ?></td>
                                <td><?= htmlspecialchars($nama_kls); ?></td>
                                <td class="fw-semibold text-start px-3"><?= htmlspecialchars($nama_gru); ?></td>
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
                                        <a href="edit_wali_kelas.php?id=<?= $id; ?>" class="btn btn-warning btn-sm text-white fw-bold px-2">
                                            <i class="bi bi-pencil-square"></i> Ubah
                                        </a>
                                        <a href="hapus_wali_kelas.php?id=<?= $id; ?>" class="btn btn-danger btn-sm fw-bold px-2" onclick="return confirm('Yakin ingin menghapus data wali kelas ini?')">
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
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data wali kelas.</td>
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