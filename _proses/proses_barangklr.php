<!-- PROSE BARANG keluar -->
<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	//$tgl_klr = date("Y-m-d");
	$tgl_klr= trim(mysqli_real_escape_string($koneksi, $_POST['tgl_klr']));
	$kode_barang = trim(mysqli_real_escape_string($koneksi, $_POST['kode_barang']));
	$jml_brg = trim(mysqli_real_escape_string($koneksi, $_POST['jml_brg']));
	
	$sql_cek_stok = mysqli_query($koneksi, "SELECT stok_barang FROM barang WHERE kode_barang = '$kode_barang'")  or die (mysqli_error($koneksi));
	$result = mysqli_fetch_array($sql_cek_stok);

	$stok = $result['stok_barang'];
		if ($stok-$jml_brg < 0) {
			echo "<script>window.location='../admin/addBarangklr.php?pesan=gagal'</script>";
		} else {
			 mysqli_query($koneksi, "INSERT INTO brg_kluar (kode_barang, jumlah_brg, tanggal_klr) VALUES ('$kode_barang', '$jml_brg', '$tgl_klr')") or die (mysqli_error($koneksi));
			 mysqli_query($koneksi, "UPDATE barang SET stok_barang = stok_barang - $jml_brg WHERE kode_barang = '$kode_barang'");
			 echo "<script>window.location='../admin/dataBarangklr.php'</script>";
		}
}else {
	echo "<script>window.location='../admin/dataBarangklr.php'</script>";
}