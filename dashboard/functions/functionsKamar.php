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


function tambahKamar($data)
{
  global $koneksi;

  // ambil data dari tiap elemen dalam form

  $jenis = htmlspecialchars($data["jenis"]);
  $harga = htmlspecialchars($data["harga"]);

  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  // query insert data
  $query = "INSERT INTO kamar 
      VALUES ('', '$gambar', '$jenis', '$harga')
 			";
  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function upload()
{
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

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


function hapus($id_kamar)
{
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM kamar where id_kamar =$id_kamar");

  return mysqli_affected_rows($koneksi);
}

function ubah($data)
{
  global $koneksi;

  $id_kamar = $data["id_kamar"];
  $jenis = htmlspecialchars($data["jenis"]);
  $harga = htmlspecialchars($data["harga"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar baru atau tidak 
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }


  // query insert data
  $query = "UPDATE kamar SET
 				gambar = '$gambar',
 				jenis = '$jenis',
 				harga = '$harga'

 				WHERE id_kamar =$id_kamar
 			";
  mysqli_query($koneksi, $query);


  return mysqli_affected_rows($koneksi);
}
