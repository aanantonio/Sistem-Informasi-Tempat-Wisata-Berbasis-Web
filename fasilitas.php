<?php
require 'dashboard/functions/functionsFasilitas.php';
$fasilitas = query("SELECT * FROM fasilitas");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manasa Agrowisata</title>

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&family=Viga&display=swap" rel="stylesheet">

  <!-- icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- My style -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg shadow-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Manasa Agrowisata</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="fasilitas.php">Fasilitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kontak.php">Kontak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="galeri.php">Galeri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kamar.php">Sewa Kamar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pesanan.php">Pesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pengumuman.php">Pengumuman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logOut.php ">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- jumbotron -->
  <div class="container px-4 text-center mt-5">
    <section class="jumbotron">
      <h1 class="display-5 mb-4">FASI<span class="text-info">LITAS</span></h1>
      <div class="row g-5">
        <?php $i = 1; ?>
        <?php foreach ($fasilitas as $row) : ?>
          <div class="d-none"><?= $i; ?></div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card" style="background-color: #f9bc60; height: 460px">
              <img src="img/<?= $row["gambar_fasilitas"]; ?>" class="card-img-top " width="100" height="200">
              <div class="card-body">
                <h5 class="card-title"><?= $row['namaFasilitas']; ?></h5>
                <p class="card-text"><?= $row['deskripsi_fasilitas']; ?></p>
              </div>
            </div>
          </div>
          <?php $i++; ?>
        <?php endforeach; ?>
      </div>
    </section>
  </div>

  <!-- footer -->
  <footer class="py-2 mt-2" style="background-color: #f9bc60;">
    <div class="container text-light text-center">
      <p class="display-6 mb-2" style="color: black;">Manasa Agrowisata</p>
      <small class="text-dark">&copy; Copyright by Aan Agniesko Antonio. All right reserved.</small>
    </div>
  </footer>


  <script src="js/bootstrap.bundle.js"></script>

  <!-- icons -->
  <script>
    feather.replace()
  </script>
</body>

</html>