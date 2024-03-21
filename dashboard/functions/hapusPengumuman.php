<?php
require 'functionspengumuman.php';

$id = $_GET["id"];

if (hapusPengumuman($id) > 0) {
  echo "
 		<script>
 			alert('data berhasil dihapuskan!');
 			document.location.href = '../pengumuman.php';
 		</script>
 	";
} else {
  echo "
 			<script>
 				alert('data gagal dihapuskan!');
 				document.location.href = 'hapusPengumuman.php';
 			</script>
 		";
}
