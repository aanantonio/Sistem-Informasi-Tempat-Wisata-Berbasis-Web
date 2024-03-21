<?php
require 'functionKontak.php';

// ambil data di URL
$idKontak = isset($_GET["idKontak"]) ? $_GET["idKontak"] : 0; // Memastikan variabel $idKontak tidak kosong
$idKontak = intval($idKontak); // Mengonversi nilai $idKontak menjadi integer

// Query data fasilitas berdasarkan idKontak dengan prepared statement
$query = "SELECT * FROM kontak WHERE idKontak = ?";
$result = query($query, [$idKontak]);

if (!empty($result)) {
  $k = $result[0];
} else {
  // Handle jika data tidak ditemukan

  echo "Data kontak tidak ditemukan.";
  exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
}






// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (editKontak($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil diubah!');
 				document.location.href = '../kontak.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal diubah!');
  			document.location.href = 'editKontak.php';
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
    <div class="bg bg-info p-5 mb-5 ">
      <p class="text-center text-dark fw-bold fs-2">Ubah Data Kontak</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idKontak" value="<?= $k["idKontak"]; ?>">
        <div class="col-md-12">
          <label for="alamat" class="form-label text-dark h5">Alamat</label>
          <input type="text" class="form-control" name="alamat" id="alamat" required value="<?= isset($k['alamat']) ? $k['alamat'] : ''; ?>">
        </div>
        <div class="col-md-12">
          <label for="noHp" class="form-label text-dark h5">No Handphone</label>
          <input type="text" class="form-control" name="noHp" id="noHp" required value="<?= isset($k['noHp']) ? $k['noHp'] : ''; ?>">
        </div>
        <div class="col-12">
          <label for="email" class="form-label text-dark h5">Email</label>
          <input type="text" class="form-control" name="email" id="email" required value="<?= isset($k['email']) ? $k['email'] : ''; ?>">
        </div>
        <div class="col-12">
          <label for="instagram" class="form-label text-dark h5">Instagram</label>
          <input type="text" class="form-control" name="instagram" id="instagram" required value="<?= isset($k['instagram']) ? $k['instagram'] : ''; ?>">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-warning " name="submit">Ubah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn  text-light" href="../kontak.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>