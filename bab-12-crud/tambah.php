<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    mysqli_query($conn, "INSERT INTO mahasiswa (nama, nim, prodi)
    VALUES ('$nama', '$nim', '$prodi')");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width:600px">

    <h3>Tambah Mahasiswa</h3>

    <form method="POST">

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Prodi</label>
            <input type="text" name="prodi" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>

        <a href="index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>

    </form>

</div>

</body>
</html>