<?php
session_start();

if (!isset($_SESSION["login_user"])) {
  header("Location: ../login.php");
  exit;
}
require 'functions/functionKontak.php';
$kontak = query("SELECT * FROM kontak");

// Ambil data kritik dan saran dari database
$query = "SELECT * FROM kritik";
$result = mysqli_query($koneksi, $query);
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
    @media (max-width: 767px) {
      .hidden-on-mobile {
        display: none !important;
      }
    }
  </style>
  <title>Kontak | Manasa Agrowisata</title>


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
          <h2 class="fs-2 m-0">Kontak</h2>
        </div>

      </nav>

      <div class="container-fluid px-4">
        <div class="row ">
          <div class="col">
            <table class="table bg-white rounded shadow-sm  table-hover text-start">
              <thead>
                <tr>
                  <th scope="col" style="max-width: 300px;" class="hidden-on-mobile">Alamat</th>
                  <th scope="col" class="hidden-on-mobile">No Handphone</th>
                  <th scope="col">Email</th>
                  <th scope="col" class="hidden-on-mobile">Instagram</th>
                  <th class="text-start">Aksi</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach ($kontak as $row) : ?>
                  <tr>
                    <td class="fs-6 hidden-on-mobile"><?= $row["alamat"]; ?></td>
                    <td class="fs-6 hidden-on-mobile"><?= $row["noHp"]; ?></td>
                    <td class="fs-6"><?= $row["email"]; ?></td>
                    <td class="fs-6 hidden-on-mobile"><?= $row["instagram"]; ?></td>

                    <td class=" fs-6">
                      <a class="btn btn-outline-info" href="functions/editKontak.php?idKontak=<?= $row["idKontak"]; ?>" role="button">Ubah</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <h2 class="fs-2  text-start" id="menu-toggle">Kritik Dan Saran</h2>
        <div class="row">
          <div class="col">
            <table class="table bg-white rounded shadow-sm  table-hover text-start">
              <thead>
                <tr>

                  <th scope="col">Nama Pengirim</th>
                  <th scope="col">Email</th>
                  <th scope="col">Pesan</th>
                  <th class="text-center">Aksi</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $row) : ?>
                  <tr>
                    <td class="fs-6"><?= $row["namaPengirim"]; ?></td>
                    <td class="fs-6"><?= $row["email"]; ?></td>
                    <td class="fs-6"><?= $row["pesan"]; ?></td>

                    <td class=" fs-6 text-center">
                      <a class="btn btn-danger" href="functions/hapusKritik.php?idKritik=<?= $row["idKritik"]; ?>" onclick="return confirm('Anda yakin hapus data ?')" role="button">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>













          <!-- <div class="col">
            <h2 class="text-center">Kritik dan Saran</h2>
            <?php foreach ($result as $row) : ?>
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title"><?= $row['namaPengirim']; ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $row['email']; ?></h6>
                  <p class="card-text"><?= $row['pesan']; ?></p>
                </div>
              </div>
            <?php endforeach; ?>
            <form class="row g-3 contactForm mt-4" method="post">
              
            </form>
          </div> -->

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
      if (e.target.classList.contains("gallery-item")) {
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