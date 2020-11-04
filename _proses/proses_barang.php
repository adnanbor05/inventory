<!-- PROSE BARANG -->
<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	// $id_user = trim(mysqli_real_escape_string($koneksi, $_POST['id_user']));
	
	$kd_brg = trim(mysqli_real_escape_string($koneksi, $_POST['kd_brg']));
	$nm_brg = trim(mysqli_real_escape_string($koneksi, $_POST['nm_brg']));
	$jns_brg = trim(mysqli_real_escape_string($koneksi, $_POST['jns_brg']));
	$harga_barang = trim(mysqli_real_escape_string($koneksi, $_POST['harga_barang']));

	$sql_cek_kodebrg = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang = '$kd_brg'")  or die (mysqli_error($koneksi));
	if (mysqli_num_rows($sql_cek_kodebrg) > 0) {
		// echo "<script>alert('Kode Supplier sudah pernah di input!');  window.location='../admin/dataSupp.php'</script>";
		echo "<script>window.location='../admin/addBarang.php?pesan=gagal'</script>";
	} else {
		mysqli_query($koneksi, "INSERT INTO barang (kode_barang, nama_barang, kode_jenis, harga_barang) VALUES ('$kd_brg', '$nm_brg', '$jns_brg', '$harga_barang')") or die (mysqli_error($koneksi));
		echo "<script>window.location='../admin/dataBarang.php'</script>";
	}
}elseif (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$kd_brg = trim(mysqli_real_escape_string($koneksi, $_POST['kd_brg']));
	$nm_brg = trim(mysqli_real_escape_string($koneksi, $_POST['nm_brg']));
	$jns_brg = trim(mysqli_real_escape_string($koneksi, $_POST['jns_brg']));
	$harga_barang = trim(mysqli_real_escape_string($koneksi, $_POST['harga_barang']));

	mysqli_query($koneksi, "UPDATE barang SET nama_barang = '$nm_brg', kode_jenis = '$jns_brg', harga_barang = '$harga_barang' WHERE kode_barang = '$kd_brg'") or die (mysqli_error($koneksi));
	echo "<script>window.location='../admin/dataBarang.php'</script>";
}