-- Database schema for Order Tracker
CREATE DATABASE IF NOT EXISTS remek CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE remek;

CREATE TABLE IF NOT EXISTS pesanan (
    id_pesanan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    produk VARCHAR(50) NOT NULL,
    jumlah INT NOT NULL CHECK (jumlah >= 1),
    tanggal_pesan DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
