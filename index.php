<?php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM pesanan ORDER BY tanggal_pesan DESC');
$orders = $stmt->fetchAll();
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracker - Daftar Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order Tracker</h1>
        <a href="create.php" class="btn btn-primary">Tambah Pesanan</a>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-success"><?= escape($message) ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal Pesan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($orders) === 0): ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada pesanan.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= escape($order['id_pesanan']) ?></td>
                        <td><?= escape($order['nama_pelanggan']) ?></td>
                        <td><?= escape($order['produk']) ?></td>
                        <td><?= escape($order['jumlah']) ?></td>
                        <td><?= escape($order['tanggal_pesan']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= escape($order['id_pesanan']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete.php?id=<?= escape($order['id_pesanan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pesanan ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
