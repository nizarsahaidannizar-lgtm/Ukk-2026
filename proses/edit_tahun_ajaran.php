<?php
session_start();

// Hubungkan ke file koneksi
include '../config/koneksi.php';

// Pengecekan session login
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil ID dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: kelola_tahun_ajaran.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Fetch data tahun ajaran berdasarkan ID
$query_get = mysqli_query($koneksi, "SELECT * FROM t_tahun_ajaran WHERE id = '$id' LIMIT 1");
if (!$query_get || mysqli_num_rows($query_get) == 0) {
    echo "<script>
            alert('Data tahun ajaran tidak ditemukan!');
            window.location.href = 'kelola_tahun_ajaran.php';
          </script>";
    exit();
}

$data = mysqli_fetch_assoc($query_get);

// Deteksi nama kolom secara aman
$val_nama    = $data['nama'] ?? $data['tahun_ajaran'] ?? $data['nama_tahun_ajaran'] ?? '';
$val_mulai   = $data['tgl_mulai'] ?? $data['tanggal_mulai'] ?? $data['mulai'] ?? '';
$val_selesai = $data['tgl_selesai'] ?? $data['tanggal_selesai'] ?? $data['tgl_akhir'] ?? $data['selesai'] ?? '';
$val_status  = $data['status_aktif'] ?? $data['status'] ?? 1;

// Proses Update Data
if (isset($_POST['update'])) {
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tgl_mulai    = mysqli_real_escape_string($koneksi, $_POST['tgl_mulai']);
    $tgl_selesai  = mysqli_real_escape_string($koneksi, $_POST['tgl_selesai']);
    $status_aktif = mysqli_real_escape_string($koneksi, $_POST['status_aktif']);

    // Coba update dengan struktur kolom pertama
    $query_update = "UPDATE t_tahun_ajaran SET 
                        nama = '$nama',
                        tgl_mulai = '$tgl_mulai',
                        tgl_selesai = '$tgl_selesai',
                        status_aktif = '$status_aktif'
                     WHERE id = '$id'";

    $exec = mysqli_query($koneksi, $query_update);

    // Fallback jika nama kolom berbeda di database
    if (!$exec) {
        $query_fallback = "UPDATE t_tahun_ajaran SET 
                             tahun_ajaran = '$nama',
                             tanggal_mulai = '$tgl_mulai',
                             tanggal_selesai = '$tgl_selesai',
                             status_aktif = '$status_aktif'
                           WHERE id = '$id'";
        $exec = mysqli_query($koneksi, $query_fallback);
    }

    if ($exec) {
        echo "<script>
                alert('Data tahun ajaran berhasil diperbarui!');
                window.location.href = 'kelola_tahun_ajaran.php';
              </script>";
        exit();
    } else {
        $error_msg = "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tahun Ajaran</title>
    <!-- Framework Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-white">

<div class="card border mx-auto" style="max-width: 600px;">
    <!-- Header Hijau Sederhana -->
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Edit Tahun Ajaran</h5>
        <a href="kelola_tahun_ajaran.php" class="btn btn-light btn-sm text-success fw-bold">Kembali</a>
    </div>

    <!-- Body Form Berwarna Putih -->
    <div class="card-body bg-white">
        
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger py-2 small mb-3"><?= $error_msg; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Tahun Ajaran</label>
                <input type="text" name="nama" class="form-control" 
                       value="<?= htmlspecialchars($val_nama); ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" 
                           value="<?= htmlspecialchars($val_mulai); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" 
                           value="<?= htmlspecialchars($val_selesai); ?>" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status_aktif" class="form-select" required>
                    <option value="1" <?= ($val_status == 1 || $val_status == '1' || strcasecmp($val_status, 'aktif') == 0) ? 'selected' : ''; ?>>Aktif</option>
                    <option value="0" <?= ($val_status == 0 || $val_status == '0' || strcasecmp($val_status, 'non-aktif') == 0) ? 'selected' : ''; ?>>Non-Aktif</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="kelola_tahun_ajaran.php" class="btn btn-secondary btn-sm px-3">Batal</a>
                <button type="submit" name="update" class="btn btn-success btn-sm px-3 fw-bold">Simpan Perubahan</button>
            </div>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>