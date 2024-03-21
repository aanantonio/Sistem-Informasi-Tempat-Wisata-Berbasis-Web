<?php
session_start();

if (!isset($_SESSION["login_user"])) {
  header("Location: ../login.php");
  exit;
}
require 'functions/functionsTransaksi.php';
$transaksi = query("SELECT * FROM transaksi");


// // ambil data di URL
// $id = isset($_GET["id"]) ? $_GET["id"] : 0; // Memastikan variabel $id tidak kosong
// $id = intval($id); // Mengonversi nilai $id menjadi integer

// // Query data fasilitas berdasarkan id dengan prepared statement
// $query = "SELECT * FROM transaksi WHERE id = ?";
// $result = query($query, [$id]);

// if (!empty($result)) {
//   $k = $result[0];
// } else {
//   // Handle jika data tidak ditemukan

//   echo "Data transaksi tidak ditemukan.";
//   exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
// }






// // cek apakah tombol submit sudah ditekan atau belum
// if (isset($_POST["submit"])) {

//   // cek apakah data berhasil ditambahkan atau tidak
//   if (ubah($_POST) > 0) {
//     echo "
//  			<script>
//  				alert('data berhasil diubah!');
//  				document.location.href = '../transaksi.php';
//  			</script>
//  		";
//   } else {
//     echo "
//   		<script>
//   			alert('data gagal diubah!');
//   		</script>
//   	";
//   }
// }
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

  <title>Pemesanan | Manasa Agrowisata</title>

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
          <h2 class="fs-2 m-0">Pemesanan</h2>
        </div>
      </nav>

      <div class="container-fluid px-4">

        <div class="row mt-2">
          <div class="col">
            <table class="table bg-white rounded-4 shadow-sm ">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">ID Pemesanan</th>
                  <th scope="col" class="hidden-on-mobile">Tanggal Masuk</th>
                  <th scope="col" class="hidden-on-mobile">Tanggal Keluar</th>
                  <th scope="col">Email Pemesan</th>
                  <th scope="col" class="hidden-on-mobile">Status</th>
                  <th scope="col">Total Bayar</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor = 1; ?>
                <?php
                $ambil = mysqli_query($koneksi, 'SELECT * FROM transaksi');
                $result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
                ?>
                <?php foreach ($result as $result) : ?>

                  <tr>
                    <th scope="row"><?php echo $nomor; ?></th>
                    <td><?php echo $result["id_transaksi"]; ?></td>
                    <td class="hidden-on-mobile"><?php echo $result["tgl_in"]; ?></td>
                    <td class="hidden-on-mobile"><?php echo $result["tgl_out"]; ?></td>
                    <td><?php echo $result["nama"]; ?></td>
                    <td class="hidden-on-mobile"><?php echo $result["status"]; ?></td>
                    <td>Rp. <?php echo number_format($result["total_harga"]); ?></td>
                    <td>

                      <a class="btn btn-outline-info m-1" href="functions/detailTransaksi.php?id_transaksi=<?php echo $result['id_transaksi'] ?>" role="button">Detail</a>|
                      <a class="btn btn-outline-danger" href="functions/hapusTransaksi.php?id_transaksi=<?php echo $result['id_transaksi'] ?>" onclick="return confirm('Anda Yakin ?');" role="button">Hapus</a>
                    </td>
                  </tr>
                  <?php $nomor++; ?>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>

        <!-- Modal -->
        <div class=" modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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