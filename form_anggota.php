<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrasi Anggota - Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Form Registrasi Anggota</h4>
                        </div>

                        <div class="card-body">
                            <?php
                            $success = '';

                            $namalengkap = '';
                            $email = '';
                            $telepon = '';
                            $alamat = '';
                            $jeniskelamin = '';
                            $tgllahir = '';
                            $pekerjaan = '';

                            $errors = [];

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                $namalengkap = trim(htmlspecialchars($_POST['namalengkap'] ?? ''));
                                $email = trim(htmlspecialchars($_POST['email'] ?? ''));
                                $telepon = trim(htmlspecialchars($_POST['telepon'] ?? ''));
                                $alamat = trim(htmlspecialchars($_POST['alamat'] ?? ''));
                                $jeniskelamin = trim($_POST['jeniskelamin'] ?? '');
                                $tgllahir = trim($_POST['tgllahir'] ?? '');
                                $pekerjaan = trim($_POST['pekerjaan'] ?? '');

                                if (empty($namalengkap)) {
                                    $errors['namalengkap'] = "Nama lengkap wajib diisi";
                                } elseif (strlen($namalengkap) < 3) {
                                    $errors['namalengkap'] = "Nama minimal 3 karakter";
                                }

                                if (empty($email)) {
                                    $errors['email'] = "Email wajib diisi";
                                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $errors['email'] = "Format email tidak valid";
                                }

                                if (empty($telepon)) {
                                    $errors['telepon'] = "Telepon wajib diisi";
                                } elseif (!preg_match("/^08[0-9]{8,11}$/", $telepon)) {
                                    $errors['telepon'] = "Format telepon harus 08xxxxxxxxxx";
                                }

                                if (empty($alamat)) {
                                    $errors['alamat'] = "Alamat wajib diisi";
                                } elseif (strlen($alamat) < 10) {
                                    $errors['alamat'] = "Alamat minimal 10 karakter";
                                }

                                if (empty($jeniskelamin)) {
                                    $errors['jeniskelamin'] = "Jenis kelamin wajib dipilih";
                                }

                                if (empty($tgllahir)) {
                                    $errors['tgllahir'] = "Tanggal lahir wajib diisi";
                                } else {
                                    $lahir = new DateTime($tgllahir);
                                    $hariini = new DateTime();
                                    $umur = $hariini->diff($lahir)->y;

                                    if ($umur < 10) {
                                        $errors['tgllahir'] = "Umur minimal 10 tahun";
                                    }
                                }

                                if (empty($pekerjaan)) {
                                    $errors['pekerjaan'] = "Pekerjaan wajib dipilih";
                                }

                                if (count($errors) == 0) {
                                    $success = "Registrasi berhasil disimpan!";
                                }
                            }
                            ?>

                            <?php if ($success): ?>
                                <div class="alert alert-success">
                                    <?php echo $success; ?>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header bg-success text-white">
                                        Data Anggota
                                    </div>

                                    <div class="card-body">
                                        <p><strong>Nama Lengkap :*</strong> <?php echo $namalengkap; ?></p>
                                        <p><strong>Email :*</strong> <?php echo $email; ?></p>
                                        <p><strong>Telepon :*</strong> <?php echo $telepon; ?></p>
                                        <p><strong>Alamat :*</strong> <?php echo $alamat; ?></p>
                                        <p><strong>Jenis Kelamin :*</strong> <?php echo $jeniskelamin; ?></p>
                                        <p><strong>Tanggal Lahir :*</strong> <?php echo $tgllahir; ?></p>
                                        <p><strong>Pekerjaan :*</strong> <?php echo $pekerjaan; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="namalengkap" value="<?php echo $namalengkap; ?>" class="form-control <?php echo isset($errors['namalengkap']) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo $errors['namalengkap'] ?? ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo $errors['email'] ?? ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" name="telepon" value="<?php echo $telepon; ?>" class="form-control <?php echo isset($errors['telepon']) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo $errors['telepon'] ?? ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control <?php echo isset($errors['alamat']) ? 'is-invalid' : ''; ?>"><?php echo $alamat; ?></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['alamat'] ?? ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">Jenis Kelamin</label>

                                    <input type="radio" name="jeniskelamin" value="Laki-laki" <?php if ($jeniskelamin == 'Laki-laki') echo 'checked'; ?>> Laki-laki
                                    <input type="radio" name="jeniskelamin" value="Perempuan" <?php if ($jeniskelamin == 'Perempuan') echo 'checked'; ?>> Perempuan

                                    <div class="text-danger">
                                        <?php echo $errors['jeniskelamin'] ?? ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tgllahir" value="<?php echo $tgllahir; ?>" class="form-control <?php echo isset($errors['tgllahir']) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo $errors['tgllahir'] ?? ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <select name="pekerjaan" class="form-select <?php echo isset($errors['pekerjaan']) ? 'is-invalid' : ''; ?>">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        <option value="Pelajar" <?php if ($pekerjaan == 'Pelajar') echo 'selected'; ?>>Pelajar</option>
                                        <option value="Mahasiswa" <?php if ($pekerjaan == 'Mahasiswa') echo 'selected'; ?>>Mahasiswa</option>
                                        <option value="Pegawai" <?php if ($pekerjaan == 'Pegawai') echo 'selected'; ?>>Pegawai</option>
                                        <option value="Lainnya" <?php if ($pekerjaan == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['pekerjaan'] ?? ''; ?>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <small><i class="bi bi-info-circle"></i> <strong>Catatan : </strong>Field dengan tanda (*) wajib diisi/dipilih</small>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </body>
</html>