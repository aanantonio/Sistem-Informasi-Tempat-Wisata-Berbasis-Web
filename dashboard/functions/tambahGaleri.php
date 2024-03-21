<?php
require 'functionsGaleri.php';

if (isset($_POST["submit"])) {
  if (tambahGaleri($_FILES)) {
    echo "
      <script>
        alert('Data berhasil ditambahkan!');
        document.location.href = '../galeri.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Gagal menambahkan file!');
        document.location.href = 'tambahGaleri.php';
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
  <title>Tambah Galeri | Manasa Agrowisata</title>

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
      <p class="text-center text-dark fw-bold fs-2">Form Tambah Galeri</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
          <label for="gambar" class="form-label text-dark h5">Gambar</label>
          <input class="form-control" type="file" name="gambar[]" id="gambar" multiple>
        </div>

        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Tambah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../galeri.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>