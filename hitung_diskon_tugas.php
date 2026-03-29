<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistem Perhitungan Diskon - Tugas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>
            
            <?php
            //data pembeli dan buku di sini
            $nama_pembeli = "Budi Santoso";
            $judul_buku = "Laravel Advanced";
            $harga_satuan = 150000;
            $jumlah_beli = 4;
            $is_member = true;

            //hitung subtotal
            $subtotal = $harga_satuan * $jumlah_beli;

            //tentukan persentase diskon
            if ($jumlah_beli >= 1 && $jumlah_beli <= 2) {
                $persentase_diskon = 0;
            } elseif ($jumlah_beli <= 5) {
                $persentase_diskon = 10;
            } elseif ($jumlah_beli <= 10) {
                $persentase_diskon = 15;
            } else {
                $persentase_diskon = 20;
            }

            //hitung diskon utama
            $diskon = $subtotal * ($persentase_diskon / 100);

            //total setelah diskon pertama
            $total_setelah_diskon1 = $subtotal - $diskon;

            //hitung diskon member jika member
            $diskon_member = 0;
            if ($is_member) {
                $diskon_member = $total_setelah_diskon1 * 0.05;
            }

            //total setelah semua diskon
            $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;

            //hitung ppn
            $ppn = $total_setelah_diskon * 0.11;

            //total akhir
            $total_akhir = $total_setelah_diskon + $ppn;

            //total penghematan
            $total_hemat = $diskon + $diskon_member;
            ?>

            <!-- tampilkan hasil perhitungan dengan bootstrap -->
            <!-- gunakan card, table, dan badge -->

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Pembelian</h5>
                </div>
                <div class="card-body">

                    <table class="table table-borderless">
                        <tr>
                            <th width="250">Nama Pembeli</th>
                            <td>: <?= $nama_pembeli ?></td>
                        </tr>
                        <tr>
                            <th>Judul Buku</th>
                            <td>: <?= $judul_buku ?></td>
                        </tr>
                        <tr>
                            <th>Harga Satuan</th>
                            <td>: Rp <?= number_format($harga_satuan,0,',','.') ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Beli</th>
                            <td>: <?= $jumlah_beli ?> buku</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: 
                                <?php if($is_member): ?>
                                    <span class="badge bg-success">Member</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Non Member</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                    <hr>

                    <table class="table">
                        <tr>
                            <th>Subtotal</th>
                            <td>Rp <?= number_format($subtotal,0,',','.') ?></td>
                        </tr>
                        <tr>
                            <th>Diskon (<?= $persentase_diskon ?>%)</th>
                            <td>- Rp <?= number_format($diskon,0,',','.') ?></td>
                        </tr>

                        <?php if($is_member): ?>
                        <tr>
                            <th>Diskon Member (5%)</th>
                            <td>- Rp <?= number_format($diskon_member,0,',','.') ?></td>
                        </tr>
                        <?php endif; ?>

                        <tr>
                            <th>Total Setelah Diskon</th>
                            <td>Rp <?= number_format($total_setelah_diskon,0,',','.') ?></td>
                        </tr>
                        <tr>
                            <th>PPN (11%)</th>
                            <td>Rp <?= number_format($ppn,0,',','.') ?></td>
                        </tr>
                        <tr class="table-primary">
                            <th>Total Akhir</th>
                            <th>Rp <?= number_format($total_akhir,0,',','.') ?></th>
                        </tr>
                        <tr>
                            <th>Total Hemat</th>
                            <td class="text-success">
                                Rp <?= number_format($total_hemat,0,',','.') ?>
                            </td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
    </body>
</html>