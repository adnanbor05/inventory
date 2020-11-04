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
					<div class="panel-heading"> Data Supplier</div>
					<div class="panel-body">
						<div>
							<a href="addsupp.php" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Supplier </a>     
						</div><br>
						<?php 
						if (isset($_GET['pesan'])) {
							if ($_GET['pesan']){?>
								<div class="alert alert-danger alert-dismissable" role="alert">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<span class="fa fa-exclamation-sign" aria-hiden="true"></span>
									<strong>Upss!</strong> kode supplier sudah pernah di input!
								</div>
								<?php
							}
						}
						?>
						

						<div class="table-responsive">
							<table class="table table-bordered table-striped table-condensed" width="100%">
								<thead>
									<tr>
										<th class="text-center">No.</th> 
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>Alamat</th>
										<th>No Telepon</th>
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

									$query = "SELECT * FROM supplier ORDER BY kode_supp DESC LIMIT $posisi, $batas";
									$queryJml = "SELECT * FROM supplier";
									$no = $posisi + 1;

									$sql_supp = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
									if (mysqli_num_rows($sql_supp) > 0) {
										while ($data = mysqli_fetch_array($sql_supp)) { ?>
											<tr>
												<td class="text-center"><?=$no++?>.</td>
												<td><?=$data['kode_supp']?></td>
												<td><?=$data['nama_supp']?></td>
												<td><?=$data['alamat_supp']?></td>
												<td><?=$data['no_telepon']?></td>
												<td class="text-center">
													<a href="editSupp.php?id=<?=$data['kode_supp']?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
													<a href="../_proses/delSupp.php?id=<?=$data['kode_supp']?>" onclick="return confirm('Yakin akan menghapus data supplier <?=$data['nama_supp']?> ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-xs"></i> Hapus</a>
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

							<div style="float: left;">
								<?php
								$jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
								echo "Jumlah Data : <b>$jml</b>";
								?>
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

						</div>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
	</section>
</div>
<?php include_once('_footer.php'); ?>