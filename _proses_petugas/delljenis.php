<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM tb_jenis WHERE kode_jenis = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../petugas/datajenis.php'</script>";
?>