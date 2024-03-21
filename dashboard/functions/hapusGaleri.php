<?php
require 'functionsgaleri.php';

$id = $_GET["id"];

if (hapusGaleri($id) > 0) {
  echo "
 		<script>
 			alert('data berhasil dihapuskan!');
 			document.location.href = '../galeri.php';
 		</script>
 	";
} else {
  echo "
 			<script>
 				alert('data gagal dihapuskan!');
 				document.location.href = 'hapusGaleri.php';
 			</script>
 		";
}
