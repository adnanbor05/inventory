<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM brg_masuk WHERE id_brgmsk = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../petugas/barangmasuk.php'</script>";
?>