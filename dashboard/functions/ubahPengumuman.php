<?php
require 'functionsPengumuman.php';

// ambil data di URL
$idPengumuman = isset($_GET["idPengumuman"]) ? $_GET["idPengumuman"] : 0; // Memastikan variabel $idPengumuman tidak kosong
$idPengumuman = intval($idPengumuman); // Mengonversi nilai $idPengumuman menjadi integer

// Query data fasilitas berdasarkan idPengumuman dengan prepared statement
$query = "SELECT * FROM pengumuman WHERE idPengumuman = ?";
$result = query($query, [$idPengumuman]);

if (!empty($result)) {
  $pengumuman = $result[0];
} else {
  // Handle jika data tidak ditemukan

  echo "Data Pengumuman tidak ditemukan.";
  exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
}






// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (ubahPengumuman($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil diubah!');
 				document.location.href = '../pengumuman.php';
 			</script>
 		";
  } else {
    echo "
  		<script>
  			alert('data gagal diubah!');
  			document.location.href = 'ubahPengumuman.php';
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
      <p class="text-center text-dark fw-bold fs-2">Ubah Data Pengumuman</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idPengumuman" value="<?= $pengumuman["idPengumuman"]; ?>">
        <div class="col-md-12">
          <label for="judulPengumuman" class="form-label text-dark h5">Judul Pengumuman</label>
          <input type="text" class="form-control" name="judulPengumuman" id="judulPengumuman" required value="<?= isset($pengumuman['judulPengumuman']) ? $pengumuman['judulPengumuman'] : ''; ?>">
        </div>
        <div class="col-md-12">
          <label for="isi" class="form-label text-dark h5">Judul Pengumuman</label>
          <input type="text" class="form-control" name="isi" id="isi" required value="<?= isset($pengumuman['isi']) ? $pengumuman['isi'] : ''; ?>">
        </div>

        <div class="col-12">
          <label for="tglPost" class="form-label text-dark h5">Tanggal ubah</label>
          <input type="date" class="form-control" name="tglPost" id="tglPost" required value="<?= isset($pengumuman['tglPost']) ? $pengumuman['tglPost'] : ''; ?>">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Ubah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../pengumuman.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>