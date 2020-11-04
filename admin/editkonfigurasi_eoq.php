<?php  
session_start();
include_once('_header.php');
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-left: 150px; padding-right: 150px;">
				<div class="panel panel-primary">
					<div class="panel-heading"> Edit Konvigurasi EOQ</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="konfigurasi_eoq.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<?php
						$id = @$_GET['id'];
						$sql_konfigurasi = mysqli_query ($koneksi, "SELECT * FROM konfigurasi_eoq WHERE id_konfigurasi = '$id'") or die (mysqli_error($koneksi));
						$data = mysqli_fetch_array($sql_konfigurasi);
						?>

						<form action="../_proses/proses_konfigurasi_eoq.php" method="post" style="margin-bottom: 20px; margin-top: 20px;">
							
							<div class="form-group">
								<input type="hidden" name="id" value="<?=$data['id_konfigurasi']?>">
								<label for="disabledSelect">Id konfigurasi</label>
								<input type="text" name="kd_brg" value="<?=$data['id_konfigurasi']?>" id="disabledInput" placeholder="Disable Input" class=" form-control" disabled>
								<input type="hidden" name="id" value="<?=$data['id_konfigurasi']?>">
							</div>

							<div class="form-group">
								<label for="tahun">Konfigurasi tahun</label>
								<input type="number" name="tahun" value="<?=$data['tahun']?>" id="tahun" placeholder="tahun" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="nama_barang">Nama Barang</label>
								<input type="text" name="nama_barang" value="<?=$data['nama_barang']?>" id="nama_barang" placeholder="nama barang" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="deman">Deman</label>
								<input type="number" name="deman" value="<?=$data['deman']?>" id="deman" placeholder="deman" class="form-control" disabled>
								<input type="hidden" name="deman" value="<?=$data['deman']?>">
							</div>

							<div class="form-group">
								<label for="b_pemesanan">Biaya Pemesanan</label>
								<input type="number" name="b_pemesanan" value="<?=$data['b_pemesanan']?>" id="b_pemesanan" placeholder="biaya pemesanan" class="form-control" disabled>
								<input type="hidden" name="b_pemesanan" value="<?=$data['b_pemesanan']?>">
							</div>

							<div class="form-group">
								<label for="b_penyimpanan">Biaya Penyimpanan</label>
								<input type="number" name="b_penyimpanan" value="<?=$data['b_penyimpanan']?>" id="b_penyimpanan" placeholder="biaya penyimpanan" class="form-control" disabled>
								<input type="hidden" name="b_penyimpanan" value="<?=$data['b_penyimpanan']?>">
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