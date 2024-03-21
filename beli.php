<?php
session_start();

$id_kamar = $_GET['id_kamar'];

if (isset($_SESSION['pesanan'][$id_kamar])) {
  $_SESSION['pesanan'][$id_kamar] += 1;
} else {
  $_SESSION['pesanan'][$id_kamar] = 1;
}

echo "<script>alert('Kamar telah masuk ke pesanan anda');</script>";
echo "<script>location= 'pesanan_pembeli.php'</script>";
