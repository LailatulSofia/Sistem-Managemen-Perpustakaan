<?php
// FUnctions Library Anggota

// 1. Function untuk hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}

// 2. Function untuk hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $anggota) {
        if ($anggota["status"] == "Aktif") {
            $total++;
        }
    }
    return $total;
}

// 3. Function untuk hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    if (count($anggota_list) == 0) return 0;

    $total = 0;
    foreach ($anggota_list as $anggota) {
        $total += $anggota["total_pinjaman"];
    }
    return $total / count($anggota_list);
}

// 4. Function untuk cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $anggota) {
        if ($anggota["id"] == $id) {
            return $anggota;
        }
    }
    return null;
}

// 5. Function untuk cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    if (count($anggota_list) == 0) return null;

    $teraktif = $anggota_list[0];
    foreach ($anggota_list as $anggota) {
        if ($anggota["total_pinjaman"] > $teraktif["total_pinjaman"]) {
            $teraktif = $anggota;
        }
    }
    return $teraktif;
}

// 6. Function untuk filter by status
function filter_by_status($anggota_list, $status) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if ($anggota["status"] == $status) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}

// 7. Function untuk validasi email
function validasi_email($email) {
    if (empty($email)) return false;
    if (strpos($email, "@") === false) return false;
    if (strpos($email, ".") === false) return false;
    return true;
}

// 8. Function untuk format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    $bulan = [
        1 => "Januari", 2 => "Februari", 3 => "Maret",
        4 => "April", 5 => "Mei", 6 => "Juni",
        7 => "Juli", 8 => "Agustus", 9 => "September",
        10 => "Oktober", 11 => "November", 12 => "Desember"
    ];

    $pecah = explode("-", $tanggal);
    return $pecah[2] . " " . $bulan[(int)$pecah[1]] . " " . $pecah[0];
}

// Sort by nama (A-Z)
function sort_by_nama($anggota_list) {
    $sorted = $anggota_list;

    for ($i = 0; $i < count($sorted) - 1; $i++) {
        for ($j = 0; $j < count($sorted) - $i - 1; $j++) {
            if ($sorted[$j]["nama"] > $sorted[$j + 1]["nama"]) {
                $temp = $sorted[$j];
                $sorted[$j] = $sorted[$j + 1];
                $sorted[$j + 1] = $temp;
            }
        }
    }

    return $sorted;
}

// Search by nama (partial match)
function search_by_nama($anggota_list, $keyword) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if (stripos($anggota["nama"], $keyword) !== false) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}
?>
