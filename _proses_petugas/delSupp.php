<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM supplier WHERE kode_supp = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../petugas/dataSupp.php'</script>";
?>