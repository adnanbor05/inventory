<?php
	date_default_timezone_set('Asia/Jakarta');  
	$koneksi = mysqli_connect("localhost","root","","revisibkeluar");

	//cek koneksi
	if (mysqli_connect_errno()) {
		echo "Koneksi database gagal: ". mysqli_connect_error();
	}
?>