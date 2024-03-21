<?php
require 'functionsHome.php';

// ambil data di URL
$idHome = isset($_GET["idHome"]) ? $_GET["idHome"] : 0; // Memastikan variabel $idHome tidak kosong
$idHome = intval($idHome); // Mengonversi nilai $idHome menjadi integer

// Query data fasilitas berdasarkan idHome dengan prepared statement
$query = "SELECT * FROM home WHERE idHome = ?";
$result = query($query, [$idHome]);

if (!empty($result)) {
  $h = $result[0];
} else {
  // Handle jika data tidak ditemukan

  echo "Data home tidak ditemukan.";
  exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
}






// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (ubahHome($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil diubah!');
 				document.location.href = '../home.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal diubah!');
  			document.location.href = 'ubahHome.php';
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
      <p class="text-center text-dark fw-bold fs-2">Ubah Data Home</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idHome" value="<?= $h["idHome"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $h["gambarHome"]; ?>">
        <div class="col-md-12">
          <label for="judulHome" class="form-label text-dark h5">Judul</label>
          <input type="text" class="form-control" name="judulHome" id="judulHome" required value="<?= isset($h['judulHome']) ? $h['judulHome'] : ''; ?>">
        </div>
        <div class="col-md-12">
          <label for="gambarHome" class="form-label text-dark h5">Gambar</label>
          <img src="../../img/<?= $h['gambarHome']; ?>" alt="" class="img-thumbnail rounded">
          <input class="form-control" type="file" name="gambarHome" id="gambarHome" value="<?= isset($h['gambarHome']) ? $h['gambarHome'] : ''; ?>">
        </div>
        <div class="col-12">
          <label for="deskripsiHome" class="form-label text-dark h5">Deskripsi</label>
          <input type="text" class="form-control" name="deskripsiHome" id="deskripsiHome" required value="<?= isset($h['deskripsiHome']) ? $h['deskripsiHome'] : ''; ?>">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Ubah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../home.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>