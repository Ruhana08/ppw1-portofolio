<?php
$errors_mhs = [];
$data_mhs = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_mhs'])) {
    // Ambil dan bersihkan data awal (trim space)
    $nama = trim($_POST['nama'] ?? '');
    $nim = trim($_POST['nim'] ?? '');
    $prodi = $_POST['prodi'] ?? '';
    $ipk = $_POST['ipk'] ?? '';
    $semester = trim($_POST['semester'] ?? '');

    // 1. Validasi Nama
    if (empty($nama)) {
        $errors_mhs['nama'] = "Nama wajib diisi!";
    }

    // 2. Validasi NIM
    if (empty($nim)) {
        $errors_mhs['nim'] = "NIM wajib diisi!";
    } elseif (!preg_match('/^\d{2}\/\d{6}\/[A-Z]{2,5}\/\d{5}$/', $nim)) {
        $errors_mhs['nim'] = "Format NIM tidak valid! Contoh: 25/557718/TK/26223";
    }

    // 3. Validasi Prodi
    $prodi_valid = ['Teknologi Rekayasa Elektro', 'Teknologi Rekayasa Instrumentasi dan Kontrol', 'Teknologi Rekayasa Internet', 'Teknologi Rekayasa Perangkat Lunak'];
    if (empty($prodi) || !in_array($prodi, $prodi_valid)) {
        $errors_mhs['prodi'] = "Pilih Program Studi yang valid!";
    }

    // 4. Validasi IPK
    $ipk_float = filter_var($ipk, FILTER_VALIDATE_FLOAT);
    if ($ipk === '') {
        $errors_mhs['ipk'] = "IPK wajib diisi!";
    } elseif ($ipk_float === false || $ipk_float < 0.00 || $ipk_float > 4.00) {
        $errors_mhs['ipk'] = "IPK harus berupa angka antara 0.00 s.d 4.00!";
    }

    // 5. Validasi Semester
    $semester_int = filter_var($semester, FILTER_VALIDATE_INT);
    if ($semester === '') {
        $errors_mhs['semester'] = "Semester wajib diisi!";
    } elseif ($semester_int === false || $semester_int < 1 || $semester_int > 14) {
        $errors_mhs['semester'] = "Semester harus berupa angka antara 1 s.d 14!";
    }

    // Jika lolos validasi, hitung predikat kelulusan
    if (empty($errors_mhs)) {
        if ($ipk_float >= 3.51) {
            $predikat = 'Dengan Pujian (Cum Laude)';
        } elseif ($ipk_float >= 3.01) {
            $predikat = 'Sangat Memuaskan';
        } elseif ($ipk_float >= 2.76) {
            $predikat = 'Memuaskan';
        } elseif ($ipk_float >= 2.00) {
            $predikat = 'Cukup';
        } else {
            $predikat = 'Tidak Lulus / Kurang';
        }

        // Simpan data ke array (Aman XSS karena di-echo menggunakan htmlspecialchars)
        $data_mhs = [
            'nama' => $nama,
            'nim' => $nim,
            'prodi' => $prodi,
            'ipk' => number_format($ipk_float, 2),
            'semester' => $semester_int,
            'predikat' => $predikat
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Mahasiswa</title>
    <!-- Bootstrap 5.3.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        /* Perbaikan: Menggunakan min-height pada body agar konten bisa memicu scroll otomatis */
        body {
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center py-5">

<div class="container" style="max-width: 600px;">
    <div class="card shadow border-0">
        <div class="card-header bg-success text-white text-center py-3">
            <h4 class="card-title mb-0">Form Pendataan Mahasiswa</h4>
        </div>
        <div class="card-body p-4">
            
            <form method="POST" action="">
                <!-- Input Nama -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control <?= isset($errors_mhs['nama']) ? 'is-invalid' : '' ?>" 
                           name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
                    <div class="invalid-feedback"><?= $errors_mhs['nama'] ?? '' ?></div>
                </div>

                <!-- Input NIM -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIM (Nomor Induk Mahasiswa)</label>
                    <input type="text" class="form-control <?= isset($errors_mhs['nim']) ? 'is-invalid' : '' ?>" 
                           name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>">
                    <div class="invalid-feedback"><?= $errors_mhs['nim'] ?? '' ?></div>
                </div>

                <!-- Dropdown Prodi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Program Studi</label>
                    <select class="form-select <?= isset($errors_mhs['prodi']) ? 'is-invalid' : '' ?>" name="prodi">
                        <option value="">-- Pilih Prodi --</option>
                        <?php
                        $prodis = ['Teknologi Rekayasa Elektro', 'Teknologi Rekayasa Instrumentasi dan Kontrol', 'Teknologi Rekayasa Internet', 'Teknologi Rekayasa Perangkat Lunak'];
                        foreach ($prodis as $p) {
                            $selected = (isset($_POST['prodi']) && $_POST['prodi'] === $p) ? 'selected' : '';
                            echo "<option value=\"" . htmlspecialchars($p) . "\" $selected>" . htmlspecialchars($p) . "</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback"><?= $errors_mhs['prodi'] ?? '' ?></div>
                </div>

                <div class="row">
                    <!-- Input IPK -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">IPK (0.00 - 4.00)</label>
                        <input type="number" step="0.01" class="form-control <?= isset($errors_mhs['ipk']) ? 'is-invalid' : '' ?>" 
                               name="ipk" value="<?= htmlspecialchars($_POST['ipk'] ?? '') ?>">
                        <div class="invalid-feedback"><?= $errors_mhs['ipk'] ?? '' ?></div>
                    </div>
                    
                    <!-- Input Semester -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Semester (1 - 14)</label>
                        <input type="number" class="form-control <?= isset($errors_mhs['semester']) ? 'is-invalid' : '' ?>" 
                               name="semester" value="<?= htmlspecialchars($_POST['semester'] ?? '') ?>">
                        <div class="invalid-feedback"><?= $errors_mhs['semester'] ?? '' ?></div>
                    </div>
                </div>


            <button type="submit" name="submit_mhs" class="btn btn-success btn-lg w-100 mt-2">Simpan & Tampilkan Data</button>
            <!-- Tombol Tambahan untuk Reset -->
            <a href="" class="btn btn-outline-secondary btn-sm w-100 mt-2">Bersihkan Form</a>

            <!-- Tempat Menampilkan Hasil Data Mahasiswa -->
            <?php if ($data_mhs): ?>
                <hr class="my-4">
                <div class="alert alert-info border-0 shadow-sm mb-0">
                    <h5 class="alert-heading text-center mb-3 fw-bold">Data Mahasiswa Berhasil Disimpan</h5>
                    <table class="table table-sm table-bordered bg-white mb-0">
                        <tr><th width="40%" class="bg-light ps-2">Nama</th><td class="ps-2"><?= htmlspecialchars($data_mhs['nama']) ?></td></tr>
                        <tr><th class="bg-light ps-2">NIM</th><td class="ps-2"><?= htmlspecialchars($data_mhs['nim']) ?></td></tr>
                        <tr><th class="bg-light ps-2">Prodi</th><td class="ps-2"><?= htmlspecialchars($data_mhs['prodi']) ?></td></tr>
                        <tr><th class="bg-light ps-2">Semester</th><td class="ps-2"><?= htmlspecialchars($data_mhs['semester']) ?></td></tr>
                        <tr><th class="bg-light ps-2">IPK</th><td class="ps-2 fw-bold"><?= htmlspecialchars($data_mhs['ipk']) ?></td></tr>
                        <tr><th class="bg-light ps-2">Predikat Kelulusan</th><td class="ps-2 fw-bold text-success"><?= htmlspecialchars($data_mhs['predikat']) ?></td></tr>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>