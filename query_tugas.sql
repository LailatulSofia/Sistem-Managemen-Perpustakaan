-- ============================================================
-- TUGAS 1: EKSPLORASI DATABASE DENGAN QUERY
-- Mata Kuliah  : Pemrograman Website 2
-- Kode MK      : INF2419
-- Pertemuan    : 6 - Database MySQL
-- Dosen        : Mohammad Reza Maulana, M.Kom
-- Universitas  : UIN K.H. Abdurrahman Wahid Pekalongan
-- Nama         : Lailatul SOfia
-- NIM          : 60324027
-- ============================================================

USE perpustakaan;

-- ============================================================
-- A. STATISTIK BUKU (5 QUERY)
-- ============================================================

-- 1. Total buku seluruhnya
--    Menghitung jumlah total record (baris) yang ada di tabel buku
SELECT COUNT(*) AS total_buku 
FROM buku;

-- 2. Total nilai inventaris (harga × stok per buku, kemudian dijumlahkan)
--    Berguna untuk mengetahui total aset buku yang dimiliki perpustakaan
SELECT SUM(harga * stok) AS total_nilai_inventaris 
FROM buku;

-- 3. Rata-rata harga buku
--    Menghitung harga rata-rata dari seluruh buku yang ada
SELECT ROUND(AVG(harga), 2) AS rata_rata_harga 
FROM buku;

-- 4. Buku termahal (tampilkan judul dan harga)
--    Mencari buku dengan harga tertinggi menggunakan ORDER BY DESC + LIMIT
SELECT judul, harga 
FROM buku 
ORDER BY harga DESC 
LIMIT 1;

-- 5. Buku dengan stok terbanyak
--    Mencari buku yang memiliki jumlah stok paling banyak di perpustakaan
SELECT judul, stok 
FROM buku 
ORDER BY stok DESC 
LIMIT 1;


-- ============================================================
-- B. FILTER DAN PENCARIAN (5 QUERY)
-- ============================================================

-- 6. Semua buku kategori Programming yang harga < 100.000
--    Menggunakan kondisi AND untuk memfilter dua syarat sekaligus
SELECT * 
FROM buku 
WHERE kategori = 'Programming' AND harga < 100000;

-- 7. Buku yang judulnya mengandung kata "PHP" atau "MySQL"
--    LIKE '%kata%' artinya: karakter apapun sebelum dan sesudah kata tersebut
SELECT * 
FROM buku 
WHERE judul LIKE '%PHP%' OR judul LIKE '%MySQL%';

-- 8. Buku yang terbit tahun 2024
--    Filter berdasarkan kolom tahun_terbit
SELECT * 
FROM buku 
WHERE tahun_terbit = 2024;

-- 9. Buku yang stoknya antara 5 hingga 10
--    BETWEEN bersifat inklusif (termasuk nilai 5 dan 10)
SELECT * 
FROM buku 
WHERE stok BETWEEN 5 AND 10;

-- 10. Buku yang pengarangnya "Budi Raharjo"
--     Pencarian tepat menggunakan tanda sama dengan (=)
SELECT * 
FROM buku 
WHERE pengarang = 'Budi Raharjo';


-- ============================================================
-- C. GROUPING DAN AGREGASI (3 QUERY)
-- ============================================================

-- 11. Jumlah buku per kategori beserta total stok per kategori
--     GROUP BY mengelompokkan data berdasarkan nilai kolom kategori
SELECT 
    kategori, 
    COUNT(*) AS jumlah_buku,
    SUM(stok) AS total_stok
FROM buku 
GROUP BY kategori
ORDER BY jumlah_buku DESC;

-- 12. Rata-rata harga per kategori
--     Membantu mengetahui kategori mana yang rata-rata harganya paling tinggi
SELECT 
    kategori, 
    ROUND(AVG(harga), 2) AS rata_rata_harga
FROM buku 
GROUP BY kategori
ORDER BY rata_rata_harga DESC;

-- 13. Kategori dengan total nilai inventaris terbesar
--     Menjumlahkan (harga × stok) per kategori lalu diurutkan dari terbesar
SELECT 
    kategori, 
    SUM(harga * stok) AS total_nilai_inventaris
FROM buku 
GROUP BY kategori
ORDER BY total_nilai_inventaris DESC
LIMIT 1;


-- ============================================================
-- D. UPDATE DATA (2 QUERY)
-- ============================================================

-- 14. Naikkan harga semua buku kategori Programming sebesar 5%
--     Mengalikan harga lama dengan 1.05 untuk menambah 5%
--     CATATAN: Selalu gunakan WHERE agar tidak update semua data!
UPDATE buku 
SET harga = harga * 1.05 
WHERE kategori = 'Programming';

-- Verifikasi hasil update:
SELECT judul, kategori, harga 
FROM buku 
WHERE kategori = 'Programming';

-- 15. Tambah stok 10 untuk semua buku yang stoknya < 5
--     Menggunakan operasi penjumlahan langsung pada kolom stok
UPDATE buku 
SET stok = stok + 10 
WHERE stok < 5;

-- Verifikasi hasil update:
SELECT judul, stok 
FROM buku 
WHERE stok BETWEEN 10 AND 14
ORDER BY stok ASC;


-- ============================================================
-- E. LAPORAN KHUSUS (2 QUERY)
-- ============================================================

-- 16. Daftar buku yang perlu restocking (stok < 5)
--     Berguna untuk laporan pengadaan buku kepada pengelola perpustakaan
SELECT 
    kode_buku,
    judul,
    pengarang,
    stok,
    CASE 
        WHEN stok = 0 THEN 'HABIS - Segera Restock'
        ELSE 'Menipis - Perlu Restock'
    END AS keterangan
FROM buku 
WHERE stok < 5
ORDER BY stok ASC;

-- 17. Top 5 buku termahal
--     Menampilkan 5 buku dengan harga tertinggi beserta detail lengkap
SELECT 
    kode_buku,
    judul,
    pengarang,
    kategori,
    CONCAT('Rp ', FORMAT(harga, 0, 'id_ID')) AS harga_format,
    stok
FROM buku 
ORDER BY harga DESC 
LIMIT 5;
