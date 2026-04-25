<?php
require 'db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM pesanan WHERE id_pesanan = ?');
$stmt->execute([$id]);
$order = $stmt->fetch();
if (!$order) {
    header('Location: index.php');
    exit;
}

$errors = [];
$nama_pelanggan = $order['nama_pelanggan'];
$produk = $order['produk'];
$jumlah = $order['jumlah'];
$tanggal_pesan = $order['tanggal_pesan'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pelanggan = trim($_POST['nama_pelanggan'] ?? '');
    $produk = trim($_POST['produk'] ?? '');
    $jumlah = trim($_POST['jumlah'] ?? '');
    $tanggal_pesan = trim($_POST['tanggal_pesan'] ?? '');

    if ($nama_pelanggan === '') {
        $errors[] = 'Nama pelanggan tidak boleh kosong.';
    }

    if ($produk === '') {
        $errors[] = 'Produk tidak boleh kosong.';
    }

    if ($jumlah === '' || !filter_var($jumlah, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
        $errors[] = 'Jumlah harus berupa angka minimal 1.';
    }

    if ($tanggal_pesan === '') {
        $errors[] = 'Tanggal pesan harus diisi.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('UPDATE pesanan SET nama_pelanggan = ?, produk = ?, jumlah = ?, tanggal_pesan = ? WHERE id_pesanan = ?');
        $stmt->execute([$nama_pelanggan, $produk, $jumlah, $tanggal_pesan, $id]);
        header('Location: index.php?message=' . urlencode('Pesanan berhasil diperbarui.'));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan - Order Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h1>Edit Pesanan</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= escape($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="<?= escape($nama_pelanggan) ?>" required>
        </div>
        <div class="col-md-6">
            <label for="produk" class="form-label">Produk</label>
            <input type="text" name="produk" id="produk" class="form-control" value="<?= escape($produk) ?>" required>
        </div>
        <div class="col-md-4">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="<?= escape($jumlah) ?>" required>
        </div>
        <div class="col-md-4">
            <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" id="tanggal_pesan" class="form-control" value="<?= escape($tanggal_pesan) ?>" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
