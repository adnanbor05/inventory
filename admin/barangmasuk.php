<?php 
session_start();
include_once('_header.php'); 
?>
<?php error_reporting(E_ALL ^ (E_NOTICE)); ?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading"> Data Detail Barang Masuk</div>
			<div class="panel-body">
				<div style="margin-bottom: 10px;">
					<form class="form-inline" action="" method="post">
						<div class="form-group">
							<input type="text" size="30" name="pencarian" class="form-control" placeholder="Pencarian berdasarkan nama barang">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
						</div>
						<div class="form-group">
							<a href="" class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</a>
						</div>
						<div class="pull-right" style="margin-bottom: 10px;">
							<a href="addBarangmsk.php" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Barang </a>  
						</div>
					</form>
				</div>
				<div class="table-responsive" style="overflow-x: auto;">
					<table class="table table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">User</th>
								<th class="text-center">Tanggal Masuk</th>
								<th class="text-center">Kode Kopi</th>
								<th class="text-center">Nama Kopi</th>
								<th class="text-center">Nama Supplier</th>
								<th class="text-center">Jumlah Masuk</th>
								<th class="text-center">Total Transaksi</th>
								<th class="text-center">Opsi</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$no = 1;
							$batas = 10;
							$hal = @$_GET['hal'];
							if (empty($hal)) {
								$posisi = 0;
								$hal = 1;
							} else {
								$posisi = ($hal - 1) * $batas;
							}

							if ($_SERVER['REQUEST_METHOD'] == "POST") {
								$pencarian = trim(mysqli_real_escape_string($koneksi, $_POST['pencarian']));
								if ($pencarian != '') {
									$sql = "SELECT * FROM brg_masuk JOIN supplier ON brg_masuk.kode_supp = supplier.kode_supp JOIN barang ON barang.kode_barang = brg_masuk.kode_barang JOIN user ON brg_masuk.id_user = user.id_user WHERE nama_barang LIKE '%$pencarian%'";
									$query = $sql;
									$queryJml = $sql;
								} else {
									$query = "SELECT * FROM brg_masuk JOIN supplier ON brg_masuk.kode_supp = supplier.kode_supp JOIN barang ON barang.kode_barang = brg_masuk.kode_barang JOIN user ON brg_masuk.id_user = user.id_user ORDER BY id_brgmsk DESC LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM brg_masuk JOIN supplier ON brg_masuk.kode_supp = supplier.kode_supp JOIN barang ON barang.kode_barang = brg_masuk.kode_barang  JOIN user ON brg_masuk.id_user = user.id_user";
							$no = $posisi + 1;
								}
							} else {
								$query = "SELECT * FROM brg_masuk JOIN supplier ON brg_masuk.kode_supp = supplier.kode_supp JOIN barang ON barang.kode_barang = brg_masuk.kode_barang JOIN user ON brg_masuk.id_user = user.id_user ORDER BY id_brgmsk DESC LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM brg_masuk JOIN supplier ON brg_masuk.kode_supp = supplier.kode_supp JOIN barang ON barang.kode_barang = brg_masuk.kode_barang JOIN user ON brg_masuk.id_user = user.id_user";
							$no = $posisi + 1;
							}

							$sql_detBarangmsk = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
							if (mysqli_num_rows($sql_detBarangmsk) > 0) {
								while ($data = mysqli_fetch_array($sql_detBarangmsk)) { ?>
									<tr>
										<td class="text-center"><?=$no++?>.</td>
										<td><?=$data['nama']?></td>
										<td class="text-center"><?=$data['tanggal_msk']?></td>
										<td class="text-center"><?=$data['kode_barang']?></td>
										<td class="text-center"><?=$data['nama_barang']?></td>
										
										<td class="text-center"><?=$data['nama_supp']?></td>
										<td class="text-center"><?=$data['jumlah_brg']?> Pcs</td>
										
										<td class="text-center">Rp. <?=number_format($data['total_transaksi'], 0, ',', '.')?></td>
										<td class="text-center">

											<a href="../_proses/delBarangmsk.php?id=<?=$data['id_brgmsk']?>&&kd=<?=$data['kode_barang']?>" onclick="return confirm('Yakin akan menghapus data <?=$data['nama_barang']?> ini?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-xs"></i></a>
										</td>
									</tr>
									<?php
								}
							} else {
								echo "<tr><td colspan=\"12\" align=\"center\">Data tidak ditemukan</td></tr>";
							}
							?>
						</tbody>
					</table>			
				</div> <!-- table responsive -->

				<?php
				if ($_POST['pencarian'] == '') { ?>
					<div style="float:left;">
						<?php  
						$jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
						echo "Jumlah Data : <b>$jml</b>"; 
						?>
						<br><br>
						<div class="pull-left">
							<a data-toggle="modal" data-target="#cetakBarangmsk" class="btn btn-default"><i class="fa fa-print"></i> Export PDF</a>
						</div>
					</div>
					<div style="float: right;">
						<ul class="pagination" style="margin: 0">
							<?php  
							$jml_hal = ceil($jml / $batas);
							for ($i=1; $i <= $jml_hal; $i++) { 
								if ($i != $hal) {
									echo "<li><a href=\"?hal=$i\">$i</a></li>";
								} else {
									echo "<li class=\"active\"><a>$i</a></li>";
								}
							}
							?>
						</ul>                                
					</div>
					<?php  
				} else {
					echo "<div <style=\"float:left;\">";
					$jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
					echo "Data Hasil Pencarian : <b>$jml</b>";
					echo "</div>";
				}
				?>

			</div>
		</div>
		
	</div>
</div><!-- /.row -->
	</section>
</div>

<?php include_once('_footer.php'); ?>