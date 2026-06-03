<?php
include 'koneksi.php';

$id = $_GET['id'] ?? '';

if (empty($id)) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    mysqli_query($conn, "UPDATE mahasiswa SET
        nama='$nama',
        nim='$nim',
        prodi='$prodi'
        WHERE id='$id'
    ");

    header("Location: index.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width:600px">

    <h3>Edit Mahasiswa</h3>

    <form method="POST">

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $row['nama']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" value="<?= $row['nim']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Prodi</label>
            <input type="text" name="prodi" value="<?= $row['prodi']; ?>" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-warning w-100">Update</button>

        <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>

    </form>

</div>

</body>
</html>