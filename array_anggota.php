<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Anggota Perpustakaan</h1>

        <?php
        // Data Anggota
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

        // Proses data
        $total_anggota = count($anggota_list);

        $aktif = 0;
        $nonaktif = 0;
        $total_pinjaman = 0;

        $teraktif = $anggota_list[0];

        foreach ($anggota_list as $anggota) {
            if ($anggota["status"] == "Aktif") {
                $aktif++;
            } else {
                $nonaktif++;
            }

            $total_pinjaman += $anggota["total_pinjaman"];

            if ($anggota["total_pinjaman"] > $teraktif["total_pinjaman"]) {
                $teraktif = $anggota;
            }
        }

        $persen_aktif = ($aktif / $total_anggota) * 100;
        $persen_nonaktif = ($nonaktif / $total_anggota) * 100;
        $rata_pinjaman = $total_pinjaman / $total_anggota;

        // Filter aktif
        $anggota_aktif = [];
        foreach ($anggota_list as $anggota) {
            if ($anggota["status"] == "Aktif") {
                $anggota_aktif[] = $anggota;
            }
        }
        ?>

        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center border-primary">
                    <div class="card-body">
                        <h5>Total Anggota</h5>
                        <h3 class="text-primary"><?php echo $total_anggota; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-success">
                    <div class="card-body">
                        <h5>Aktif</h5>
                        <h3 class="text-success"><?php echo number_format($persen_aktif,1); ?>%</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-danger">
                    <div class="card-body">
                        <h5>Non-Aktif</h5>
                        <h3 class="text-danger"><?php echo number_format($persen_nonaktif,1); ?>%</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-warning">
                    <div class="card-body">
                        <h5>Rata Pinjaman</h5>
                        <h3 class="text-warning"><?php echo number_format($rata_pinjaman,1); ?></h3>
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
                <p>Total Pinjaman: <strong><?php echo $teraktif["total_pinjaman"]; ?></strong></p>
            </div>
        </div>

        <!-- Tabel Anggota -->
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
                            <th>Total Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($anggota_list as $anggota): 
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

        <!-- Filter Anggota Aktif -->
        <div class="card">
            <div class="card-header bg-info text-white">
                Anggota Aktif
            </div>
            <div class="card-body">
                <ul>
                    <?php foreach ($anggota_aktif as $anggota): ?>
                        <li><?php echo $anggota["nama"]; ?> (<?php echo $anggota["total_pinjaman"]; ?> pinjaman)</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>
    <br>
</body>
</html>