<!-- PROSE SUPPLIER -->
<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	$kd_supp = trim(mysqli_real_escape_string($koneksi, $_POST['kd_supp']));
	$nm_supp = trim(mysqli_real_escape_string($koneksi, $_POST['nm_supp']));
	$alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
	$no_telp = trim(mysqli_real_escape_string($koneksi, $_POST['no_telp']));

	$sql_cek_kodesupp = mysqli_query($koneksi, "SELECT * FROM supplier WHERE kode_supp = '$kd_supp'")  or die (mysqli_error($koneksi));
	if (mysqli_num_rows($sql_cek_kodesupp) > 0) {
		// echo "<script>alert('Kode Supplier sudah pernah di input!');  window.location='../admin/dataSupp.php'</script>";
		echo "<script>window.location='../petugas/dataSupp.php?pesan=gagal'</script>";
	} else {
		mysqli_query($koneksi, "INSERT INTO supplier (kode_supp, nama_supp, alamat_supp, no_telepon) VALUES ('$kd_supp', '$nm_supp','$alamat','$no_telp')") or die (mysqli_error($koneksi));
		echo "<script>window.location='../petugas/dataSupp.php'</script>";
	}
}elseif (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$kd_supp = trim(mysqli_real_escape_string($koneksi, $_POST['kd_supp']));
	$nm_supp = trim(mysqli_real_escape_string($koneksi, $_POST['nm_supp']));
	$alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
	$no_telp = trim(mysqli_real_escape_string($koneksi, $_POST['no_telp']));

	mysqli_query($koneksi, "UPDATE supplier SET nama_supp = '$nm_supp', alamat_supp = '$alamat', no_telepon = '$no_telp' WHERE kode_supp = '$kd_supp'") or die (mysqli_error($koneksi));

	echo "<script>window.location='../petugas/dataSupp.php'</script>";
}