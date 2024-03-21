<?php
require 'functionsTransaksi.php';

$id = $_GET["id_transaksi"];

if (hapus($id) > 0) {
	echo "
 		<script>
 			alert('data berhasil dihapuskan!');
 			document.location.href = '../transaksi.php';
 		</script>
 	";
} else {
	echo "
 			<script>
 				alert('data gagal dihapuskan!');
 			</script>
 		";
}
