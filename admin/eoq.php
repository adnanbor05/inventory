<?php 
session_start();
include_once('_header.php'); 
include_once('../_config/koneksi.php');
?>
<?php error_reporting(E_ALL ^ (E_NOTICE)); ?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading"> Data Perhitungan EOQ</div>
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
								<div class="pull-right">
									<a href="addeoq.php" class="btn btn-success"><i class="fa fa-plus"></i> New EOQ </a>     
								</div>
							</form>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-condensed" width="100%">
								<thead>
									<tr>
										<th class="text-center">No.</th> 
										<th class="text-center">Nama Barang</th>
										<!-- <th class="text-center">Jenis Barang</th> -->
										<th class="text-center">Konfigurasi Periode</th>
										<th class="text-center">Total Pemakaian</th>
										<th class="text-center">Biaya Pemesanan</th>
										<th class="text-center">Biaya Penyimpanan</th>
										<th class="text-center">Total Cost</th>
										<th class="text-center">Frekuensi Pemesanan</th>
										<th class="text-center">Jarak Antar Pesanan</th>
										<th class="text-center">Tanggal Awal Pesanan</th>
										<th class="text-center">EOQ Periode</th>
										<th class="text-center">EOQ</th>
										<!-- <th class="text-center">ROP</th> -->

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
											$sql = "SELECT * FROM eoq_rop JOIN konfigurasi_eoq ON konfigurasi_eoq.id_konfigurasi = eoq_rop.id_konfigurasi WHERE nama_barang LIKE '%$pencarian%'";
											$query = $sql;
											$queryJml = $sql;
										} else {
											$query = "SELECT * FROM eoq_rop JOIN konfigurasi_eoq ON konfigurasi_eoq.id_konfigurasi = eoq_rop.id_konfigurasi ORDER BY id_eoq DESC LIMIT $posisi, $batas";
											$queryJml = "SELECT * FROM eoq_rop";
											$no = $posisi + 1;
										}
									} else {
										$query = "SELECT * FROM eoq_rop JOIN konfigurasi_eoq ON konfigurasi_eoq.id_konfigurasi = eoq_rop.id_konfigurasi ORDER BY id_eoq DESC LIMIT $posisi, $batas";
										$queryJml = "SELECT * FROM eoq_rop";
										$no = $posisi + 1;
									}

									$sql_eoq = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
									if (mysqli_num_rows($sql_eoq) > 0) {
										while ($data = mysqli_fetch_array($sql_eoq)) { ?>
											<tr>
												<td class="text-center"><?=$no++?>.</td>
												<td class="text-center"><?=$data['nama_barang']?></td>
												<td class="text-center"><?=$data['konv_tahun']?></td>
												<td class="text-center"><?=number_format($data['deman'], 0, ',', '.')?> Pcs</td>
												<td class="text-center">Rp. <?=number_format($data['b_pemesanan'], 0, ',', '.')?></td>
												<td class="text-center">Rp. <?=number_format($data['b_penyimpanan'], 0, ',', '.')?></td>
												<td class="text-center">Rp. <?=number_format($data['tc'], 0, ',', '.')?></td>
												<td class="text-center"><?=$data['frekuensi_pemesanan']?></td>
												<td class="text-center"><?=$data['jarak_pemesanan']?></td>
												<td class="text-center"><?=$data['jadwal']?></td>
												<td class="text-center"><?=$data['periode']?></td>
												<td class="text-center"><?=$data['eoq']?> Pcs</td>
												
												
												<td class="text-center">
													<a href="hasileoq.php?id=<?=$data['id_eoq']?>"><i class="fa fa-eye"></i></a>
										
													<a href="../_proses/deleoq.php?id=<?=$data['id_eoq']?>" onclick="return confirm('Yakin akan menghapus data perhitungan EOQ untuk periode tahun <?=$data['periode']?> ini?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-xs"></i></a>
												</td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan=\"6\" align=\"center\">Data tidak ditemukan</td></tr>";
									}
									?>
								</tbody>
							</table>
						</div>

						<?php
						if ($_POST['pencarian'] == '') { ?>
							<div style="float:left;">
								<?php  
								$jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
								echo "Jumlah Data : <b>$jml</b>"; 
								?>
								<br><br>
								<!-- cetak perhitungan -->
								<!-- <div class="pull-left">
									<a href="../_laporan/cetak_eoq.php" class="btn btn-default"><i class="fa fa-print"></i> Export PDF</a>
								</div> -->
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