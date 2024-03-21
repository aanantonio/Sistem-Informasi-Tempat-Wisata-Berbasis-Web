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


?>

<?php
if (empty($_SESSION["pesanan"]) or !isset($_SESSION["pesanan"])) {
  echo "<script>alert('Pesanan kosong, Silahkan Pesan dahulu');</script>";
  echo "<script>location= 'kamar.php'</script>";
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
            <a class="nav-link active" href="index.php">Home</a>
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
  <div class="container px-4 text-center mt-2 min-vh-100">

    <div class="row">
      <div class="judul-pesanan mt-5">

        <h3 class="text-center font-weight-bold mt-4"><span class="text-info">KONFIRMASI </span>PESANAN <span class="text-info">ANDA</span></h3>

      </div>
      <form method="POST" action="">
        <table class="table bg-white rounded-2 shadow-sm" id="example">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Jenis Kamar</th>
              <th scope="col">Harga</th>
              <th scope="col">Tanggal Masuk</th>
              <th scope="col">Tanggal Keluar</th>
              <th scope="col">Durasi</th>

              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor = 1; ?>

            <?php foreach ($_SESSION["pesanan"] as $id_kamar => $jumlah) : ?>

              <?php
              $ambil = mysqli_query($koneksi, "SELECT * FROM kamar WHERE id_kamar='$id_kamar'");
              $pecah = $ambil->fetch_assoc();
              ?>

              <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah["jenis"]; ?></td>
                <td>
                  <p id="hrg" onload="hitung()">Rp. <?php echo number_format($pecah["harga"]); ?></p>
                </td>
                <!-- Tanggal Masuk -->
                <td>
                  <input type="date" id="d1" name="d1" min="<?php echo date('Y-m-d'); ?>" onchange="hitung()" class="date-input">
                </td>

                <!-- Tanggal Keluar -->
                <td>
                  <input type="date" id="d2" name="d2" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" onchange="hitung()" class="date-input">
                </td>

                <td>
                  <p id="output" class="duration" onchange="hitung()"></p>Hari
                </td>


                <td>
                  <a href="hapus_pesanan.php?id_kamar=<?php echo $id_kamar ?>" class="badge badge-danger btn btn-danger btn-lg" role="button">Hapus</a>
                </td>
              </tr>
              <?php $nomor++; ?>

            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5">Total Bayar</th>
              <th colspan="2">Rp<input type="text" id="total_harga" name="total_harga" value="<?php echo  isset($total_harga) ? $total_harga : ''; ?>" readonly>
              </th>

            </tr>
          </tfoot>

        </table>



        <br>

        <a href="kamar.php" class="btn btn-primary btn-sm">Lihat Kamar</a>
        <button class="btn btn-success btn-sm" name="konfirm">Konfirmasi Pesanan</button>
      </form>

      <?php
      if (isset($_POST['konfirm'])) {
        $tgl_in = $_POST['d1'];
        $tgl_out = $_POST['d2'];
        $total_harga = $_POST['total_harga'];

        // Validasi tanggal masuk dan tanggal keluar
        if ($tgl_in >= $tgl_out) {
          echo "<script>alert('Tanggal masuk harus sebelum tanggal keluar!');</script>";
          echo "<script>location= 'pesanan.php'</script>";
          exit; // Menghentikan eksekusi kode selanjutnya jika tanggal tidak valid
        }

        // Retrieve user's name from session
        $nama = $_SESSION["login_user"];

        // Menyimpan data ke tabel pemesanan
        $insert = mysqli_query($koneksi, "INSERT INTO transaksi (tgl_in, tgl_out, total_harga, nama, status) VALUES ('$tgl_in', '$tgl_out', '$total_harga', '$nama', 'Belum Dikonfirmasi')");

        // Mendapatkan ID barusan
        $id_terbaru = $koneksi->insert_id;

        // Menyimpan data ke tabel pemesanan produk
        foreach ($_SESSION["pesanan"] as $id_kamar => $jumlah) {
          $insert = mysqli_query($koneksi, "INSERT INTO pemesanan_kamar (id_transaksi, id_kamar, jumlah) 
       VALUES ('$id_terbaru', '$id_kamar', '$jumlah') ");
        }

        // Mengosongkan pesanan
        unset($_SESSION["pesanan"]);

        // Dialihkan ke halaman pesanan
        echo "<script>alert('Pemesanan Sukses!');</script>";
        echo "<script>location= 'pesanan.php'</script>";
      }
      ?>
    </div>

  </div>

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