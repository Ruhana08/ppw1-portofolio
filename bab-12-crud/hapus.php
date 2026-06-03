<?php
include 'koneksi.php';

$id = $_GET['id'] ?? '';

if (!empty($id)) {
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id='$id'");
}

header("Location: index.php");
exit;