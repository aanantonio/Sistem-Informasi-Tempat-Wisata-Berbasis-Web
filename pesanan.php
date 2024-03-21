<?php
session_start();

if (!isset($_SESSION["login_user"])) {
  header("Location: login.php");
  exit;
}

$host = "localhost";
$username = "root";
$password = "";
$database = "dbmanasa";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_set_charset($koneksi, "utf8");

// Retrieve user's name from session
$nama = $_SESSION["login_user"];

// Retrieve orders for the logged-in user
$query = "SELECT * FROM transaksi WHERE nama = '$nama'";
$result = mysqli_query($koneksi, $query);


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


  <style>
    .date-input {
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .duration {
      font-size: 18px;
      font-weight: bold;
      color: #555;
    }
  </style>


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

  <body>

    <div class="container min-vh-100 m-auto">
      <div class="p-1 mt-3">
        <h3 class="text-center font-weight-bold mt-5"><span class="text-info">PESANAN</span> ANDA</h3>
      </div>

      <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="table text-light">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Keluar</th>
              <th>Total Bayar</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $row["tgl_in"]; ?></td>
                <td><?php echo $row["tgl_out"]; ?></td>
                <td>Rp<?php echo number_format($row["total_harga"]); ?></td>
                <td><?php echo $row["status"]; ?></td>


              </tr>
              <?php $nomor++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>Tidak ada pesanan yang ditemukan.</p>
      <?php endif; ?>
      <div>
        <a href="kamar.php" role="button" class="btn btn-info">Kembali</a>

      </div>
    </div>

    <!-- Add your HTML content here -->
    <!-- footer -->
    <footer class="py-2 mt-2" style="background-color: #f9bc60;
  width: 100% !important;">
      <div class="container text-light text-center">
        <p class="display-6 mb-2" style="color: black;">Manasa Agrowisata</p>
        <small class="text-dark">&copy; Copyright by Aan Agniesko Antonio. All right reserved.</small>
      </div>
    </footer>


    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/main.js"></script>

    <!-- icons -->

  </body>

</html>