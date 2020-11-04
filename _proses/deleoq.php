<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM eoq_rop WHERE id_eoq = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../admin/eoq.php'</script>";
?>