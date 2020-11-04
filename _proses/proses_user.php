<!-- PROSES USER -->
<?php 
require_once'../_config/koneksi.php'; 

if (isset($_POST['tambah'])){
	$username = trim(mysqli_real_escape_string($koneksi, $_POST['username']));
	$password = trim(mysqli_real_escape_string($koneksi, $_POST['password']));
	$nama_user = trim(mysqli_real_escape_string($koneksi, $_POST['nama_user']));
	$jenis_kelamin = trim(mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']));
	$alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
	$telp = trim(mysqli_real_escape_string($koneksi, $_POST['telp']));
	$level = trim(mysqli_real_escape_string($koneksi, $_POST['level']));

	//upload foto
	// $foto = $_FILES['foto']['name'];
	// $lokasi = $_FILES['foto']['tmp_name'];
	// $folder = '../img/';
	// move_uploaded_file($lokasi, $folder.$nama_file);


	mysqli_query($koneksi, "INSERT INTO user (username, password, nama, jns_kelamin, alamat, no_telp, level) VALUES ('$username', '$password', '$nama_user', '$jenis_kelamin', '$alamat', '$telp', '$level')") or die (mysqli_error($koneksi));
	echo "<script>window.location='../admin/dataUser.php'</script>";
}elseif (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$username = trim(mysqli_real_escape_string($koneksi, $_POST['username']));
	$nama_user = trim(mysqli_real_escape_string($koneksi, $_POST['nama_user']));
	$jenis_kelamin = trim(mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']));
	$alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
	$telp = trim(mysqli_real_escape_string($koneksi, $_POST['telp']));
	$level = trim(mysqli_real_escape_string($koneksi, $_POST['level']));
	mysqli_query($koneksi, "UPDATE  user SET username = '$username', nama = '$nama_user', jns_kelamin = '$jenis_kelamin', alamat = '$alamat', no_telp = '$telp', level = '$level' WHERE id_user = '$id'") or die (mysqli_error($koneksi));
	echo "<script>window.location='../admin/dataUser.php'</script>";
}
?>