<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pencarian Buku</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4"><i class="bi bi-search"></i> Pencarian Buku Lanjutan - Perpustakaan</h1>

            <?php
            // Data buku
            $buku_list = [
                [
                    "kode" => "BK-001",
                    "judul" => "Matematika Dasar SD Kelas 4",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Siti Nurhayati",
                    "penerbit" => "Erlangga",
                    "tahun" => 2023,
                    "harga" => 55000,
                    "stok" => 10
                ],
                [
                    "kode" => "BK-002",
                    "judul" => "IPA Seru untuk SD",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Budi Santoso",
                    "penerbit" => "Yudhistira",
                    "tahun" => 2022,
                    "harga" => 60000,
                    "stok" => 8
                ],
                [
                    "kode" => "BK-003",
                    "judul" => "Bahasa Indonesia SMP Kelas 7",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Dewi Lestari",
                    "penerbit" => "Tiga Serangkai",
                    "tahun" => 2024,
                    "harga" => 70000,
                    "stok" => 12
                ],
                [
                    "kode" => "BK-004",
                    "judul" => "Matematika SMP Kelas 8",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Ahmad Fauzi",
                    "penerbit" => "Grafindo",
                    "tahun" => 2023,
                    "harga" => 75000,
                    "stok" => 9
                ],
                [
                    "kode" => "BK-005",
                    "judul" => "IPS Terpadu SMP",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Rina Marlina",
                    "penerbit" => "Erlangga",
                    "tahun" => 2023,
                    "harga" => 68000,
                    "stok" => 7
                ],
                [
                    "kode" => "BK-006",
                    "judul" => "Biologi SMA Kelas 10",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Yusuf Hidayat",
                    "penerbit" => "Yrama Widya",
                    "tahun" => 2024,
                    "harga" => 85000,
                    "stok" => 6
                ],
                [
                    "kode" => "BK-007",
                    "judul" => "Fisika SMA Kelas 11",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Nina Kartika",
                    "penerbit" => "Tiga Serangkai",
                    "tahun" => 2024,
                    "harga" => 90000,
                    "stok" => 5
                ],
                [
                    "kode" => "BK-008",
                    "judul" => "Kimia SMA Kelas 12",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Dani Pratama",
                    "penerbit" => "Grafindo",
                    "tahun" => 2023,
                    "harga" => 88000,
                    "stok" => 0
                ],
                [
                    "kode" => "BK-009",
                    "judul" => "Bahasa Inggris SD dan SMP",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Lina Safitri",
                    "penerbit" => "Erlangga",
                    "tahun" => 2022,
                    "harga" => 65000,
                    "stok" => 11
                ],
                [
                    "kode" => "BK-010",
                    "judul" => "Pendidikan Pancasila SMA",
                    "kategori" => "Pelajaran",
                    "pengarang" => "Agus Setiawan",
                    "penerbit" => "Yudhistira",
                    "tahun" => 2024,
                    "harga" => 72000,
                    "stok" => 0
                ]
            ];

            // Ambil GET
            $keyword = $_GET['keyword'] ?? '';
            $kategori = $_GET['kategori'] ?? '';
            $min_harga = $_GET['min_harga'] ?? '';
            $max_harga = $_GET['max_harga'] ?? '';
            $tahun = $_GET['tahun'] ?? '';
            $status = $_GET['status'] ?? 'semua';
            $sort = $_GET['sort'] ?? 'judul';
            $page = $_GET['page'] ?? 1;

            // Sanitasi
            $keyword = htmlspecialchars($keyword);
            $kategori = htmlspecialchars($kategori);

            // Validasi
            $errors = [];

            if (!empty($min_harga) && !empty($max_harga)) {
                if ($min_harga > $max_harga) {
                    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum";
                }
            }

            if (!empty($tahun)) {
                if ($tahun < 1900 || $tahun > date('Y')) {
                    $errors[] = "Tahun tidak valid";
                }
            }

            // Proses pencarian
            $hasil = [];

            foreach ($buku_list as $buku) {
                $match = true;

                if (!empty($keyword)) {
                    if (
                        stripos($buku['judul'], $keyword) === false &&
                        stripos($buku['pengarang'], $keyword) === false
                    ) {
                        $match = false;
                    }
                }

                if (!empty($kategori) && $buku['kategori'] != $kategori) {
                    $match = false;
                }

                if (!empty($min_harga) && $buku['harga'] < $min_harga) {
                    $match = false;
                }

                if (!empty($max_harga) && $buku['harga'] > $max_harga) {
                    $match = false;
                }

                if (!empty($tahun) && $buku['tahun'] != $tahun) {
                    $match = false;
                }

                if ($status == 'tersedia' && $buku['stok'] <= 0) {
                    $match = false;
                }

                if ($status == 'habis' && $buku['stok'] > 0) {
                    $match = false;
                }

                if ($match) {
                    $hasil[] = $buku;
                }
            }

            // Sorting
            if ($sort == 'judul') {
                usort($hasil, fn($a, $b) => strcmp($a['judul'], $b['judul']));
            } elseif ($sort == 'harga') {
                usort($hasil, fn($a, $b) => $a['harga'] <=> $b['harga']);
            } elseif ($sort == 'tahun') {
                usort($hasil, fn($a, $b) => $a['tahun'] <=> $b['tahun']);
            }

            // Pagination
            $per_page = 10;
            $total = count($hasil);
            $jumlah_page = ceil($total / $per_page);
            $awal = ($page - 1) * $per_page;
            $hasil = array_slice($hasil, $awal, $per_page);
            ?>

            <!-- Form -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-funnel"></i> Filter Pencarian</h5>
                </div>
                <div class="card-body">
                    <form method="GET">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Keyword</label>
                                <input type="text" name="keyword" class="form-control"
                                    value="<?php echo $keyword; ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="">Semua</option>
                                    <option value="Pelajaran" <?php echo ($kategori == 'Pelajaran') ? 'selected' : ''; ?>>Pelajaran</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Min Harga</label>
                                <input type="number" name="min_harga" class="form-control"
                                    value="<?php echo $min_harga; ?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Max Harga</label>
                                <input type="number" name="max_harga" class="form-control"
                                    value="<?php echo $max_harga; ?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Tahun</label>
                                <input type="number" name="tahun" class="form-control"
                                    value="<?php echo $tahun; ?>">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Filter</label>
                                <select name="sort" class="form-select">
                                    <option value="judul">Judul</option>
                                    <option value="harga">Harga</option>
                                    <option value="tahun">Tahun</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Status</label><br>

                            <input type="radio" name="status" value="semua"
                                <?php echo ($status == 'semua') ? 'checked' : ''; ?>> Semua

                            <input type="radio" name="status" value="tersedia"
                                <?php echo ($status == 'tersedia') ? 'checked' : ''; ?>> Tersedia

                            <input type="radio" name="status" value="habis"
                                <?php echo ($status == 'habis') ? 'checked' : ''; ?>> Habis
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Cari
                        </button>

                        <a href="search_advanced.php" class="btn btn-secondary">
                            Reset
                        </a>

                    </form>
                </div>
            </div>

            <!-- Error -->
            <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
           <?php else: ?>
            <!-- Tampilkan semua buku jika belum search -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-book"></i> Semua Buku Perpustakaan 
                        <span class="badge bg-light text-dark"><?php echo count($buku_list); ?> buku</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Gunakan form di atas untuk mencari buku berdasarkan kriteria tertentu.
                    </div>
                    
                    <div class="row">
                        <?php foreach ($buku_list as $buku): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $buku['judul']; ?></h6>
                                    <p class="card-text mb-2">
                                        <small class="text-muted">
                                            <strong><?php echo $buku['pengarang']; ?></strong> | 
                                            <?php echo $buku['penerbit']; ?> (<?php echo $buku['tahun']; ?>)
                                        </small>
                                    </p>
                                    <p class="mb-2">
                                        <span class="badge bg-primary"><?php echo $buku['kategori']; ?></span>
                                        <?php if ($buku['stok'] > 0): ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Habis</span>
                                        <?php endif; ?>
                                    </p>
                                    <p class="mb-0">
                                        <strong>Harga:</strong> Rp <?php echo number_format($buku['harga'], 0, ',', '.'); ?><br />
                                        <strong>Stok:</strong> <?php echo $buku['stok']; ?> buku
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <br>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>