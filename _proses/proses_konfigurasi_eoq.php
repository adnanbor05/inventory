<!-- PROSES konfigurasi_eoq -->
<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	$tahun = trim(mysqli_real_escape_string($koneksi, $_POST['tahun']));
	$nama_barang = trim(mysqli_real_escape_string($koneksi, $_POST['nama_barang']));
	$kode_barang = trim(mysqli_real_escape_string($koneksi, $_POST['kode_barang']));
	$harga = trim(mysqli_real_escape_string($koneksi, $_POST['harga']));
	$deman = trim(mysqli_real_escape_string($koneksi, $_POST['deman']));

	$pemesanan_bulan = trim(mysqli_real_escape_string($koneksi, $_POST['pemesanan_bulan']));
	//hitung pemesanan perbulan
	$perbulan=12*$_POST['pemesanan_bulan'];

	//BIAYA PEMESANAN
	$jml_panggilan = trim(mysqli_real_escape_string($koneksi, $_POST['jml_panggilan']));
	$b_telepon = trim(mysqli_real_escape_string($koneksi, $_POST['b_telepon']));
	//hitung biaya telepon
	$biaya_telepon = ($_POST['jml_panggilan']*$_POST['b_telepon']);

	$jml_kirim = trim(mysqli_real_escape_string($koneksi, $_POST['jml_kirim']));
	$b_jasa = trim(mysqli_real_escape_string($koneksi, $_POST['b_jasa']));
	//hitung biaya jasa
	$biaya_jasa = ($_POST['jml_kirim']*$_POST['b_jasa']);

	//BIAYA PENYIMPANAN
	//hitung biaya listrik perbulan
	$b_listrik = trim(mysqli_real_escape_string($koneksi, $_POST['b_listrik']));
	$biaya_listrik = ($_POST['b_listrik']*12);
	//hitung biaya jasa perbulan
	$b_tenaga = trim(mysqli_real_escape_string($koneksi, $_POST['b_tenaga']));
	$biaya_tenaga = ($_POST['b_tenaga']*12);


	// hitung biaya
	$b_pemesanan = ($biaya_telepon+$biaya_jasa)/$perbulan;

	$b_penyimpanan = ($biaya_listrik+$biaya_tenaga)/$_POST['deman'];

	mysqli_query($koneksi, "INSERT INTO konfigurasi_eoq (tahun, nama_barang, kode_barang, harga, deman, b_pemesanan, b_penyimpanan) VALUES ('$tahun','$nama_barang','$kode_barang','$harga', '$deman', '$b_pemesanan', '$b_penyimpanan')") or die (mysqli_error($koneksi));
	echo "<script>window.location='../admin/konfigurasi_eoq.php'</script>";
}elseif (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$tahun = trim(mysqli_real_escape_string($koneksi, $_POST['tahun']));
	$nama_barang = trim(mysqli_real_escape_string($koneksi, $_POST['nama_barang']));
	$deman = trim(mysqli_real_escape_string($koneksi, $_POST['deman']));
	$b_pemesanan = trim(mysqli_real_escape_string($koneksi, $_POST['b_pemesanan']));
	$b_penyimpanan = trim(mysqli_real_escape_string($koneksi, $_POST['b_penyimpanan']));
	

	mysqli_query($koneksi, "UPDATE konfigurasi_eoq SET tahun = '$tahun', nama_barang = '$nama_barang' WHERE id_konfigurasi = '$id'") or die (mysqli_error($koneksi));
	echo "<script>window.location='../admin/konfigurasi_eoq.php'</script>";
}
?>