<?php  
require_once'../_config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$_GET[id]'") or die (mysqli_error($koneksi));
echo "<script>window.location='../admin/dataUser.php'</script>";
?>