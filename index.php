<?php

require 'dashboard/functions/functionshome.php';
$home = query("SELECT * FROM home");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

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
            <a class="nav-link " href="index.php">Home</a>
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
  <div class="container px-4 text-center mt-5 min-vh-100">
    <?php $i = 1; ?>
    <?php foreach ($home as $row) : ?>
      <section class="jumbotron">
        <div class="d-none"><?= $i; ?></div>
        <h1 class="display-5 mb-4"><?= $row['judulHome']; ?></h1>
        <img src="img/<?= $row["gambarHome"]; ?>" class="img-fluid img-thumbnail shadow-lg" alt="manasa" width="400px">
        <p class="mt-4"><?= $row['deskripsiHome']; ?> </p>
      </section>
      <?php $i++; ?>
    <?php endforeach; ?>
  </div>

  <!-- footer -->
  <footer class="py-2 mt-2" style="background-color: #f9bc60;">
    <div class="container text-light text-center">
      <p class="display-6 mb-2" style="color: black;">Manasa Agrowisata</p>
      <small class="text-dark">&copy; Copyright by Aan Agniesko Antonio. All right reserved.</small>
    </div>
  </footer>


  <script src="js/bootstrap.bundle.js"></script>
  <script src="https://kit.fontawesome.com/34bc501748.js" crossorigin="anonymous"></script>

</body>

</html>