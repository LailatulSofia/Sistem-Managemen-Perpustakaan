<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <?php
    require_once 'functions_anggota.php';

    // Data anggota
    $anggota_list = [
        [
            "id" => "AGT-001",
            "nama" => "Budi Santoso",
            "email" => "budi@email.com",
            "telepon" => "081234567890",
            "alamat" => "Jakarta",
            "tanggal_daftar" => "2024-01-15",
            "status" => "Aktif",
            "total_pinjaman" => 5
        ],
        [
            "id" => "AGT-002",
            "nama" => "Lailatu Sofia",
            "email" => "sofia@email.com",
            "telepon" => "081298765432",
            "alamat" => "Bandung",
            "tanggal_daftar" => "2024-02-10",
            "status" => "Aktif",
            "total_pinjaman" => 8
        ],
        [
            "id" => "AGT-003",
            "nama" => "Surya Ardhiartha",
            "email" => "surya@email.com",
            "telepon" => "081212121212",
            "alamat" => "Surabaya",
            "tanggal_daftar" => "2024-03-05",
            "status" => "Non-Aktif",
            "total_pinjaman" => 2
        ],
        [
            "id" => "AGT-004",
            "nama" => "Arum Rahma",
            "email" => "arum@email.com",
            "telepon" => "081233344455",
            "alamat" => "Yogyakarta",
            "tanggal_daftar" => "2024-01-25",
            "status" => "Aktif",
            "total_pinjaman" => 10
        ],
        [
            "id" => "AGT-005",
            "nama" => "Dedi Santoso",
            "email" => "dedi@email.com",
            "telepon" => "081255566677",
            "alamat" => "Medan",
            "tanggal_daftar" => "2024-02-18",
            "status" => "Non-Aktif",
            "total_pinjaman" => 1
        ]
    ];

    // Statistik
    $total = hitung_total_anggota($anggota_list);
    $aktif = hitung_anggota_aktif($anggota_list);
    $nonaktif = $total - $aktif;
    $rata = hitung_rata_rata_pinjaman($anggota_list);
    $teraktif = cari_anggota_teraktif($anggota_list);

    $persen_aktif = ($aktif / $total) * 100;
    $persen_nonaktif = ($nonaktif / $total) * 100;

    // Filter
    $anggota_aktif = filter_by_status($anggota_list, "Aktif");
    $anggota_nonaktif = filter_by_status($anggota_list, "Non-Aktif");

    // BONUS: sort A-Z pakai function
    $anggota_list = sort_by_nama($anggota_list);

    // BONUS: search pakai function
    $keyword = isset($_GET['search']) ? $_GET['search'] : "";
    $hasil_search = [];

    if ($keyword != "") {
        $hasil_search = search_by_nama($anggota_list, $keyword);
    }
    ?>

    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>

        <!-- Search -->
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama anggota...">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>

        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center border-primary">
                    <div class="card-body">
                        <h6>Total Anggota</h6>
                        <h3 class="text-primary"><?php echo $total; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-success">
                    <div class="card-body">
                        <h6>Aktif</h6>
                        <h3 class="text-success"><?php echo number_format($persen_aktif,1); ?>%</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-danger">
                    <div class="card-body">
                        <h6>Non-Aktif</h6>
                        <h3 class="text-danger"><?php echo number_format($persen_nonaktif,1); ?>%</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-warning">
                    <div class="card-body">
                        <h6>Rata Pinjaman</h6>
                        <h3 class="text-warning"><?php echo number_format($rata,1); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Anggota Teraktif -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Anggota Teraktif
            </div>
            <div class="card-body">
                <h5><?php echo $teraktif["nama"]; ?></h5>
                <p><?php echo $teraktif["email"]; ?></p>
                <span class="badge bg-success">Total Pinjaman: <?php echo $teraktif["total_pinjaman"]; ?></span>
            </div>
        </div>

        <!-- Tabel -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Daftar Anggota
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $data_tampil = ($keyword != "") ? $hasil_search : $anggota_list;
                        $no = 1;
                        foreach ($data_tampil as $anggota): 
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $anggota["id"]; ?></td>
                            <td><?php echo $anggota["nama"]; ?></td>
                            <td><?php echo $anggota["email"]; ?></td>
                            <td>
                                <?php if ($anggota["status"] == "Aktif"): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Non-Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $anggota["total_pinjaman"]; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- List Aktif & Non Aktif -->
        <div class="row">
            <div class="col-md-6">
                <div class="card border-success">
                    <div class="card-header bg-success text-white">Anggota Aktif</div>
                    <div class="card-body">
                        <ul>
                            <?php foreach ($anggota_aktif as $a): ?>
                                <li><?php echo $a["nama"]; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">Anggota Non-Aktif</div>
                    <div class="card-body">
                        <ul>
                            <?php foreach ($anggota_nonaktif as $a): ?>
                                <li><?php echo $a["nama"]; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>