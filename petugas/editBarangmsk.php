<?php 
session_start();
include_once('_header.php'); 
?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-left: 150px; padding-right: 150px;">
				<div class="panel panel-primary">
					<div class="panel-heading">Edit Barang Masuk</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="barangmasuk.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<?php 
						$id = @$_GET['id'];
						$sql_barangmsk = mysqli_query ($koneksi, "SELECT * FROM brg_masuk JOIN supplier ON brg_masuk.kode_supp = supplier.kode_supp JOIN barang ON barang.kode_barang = brg_masuk.kode_barang JOIN user ON brg_masuk.id_user = user.id_user WHERE id_brgmsk = '$id'") or die (mysqli_error($koneksi));
						$data = mysqli_fetch_array($sql_barangmsk);
						?>
						<form action="../_proses_petugas/proses_barangmsk.php" method="post" style="margin-bottom: 20px; margin-top: 20px;">
							<div class="form-group">
								<input type="hidden" name="id" value="<?=$data['id_brgmsk']?>">
								<input type="hidden" name="kd_brg" value="<?=$data['kode_barang']?>">
								<label for="disabledSelect">Kode Kopi</label>
								<input type="text" name="kd_brg" value="<?=$data['kode_barang']?>" id="disabledInput" placeholder="Disable Input" class=" form-control" disabled>
							</div>
							<div class="form-group">
								<label for="nm_brg">Nama Kopi</label>
								<input type="text" name="nm_brg" id="nm_brg" value="<?=$data['nama_barang']?>" placeholder="Nama Barang" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="jns_brg">Jenis</label>
								<select name="jns_brg" value="" class="form-control" required> 
									<option value="">- Pilih -</option> 
									<?php  
									$query=mysqli_query($koneksi, "SELECT * from tb_jenis"); 
									while ($result=mysqli_fetch_array($query)) {?>	
										<option value=<?=$result['kode_jenis']?>>
											<?=$result['nama_jenis']?>
										</option> 
									<?php  } ?> 	
								</select>
							</div>

							<div class="form-group">
								<label for="jml_brg">Jumlah</label>
								<input type="number" name="jml_brg" id="jml_brg" value="<?=$data['jumlah_brg']?>" placeholder="0" class=" form-control" required>
							</div>
							<div class="form-group">
								<label for="hrg_brg">Harga satuan</label>
								<input type="number" name="hrg_brg" id="hrg_brg" value="<?=$data['harga']?>" placeholder="0" class=" form-control" required>
							</div>
							<div class="form-group pull-right">
								<button type="submit" class="btn btn-success" name="edit">Simpan</button>
							</div>

						</form>

					</div>
				</div>
			</div>

		</div><!-- /.row -->
	</section>
</div>

<?php include_once('_footer.php'); ?>