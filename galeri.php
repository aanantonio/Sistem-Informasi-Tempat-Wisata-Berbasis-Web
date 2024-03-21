<?php
require 'dashboard/functions/functionsGaleri.php';
$galeri = query("SELECT * FROM galeri");
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
  <section class="gallery min-vh-100" style="background-color: #004643;">
    <div class="container text-center">
      <h2 class="display-5 mb-3">GALERI <span class="text-info">MANASA</span></h2>
      <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
        <?php foreach ($galeri as $row) : ?>
          <div class="col" style="background-color: #004643;">
            <img src="img/<?= $row["gambar"]; ?>" class="gallery-item" alt="gallery" data-bs-toggle="modal" data-bs-target="#gallery-modal" style=" max-height: 215px">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-0">
          <img src="" class="modal-img" alt="modal img">
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <footer class="py-2 mt-2" style="background-color: #f9bc60;">
    <div class="container text-light text-center">
      <p class="display-6 mb-2" style="color: black;">Manasa Agrowisata</p>
      <small class="text-dark">&copy; 2023 by Aan Agniesko Antonio. All right reserved.</small>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script>
    // Mengatur gambar modal saat modal ditampilkan
    var galleryModal = document.getElementById('gallery-modal');
    galleryModal.addEventListener('show.bs.modal', function(event) {
      var image = event.relatedTarget.src;
      var modalImage = galleryModal.querySelector('.modal-img');
      modalImage.src = image;
    });
  </script>
</body>

</html>