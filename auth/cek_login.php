<?php  
	//mengaktifkan session pada php
	session_start();
	ob_start();

	//menghubungkan php dengan koneksi database
	require_once '../_config/koneksi.php';

	//menangkap data yang dikirim dari form login
	$username = $_POST['username'];
	$password = $_POST['password'];

	//menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
	//menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

	//cek apakah username dan password ditemukan pada database
	if($cek > 0){
		$data = mysqli_fetch_assoc($login);

		//cek jika user login sebagai admin
		if($data['level']=="Admin"){
			//buat session dengan login dan username
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['level'] = "admin";
			$_SESSION['status'] = "login";
			$_SESSION['id_user'] = $data['id_user'];

			//alihkan ke halaman dashboard admin
			header("location:../admin/index.php");

			//cek jika login sebagai petugas
		}else if ($data['level']=="Petugas") {
			//buat session dengan login dan username
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['level'] = "petugas";
			$_SESSION['status'] = "login";
			$_SESSION['id_user'] = $data['id_user'];

			//alihkan ke halaman dashboard petugas
			header("location:../petugas/index.php");
		}else{
			//alihkan ke halaman login kembali
			header("location:login.php?pesan=gagal");	
		}
	}else{
		//alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}
?>