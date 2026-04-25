<?php
// koneksi.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'order_tracker'; 

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>