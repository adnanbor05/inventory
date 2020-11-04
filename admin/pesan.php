<?php 
session_start();
include_once('_header.php');

$id_member = $_SESSION['id_user'];
?>
<!-- Content Wrapper. Contains page content -->
<style type="text/css">
	.tabel_pesan{
  background-color: #fafafa ;
}
.tabel_pesan tr th {
  background-color: #abcdef;
  text-align: left;
}
tabel_pesan tr td{
  border-bottom: 2px solid #fff;
}
.tabel_belum{
  background-color: yellow;
  font-weight: bold;
}
.tabel_belum a{
  color: #000;
}
</style>
<div class="content-wrapper">
	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading"> Inbox Pesan
					</div>
					<div class="panel-body">
						<p><a href="chat.php">&laquo; Kembali</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="ke_kirim_pesan">Kirim pesan</a></p>
						<!--  -->
						<div id="kirim_pesan">
							<form method="post" id="form_kirim_pesan">
								Penerima <br>
								<select name="penerima_kirim_pesan" id="penerima_kirim_pesan">
									<option value="0"> -pilih penerima - </option>
									<?php
									$query_penerima = mysqli_query($koneksi, "SELECT id_user, nama FROM user WHERE id_user != $id_member");
									while ($daftar_penerima = mysqli_fetch_array($query_penerima)) {
									?>
									<option value="<?php echo $daftar_penerima['id_member']; ?>"><?php echo $daftar_penerima['nama']; ?></option>
									<?php
									 } 
									?>
								</select><br><br>
								Subyek Pesan <br>
								<input type="text" id="subyek_kirim_pesan" name="subyek_kirim_pesan" cellspacing="0">
								<br><br>
								Isi Pesan <br>
								<textarea id="isi_kirim_pesan" name="isi_kirim_pesan" cellpadding="5" cellspacing="0"></textarea>
								<br><br>
								<input type="submit" name="submit_kirim_pesan" value="Kirim Pesan">
								<br>

							</form>
						</div>
						<!--  -->


						<table width="600" class="table_pesan" cellpadding="5" cellspacing="0">
							<thead>
								<tr>
									<th>Pengirim</th>
									<th>Subyek Pesan</th>
									<th>Tanggal</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$query_daftar_pesan = mysqli_query($koneksi,"SELECT P.*, M.id_user, M.nama FROM pesan P, user M WHERE P.id_pengirim=M.id_user AND P.id_penerima='$id_member' ORDER BY P.id_pesan DESC");

								while ($daftar_pesan = mysqli_fetch_array($query_daftar_pesan)){
									if ($daftar_pesan['sudah_dibaca'] == "belum") {
										
										?>
										<tr class="pesan pesan_belum">
											<td><?php echo $daftar_pesan['nama']; ?></td>
											<td><a href="buka_pesan.php?id_user=<?php echo $id_member; ?>$id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a></td>
											<td><?php echo $daftar_pesan['tanggal']; ?></td>
										</tr>
									<?php } 
									elseif ($daftar_pesan['sudah_dibaca'] == "sudah") {
										?>
										<tr class="pesan">
											<td><?php echo $daftar_pesan['nama']; ?></td>
											<td><a href="buka_pesan.php?id_user=<?php echo $id_member; ?>$id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a></td>
											<td><?php echo $daftar_pesan['tanggal']; ?></td>
										</tr>

										<?php
									}

								} ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
		
	</section>
</div>
<?php include_once('_footer.php'); ?>