<?php
require 'functionsKamar.php';

// ambil data di URL
$id_kamar = isset($_GET["id_kamar"]) ? $_GET["id_kamar"] : 0; // Memastikan variabel $id_kamar tidak kosong
$id_kamar = intval($id_kamar); // Mengonversi nilai $id_kamar menjadi integer

// Query data fasilitas berdasarkan id dengan prepared statement
$query = "SELECT * FROM kamar WHERE id_kamar = ?";
$result = query($query, [$id_kamar]);

if (!empty($result)) {
  $k = $result[0];
} else {
  // Handle jika data tidak ditemukan

  echo "Data Kamar tidak ditemukan.";
  exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
}






// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (ubah($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil diubah!');
 				document.location.href = '../kamar.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal diubah!');
  		</script>
  	";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Kamar | Manasa Agrowisata</title>

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&family=Viga&display=swap" rel="stylesheet">

  <!-- My style -->
  <link rel="stylesheet" href="../../css/bootstrap.css">
</head>

<body>
  <div class="container mt-5">
    <div class="bg bg-info p-5 ">
      <p class="text-center text-dark fw-bold fs-2">Ubah Data Kamar</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_kamar" value="<?= $k["id_kamar"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $k["gambar"]; ?>">
        <div class="col-md-12">
          <label for="jenis" class="form-label text-dark h5">Jenis Kamar</label>
          <input type="text" class="form-control" name="jenis" id="jenis" required value="<?= isset($k['jenis']) ? $k['jenis'] : ''; ?>">
        </div>
        <div class="col-md-12">
          <label for="gambar" class="form-label text-dark h5">Gambar</label>
          <img src="../../img/<?= $k['gambar']; ?>" alt="" class="img-thumbnail rounded">
          <input class="form-control" type="file" name="gambar" id="gambar" value="<?= isset($k['gambar']) ? $k['gambar'] : ''; ?>">
        </div>
        <div class="col-12">
          <label for="harga" class="form-label text-dark h5">Harga</label>
          <input type="text" class="form-control" name="harga" id="harga" required value="<?= isset($k['harga']) ? $k['harga'] : ''; ?>">
        </div>

        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Ubah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../kamar.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>