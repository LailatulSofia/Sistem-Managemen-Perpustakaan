<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Status Peminjaman</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Status Peminjaman Anggota</h1>

            <?php
            // Data Anggota
            $nama_anggota = "Budi Santoso";
            $total_pinjaman = 2;
            $buku_terlambat = 1;
            $hari_keterlambatan = 5; // hari

            // Aturan Business Logic
            $maks_pinjaman = 3;
            $denda_per_hari = 1000;
            $maks_denda = 50000;

            // Hitung denda
            $total_denda = 0;

            if ($buku_terlambat > 0) {
                $total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;

                // Batasi maksimal denda
                if ($total_denda > $maks_denda) {
                    $total_denda = $maks_denda;
                }
            }

            // Cek apakah bisa pinjam
            if ($buku_terlambat > 0) {
                $status_pinjam = "Tidak bisa meminjam (Ada keterlambatan)";
                $warna_status = "danger";
            } elseif ($total_pinjaman >= $maks_pinjaman) {
                $status_pinjam = "Tidak bisa meminjam (Mencapai batas maksimal)";
                $warna_status = "warning";
            } else {
                $status_pinjam = "Bisa meminjam buku";
                $warna_status = "success";
            }

            // Tentukan level member dengan SWITCH
            switch (true) {
                case ($total_pinjaman <= 5):
                    $level = "Bronze";
                    break;
                case ($total_pinjaman <= 15):
                    $level = "Silver";
                    break;
                default:
                    $level = "Gold";
            }       
            ?>

            <!-- Informasi Anggota -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Informasi Anggota
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> <?php echo $nama_anggota; ?></p>
                    <p><strong>Total Pinjaman:</strong> <?php echo $total_pinjaman; ?></p>
                    <p><strong>Level Member:</strong> <?php echo $level; ?></p>
                </div>
            </div>

            <!-- Status Peminjaman -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    Status Peminjaman
                </div>
                <div class="card-body">
                    <span class="badge bg-<?php echo $warna_status; ?>">
                        <?php echo $status_pinjam; ?>
                    </span>

                    <?php if ($buku_terlambat > 0): ?>
                        <div class="alert alert-danger mt-3">
                            <strong>Peringatan!</strong><br>
                            Anda memiliki <?php echo $buku_terlambat; ?> buku terlambat selama 
                            <?php echo $hari_keterlambatan; ?> hari.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Informasi Denda -->
            <div class="card">
                <div class="card-header bg-warning">
                    Informasi Denda
                </div>
                <div class="card-body">
                    <p><strong>Total Denda:</strong> Rp <?php echo number_format($total_denda, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    </body>
</html>