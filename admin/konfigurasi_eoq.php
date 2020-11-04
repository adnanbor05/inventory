<?php 
session_start();
include_once('_header.php');
require_once'../_config/koneksi.php'; 

?>
<?php error_reporting(E_ALL ^ (E_NOTICE)); ?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading"> Konvigurasi EOQ
					</div>
					<div class="panel-body">
						<div>
							<a href="addkonfigurasi_eoq.php" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Konvigurasi </a>     
						</div><br>
						<div class="table-responsive">
							<table class="table table-bordered table-striped" width="100%">
								<thead>
									<tr>
										<th class="text-center">No.</th> 
										<th class="text-center">konfigurasi Tahun</th>
										<th class="text-center">Nama Barang</th>
										<th class="text-center">harga Satuan</th>
										<th class="text-center">Deman (Pemakaian)</th>
										<th class="text-center">Biaya Pemesanan</th>
										<th class="text-center">Biaya Penyimpanan</th>
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

									$query = "SELECT * FROM konfigurasi_eoq ORDER BY id_konfigurasi DESC LIMIT $posisi, $batas";
									$queryJml = "SELECT * FROM konfigurasi_eoq";
									$no = $posisi + 1;
									$sql_user = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
									if (mysqli_num_rows($sql_user) > 0) {
										while ($data = mysqli_fetch_array($sql_user)) { ?>
											<tr>
												<td class="text-center"><?=$no++?>.</td>
												<td class="text-center"><?=$data['tahun']?></td>
												<td class="text-center"><?=$data['nama_barang']?></td>
												<td class="text-center">Rp. <?=number_format($data['harga'], 0, ',', '.')?></td>
												<th class="text-center"><?=$data['deman']?> Pcs</th>
												<td class="text-center">Rp. <?=number_format($data['b_pemesanan'], 0, ',', '.')?></td>
												<td class="text-center">Rp. <?=number_format($data['b_penyimpanan'], 0, ',', '.')?></td>
												<td class="text-center">
													<!-- hapus edit konfigurasi -->
													<!-- <a href="editkonfigurasi_eoq.php?id=//$data['id_konfigurasi']" class="btn btn-info btn-xs"><i class="fa fa-edit fa-xs"></i> Edit</a>  -->

													<a href="../_proses/delkonfigurasi_eoq.php?id=<?=$data['id_konfigurasi']?>" onclick="return confirm('Yakin akan menghapus data konfigurasi tahun <?=$data['tahun']?> ini?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-xs"></i> Hapus</a>
												</td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan=\"8\" align=\"center\">Data tidak ditemukan</td></tr>";
									}
									?>
								</tbody>
							</table>

							<div style="float: left;">
								<?php
								$jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
								echo "Jumlah Data : <b>$jml</b>";
								?>
							</div>
							<div style="float: right;">
								<ul class="pagination pagination-sm" style="margin: 0">
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

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include_once('_footer.php'); ?>