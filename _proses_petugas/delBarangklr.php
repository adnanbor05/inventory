<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM brg_kluar WHERE id_brgklr = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../petugas/dataBarangklr.php'</script>";
?>