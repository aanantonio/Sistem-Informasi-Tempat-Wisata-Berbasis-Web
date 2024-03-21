<?php
session_start();

$id_kamar = $_GET["id_kamar"];

unset($_SESSION["pesanan"][$id_kamar]);

echo "<script>alert('Kamar telah dihapus');</script>";
echo "<script>location= 'pesanan_pembeli.php'</script>";
