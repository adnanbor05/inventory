<!-- PROSE jenis -->
<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	$kode_jenis = trim(mysqli_real_escape_string($koneksi, $_POST['kode_jenis']));
	$nm_jenis = trim(mysqli_real_escape_string($koneksi, $_POST['nm_jenis']));

	$sql_cek_kodejns = mysqli_query($koneksi, "SELECT * FROM tb_jenis WHERE kode_jenis = '$kode_jenis'")  or die (mysqli_error($koneksi));
	if (mysqli_num_rows($sql_cek_kodejns) > 0) {
		
		echo "<script>window.location='../admin/datajenis.php?pesan=gagal'</script>";
	} else {
		mysqli_query($koneksi, "INSERT INTO tb_jenis (kode_jenis, nama_jenis) VALUES ('$kode_jenis', '$nm_jenis')") or die (mysqli_error($koneksi));
		echo "<script>window.location='../admin/datajenis.php'</script>";
	}
}elseif (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$kode_jenis = trim(mysqli_real_escape_string($koneksi, $_POST['kode_jenis']));
	$nm_jenis = trim(mysqli_real_escape_string($koneksi, $_POST['nm_jenis']));

	mysqli_query($koneksi, "UPDATE tb_jenis SET nama_jenis = '$nm_jenis' WHERE kode_jenis = '$kode_jenis'") or die (mysqli_error($koneksi));

	echo "<script>window.location='../admin/datajenis.php'</script>";
}