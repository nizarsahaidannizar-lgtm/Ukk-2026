<?php
// Panggil file session dan koneksi sesuai struktur folder Anda
include "../include/cek_session.php";
include "../config/koneksi.php";

// Pengecekan role admin
if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) != "admin") {
    header("Location: ../dashboard.php");
    exit();
}

// Proses Hapus Data Kelas
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query_hapus = "DELETE FROM t_kelas WHERE id = '$id'";
    if (mysqli_query($koneksi, $query_hapus)) {
        echo "<script>
                alert('Data kelas berhasil dihapus!');
                window.location.href = 'kelas.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - SMK Muhammadiyah</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

            <!-- LINK SIDEBAR DISESUAIKAN DENGAN NAMA FILE DI FOLDER PROSES -->
            <div class="nav nav-pills flex-column gap-2">
                <a href="../dashboard.php" class="nav-link text-white bg-success-emphasis">Dashboard</a>
                <a href="siswa.php" class="nav-link text-white bg-success-emphasis">Data Siswa</a>
                <a href="../guru/guru.php" class="nav-link text-white bg-success-emphasis">Data Guru</a>
                <a href="kelas.php" class="nav-link active bg-dark fw-bold">Kelas</a>
                <a href="laporan.php" class="nav-link text-white bg-success-emphasis">Laporan</a>
                
                <hr class="text-white my-2">
                <a href="logout.php" class="nav-link text-primary fw-semibold px-2">Logout</a>
            </div>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="col-md-9 col-lg-10 p-4 p-md-5">
            
            <!-- FORM TAMBAH KELAS -->
            <div class="card border-0 shadow-sm bg-white rounded-4 mb-4">
                <div class="card-body p-4 p-md-5">
                    <h3 class="fw-bold mb-4 text-success">Tambah Data Kelas</h3>

                    <form method="POST">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-semibold">Nama Kelas (nama)</label>
                                <input type="text" name="nama" class="form-control bg-light" placeholder="Contoh: X RPL 1" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-semibold">Tingkat (tingkat)</label>
                                <select name="tingkat" class="form-select bg-light" required>
                                    <option value="" selected disabled>-- Pilih Tingkat --</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-semibold">Jurusan (jurusan)</label>
                                <input type="text" name="jurusan" class="form-control bg-light" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="reset" class="btn btn-secondary px-4">Batal</button>
                            <button type="submit" name="simpan" class="btn btn-success px-4">Simpan</button>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['simpan'])) {
                        $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
                        $tingkat = mysqli_real_escape_string($koneksi, $_POST['tingkat']);
                        $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);

                        $query_insert = "INSERT INTO t_kelas (nama, tingkat, jurusan, status_aktif, created_at, updated_at) 
                                         VALUES ('$nama', '$tingkat', '$jurusan', 1, NOW(), NOW())";
                        
                        if (mysqli_query($koneksi, $query_insert)) {
                            echo "<script>
                                    alert('Data kelas berhasil disimpan!');
                                    window.location.href = 'kelas.php';
                                  </script>";
                            exit();
                        } else {
                            echo "<div class='alert alert-danger mt-3 mb-0'>Gagal menyimpan: " . mysqli_error($koneksi) . "</div>";
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- TABEL DAFTAR KELAS -->
            <div class="card border-0 shadow-sm bg-white rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h4 class="fw-bold text-success mb-4">Daftar Data Kelas</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-success text-center">
                                <tr>
                                    <th scope="col" style="width: 50px;">id</th>
                                    <th scope="col">nama</th>
                                    <th scope="col">tingkat</th>
                                    <th scope="col">jurusan</th>
                                    <th scope="col">status_aktif</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">updated_at</th>
                                    <th scope="col" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM t_kelas ORDER BY id ASC");

                                if ($query && mysqli_num_rows($query) > 0) {
                                    while ($data = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td class="text-center fw-bold"><?= $data['id']; ?></td>
                                            <td class="fw-semibold"><?= htmlspecialchars($data['nama']); ?></td>
                                            <td class="text-center"><?= htmlspecialchars($data['tingkat']); ?></td>
                                            <td><?= htmlspecialchars($data['jurusan']); ?></td>
                                            <td class="text-center"><?= $data['status_aktif']; ?></td>
                                            <td class="small text-muted"><?= $data['created_at']; ?></td>
                                            <td class="small text-muted"><?= $data['updated_at']; ?></td>
                                            <td class="text-center">
                                                <a href="kelas.php?hapus=<?= $data['id']; ?>" 
                                                   class="btn btn-danger btn-sm" 
                                                   onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                <?php 
                                    }
                                } else {
                                    echo "<tr><td colspan='8' class='text-center py-4 text-muted'>Belum ada data kelas tersimpan.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>