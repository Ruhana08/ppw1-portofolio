<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Nilai</title>
    <!-- Bootstrap 5.3.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        /* CSS tambahan untuk membuat konten benar-benar berada di tengah layar */
        html, body {
            height: 100%;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center">

<div class="container" style="max-width: 450px;">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="card-title mb-0">Form Konversi Nilai</h4>
        </div>
        <div class="card-body p-4">
            
            <form method="GET" action="">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nilai Angka (0-100)</label>
                    <input type="number" name="nilai" class="form-control form-control-lg text-center" min="0" max="100" required
                           value="<?= htmlspecialchars($_GET['nilai'] ?? '') ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Konversi</button>
            </form>

            <?php
            if (isset($_GET['nilai']) && $_GET['nilai'] !== '') {
                $nilai = (int) $_GET['nilai'];

                if ($nilai < 0 || $nilai > 100) {
                    echo '<div class="alert alert-danger mt-4 text-center">Nilai harus antara 0 dan 100.</div>';
                } else {
                    if ($nilai >= 85) {
                        $grade = 'A'; $deskripsi = 'Sangat Memuaskan'; $warna = 'success';
                    } elseif ($nilai >= 70) {
                        $grade = 'B'; $deskripsi = 'Memuaskan'; $warna = 'primary';
                    } elseif ($nilai >= 55) {
                        $grade = 'C'; $deskripsi = 'Cukup'; $warna = 'warning';
                    } elseif ($nilai >= 40) {
                        // Diubah dari 'orange' ke 'secondary' (abu-abu) karena Bootstrap tidak punya class alert-orange secara bawaan
                        $grade = 'D'; $deskripsi = 'Kurang'; $warna = 'secondary'; 
                    } else {
                        $grade = 'E'; $deskripsi = 'Sangat Kurang / Tidak Lulus'; $warna = 'danger';
                    }

                    echo "<hr class='my-4'>
                          <div class='alert alert-{$warna} text-center mb-0 py-3'>
                            <p class='mb-1 fs-5'>Nilai Anda: <strong>$nilai</strong></p>
                            <h2 class='display-6 fw-bold mb-1'>Grade $grade</h2>
                            <span class='badge bg-white text-dark border'>$deskripsi</span>
                          </div>";
                }
            }
            ?>

        </div>
    </div>
</div>

</body>
</html>