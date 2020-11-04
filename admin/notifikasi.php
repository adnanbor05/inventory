<?php 
session_start();
include_once('_header.php'); 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading"> Kelola Notifikasi
					</div>
					<div class="panel-body">
						<div>
							<a href="addUser.php" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Notifikasi </a>     
						</div><br>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-condensed" width="100%">
								<thead>
									<tr>
										<th class="text-center">No.</th> 
										<th >Kode Barang</th>
										<th>Nama Barang</th>
										<th>Jenis Barang</th>
										<th class="text-center">Stok Barang</th>
										<th class="text-center">Opsi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include_once('../_config/koneksi.php');
									
									$query = "SELECT * FROM eoq_rop JOIN barang ON eoq_rop.kode_barang = barang.kode_barang WHERE rop = stok_barang";
									// atau
									$query = "SELECT rop, stok_barang FROM eoq_rop JOIN barang ON eoq_rop.kode_barang = barang.kode_barang WHERE rop = stok_barang";

									if (mysqli_num_rows($sql_barang) > 0) {
										while ($data = mysqli_fetch_array($sql_barang)) { ?>
											<tr>
												
												<td><?=$data['kode_barang']?></td>
												<td><?=$data['nama_barang']?></td>
												<td><?=$data['jenis_barang']?></td>
												<td class="text-center"><?=$data['stok_barang']?> Pcs</td>
												<td class="text-center">
													<a href="" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
													<a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-xs"></i> Hapus</a>
												</td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan=\"6\" align=\"center\">Data tidak ditemukan</td></tr>";
									}
									?>
								</tbody>
							</table> <!-- table responsive -->

						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
</div>
<?php include_once('_footer.php'); ?>