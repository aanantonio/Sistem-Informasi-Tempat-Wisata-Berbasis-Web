<?php
session_start();

if (!isset($_SESSION["login_user"])) {
  header("Location: ../login.php");
  exit;
}
require 'functions/functionsGaleri.php';
$galeri = query("SELECT * FROM galeri");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="../css/dashboard.css" />
  <style>
    img {
      max-width: 100%;
    }

    .gallery {
      background-color: #dbddf1;
      padding: 80px 0;
    }

    .gallery img {
      background-color: #ffffff;
      padding: 15px;
      width: 100%;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      cursor: pointer;
    }

    #gallery-modal .modal-img {
      width: 100%;
    }

    @media (max-width: 767px) {
      .hidden-on-mobile {
        display: none !important;
      }
    }
  </style>

  <title>Galeri | Manasa Agrowisata</title>

  <!-- fonts -->

</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-white" id="sidebar-wrapper">
      <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-user-secret me-2"></i>Manasa Agrowisata</div>
      <div class="list-group list-group-flush my-3">
        <a href="home.php" class="list-group-item list-group-item-action  fw-bold "><i class="fas fa-solid fa-house me-2"></i>Home</a>
        <a href="fasilitas.php" class="list-group-item list-group-item-action  fw-bold"><i class="fas fa-solid fa-building-wheat me-2"></i>Fasilitas</a>
        <a href="kontak.php" class="list-group-item list-group-item-action  fw-bold"><i class="fas fa-solid fa-address-book me-2"></i>Kontak</a>
        <a href="galeri.php" class="list-group-item list-group-item-action  fw-bold"><i class="fas fa-solid fa-images me-2"></i>Galeri</a>
        <a href="kamar.php" class="list-group-item list-group-item-action  fw-bold"><i class="fas fa-solid fa-bed me-2"></i>Kamar</a>
        <a href="pengumuman.php" class="list-group-item list-group-item-action  fw-bold"><i class="fas fa-solid fa-circle-info me-2"></i>Pengumuman</a>
        <a href="transaksi.php" class="list-group-item list-group-item-action  fw-bold"><i class="fas fa-solid fa-cart-shopping me-2"></i>Pemesanan</a>
        <a href="../logOut.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light py-4 px-4">
        <div class="d-flex align-items-center">
          <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
          <h2 class="fs-2 m-0">Galeri</h2>
        </div>


      </nav>

      <div class="container-fluid px-4">
        <a class="btn btn-success" href="functions/tambahGaleri.php" role="button">Tambah Gambar</a>

        <div class="row mt-2">
          <div class="col">
            <table class="table bg-white rounded-4 shadow-sm ">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col" style="max-width: 400px;" class="text-center">Gambar</th>
                  <th scope="col" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($galeri as $row) : ?>
                  <tr class="text-start">
                    <td class="fs-6"><?= $i; ?></td>
                    <td class="fs-6" style="max-width: 400px;"><img src="../img/<?= $row["gambar"]; ?>" class="item img-fluid" style="cursor: pointer; "></td>
                    <td class=" fs-6 text-center">
                      <a class="btn btn-outline-danger  " href="functions/hapusGaleri.php?id=<?= $row["idGaleri"]; ?>" onclick="return confirm('Anda yakin menghapus data ?');" role="button">Hapus</a> |
                      <a class="btn btn-outline-info" href="functions/ubahGaleri.php?idGaleri=<?= $row["idGaleri"]; ?>" role="button">Ubah</a>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body mt-0">
                <img src="../img/<?= $row["gambar"]; ?>" class="modal-img" alt="modal img">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- /#page-content-wrapper -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/34bc501748.js" crossorigin="anonymous"></script>
  <script>
    // modal

    document.addEventListener("click", function(e) {
      if (e.target.classList.contains("item")) {
        const src = e.target.getAttribute("src");
        document.querySelector(".modal-img").src = src;
        const galleryModal = new bootstrap.Modal(
          document.getElementById("gallery-modal")
        );
        galleryModal.show();
      }
    });
  </script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
      el.classList.toggle("toggled");
    };
  </script>
</body>

</html>