<?php
require 'dashboard/functions/functionKontak.php';
$kontak = query("SELECT * FROM kontak");

// Proses penyimpanan data kritik dan saran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kritik_saran_submit'])) {
  $namaPengirim = $_POST['namaPengirim'];
  $email = $_POST['email'];
  $pesan = $_POST['pesan'];


  // Simpan data kritik dan saran ke tabel kritik_saran
  $query = "INSERT INTO kritik (namaPengirim, email, pesan) VALUES ('$namaPengirim', '$email', '$pesan')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<script>
    alert('data berhasil dikirim!');
    document.location.href = 'kontak.php';
  </script>";
  } else {
    echo "Terjadi kesalahan saat menyimpan data kritik dan saran.";
  }
}

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
            <a class="nav-link " href="logOut.php ">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- contact -->
  <div class="container mt-5">
    <div class="row ">
      <div class="card mt-5 mb-3 col-md-4 p-5 text-white order-sm-first order-last" style="background-color: #f9bc60;">
        <?php foreach ($kontak as $row) : ?>
          <h2 style="color: #001e1d;">Hubungi Kami</h2>
          <p style="color: #001e1d;">"Kami dengan senang hati menerima segala saran dan juga tersedia untuk mengobrol dengan Anda!"</p>
          <div class="d-flex mt-1">
            <i class="bi bi-geo-alt mt-2" style="font-size: 40px; color: #001e1d;"></i>
            <p class="mt-3 ms-3" style="color: #001e1d;"><?= $row['alamat']; ?></p>
          </div>
          <div class="d-flex mt-2">
            <i class="bi bi-telephone-forward mt-2" style="font-size: 40px; color: #001e1d;"></i>
            <p class="mt-4 ms-3" style="color: #001e1d;"><?= $row['noHp']; ?></p>
          </div>
          <div class="d-flex mt-2">
            <i class="bi bi-envelope mt-2" style="font-size: 40px; color: #001e1d;"></i>
            <p class="mt-4 ms-3" style="color: #001e1d;"><?= $row['email']; ?></p>
          </div>
          <div class="d-flex mt-2">
            <i class="bi bi-instagram mt-2" style="font-size: 40px; color: #001e1d;"></i>
            <p class="mt-4 ms-3" style="color: #001e1d;"><?= $row['instagram']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-md-8 p-5 ">
        <h2 class="text-center"><span class="text-info">Kri</span>tik D<span class="text-info">an Sar</span>an</h2>
        </h2>
        <form class="row g-3 contactForm mt-4" method="post">
          <div class="col-md-12">
            <label for="namaPengirim" class="form-label text-light h5">Nama</label>
            <input type="text" class="form-control" name="namaPengirim" id="namaPengirim" required>
          </div>
          <div class="col-md-12">
            <label for="email" class="form-label text-light h5">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="col-12">
            <label for="pesan" class="form-label text-light h5">Pesan</label>
            <textarea class="form-control" name="pesan" id="pesan" rows="5" required></textarea>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-outline-warning btn-lg" name="kritik_saran_submit">Kirim Pesan</button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <!-- footer -->
  <footer class="py-2 mt-2" style="background-color: #f9bc60;">
    <div class="container text-light text-center">
      <p class="display-6 mb-2" style="color: black;">Manasa Agrowisata</p>
      <small class="text-dark">&copy; Copyright by Aan Agniesko Antonio. All right reserved.</small>
    </div>
  </footer>


  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>