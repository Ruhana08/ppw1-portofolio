<?php
// 1. WAJIB jalankan session di paling atas agar $_SESSION['user_id'] bisa terbaca
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "sql105.infinityfree.com"; 
$user = "if0_42099470";
$pass = "PASSWORD_VPANEL_KAMU"; // <-- Pastikan ini diganti dengan password vpanel asli kamu
$db   = "if0_42099470_praktikum_crud";

// Membuat koneksi dengan nama variabel $koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk cek login
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fungsi untuk redirect jika belum login
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

// Fungsi untuk upload file
function uploadFile($file, $target_dir = "uploads/mahasiswa/") {
    // Membuat folder otomatis jika belum ada di hostingan
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Cek apakah file adalah gambar
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return array('success' => false, 'message' => 'File bukan gambar.');
    }
    
    // Cek ukuran file (max 5MB)
    if ($file["size"] > 5000000) {
        return array('success' => false, 'message' => 'File terlalu besar. Maksimal 5MB.');
    }
    
    // Hanya allow format tertentu
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return array('success' => false, 'message' => 'Hanya format JPG, JPEG, PNG & GIF yang diizinkan.');
    }
    
    // Generate nama file unik
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return array('success' => true, 'filename' => $new_filename);
    } else {
        return array('success' => false, 'message' => 'Error saat upload file.');
    }
}

// Fungsi untuk hapus file
function deleteFile($filename, $dir = "uploads/mahasiswa/") {
    if ($filename && file_exists($dir . $filename)) {
        unlink($dir . $filename);
    }
}
?>