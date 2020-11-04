<?php  
session_start();
include_once('_header.php');
?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12" style="padding-left: 150px; padding-right: 150px;">
				<div class="panel panel-primary">
					<div class="panel-heading"> Edit Data Kopi</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="dataBarang.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<?php
						$id = @$_GET['id'];
						$sql_barang = mysqli_query ($koneksi, "SELECT * FROM barang WHERE kode_barang = '$id'") or die (mysqli_error($koneksi));
						$data = mysqli_fetch_array($sql_barang);
						?>
						<form action="../_proses/proses_barang.php" method="post" style="margin-bottom: 20px; margin-top: 20px;">
							<div class="form-group">
								<input type="hidden" name="id" value="<?=$data['kode_barang']?>">
								<label for="disabledSelect">Kode Kopi</label>
								<input type="text" name="kd_brg" value="<?=$data['kode_barang']?>" id="disabledInput" placeholder="Disable Input" class=" form-control" disabled>
								<input type="hidden" name="kd_brg" value="<?=$data['kode_barang']?>">
							</div>
							<div class="form-group">
								<label for="nm_brg">Nama Kopi</label>
								<input type="text"  pattern="[A-Za-z ]+" title="Masukkan Harus Huruf"  name="nm_brg" value="<?=$data['nama_barang']?>" id="nama_barang" placeholder="Nama Barang" class="form-control" required>
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
								<label for="harga_barang">Harga Barang</label>
								<input type="number" name="harga_barang" id="harga_barang" value="<?=$data['harga_barang']?>" class=" form-control" required>
							</div>

							<div class="form-group pull-right">
								<input type="submit" name="edit" value="Simpan" class="btn btn-success">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
	</section>
</div>
<?php include_once('_footer.php'); ?>