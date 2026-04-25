# Order Tracker

A simple PHP CRUD application for managing `pesanan` records using MySQL / MariaDB.

## Fitur

- Create: tambah pesanan baru
- Read: tampilkan daftar pesanan
- Update: edit data pesanan
- Delete: hapus pesanan
- Validasi input: nama pelanggan & produk tidak boleh kosong, jumlah minimal 1

## File penting

- `db.php` - koneksi database dan helper
- `index.php` - daftar pesanan
- `create.php` - form tambah pesanan
- `edit.php` - form edit pesanan
- `delete.php` - hapus pesanan
- `schema.sql` - skrip pembuatan database & tabel

## Cara pakai

1. Import `schema.sql` ke MySQL/MariaDB.
2. Tempatkan folder `REMEK` di `htdocs` XAMPP.
3. Buka browser ke `http://localhost/REMEK/index.php`.
4. Tambah, edit, atau hapus pesanan.

## Catatan

- Pastikan database `remek` sudah ada.
- Sesuaikan konfigurasi database di `db.php` jika diperlukan.
