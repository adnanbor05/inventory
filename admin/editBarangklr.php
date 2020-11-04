<?php 
session_start();
include_once('_header.php'); 
?>
<div class="content-wrapper">
	<section class="content">
<div class="row">
	<div class="col-lg-12" style="padding-left: 150px; padding-right: 150px;">
		<div class="panel panel-primary">
			<div class="panel-heading"> Edit Barang Keluar</div>
			<div class="panel-body">
				<div class="pull-right">
					<a href="dataBarangklr.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
				</div>
				<?php 
				$id = @$_GET['id'];
				$sql_barangklr = mysqli_query ($koneksi, "SELECT * FROM brg_kluar JOIN barang ON brg_kluar.kode_barang = barang.kode_barang WHERE id_brgklr = '$id'") or die (mysqli_error($koneksi));
				$data = mysqli_fetch_array($sql_barangklr);
				?>
				<form action="../_proses/proses_barangklr.php" method="post" style="margin-top: 20px; margin-bottom: 20px;">
					<div class="form-group">
						<label for="disabledSelect">Nama Kopi</label>
						<input type="hidden" name="id" value="<?=$data['id_brgklr']?>">
						<input type="text" name="nm_brg" value="<?=$data['nama_barang']?>" id="disabledInput" placeholder="Disable Input" class=" form-control" disabled>
						<input type="hidden" name="nm_brg" value="<?=$data['nama_barang']?>">
					</div>
					<div class="form-group">
						<label for="disabledSelect">Jumlah</label>
						<input type="text" name="jml_brg" value="<?=$data['jumlah_brg']?>" id="disabledInput" placeholder="Disable Input" class=" form-control" disabled>
						<input type="hidden" name="jml_brg" value="<?=$data['jumlah_brg']?>">
					</div>
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-success" name="edit" style="margin-top: 20px;">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!-- /.row -->
</section>
</div>
<?php include_once('_footer.php'); ?>