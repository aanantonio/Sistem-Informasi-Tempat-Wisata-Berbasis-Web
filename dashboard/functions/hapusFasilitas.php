<?php
require 'functionsFasilitas.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
	echo "
 		<script>
 			alert('data berhasil dihapuskan!');
 			document.location.href = '../fasilitas.php';
 		</script>
 	";
} else {
	echo "
 			<script>
 				alert('data gagal dihapuskan!');
 				document.location.href = 'hapusFasilitas.php';
 			</script>
 		";
}
