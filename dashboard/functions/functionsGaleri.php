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


function tambahGaleri($data)
{
  global $koneksi;

  // Iterasi melalui file-file yang diunggah
  for ($i = 0; $i < count($data['gambar']['name']); $i++) {
    $gambar = upload($data['gambar']['name'][$i], $data['gambar']['tmp_name'][$i], $data['gambar']['size'][$i], $data['gambar']['error'][$i]);
    if (!$gambar) {
      return false;
    }

    // query insert data
    $query = "INSERT INTO galeri (gambar) VALUES ('$gambar')";
    mysqli_query($koneksi, $query);
  }

  return true;
}

function upload($namaFile, $tmpName, $ukuranFile, $error)
{
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
				alert('Yang Anda upload bukan gambar!');
			 </script>";
    return false;
  }

  // cek ukurannya terlalu besar
  if ($ukuranFile > 10000000) {
    echo "<script>alert('Ukuran gambar terlalu besar, Maks 10MB 1 file');</script>";
    return false;
  }

  // lolos pengecekan, gambar siap diupload
  // generate nama gambar baru
  $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

  move_uploaded_file($tmpName, '../../img/' . $namaFileBaru);

  return $namaFileBaru;
}


function hapusGaleri($id)
{
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM galeri where idGaleri  = $id");

  return mysqli_affected_rows($koneksi);
}

function ubahGaleri($data)
{
  global $koneksi;

  $idGaleri = $data["idGaleri"];
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar baru atau tidak 
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload($_FILES['gambar']['name'], $_FILES['gambar']['tmp_name'], $_FILES['gambar']['size'], $_FILES['gambar']['error']);
  }



  // query insert data
  $query = "UPDATE galeri SET
          gambar = '$gambar'
 			
 				WHERE idGaleri = $idGaleri
 			";
  mysqli_query($koneksi, $query);


  return mysqli_affected_rows($koneksi);
}
