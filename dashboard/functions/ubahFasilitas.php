<?php
require 'functionsFasilitas.php';

// ambil data di URL
$id_fasilitas = isset($_GET["id_fasilitas"]) ? $_GET["id_fasilitas"] : 0; // Memastikan variabel $id_fasilitas tidak kosong
$id_fasilitas = intval($id_fasilitas); // Mengonversi nilai $id_fasilitas menjadi integer

// Query data fasilitas berdasarkan id_fasilitas dengan prepared statement
$query = "SELECT * FROM fasilitas WHERE id_fasilitas = ?";
$result = query($query, [$id_fasilitas]);

if (!empty($result)) {
  $f = $result[0];
} else {
  // Handle jika data tidak ditemukan

  echo "Data fasilitas tidak ditemukan.";
  exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
}






// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (ubahFasilitas($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil diubah!');
 				document.location.href = '../fasilitas.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal diubah!');
  			document.location.href = 'ubahFasilitas.php';
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
  <title> Fasilitas | Manasa Agrowisata</title>

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
      <p class="text-center text-dark fw-bold fs-2">Ubah Data Fasilitas</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_fasilitas" value="<?= $f["id_fasilitas"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $f["gambar_fasilitas"]; ?>">
        <div class="col-md-12">
          <label for="namaFasilitas" class="form-label text-dark h5">Nama Fasilitas</label>
          <input type="text" class="form-control" name="namaFasilitas" id="namaFasilitas" required value="<?= isset($f['namaFasilitas']) ? $f['namaFasilitas'] : ''; ?>">
        </div>
        <div class="col-md-12">
          <label for="gambar_fasilitas" class="form-label text-dark h5">Gambar</label>
          <img src="../../img/<?= $f['gambar_fasilitas']; ?>" alt="" class="img-thumbnail rounded">
          <input class="form-control" type="file" name="gambar_fasilitas" id="gambar_fasilitas" value="<?= isset($f['gambar_fasilitas']) ? $f['gambar_fasilitas'] : ''; ?>">
        </div>
        <div class="col-12">
          <label for="deskripsi_fasilitas" class="form-label text-dark h5">Deskripsi</label>
          <input type="text" class="form-control" name="deskripsi_fasilitas" id="deskripsi_fasilitas" required value="<?= isset($f['deskripsi_fasilitas']) ? $f['deskripsi_fasilitas'] : ''; ?>">
        </div>
        <div class="col-12">
          <label for="tgl_ubah" class="form-label text-dark h5">Tanggal Tambah</label>
          <input type="date" class="form-control" name="tgl_ubah" id="tgl_ubah" required value="<?= isset($f['tgl_ubah']) ? $f['tgl_ubah'] : ''; ?>">
        </div>

        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Ubah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../fasilitas.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>