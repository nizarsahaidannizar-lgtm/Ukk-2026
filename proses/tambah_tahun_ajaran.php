<?php
session_start();

// Hubungkan ke file koneksi
include '../config/koneksi.php';

// Pengecekan session login
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit();
}

// Proses Simpan Data Tahun Ajaran
if (isset($_POST['simpan'])) {
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tgl_mulai    = mysqli_real_escape_string($koneksi, $_POST['tgl_mulai']);
    $tgl_selesai  = mysqli_real_escape_string($koneksi, $_POST['tgl_selesai']);
    $status_aktif = mysqli_real_escape_string($koneksi, $_POST['status_aktif']);

    // Coba simpan dengan opsi nama kolom pertama (nama, tgl_mulai, tgl_selesai)
    $query_simpan = "INSERT INTO t_tahun_ajaran (nama, tgl_mulai, tgl_selesai, status_aktif) 
                     VALUES ('$nama', '$tgl_mulai', '$tgl_selesai', '$status_aktif')";

    $exec = mysqli_query($koneksi, $query_simpan);

    // Fallback jika struktur kolom di database bernama (tahun_ajaran, tanggal_mulai, tanggal_selesai)
    if (!$exec) {
        $query_fallback = "INSERT INTO t_tahun_ajaran (tahun_ajaran, tanggal_mulai, tanggal_selesai, status_aktif) 
                           VALUES ('$nama', '$tgl_mulai', '$tgl_selesai', '$status_aktif')";
        $exec = mysqli_query($koneksi, $query_fallback);
    }

    if ($exec) {
        echo "<script>
                alert('Tahun ajaran berhasil ditambahkan!');
                window.location.href = 'kelola_tahun_ajaran.php';
              </script>";
        exit();
    } else {
        $error_msg = "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tahun Ajaran</title>
    <!-- Framework Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-white">

<div class="card border mx-auto" style="max-width: 600px;">
    <!-- Header Hijau Sederhana -->
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Tambah Tahun Ajaran</h5>
        <a href="kelola_tahun_ajaran.php" class="btn btn-light btn-sm text-success fw-bold">Kembali</a>
    </div>

    <!-- Body Form Berwarna Putih -->
    <div class="card-body bg-white">
        
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger py-2 small mb-3"><?= $error_msg; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Tahun Ajaran <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" 
                       placeholder="Contoh: 2024/2025 Ganjil" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_mulai" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Selesai <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_selesai" class="form-control" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                <select name="status_aktif" class="form-select" required>
                    <option value="1" selected>Aktif</option>
                    <option value="0">Non-Aktif</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="kelola_tahun_ajaran.php" class="btn btn-secondary btn-sm px-3">Batal</a>
                <button type="submit" name="simpan" class="btn btn-success btn-sm px-3 fw-bold">Simpan Data</button>
            </div>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>