<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Info Buku</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Informasi Buku</h1>

            <?php
            // buku 1
            $judul1 = "Laravel from Beginner to Advance";
            $pengarang1 = "Budi Raharjo";
            $penerbit1 = "Informatika";
            $tahun_terbit1 = 2023;
            $harga1 = 125000;
            $stok1 = 8;
            $isbn1 = "978-602-1234-56-7";
            $kategori1 = "Programming";
            $bahasa1 = "Indonesia";
            $halaman1 = 320;
            $berat1 = 500;

            // bkuku 2
            $judul2 = "Belajar JavaScript Dasar";
            $pengarang2 = "Andi Setiawan";
            $penerbit2 = "Elex Media";
            $tahun_terbit2 = 2022;
            $harga2 = 110000;
            $stok2 = 10;
            $isbn2 = "978-602-9876-11-2";
            $kategori2 = "Programming";
            $bahasa2 = "Inggris";
            $halaman2 = 280;
            $berat2 = 450;

            // buku 3
            $judul3 = "Mastering MySQL Database";
            $pengarang3 = "Rudi Hartono";
            $penerbit3 = "Informatika";
            $tahun_terbit3 = 2021;
            $harga3 = 135000;
            $stok3 = 6;
            $isbn3 = "978-602-5678-22-3";
            $kategori3 = "Database";
            $bahasa3 = "Indonesia";
            $halaman3 = 350;
            $berat3 = 550;

            // buku 4
            $judul4 = "UI/UX Web Design Modern";
            $pengarang4 = "Sinta Dewi";
            $penerbit4 = "Gramedia";
            $tahun_terbit4 = 2023;
            $harga4 = 120000;
            $stok4 = 7;
            $isbn4 = "978-602-3344-99-1";
            $kategori4 = "Web Design";
            $bahasa4 = "Inggris";
            $halaman4 = 300;
            $berat4 = 480;
            ?>

            <div class="row">
                <!-- Buku 1 -->
                <div class="col-md-3">
                    <div class="card mb-4 shadow">
                        <div class="card-header bg-primary text-white">
                            <?= $judul1 ?>
                        </div>
                        <div class="card-body">
                            <span class="badge bg-primary"><?= $kategori1 ?></span>
                            <table class="table mt-2">
                                <tr><td>Pengarang</td><td><?= $pengarang1 ?></td></tr>
                                <tr><td>Penerbit</td><td><?= $penerbit1 ?></td></tr>
                                <tr><td>Tahun</td><td><?= $tahun_terbit1 ?></td></tr>
                                <tr><td>ISBN</td><td><?= $isbn1 ?></td></tr>
                                <tr><td>Bahasa</td><td><?= $bahasa1 ?></td></tr>
                                <tr><td>Halaman</td><td><?= $halaman1 ?></td></tr>
                                <tr><td>Berat</td><td><?= $berat1 ?> gram</td></tr>
                                <tr><td>Harga</td><td>Rp <?= number_format($harga1) ?></td></tr>
                                <tr><td>Stok</td><td><?= $stok1 ?></td></tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Buku 2 -->
                <div class="col-md-3">
                    <div class="card mb-4 shadow">
                        <div class="card-header bg-primary text-white">
                            <?= $judul2 ?>
                        </div>
                        <div class="card-body">
                            <span class="badge bg-primary"><?= $kategori2 ?></span>
                            <table class="table mt-2">
                                <tr><td>Pengarang</td><td><?= $pengarang2 ?></td></tr>
                                <tr><td>Penerbit</td><td><?= $penerbit2 ?></td></tr>
                                <tr><td>Tahun</td><td><?= $tahun_terbit2 ?></td></tr>
                                <tr><td>ISBN</td><td><?= $isbn2 ?></td></tr>
                                <tr><td>Bahasa</td><td><?= $bahasa2 ?></td></tr>
                                <tr><td>Halaman</td><td><?= $halaman2 ?></td></tr>
                                <tr><td>Berat</td><td><?= $berat2 ?> gram</td></tr>
                                <tr><td>Harga</td><td>Rp <?= number_format($harga2) ?></td></tr>
                                <tr><td>Stok</td><td><?= $stok2 ?></td></tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Buku 3 -->
                <div class="col-md-3">
                    <div class="card mb-4 shadow">
                        <div class="card-header bg-danger text-white">
                            <?= $judul3 ?>
                        </div>
                        <div class="card-body">
                            <span class="badge bg-danger"><?= $kategori3 ?></span>
                            <table class="table mt-2">
                                <tr><td>Pengarang</td><td><?= $pengarang3 ?></td></tr>
                                <tr><td>Penerbit</td><td><?= $penerbit3 ?></td></tr>
                                <tr><td>Tahun</td><td><?= $tahun_terbit3 ?></td></tr>
                                <tr><td>ISBN</td><td><?= $isbn3 ?></td></tr>
                                <tr><td>Bahasa</td><td><?= $bahasa3 ?></td></tr>
                                <tr><td>Halaman</td><td><?= $halaman3 ?></td></tr>
                                <tr><td>Berat</td><td><?= $berat3 ?> gram</td></tr>
                                <tr><td>Harga</td><td>Rp <?= number_format($harga3) ?></td></tr>
                                <tr><td>Stok</td><td><?= $stok3 ?></td></tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Buku 4 -->
                <div class="col-md-3">
                    <div class="card mb-4 shadow">
                        <div class="card-header bg-success text-white">
                            <?= $judul4 ?>
                        </div>
                        <div class="card-body">
                            <span class="badge bg-success"><?= $kategori4 ?></span>
                            <table class="table mt-2">
                                <tr><td>Pengarang</td><td><?= $pengarang4 ?></td></tr>
                                <tr><td>Penerbit</td><td><?= $penerbit4 ?></td></tr>
                                <tr><td>Tahun</td><td><?= $tahun_terbit4 ?></td></tr>
                                <tr><td>ISBN</td><td><?= $isbn4 ?></td></tr>
                                <tr><td>Bahasa</td><td><?= $bahasa4 ?></td></tr>
                                <tr><td>Halaman</td><td><?= $halaman4 ?></td></tr>
                                <tr><td>Berat</td><td><?= $berat4 ?> gram</td></tr>
                                <tr><td>Harga</td><td>Rp <?= number_format($harga4) ?></td></tr>
                                <tr><td>Stok</td><td><?= $stok4 ?></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>