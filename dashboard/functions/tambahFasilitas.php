<?php
require 'functionsFasilitas.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (tambahFAsilitas($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil ditambahkan!');
 				document.location.href = '../fasilitas.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal ditambahkan!');
  			document.location.href = 'tambahFasilitas.php';
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
  <title>Tambah Fasilitas | Manasa Agrowisata</title>

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
      <p class="text-center text-dark fw-bold fs-2">Form Tambah Fasilitas</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
          <label for="namaFasilitas" class="form-label text-dark h5">Nama Fasilitas</label>
          <input type="text" class="form-control" name="namaFasilitas" id="namaFasilitas" required>
        </div>
        <div class="col-md-12">
          <label for="gambar_fasilitas" class="form-label text-dark h5">Gambar</label>
          <input class="form-control" type="file" name="gambar_fasilitas" id="gambar_fasilitas">
        </div>
        <div class="col-12">
          <label for="deskripsi_fasilitas" class="form-label text-dark h5">Deskripsi</label>
          <input type="text" class="form-control" name="deskripsi_fasilitas" id="deskripsi_fasilitas" required>
        </div>
        <div class="col-12">
          <label for="tgl_ubah" class="form-label text-dark h5">Tanggal Tambah</label>
          <input type="date" class="form-control" name="tgl_ubah" id="tgl_ubah" required>
        </div>

        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Tambah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../fasilitas.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>