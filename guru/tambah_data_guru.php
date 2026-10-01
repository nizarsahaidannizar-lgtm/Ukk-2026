<?php
// Path disesuaikan karena file sudah di folder 'proses'
include "../include/cek_session.php";
include "../config/koneksi.php";

// Pengecekan role admin
if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) != "admin") {
    header("Location: ../dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Guru - SMK Muhammadiyah</title>
    <!-- Framework Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-success-subtle">

<div class="container-fluid">
    <div class="row min-vh-100">

        <!-- SIDEBAR HIJAU -->
        <div class="col-md-3 col-lg-2 bg-success text-white p-3">
            
            <div class="d-flex align-items-center gap-2 mb-4 px-1">
                <img src="../logo smk muhamadiyah.png" alt="Logo SMK" class="img-fluid" style="width: 42px; height: 42px; object-fit: contain;">
                <h5 class="fw-bold fs-6 mb-0 text-white lh-sm">
                    SMK<br>Muhammadiyah
                </h5>
            </div>

            <!-- Navigasi Menu Bootstrap -->
            <div class="nav nav-pills flex-column gap-2">
                <a href="../dashboard.php" class="nav-link text-white bg-success-emphasis">Dashboard</a>
                <a href="menu1.php" class="nav-link text-white bg-success-emphasis">Data Siswa</a>
                <a href="tambah_data_guru.php" class="nav-link active bg-dark fw-bold">Data Guru</a>
                <a href="#" class="nav-link text-white bg-success-emphasis">Kelas</a>
                <a href="#" class="nav-link text-white bg-success-emphasis">Laporan</a>
                
                <hr class="text-white my-2">
                <a href="logout.php" class="nav-link text-primary fw-semibold px-2">Logout</a>
            </div>
        </div>

        <!-- KONTEN FORM -->
        <div class="col-md-9 col-lg-10 p-4 p-md-5">
            <div class="card border-0 shadow-sm bg-white rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <h3 class="fw-bold mb-4 text-success">Tambah Data Guru</h3>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">NIP / NUPTK</label>
                            <input type="text" name="nip" class="form-control bg-light" placeholder="Masukkan NIP guru" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama" class="form-control bg-light" placeholder="Masukkan nama lengkap guru" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select bg-light" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki (L)</option>
                                <option value="P">Perempuan (P)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">No. Telepon / WhatsApp</label>
                            <input type="text" name="no_telp" class="form-control bg-light" placeholder="Masukkan nomor telepon" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Alamat</label>
                            <textarea name="alamat" class="form-control bg-light" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Status Aktif</label>
                            <select name="status_aktif" class="form-select bg-light" required>
                                <option value="1" selected>Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="../dashboard.php" class="btn btn-danger px-4">Batal</a>
                            <button type="submit" name="tambah" class="btn btn-success px-4">Tambah</button>
                        </div>

                    </form>

                    <?php
                    if (isset($_POST['tambah'])) {
                        $nip           = mysqli_real_escape_string($koneksi, $_POST['nip']);
                        $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
                        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
                        $no_telp       = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
                        $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
                        $status_aktif  = mysqli_real_escape_string($koneksi, $_POST['status_aktif']);

                        $query = "INSERT INTO t_guru (nip, nama, jenis_kelamin, no_telp, alamat, status_aktif, created_at, updated_at) 
                                  VALUES ('$nip', '$nama', '$jenis_kelamin', '$no_telp', '$alamat', '$status_aktif', NOW(), NOW())";

                        $simpan = mysqli_query($koneksi, $query);

                        if ($simpan) {
                            echo "<script>
                                    alert('Data guru berhasil disimpan!');
                                    window.location.href = '../dashboard.php';
                                  </script>";
                            exit();
                        } else {
                            echo "<div class='alert alert-danger mt-3 mb-0'>Gagal menyimpan: " . mysqli_error($koneksi) . "</div>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>