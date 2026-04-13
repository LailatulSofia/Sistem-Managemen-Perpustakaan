<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Function Search Buku</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    </head>
    <body>

        <div class="container mt-5">

            <!-- =================== HEADER =================== -->
            <h1 class="mb-4">
                <i class="bi bi-search"></i> Function Search Buku
            </h1>

            <?php
            // =================== DATA BUKU ===================
            $buku_list = [
                [
                    "kode" => "BK-001",
                    "judul" => "Pemrograman PHP untuk Pemula",
                    "kategori" => "Programming",
                    "pengarang" => "Budi Raharjo",
                    "tahun" => 2023,
                    "harga" => 75000,
                    "stok" => 10
                ],
                [
                    "kode" => "BK-002",
                    "judul" => "Mastering MySQL Database",
                    "kategori" => "Database",
                    "pengarang" => "Andi Nugroho",
                    "tahun" => 2022,
                    "harga" => 95000,
                    "stok" => 5
                ],
                [
                    "kode" => "BK-003",
                    "judul" => "Laravel Framework Advanced",
                    "kategori" => "Programming",
                    "pengarang" => "Siti Aminah",
                    "tahun" => 2024,
                    "harga" => 125000,
                    "stok" => 8
                ],
                [
                    "kode" => "BK-004",
                    "judul" => "PHP Web Services",
                    "kategori" => "Programming",
                    "pengarang" => "Budi Raharjo",
                    "tahun" => 2023,
                    "harga" => 85000,
                    "stok" => 12
                ],
                [
                    "kode" => "BK-005",
                    "judul" => "PostgreSQL Advanced",
                    "kategori" => "Database",
                    "pengarang" => "Rina Wijaya",
                    "tahun" => 2024,
                    "harga" => 110000,
                    "stok" => 3
                ]
            ];

            // =================== FUNCTION SEARCH ===================

            // 1. Cari berdasarkan kode
            function cari_by_kode($buku_list, $kode) {
                foreach ($buku_list as $buku) {
                    if ($buku["kode"] == $kode) {
                        return $buku;
                    }
                }
                return null;
            }

            // 2. Cari berdasarkan judul (partial + case insensitive)
            function cari_by_judul($buku_list, $keyword) {
                $hasil = [];

                foreach ($buku_list as $buku) {
                    if (stripos($buku["judul"], $keyword) !== false) {
                        $hasil[] = $buku;
                    }
                }

                return $hasil;
            }

            // 3. Cari berdasarkan kategori
            function cari_by_kategori($buku_list, $kategori) {
                $hasil = [];

                foreach ($buku_list as $buku) {
                    if ($buku["kategori"] == $kategori) {
                        $hasil[] = $buku;
                    }
                }

                return $hasil;
            }

            // 4. Cari berdasarkan pengarang
            function cari_by_pengarang($buku_list, $pengarang) {
                $hasil = [];

                foreach ($buku_list as $buku) {
                    if (stripos($buku["pengarang"], $pengarang) !== false) {
                        $hasil[] = $buku;
                    }
                }

                return $hasil;
            }

            // 5. Cari berdasarkan range harga
            function cari_by_range_harga($buku_list, $min, $max) {
                $hasil = [];

                foreach ($buku_list as $buku) {
                    if ($buku["harga"] >= $min && $buku["harga"] <= $max) {
                        $hasil[] = $buku;
                    }
                }

                return $hasil;
            }

            // 6. Cari buku yang tersedia
            function cari_buku_tersedia($buku_list) {
                $hasil = [];

                foreach ($buku_list as $buku) {
                    if ($buku["stok"] > 0) {
                        $hasil[] = $buku;
                    }
                }

                return $hasil;
            }

            // 7. Cari buku terbaru
            function cari_buku_terbaru($buku_list, $tahun) {
                $hasil = [];

                foreach ($buku_list as $buku) {
                    if ($buku["tahun"] >= $tahun) {
                        $hasil[] = $buku;
                    }
                }

                return $hasil;
            }

            // =================== FUNCTION DISPLAY ===================
            function tampilkan_hasil($hasil, $judul_pencarian) {

                if (count($hasil) > 0) {

                    echo "<div class='alert alert-success'>";
                    echo "<strong>$judul_pencarian:</strong> Ditemukan " . count($hasil) . " buku";
                    echo "</div>";

                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered table-hover'>";
                    echo "<thead class='table-dark'>";
                    echo "<tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pengarang</th>
                            <th>Tahun</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    $no = 1;
                    foreach ($hasil as $buku) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td><code>{$buku['kode']}</code></td>";
                        echo "<td>{$buku['judul']}</td>";
                        echo "<td><span class='badge bg-primary'>{$buku['kategori']}</span></td>";
                        echo "<td>{$buku['pengarang']}</td>";
                        echo "<td>{$buku['tahun']}</td>";
                        echo "<td>Rp " . number_format($buku['harga'], 0, ',', '.') . "</td>";
                        echo "<td>{$buku['stok']}</td>";
                        echo "</tr>";
                        $no++;
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";

                } else {

                    echo "<div class='alert alert-warning'>";
                    echo "<strong>$judul_pencarian:</strong> Tidak ada buku yang ditemukan";
                    echo "</div>";

                }
            }
            ?>

            <!-- =================== UI SECTION =================== -->

            <!-- 1. Cari by kode -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">1. Pencarian by Kode</h5>
                </div>
                <div class="card-body">
                    <?php
                    $kode_cari = "BK-002";
                    $buku = cari_by_kode($buku_list, $kode_cari);

                    if ($buku != null) {
                        tampilkan_hasil([$buku], "Hasil Pencarian Kode '$kode_cari'");
                    } else {
                        echo "<div class='alert alert-warning'>Buku tidak ditemukan</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- 2. Cari by judul -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">2. Pencarian by Judul (PHP)</h5>
                </div>
                <div class="card-body">
                    <?php
                    tampilkan_hasil(cari_by_judul($buku_list, "PHP"), "Pencarian Judul");
                    ?>
                </div>
            </div>

            <!-- 3. Cari by kategori -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">3. Pencarian by Kategori (Programming)</h5>
                </div>
                <div class="card-body">
                    <?php
                    tampilkan_hasil(cari_by_kategori($buku_list, "Programming"), "Pencarian Kategori");
                    ?>
                </div>
            </div>

            <!-- 4. Cari by pengarang -->
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">4. Pencarian by Pengarang (Budi)</h5>
                </div>
                <div class="card-body">
                    <?php
                    tampilkan_hasil(cari_by_pengarang($buku_list, "Budi"), "Pencarian Pengarang");
                    ?>
                </div>
            </div>

            <!-- 5. Range harga -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">5. Range Harga</h5>
                </div>
                <div class="card-body">
                    <?php
                    tampilkan_hasil(cari_by_range_harga($buku_list, 70000, 100000), "Range Harga");
                    ?>
                </div>
            </div>

            <!-- 6. Buku tersedia -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">6. Buku Tersedia</h5>
                </div>
                <div class="card-body">
                    <?php
                    tampilkan_hasil(cari_buku_tersedia($buku_list), "Buku Tersedia");
                    ?>
                </div>
            </div>

            <!-- 7. Buku terbaru -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">7. Buku Terbaru</h5>
                </div>
                <div class="card-body">
                    <?php
                    tampilkan_hasil(cari_buku_terbaru($buku_list, 2024), "Buku Terbaru");
                    ?>
                </div>
            </div>

        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>