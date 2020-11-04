<!-- PROSES BARANG MASUK -->
<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	// $tgl_msk = date('d-m-Y');
	$id_user = trim(mysqli_real_escape_string($koneksi, $_POST['id_user']));
	$kd_supp = trim(mysqli_real_escape_string($koneksi, $_POST['kd_supp']));
	$kode_barang = trim(mysqli_real_escape_string($koneksi, $_POST['kode_barang']));
	$tgl_msk = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_msk']));
	$nm_brg = trim(mysqli_real_escape_string($koneksi, $_POST['nm_brg']));
	$nama_jenis = trim(mysqli_real_escape_string($koneksi, $_POST['nama_jenis']));
	$harga_barang = trim(mysqli_real_escape_string($koneksi, $_POST['harga_barang']));
	$jml_brg = trim(mysqli_real_escape_string($koneksi, $_POST['jml_brg']));
	$total_stok = trim(mysqli_real_escape_string($koneksi, $_POST['total_stok']));
	$tot_trans = ($harga_barang * $jml_brg);

	$qry = mysqli_query($koneksi, "INSERT INTO brg_masuk (id_user, kode_barang, kode_supp, jumlah_brg, tanggal_msk, total_transaksi) VALUES ('$id_user','$kode_barang', '$kd_supp', '$jml_brg', '$tgl_msk', '$tot_trans')") or die (mysqli_error($koneksi));
	if ($qry) {
		$qry1 = mysqli_query($koneksi, "UPDATE barang SET stok_barang = '$total_stok' WHERE kode_barang = '$kode_barang'") or die ('ada kesalahan pada query update : '.mysqli_error($koneksi));

		if ($qry1) {
			echo "<script>window.location='../admin/barangmasuk.php'</script>";
		}
	}
	


}elseif (isset($_POST['edit'])) {
	$id = $_POST['id'];

	$kode_barang = trim(mysqli_real_escape_string($koneksi, $_POST['kode_barang']));
	$nm_brg = trim(mysqli_real_escape_string($koneksi, $_POST['nm_brg']));
	$nama_jenis = trim(mysqli_real_escape_string($koneksi, $_POST['nama_jenis']));
	$harga_barang = trim(mysqli_real_escape_string($koneksi, $_POST['harga_barang']));
	$jml_brg = trim(mysqli_real_escape_string($koneksi, $_POST['jml_brg']));
	$tot_trans = ($harga_barang * $jml_brg);

	mysqli_query($koneksi, "UPDATE barang SET nama_barang = '$nm_brg', kode_jenis = '$nama_jenis', stok_barang='$jml_brg' WHERE kode_barang = '$kode_barang'") or die (mysqli_error($koneksi));
	
	mysqli_query($koneksi, "UPDATE brg_masuk SET kode_barang = '$kode_barang', kode_jenis = '$nama_jenis', harga = '$harga_barang', jumlah_brg = '$jml_brg', total_transaksi = '$tot_trans' WHERE id_brgmsk = '$id'") or die (mysqli_error($koneksi));
	
	echo "<script>window.location='../admin/barangmasuk.php'</script>";
}
?>