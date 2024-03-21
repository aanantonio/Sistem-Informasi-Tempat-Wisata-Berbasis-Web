<?php
require 'functionsTransaksi.php';

// ambil data di URL
$id_transaksi = isset($_GET["id_transaksi"]) ? $_GET["id_transaksi"] : 0; // Memastikan variabel $id_transaksi tidak kosong
$id_transaksi = intval($id_transaksi); // Mengonversi nilai $id_transaksi menjadi integer

// Query data fasilitas berdasarkan id dengan prepared statement
$query = "SELECT * FROM transaksi WHERE id_transaksi = ?";
$result = query($query, [$id_transaksi]);

if (!empty($result)) {
  $k = $result[0];
} else {
  // Handle jika data tidak ditemukan

  echo "Data Transaksi tidak ditemukan.";
  exit; // Berhenti eksekusi kode selanjutnya jika data tidak ditemukan
}






// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (ubah($_POST) > 0) {
    echo "
 			<script>
 				alert('data berhasil diubah!');
 				document.location.href = '../transaksi.php';
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
  <title> Detail Transaksi | Manasa Agrowisata</title>

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
      <p class="text-center text-dark fw-bold fs-2">Detail Data Transaksi</p>
      <form class="row g-3 contactForm mt-4" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_transaksi" value="<?= $k["id_transaksi"]; ?>">
        <div class="col-md-6">
          <label for="tgl_in" class="form-label text-dark h5">Check-in</label>
          <input type="text" class="form-control" name="tgl_in" id="tgl_in" required readonly value="<?= isset($k['tgl_in']) ? $k['tgl_in'] : ''; ?>">
        </div>
        <div class="col-md-6">
          <label for="tgl_out" class="form-label text-dark h5">Check-out</label>
          <input type="text" class="form-control" name="tgl_out" id="tgl_out" required readonly value="<?= isset($k['tgl_out']) ? $k['tgl_out'] : ''; ?>">
        </div>
        <div class="col-md-6">
          <label for="total_harga" class="form-label text-dark h5">Total Bayar</label>
          <input type="text" class="form-control" name="total_harga" id="total_harga" required readonly value="<?= isset($k['total_harga']) ? $k['total_harga'] : ''; ?>">
        </div>


        <div class="col-12">
          <label for="status" class="form-label text-dark h5">Status</label>
          <select class="form-select" name="status" id="status" required>

            <option value="Mohon Maaf, Room Penuh" <?= isset($k['status']) && $k['status'] == 'Pending' ? 'selected' : ''; ?>>Mohon Maaf, Room Penuh</option>
            <option value="Pesanan Anda selesai. Mohon lakukan pembayaran saat Check-In dalam waktu 24 jam, jika tidak pesanan akan dibatalkan. Terima kasih." <?= isset($k['status']) && $k['status'] == 'Selesai' ? 'selected' : ''; ?>>Pesanan Anda selesai. Mohon lakukan pembayaran saat Check-In dalam waktu 24 jam, jika tidak pesanan akan dibatalkan. Terima kasih.</option>
            <option value="Mohon Isi Data dengan Benar, Pesanan ini kami hapus 1x24 jam" <?= isset($k['status']) && $k['status'] == 'Selesai' ? 'selected' : ''; ?>>Mohon Isi Data dengan Benar, Pesanan ini kami hapus 1x24 jam</option>
            <!-- Tambahkan opsi status lainnya jika diperlukan -->
          </select>

        </div>

        <div class="col">
          <button type="submit" class="btn btn-warning btn-lg" name="submit">Ubah Data!</button>
        </div>
        <div class="col text-end">
          <a class="btn btn-lg text-light" href="../transaksi.php" role="button" style="background-color: #004643;">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>