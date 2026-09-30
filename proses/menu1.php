<?php
// Panggil file session dan koneksi dengan jalur relative yang benar dari folder 'proses'
include "../include/cek_session.php";
include "../config/koneksi.php";

// Pengecekan role admin
if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) != "admin") {
    header("Location: ../dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Siswa</title>
    <!-- Framework Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar-green {
            background-color: #1b5e20; /* Warna hijau gelap sidebar */
            min-height: 100vh;
        }
        .sidebar-btn {
            background-color: #00838f; /* Warna tombol navigasi di sidebar */
            color: white;
            margin-bottom: 5px;
            border-radius: 0;
            text-align: left;
        }
        .sidebar-btn:hover {
            color: #e0e0e0;
            background-color: #006064;
        }
        .btn-batal {
            background-color: #e50000;
            color: white;
            border: none;
            width: 130px;
            padding: 8px 0;
            border-radius: 4px;
        }
        .btn-batal:hover {
            background-color: #cc0000;
            color: white;
        }
        .btn-tambah {
            background-color: #00c853;
            color: white;
            border: none;
            width: 130px;
            padding: 8px 0;
            border-radius: 4px;
        }
        .btn-tambah:hover {
            background-color: #00a843;
            color: white;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR HIJAU (Sesuai Gambar) -->
        <div class="col-md-3 col-lg-2 sidebar-green p-3 text-white">
            <h4 class="text-center my-3 fw-bold">JusticeAdmin</h4>

            <div class="d-grid gap-1 mt-4">
                <a href="../dashboard.php" class="btn sidebar-btn">Dashboard</a>
                <a href="#" class="btn sidebar-btn">Pengguna</a>
                <a href="menu1.php" class="btn sidebar-btn active fw-bold">Siswa</a>
                <a href="#" class="btn sidebar-btn">Guru</a>
                <a href="#" class="btn sidebar-btn">Pelanggaran</a>
                <a href="#" class="btn sidebar-btn">Tentang</a>
                <a href="logout.php" class="btn sidebar-btn">Logout</a>
            </div>
        </div>

        <!-- FORM KONTEN (Tambah Data Siswa) -->
        <div class="col-md-9 col-lg-10 p-5 bg-white">
            <h3 class="fw-bold mb-4">Tambah Data Siswa</h3>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label small fw-semibold">NISN</label>
                    <input type="text" name="nisn" class="form-control bg-light" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">NIS</label>
                    <input type="text" name="nis" class="form-control bg-light" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Nama</label>
                    <input type="text" name="nama" class="form-control bg-light" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" class="form-control bg-light" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Tanggal lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control bg-light" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Alamat</label>
                    <input type="text" name="alamat" class="form-control bg-light" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Status aktif</label>
                    <input type="text" name="status_aktif" class="form-control bg-light" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Created at</label>
                    <input type="text" class="form-control bg-light" disabled placeholder="">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Created at</label>
                    <input type="text" class="form-control bg-light" disabled placeholder="">
                </div>

                <!-- TOMBOL KANAN PRESISI DENGAN INPUT -->
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="../dashboard.php" class="btn btn-batal text-center text-decoration-none">Batal</a>
                    <button type="submit" name="tambah" class="btn btn-tambah">Tambah</button>
                </div>

            </form>

            <?php
            if (isset($_POST['tambah'])) {
                $nisn          = mysqli_real_escape_string($koneksi, $_POST['nisn']);
                $nis           = mysqli_real_escape_string($koneksi, $_POST['nis']);
                $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
                $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
                $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
                $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
                $status_aktif  = mysqli_real_escape_string($koneksi, $_POST['status_aktif']);

                $query = "INSERT INTO siswa (nisn, nis, nama, jenis_kelamin, tanggal_lahir, alamat, status_aktif, created_at) 
                          VALUES ('$nisn', '$nis', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$status_aktif', NOW())";

                $simpan = mysqli_query($koneksi, $query);

                if ($simpan) {
                    echo "<div class='alert alert-success mt-3'>Data berhasil disimpan!</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Gagal menyimpan: " . mysqli_error($koneksi) . "</div>";
                }
            }
            ?>

        </div>

    </div>
</div>

</body>
</html>