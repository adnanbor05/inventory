<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM pesan WHERE id_pesan = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../petugas/chat.php'</script>";
?>