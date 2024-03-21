<?php
require 'dashboard/functions/functionsPengumuman.php';
$pengumuman = query("SELECT * FROM pengumuman");
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

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

  <!-- galeri -->


  <!-- galeri -->
  <div class="container px-4 text-center mt-5">

    <h2 class="text-light pt-5 mt-5">Pengu<span class="text-info">muman</span></h2>

    <section class="jumbotron min-vh-100">
      <?php $i = 1; ?>
      <?php foreach ($pengumuman as $row) : ?>
        <div class="d-none"><?= $i; ?></div>
        <div class="card text-center mt-3 " style="background-color: #f9bc60;">
          <div class="card-header mb-2  text-emphasis-info" style="background-color: #e16162;">
            <h2 class="display-7 fw-bolder"><?= $row['judulPengumuman']; ?> </h2>
          </div>
          <div class="card-body">
            <p class="card-text"><?= $row['isi']; ?></p>
          </div>
          <div class="card-footer text-body-secondary">
            <p class="h6"><?= $row['tglPost']; ?></p>
          </div>
        </div>
        <?php $i++; ?>
      <?php endforeach; ?>
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
  <script src="js/main.js"></script>
</body>

</html>