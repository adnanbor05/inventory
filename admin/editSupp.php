<?php  
session_start();
include_once('_header.php');
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-left: 150px; padding-right: 150px;">
				<div class="panel panel-primary">
					<div class="panel-heading"> Edit Supplier</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="dataSupp.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<?php
						$id = @$_GET['id'];
						$sql_barang = mysqli_query ($koneksi, "SELECT * FROM supplier WHERE kode_supp = '$id'") or die (mysqli_error($koneksi));
						$data = mysqli_fetch_array($sql_barang);
						?>
						<form action="../_proses/proses_supp.php" method="post" style="margin-bottom: 20px; margin-top: 20px;">
							<div class="form-group">
								<input type="hidden" name="id" value="<?=$data['kode_supp']?>">
								<label for="disabledSelect">Kode Supplier</label>
								<input type="text" name="kd_supp" value="<?=$data['kode_supp']?>" id="disabledInput" placeholder="Disable Input" class=" form-control" disabled>
								<input type="hidden" name="kd_supp" value="<?=$data['kode_supp']?>">
							</div>
							<div class="form-group">
								<label for="nm_supp">Nama Supplier</label>
								<input type="text"  pattern="[A-Za-z ]+" title="Masukkan Harus Huruf"  name="nm_supp" value="<?=$data['nama_supp']?>" id="nm_supp" placeholder="Nama Supplier" class="form-control" required>
							</div>
							<div class="form-group"> 
								<label>Alamat</label> 
								<textarea name="alamat" class="form-control" rows="3"><?=$data['alamat_supp']?></textarea> 
							</div>
							<div class="form-group">
								<label for="no_telp">No telepon</label>
								<input type="number" name="no_telp" value="<?=$data['no_telepon']?>" id="no_telp" placeholder="Nama Supplier" class="form-control" required>
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