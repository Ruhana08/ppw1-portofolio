<?php
// ==========================================
// TUGAS 1: Variabel Data Diri
// ==========================================
$nama  = "Ruhana Faiz Restiyanti";
$nim   = "25/557718/SV/26223";
$prodi = "Teknologi Rekayasa Perangkat Lunak";
$kota  = "Pacitan";

// ==========================================
// TUGAS 2: Fungsi Hitung IMT
// ==========================================
function hitungIMT($berat, $tinggi) {
    $imt = $berat / ($tinggi * $tinggi);

    if ($imt < 18.5) {
        return "Kurus";
    } elseif ($imt >= 18.5 && $imt < 25) {
        return "Normal";
    } elseif ($imt >= 25 && $imt < 30) {
        return "Gemuk";
    } else {
        return "Obesitas";
    }
}

$beratBadan  = 57;
$tinggiBadan = 1.50;
$kategoriIMT = hitungIMT($beratBadan, $tinggiBadan);

// ==========================================
// TUGAS 3: Manipulasi Fungsi date() PHP
// ==========================================
date_default_timezone_set('Asia/Jakarta');

$bulanSekarang  = date('F');
$totalHari      = date('t');
$tanggalHariIni = date('j');

$hariTersisa = $totalHari - $tanggalHariIni;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum PHP Modul 11</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Latar belakang satu tone soft blue ke putih */
            background: linear-gradient(180deg, #f0f4f8 0%, #ffffff 100%);
            min-height: 100vh;
            padding: 40px 0;
            color: #1e293b;
        }

        .judul h1 {
            font-weight: 700;
            color: #1e3a8a; /* Deep Blue 1 Tone */
            letter-spacing: 0.5px;
        }

        .judul p {
            color: #64748b;
            font-weight: 400;
        }

        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(30, 58, 138, 0.05);
            transition: 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.08);
        }

        .card-header-custom {
            font-weight: 600;
            font-size: 16px;
            padding: 16px 20px;
            /* Seluruh header kartu menggunakan warna dasar yang seragam */
            background-color: #1e3a8a; 
            color: #ffffff;
            border: none;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            width: 35%;
            background-color: #f8fafc;
            color: #1e3a8a;
            font-weight: 600;
            border-color: #e2e8f0;
        }

        .table td {
            color: #334155;
            border-color: #e2e8f0;
        }

        .badge-custom {
            font-size: 15px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 30px;
            background-color: #1e3a8a; /* Seragam 1 Tone */
            color: #ffffff;
            border: none;
        }

        .info-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px;
            margin-top: 10px;
            border: 1px solid #e2e8f0;
        }

        .info-box p {
            margin-bottom: 4px;
            font-size: 13px;
            color: #64748b;
        }

        .info-box h3, .info-box h4 {
            margin-bottom: 0;
            font-weight: 600;
            color: #1e3a8a; /* Teks angka fokus ke warna utama */
        }
    </style>
</head>
<body>

<div class="container">

    <div class="judul mb-5 text-center">
        <h1>Praktikum PPW 11</h1>
        <p>Variabel PHP, Fungsi IMT, dan Manipulasi Tanggal</p>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card card-custom h-100">
                <div class="card-header-custom">
                    📋 Tugas 1 - Profil Diri
                </div>

                <div class="card-body p-4">
                    <table class="table table-bordered align-middle">
                        <tr>
                            <th>Nama</th>
                            <td><?= $nama; ?></td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td><?= $nim; ?></td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td><?= $prodi; ?></td>
                        </tr>
                        <tr>
                            <th>Asal Kota</th>
                            <td><?= $kota; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-custom h-100">
                <div class="card-header-custom">
                    ⚖️ Tugas 2 - Perhitungan IMT
                </div>

                <div class="card-body p-4">
                    <div class="info-box">
                        <p>Berat Badan</p>
                        <h4><?= $beratBadan; ?> kg</h4>
                    </div>

                    <div class="info-box">
                        <p>Tinggi Badan</p>
                        <h4><?= $tinggiBadan; ?> m</h4>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="mb-2" style="font-size: 14px; color: #64748b;">Hasil Kategori IMT</p>
                        <span class="badge badge-custom">
                            <?= $kategoriIMT; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header-custom">
                    📅 Tugas 3 - Informasi Bulan & Sisa Hari
                </div>

                <div class="card-body p-4">
                    <div class="row g-3 text-center">
                        <div class="col-md-4">
                            <div class="info-box">
                                <p>Bulan Sekarang</p>
                                <h3><?= $bulanSekarang; ?></h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <p>Tanggal Hari Ini</p>
                                <h3><?= $tanggalHariIni; ?></h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <p>Sisa Hari</p>
                                <h3><?= $hariTersisa; ?> Hari</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>