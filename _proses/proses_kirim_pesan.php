<!-- PROSES USER -->
<?php 
require_once'../_config/koneksi.php'; 
$pengirim_kirim_pesan = $_POST['pengirim_kirim_pesan'];
$penerima_kirim_pesan = $_POST['penerima_kirim_pesan'];
$subyek_kirim_pesan = $_POST['subyek_kirim_pesan'];
$isi_kirim_pesan = $_POST['isi_kirim_pesan'];
$tanggal = date('y-m-d');

// if (!(int)$penerima_kirim_pesan) {
// 	die(pesan(0, "<script>window.location='../admin/contoh_chat.php?pesan=gagal'</script>"));
// }

// $isi = mysqli_query($koneksi, "INSERT INTO pesan(id_pengirim, id_penerima, subyek_pesan, isi_pesan, tanggal, sudah_dibaca) VALUES ('$pengirim_kirim_pesan','$penerima_kirim_pesan','$subyek_kirim_pesan','$isi_kirim_pesan','$tanggal','belum')");
// die(pesan(1, "<script>alert('pesan berhasil');window.location='../admin/contoh_chat.php'</script>"));

// function pesan ($status, $teks){
// 	return'{"status" : '.$status.', "teks" :"'.$teks.'"';
// }
if (empty($penerima_kirim_pesan)) {
	echo "<script>alert('pesan gagal');window.location='../admin/chat.php'</script>";
} else {
	mysqli_query($koneksi, "INSERT INTO pesan(id_pengirim, id_penerima, subyek_pesan, isi_pesan, tanggal, sudah_dibaca) VALUES ('$pengirim_kirim_pesan','$penerima_kirim_pesan','$subyek_kirim_pesan','$isi_kirim_pesan','$tanggal','belum')");
	echo "<script>alert('pesan berhasil');window.location='../admin/chat.php'</script>";
}
?>


