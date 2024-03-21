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


function query($query, $params = [])
{
  global $koneksi;

  $stmt = mysqli_prepare($koneksi, $query);
  if ($stmt === false) {
    die("Query preparation failed: " . mysqli_error($koneksi));
  }

  if (!empty($params)) {
    $types = '';
    $paramsRef = [];
    foreach ($params as $param) {
      if (is_int($param)) {
        $types .= 'i'; // integer
      } elseif (is_double($param)) {
        $types .= 'd'; // double
      } elseif (is_string($param)) {
        $types .= 's'; // string
      } else {
        $types .= 'b'; // blob
      }
      $paramsRef[] = &$param;
    }

    array_unshift($paramsRef, $stmt, $types);
    $bindResult = call_user_func_array('mysqli_stmt_bind_param', $paramsRef);
    if ($bindResult === false) {
      die("Binding parameters failed: " . mysqli_error($koneksi));
    }
  }

  $executeResult = mysqli_stmt_execute($stmt);
  if ($executeResult === false) {
    die("Query execution failed: " . mysqli_error($koneksi));
  }

  $result = mysqli_stmt_get_result($stmt);
  if ($result === false) {
    die("Getting result set failed: " . mysqli_error($koneksi));
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  mysqli_stmt_close($stmt);

  return $rows;
}


function tambahHome($data)
{
  global $koneksi;

  // ambil data dari tiap elemen dalam form
  $judulHome = htmlspecialchars($data["judulHome"]);
  $deskripsiHome = htmlspecialchars($data["deskripsiHome"]);


  // upload gambar
  $gambarHome = upload();
  if (!$gambarHome) {
    return false;
  }

  // query insert data
  $query = "INSERT INTO home 
      VALUES ('', '$judulHome', '$gambarHome', '$deskripsiHome')
 			";
  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function upload()
{
  $namaFile = $_FILES['gambarHome']['name'];
  $ukuranFile = $_FILES['gambarHome']['size'];
  $error = $_FILES['gambarHome']['error'];
  $tmpName = $_FILES['gambarHome']['tmp_name'];

  // cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
    return false;
  }

  // cek apakah yang diupload adalah gambar
  $ekstensigambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensigambarValid)) {
    echo "<script>
				alert('yang anda upload bukan gambar!');
			 </script>";

    return false;
  }

  // cek ukurannya terlalu besar
  if ($ukuranFile > 1000000) {
    echo "<script>alert('Ukuran gambar terlalu besar');</script>";
    return false;
  }

  // lolos pengecekan, gambar siap diupload
  // generate nama gambar baru
  $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

  move_uploaded_file($tmpName, '../../img/' . $namaFileBaru);

  return $namaFileBaru;
}


function hapusHome($idHome)
{
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM home where idHome = $idHome");

  return mysqli_affected_rows($koneksi);
}

function ubahHome($data)
{
  global $koneksi;

  $idHome = $data["idHome"];
  $judulHome = htmlspecialchars($data["judulHome"]);
  $deskripsiHome = htmlspecialchars($data["deskripsiHome"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar baru atau tidak 
  if ($_FILES['gambarHome']['error'] === 4) {
    $gambarHome = $gambarLama;
  } else {
    $gambarHome = upload();
  }


  // query insert data
  $query = "UPDATE home SET
 				judulHome = '$judulHome',
 				gambarHome = '$gambarHome',
 				deskripsiHome = '$deskripsiHome'

 				WHERE idHome = $idHome
 			";
  mysqli_query($koneksi, $query);


  return mysqli_affected_rows($koneksi);
}
