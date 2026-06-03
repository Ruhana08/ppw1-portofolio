<?php
include 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container{
            margin-top: 50px;
        }

        h2{
            font-weight: bold;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .btn-primary{
            background-color: #4e73df;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
        }

        .btn-primary:hover{
            background-color: #375ac2;
        }

        .table{
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .table th{
            background-color: #4e73df;
            color: white;
            text-align: center;
        }

        .table td{
            vertical-align: middle;
        }

        .btn-warning{
            color: white;
            border-radius: 8px;
        }

        .btn-danger{
            border-radius: 8px;
        }

        tr:hover{
            background-color: #f1f1f1;
            transition: 0.3s;
        }

    </style>
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Data Mahasiswa</h2>

    <a href="tambah.php" class="btn btn-primary mb-3">
        Tambah Data
    </a>

    <table class="table table-bordered table-hover">

        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>

        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nim']; ?></td>
            <td><?= $row['prodi']; ?></td>

            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">
                    Hapus
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>