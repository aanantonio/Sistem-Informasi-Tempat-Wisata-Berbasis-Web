<?php
require('functionsHome.php');

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (tambahHome($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil ditambahkan!');
 				document.location.href = '../home.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal ditambahkan!');
  			document.location.href = 'tambahHome.php';
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
  <title>Tambah Home | Manasa Agrowisata</title>

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
      <p class="text-center text-dark fw-bold fs-2">Form Tambah Home</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
          <label for="judulHome" class="form-label text-dark h5">Judul</label>
          <input type="text" class="form-control" name="judulHome" id="judulHome" required>
        </div>
        <div class="col-md-12">
          <label for="gambarHome" class="form-label text-dark h5">Gambar</label>
          <input class="form-control" type="file" name="gambarHome" id="gambarHome">
        </div>
        <div class="col-12">
          <label for="deskripsiHome" class="form-label text-dark h5">Deskripsi</label>
          <input type="text" class="form-control" name="deskripsiHome" id="deskripsiHome" required>
        </div>
        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Tambah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../home.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>