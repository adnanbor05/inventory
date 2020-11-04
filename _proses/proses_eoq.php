<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	$id_konfigurasi = trim(mysqli_real_escape_string($koneksi, $_POST['id_konfigurasi']));
	// hilangkan / ganti
	// $jenis_barang = trim(mysqli_real_escape_string($koneksi, $_POST['jenis_barang']));
	$jadwal = trim(mysqli_real_escape_string($koneksi, $_POST['jadwal']));

	$periode = trim(mysqli_real_escape_string($koneksi, $_POST['periode']));
	
	$konv_tahun = trim(mysqli_real_escape_string($koneksi, $_POST['konv_tahun']));
	$harga = trim(mysqli_real_escape_string($koneksi, $_POST['harga']));
	$deman = trim(mysqli_real_escape_string($koneksi, $_POST['deman']));

	$b_pemesanan = trim(mysqli_real_escape_string($koneksi, $_POST['b_pemesanan']));
	$b_penyimpanan = trim(mysqli_real_escape_string($koneksi, $_POST['b_penyimpanan']));

	$hari_kerja = trim(mysqli_real_escape_string($koneksi, $_POST['hari_kerja']));

	// perhitungan EOQ
	$jumlah=2*$_POST['deman']*$_POST['b_pemesanan']/$_POST['b_penyimpanan'];
	$eoq= sqrt($jumlah);

	$frekuensi_pemesanan = $_POST['deman']/$eoq;
	$jarak_pemesanan = $_POST['hari_kerja']/$frekuensi_pemesanan;

	//perhitungan TC
	$tc = $_POST['deman']/$eoq*$_POST['b_pemesanan']+$eoq/2*$_POST['b_penyimpanan']+$_POST['harga']*$_POST['deman'];



	


	// insert ke database
	mysqli_query($koneksi, "INSERT INTO eoq_rop (periode, id_konfigurasi, konv_tahun, deman, b_pemesanan, b_penyimpanan, tc, jarak_pemesanan, frekuensi_pemesanan, jadwal, eoq) VALUES ('$periode', '$id_konfigurasi', '$konv_tahun','$deman','$b_pemesanan','$b_penyimpanan','$tc','$jarak_pemesanan','$frekuensi_pemesanan','$jadwal','$eoq')") or die (mysqli_error($koneksi));
	echo "<script>window.location='../admin/eoq.php'</script>";

}
?>
<!-- proses eoq ada yang salah. yang salah id_eoq. saat input perhitungan -->
