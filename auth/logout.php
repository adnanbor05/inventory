<?php 
	//mengaktifkan session PHP
	session_start();
	ob_start();
	//menghapus semua session
	ob_end_clean();
	session_destroy();
	//alihkan ke halaman login kembali
	header("location:login.php");
?>