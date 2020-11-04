<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM barang WHERE kode_barang = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../admin/dataBarang.php'</script>";
?>