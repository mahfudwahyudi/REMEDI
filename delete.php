<?php
require 'db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM pesanan WHERE id_pesanan = ?');
$stmt->execute([$id]);
header('Location: index.php?message=' . urlencode('Pesanan berhasil dihapus.'));
exit;
