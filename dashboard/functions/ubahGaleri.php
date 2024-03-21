<?php
require 'functionsGaleri.php';

// ambil data di URL
$idGaleri = isset($_GET["idGaleri"]) ? $_GET["idGaleri"] : 0; // Memastikan variabel $idGaleri tidak kosong
$idGaleri = intval($idGaleri); // Mengonversi nilai $idGaleri menjadi integer

// Query data fasilitas berdasarkan idGaleri dengan prepared statement
$query = "SELECT * FROM galeri WHERE idGaleri = ?";
$result = query($query, [$idGaleri]);

if (!empty($result)) {
  $g = $result[0];
} else {
  // Handle jika data tidak ditemukan

  echo "Data fasilitas tidak ditemukan.";
  exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
}






// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (ubahGaleri($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil diubah!');
 				document.location.href = '../galeri.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal diubah!');
  			document.location.href = 'ubahGaleri.php';
  		</script>
  	";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Fasilitas | Manasa Agrowisata</title>

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&family=Viga&display=swap" rel="stylesheet">

  <!-- My style -->
  <link rel="stylesheet" href="../../css/bootstrap.css">
</head>

<body>
  <div class="container mt-5">
    <div class="bg bg-info p-5 ">
      <p class="text-center text-dark fw-bold fs-2">Ubah Data Fasilitas</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idGaleri" value="<?= $g["idGaleri"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $g["gambar"]; ?>">
        <div class="col-md-12">
          <label for="gambar" class="form-label text-dark h5">Gambar</label>
          <img src="../../img/<?= $g['gambar']; ?>" alt="" class="img-thumbnail rounded">
          <input class="form-control" type="file" name="gambar" id="gambar" value="<?= isset($g['gambar']) ? $g['gambar'] : ''; ?>">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-warning " name="submit">Ubah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn  text-light" href="../galeri.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>