<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM konfigurasi_eoq WHERE id_konfigurasi = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../admin/konfigurasi_eoq.php'</script>";
?>