<?php
require 'functionKontak.php';

$idKritik = $_GET["idKritik"];

if (hapusKritik($idKritik) > 0) {
  echo "
 		<script>
 			alert('data berhasil dihapuskan!');
 			document.location.href = '../kontak.php';
 		</script>
 	";
} else {
  echo "
 			<script>
 				alert('data gagal dihapuskan!');
 				document.location.href = '../kontak.php';
 			</script>
 		";
}
