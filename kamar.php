<?php
session_start();

if (!isset($_SESSION["login_user"])) {
  header("Location: login.php");
  exit;
}
require 'dashboard/functions/functionsKamar.php';
$query = mysqli_query($koneksi, 'SELECT * FROM kamar');
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
    <section class="jumbotron">
      <div class="our-room text-center ptb-80 white-bg">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-title mb-75">
                <h2 class="text-light">Jenis <span class="text-info">Kamar</span></h2>
                <p>Kami menyediakan berbagai jenis kamar, baik untuk sendiri, pasangan, maupun keluarga.</p>
              </div>
            </div>
          </div>
          <div class="row g-5">
            <?php $i = 1; ?>
            <?php foreach ($result as $result) : ?>
              <div class="d-none"><?= $i; ?></div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                  <img src="img/<?php echo $result['gambar'] ?>" class="card-img-top" alt="..." style="max-height: 160px;">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $result['jenis'] ?></h5>
                    <div class="row">
                      <div class="col-8 text-start mt-1">
                        <p class="card-text ">Rp<?php echo number_format($result['harga']); ?>/Malam</p>
                      </div>
                      <div class="text-end col-4">
                        <a href="beli.php?id_kamar=<?php echo $result['id_kamar']; ?>" class="btn btn-success btn-sm btn-block ">BELI</a>
                      </div>
                    </div>


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

</body>

</html>