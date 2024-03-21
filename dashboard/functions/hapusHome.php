<?php
require 'functionsHome.php';

$id = $_GET["id"];

if (hapusHome($id) > 0) {
  echo "
 		<script>
 			alert('data berhasil dihapuskan!');
 			document.location.href = '../Home.php';
 		</script>
 	";
} else {
  echo "
 			<script>
 				alert('data gagal dihapuskan!');
 				document.location.href = 'hapusHome.php';
 			</script>
 		";
}
