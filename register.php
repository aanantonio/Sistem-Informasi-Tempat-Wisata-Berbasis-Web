<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "dbmanasa";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_set_charset($koneksi, "utf8");

function query($query)
{
  global $koneksi;
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function registrasi($data)
{
  global $koneksi;

  $nama = htmlspecialchars($data["nama"]);
  $email = strtolower(stripcslashes($data["email"]));
  $password = mysqli_real_escape_string($koneksi, $data["password"]);
  $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

  // cek email sudah terdaftar atau belum
  $result = mysqli_query($koneksi, "SELECT email FROM pengguna WHERE email = '$email'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Email sudah terdaftar!');</script>";
    return false;
  }

  // cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
    return false;
  }

  // enkripsi password


  // tambahkan user baru ke database
  mysqli_query($koneksi, "INSERT INTO pengguna (nama, email, password) VALUES ('$nama', '$email', '$password')");

  return mysqli_affected_rows($koneksi);
}

if (isset($_POST["register"])) {
  if (registrasi($_POST) > 0) {
    echo "<script>alert('User baru berhasil ditambahkan');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
  } else {
    echo mysqli_error($koneksi);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun </title>
  <link rel="stylesheet" href="css/bootstrap.css">

  <style>
    body {
      background-color: #025464;
    }
  </style>
</head>

<body>
  <!-- Form Registrasi -->
  <div class="container ">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card shadow-lg">
          <div class="card-header" style="background-color: #99DBF5;">
            <h4 class="text-center text-dark">Daftar <span style="color: #025464;">Akun</span></h4>
          </div>
          <div class="card-body" style="background-color: #98EECC;">
            <form action="" method="POST">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
              </div>
              <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Masukkan kembali password" required>
              </div>
              <div class="row">
                <div class="text-start mt-3 col">
                  <button type="submit" name="register" class="btn btn-primary">Daftar</button>
                </div>
                <div class="col mt-3 text-end">
                  <a class="btn text-light" href="login.php" role="button" style="background-color: #004643;">Kembali</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Form Registrasi -->

  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>