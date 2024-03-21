<?php
require 'functionsKamar.php';

$id_kamar = $_GET["id_kamar"];

if (hapus($id_kamar) > 0) {
	echo "
 		<script>
 			alert('data berhasil dihapuskan!');
 			document.location.href = '../kamar.php';
 		</script>
 	";
} else {
	echo "
 			<script>
 				alert('data gagal dihapuskan!');
 			</script>
 		";
}
