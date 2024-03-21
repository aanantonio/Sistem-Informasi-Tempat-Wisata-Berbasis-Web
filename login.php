<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "dbmanasa";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_set_charset($koneksi, "utf8");

$login_error = ""; // Variabel untuk menyimpan pesan error

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query untuk memilih tabel
  $cek_data = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email = '$email' AND password = '$password'");
  $hasil = mysqli_fetch_array($cek_data);

  if ($hasil) {
    $akses = $hasil['akses'];
    $row = mysqli_num_rows($cek_data);

    // cek remember me
    if (isset($_POST['remember'])) {
      // buat cookie
      setcookie('id', $hasil['id'], time() + 60);
      setcookie('key', hash('sha256', $hasil['email']), time() + 60);
    }

    // Pengecekan Kondisi Login Berhasil/Tidak
    if ($row > 0) {
      $_SESSION['login_user'] = $email;
      $_SESSION['user_id'] = $hasil['id']; // Simpan ID pengguna dalam sesi
      $_SESSION['nama_pengguna'] = $hasil['nama']; // Simpan nama pengguna dalam sesi

      if ($akses == 'admin') {
        header('location: dashboard/home.php');
        exit; // Tambahkan exit setelah mengarahkan pengguna ke halaman tujuan
      } elseif ($akses == 'user') {
        header('location: kamar.php');
        exit; // Tambahkan exit setelah mengarahkan pengguna ke halaman tujuan
      }
    } else {
      $login_error = "Email atau password salah"; // Set pesan error
    }
  } else {
    $login_error = "Email atau password salah"; // Set pesan error
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Manasa Agrowisata</title>
  <link rel="stylesheet" href="css/bootstrap.css">

  <style>
    body {
      background-color: #025464;
    }
  </style>
</head>

<body>
  <!-- Form Login -->
  <div class="container ">
    <div class="row justify-content-center mt-5">

      <div class="col-md-6">
        <div class="card shadow-lg">
          <div class="card-header" style="background-color: #99DBF5;">
            <h4 class="text-center text-dark">Silahkan <span style="color: #025464;">Login</span></h4>
          </div>
          <div class="card-body" style="background-color: #98EECC;">
            <form action="" method="POST">
              <?php if ($login_error) : ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $login_error; ?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
              </div>
              <div class="text-center mt-3">
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <!-- <div class="form-check mb-0">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" name="remember" />
                  <label class="form-check-label" for="form2Example3" type="remember" id="remember">
                    Remember me
                  </label>
                </div> -->

              </div>
              <div class="text-center text-lg-start pt-2">
                <p class="small fw-bold mt-2 pt-1 mb-0">Belum Punya Akun? <a href="register.php" class="link-danger" style="text-decoration: none;">Daftar</a></p>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Eksekusi Form Login -->
  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>