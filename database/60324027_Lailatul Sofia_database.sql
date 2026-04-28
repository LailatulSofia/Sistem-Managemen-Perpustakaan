USE perpustakaan;

-- ============================================================
-- LANGKAH 1: Buat tabel KATEGORI_BUKU
-- ============================================================

CREATE TABLE IF NOT EXISTS kategori_buku (
    id_kategori   INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL UNIQUE,
    deskripsi     TEXT,
    created_at    TIMESTAMP   DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- LANGKAH 2: Buat tabel PENERBIT
--            Memisahkan penerbit dari kolom VARCHAR menjadi
--            tabel mandiri dengan informasi lengkap
-- ============================================================

CREATE TABLE IF NOT EXISTS penerbit (
    id_penerbit   INT AUTO_INCREMENT PRIMARY KEY,
    nama_penerbit VARCHAR(100) NOT NULL UNIQUE,
    alamat        TEXT,
    telepon       VARCHAR(15),
    email         VARCHAR(100),
    created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- LANGKAH 3: Buat tabel RAK (BONUS)
--            Lokasi fisik penyimpanan buku di perpustakaan
-- ============================================================

CREATE TABLE IF NOT EXISTS rak (
    id_rak     INT AUTO_INCREMENT PRIMARY KEY,
    kode_rak   VARCHAR(10)  NOT NULL UNIQUE,
    lokasi     VARCHAR(100) NOT NULL,
    kapasitas  INT          NOT NULL DEFAULT 50,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- LANGKAH 4: Insert data KATEGORI_BUKU
--            Disesuaikan dengan nilai ENUM yang sudah ada
--            di tabel buku sebelumnya
-- ============================================================

INSERT INTO kategori_buku (nama_kategori, deskripsi) VALUES
('Programming',  'Buku tentang pemrograman dan pengembangan perangkat lunak'),
('Database',     'Buku tentang sistem basis data dan manajemen data'),
('Web Design',   'Buku tentang desain antarmuka dan pengalaman pengguna web'),
('Networking',   'Buku tentang jaringan komputer dan keamanan jaringan'),
('Artificial Intelligence', 'Buku tentang kecerdasan buatan dan machine learning');

-- ============================================================
-- LANGKAH 5: Insert data PENERBIT
--            Disesuaikan dengan nilai kolom penerbit yang
--            sudah ada di tabel buku sebelumnya
-- ============================================================

INSERT INTO penerbit (nama_penerbit, alamat, telepon, email) VALUES
('Informatika', 'Jl. Setiabudhi No. 229, Bandung',       '022-2034008', 'info@informatika.com'),
('Graha Ilmu',  'Jl. Kaliurang KM 9.3, Yogyakarta',     '0274-895555', 'info@grahailmu.co.id'),
('Andi',        'Jl. Beo No. 38-40, Yogyakarta',         '0274-561881', 'cs@andipublisher.com'),
('Erlangga',    'Jl. H. Baping Raya No. 100, Jakarta',   '021-8721251', 'info@erlangga.co.id'),
('Elex Media',  'Jl. Palmerah Barat No. 29-37, Jakarta', '021-5300888', 'info@elexmedia.co.id');

-- ============================================================
-- LANGKAH 6: Insert data RAK (BONUS)
-- ============================================================

INSERT INTO rak (kode_rak, lokasi, kapasitas) VALUES
('RAK-A1', 'Lantai 1 - Baris A, Kolom 1', 40),
('RAK-A2', 'Lantai 1 - Baris A, Kolom 2', 40),
('RAK-B1', 'Lantai 1 - Baris B, Kolom 1', 50),
('RAK-C1', 'Lantai 2 - Baris C, Kolom 1', 60);

-- ============================================================
-- LANGKAH 7: Tambah kolom id_kategori dan id_penerbit
--            di tabel buku yang sudah ada
-- ============================================================

ALTER TABLE buku
    ADD COLUMN id_kategori INT AFTER kategori,
    ADD COLUMN id_penerbit INT AFTER penerbit,
    ADD COLUMN id_rak      INT AFTER id_penerbit;

-- ============================================================
-- LANGKAH 8: Isi nilai id_kategori berdasarkan kolom
--            kategori (ENUM) yang sudah ada di tabel buku
--
--            Logika: cocokkan teks kategori lama dengan
--            id di tabel kategori_buku yang baru dibuat
-- ============================================================

UPDATE buku SET id_kategori = 1 WHERE kategori = 'Programming';
UPDATE buku SET id_kategori = 2 WHERE kategori = 'Database';
UPDATE buku SET id_kategori = 3 WHERE kategori = 'Web Design';
UPDATE buku SET id_kategori = 4 WHERE kategori = 'Networking';

-- ============================================================
-- LANGKAH 9: Isi nilai id_penerbit berdasarkan kolom
--            penerbit (VARCHAR) yang sudah ada di tabel buku
-- ============================================================

UPDATE buku SET id_penerbit = 1 WHERE penerbit = 'Informatika';
UPDATE buku SET id_penerbit = 2 WHERE penerbit = 'Graha Ilmu';
UPDATE buku SET id_penerbit = 3 WHERE penerbit = 'Andi';
UPDATE buku SET id_penerbit = 4 WHERE penerbit = 'Erlangga';
UPDATE buku SET id_penerbit = 5 WHERE penerbit = 'Elex Media';

-- Isi id_rak untuk semua buku (sesuaikan jika perlu)
UPDATE buku SET id_rak = 1 WHERE kategori IN ('Programming', 'Networking');
UPDATE buku SET id_rak = 2 WHERE kategori = 'Database';
UPDATE buku SET id_rak = 3 WHERE kategori = 'Web Design';

-- ============================================================
-- LANGKAH 10: Pasang FOREIGN KEY setelah kolom terisi semua
--             Urutan ini penting! FK tidak bisa dipasang
--             jika ada nilai NULL di kolom yang direferensikan
-- ============================================================

ALTER TABLE buku
    ADD CONSTRAINT fk_buku_kategori
        FOREIGN KEY (id_kategori) REFERENCES kategori_buku(id_kategori),
    ADD CONSTRAINT fk_buku_penerbit
        FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit),
    ADD CONSTRAINT fk_buku_rak
        FOREIGN KEY (id_rak) REFERENCES rak(id_rak);

-- ============================================================
-- LANGKAH 11: Tambah buku baru untuk melengkapi data
--             (menggunakan id_kategori dan id_penerbit)
-- ============================================================

INSERT INTO buku (kode_buku, judul, kategori, id_kategori, pengarang, penerbit, id_penerbit, id_rak, tahun_terbit, isbn, harga, stok, deskripsi) VALUES
('BK-010', 'Network Security Fundamentals', 'Networking',   4, 'Rina Wijaya',  'Erlangga',  4, 1, 2023, '978-602-1234-56-10', 110000,  3, 'Dasar-dasar keamanan jaringan komputer'),
('BK-011', 'UI/UX Design dengan Figma',     'Web Design',   3, 'Dewi Pratiwi', 'Andi',      3, 3, 2024, '978-602-1234-56-11',  95000,  8, 'Panduan desain UI/UX menggunakan Figma'),
('BK-012', 'Cisco Networking Essentials',   'Networking',   4, 'Andi Nugroho', 'Erlangga',  4, 1, 2022, '978-602-1234-56-12', 120000,  2, 'Konfigurasi jaringan Cisco untuk pemula'),
('BK-013', 'Machine Learning dengan Python','Programming',  1, 'Ahmad Yani',   'Graha Ilmu',2, 2, 2024, '978-602-1234-56-13', 135000, 10, 'Implementasi machine learning dengan Python'),
('BK-014', 'Desain Database Relasional',    'Database',     2, 'Siti Aminah',  'Informatika',1,2, 2023, '978-602-1234-56-14',  85000,  6, 'Perancangan basis data relasional');

-- ============================================================
-- LANGKAH 12: QUERY JOIN — Tampilkan relasi antar tabel
-- ============================================================

-- Query 1: Detail buku lengkap dengan nama kategori dan penerbit
SELECT
    b.kode_buku                        AS 'Kode Buku',
    b.judul                            AS 'Judul',
    k.nama_kategori                    AS 'Kategori',
    b.pengarang                        AS 'Pengarang',
    p.nama_penerbit                    AS 'Penerbit',
    b.tahun_terbit                     AS 'Tahun',
    CONCAT('Rp ', FORMAT(b.harga, 0))  AS 'Harga',
    b.stok                             AS 'Stok'
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
JOIN penerbit      p ON b.id_penerbit = p.id_penerbit
WHERE b.is_deleted = 0
ORDER BY k.nama_kategori, b.judul;

-- Query 2: Jumlah buku dan total stok per kategori
SELECT
    k.nama_kategori    AS 'Kategori',
    COUNT(b.id_buku)   AS 'Jumlah Buku',
    SUM(b.stok)        AS 'Total Stok'
FROM kategori_buku k
LEFT JOIN buku b ON k.id_kategori = b.id_kategori AND b.is_deleted = 0
GROUP BY k.id_kategori, k.nama_kategori
ORDER BY COUNT(b.id_buku) DESC;

-- Query 3: Jumlah buku dan rata-rata harga per penerbit
SELECT
    p.nama_penerbit          AS 'Penerbit',
    COUNT(b.id_buku)         AS 'Jumlah Buku',
    ROUND(AVG(b.harga), 0)   AS 'Rata-rata Harga'
FROM penerbit p
LEFT JOIN buku b ON p.id_penerbit = b.id_penerbit AND b.is_deleted = 0
GROUP BY p.id_penerbit, p.nama_penerbit
ORDER BY COUNT(b.id_buku) DESC;

-- Query 4: Detail transaksi lengkap (JOIN 4 tabel)
SELECT
    t.id_transaksi                     AS 'ID Transaksi',
    b.judul                            AS 'Judul Buku',
    k.nama_kategori                    AS 'Kategori',
    a.nama                             AS 'Nama Anggota',
    t.tanggal_pinjam                   AS 'Tgl Pinjam',
    t.tanggal_harus_kembali            AS 'Harus Kembali',
    t.tanggal_kembali                  AS 'Tgl Kembali',
    t.status                           AS 'Status',
    CONCAT('Rp ', FORMAT(t.denda, 0))  AS 'Denda'
FROM transaksi t
JOIN buku          b ON t.id_buku     = b.id_buku
JOIN anggota       a ON t.id_anggota  = a.id_anggota
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
ORDER BY t.tanggal_pinjam DESC;