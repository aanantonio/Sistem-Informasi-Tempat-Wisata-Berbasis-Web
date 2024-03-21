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



function hapus($id)
{
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM transaksi where id_transaksi = $id");

  return mysqli_affected_rows($koneksi);
}

function ubah($data)
{
  global $koneksi;

  $id = $data["id_transaksi"];
  $tgl_in = htmlspecialchars($data["tgl_in"]);
  $tgl_out = htmlspecialchars($data["tgl_out"]);
  $total_harga = htmlspecialchars($data["total_harga"]);
  $status = htmlspecialchars($data["status"]);


  // query insert data
  $query = "UPDATE transaksi SET
 tgl_in = '$tgl_in',
 tgl_out = '$tgl_out',
 status = '$status'


 WHERE id_transaksi = $id
";
  mysqli_query($koneksi, $query);


  return mysqli_affected_rows($koneksi);
}
