<?php 
session_start();
include_once('_header.php');

// kode barang otomatis
$no = mysqli_query($koneksi, "SELECT kode_supp FROM supplier ORDER BY kode_supp DESC");
$result = mysqli_query($koneksi, "SELECT * FROM supplier ") or die (mysqli_error($koneksi));

$kd_supplier = mysqli_fetch_array($no);
$kode = $kd_supplier['kode_supp'];

// SPL001
// 012345
$urut = substr($kode, 3, 3);
$tambah = (int) $urut + 1 ;
if (strlen($tambah) == 1) {
	$format = "SPL"."00".$tambah;
} else if (strlen($tambah) == 2) {
	$format = "SPL"."0".$tambah;
}else{
	$format = "SPL".$tambah;
}

?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading"> Tambah Supplier</div>
					<div class="panel-body">

						<div class="pull-right">
							<a href="dataSupp.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>

						<form action="../_proses/proses_supp.php" method="post" style="margin-top: 40px;" id="myform" onSubmit="return validasi()">
							<div class="col-lg-12">
								<div class="panel panel-info">
									<div class="panel-heading">Data Supplier</div>
									<div class="panel-body">

										<div class="form-group">
											<label for="kd_supp">Kode Supplier</label>
											<input type="text" name="kd_supp" id="kd_supp" placeholder="Kode Barang" class=" form-control" value="<?php echo $format ; ?>" readonly>
										</div>
										
										<div class="form-group">
											<label for="nm_supp">Nama Supplier</label>
											<input type="text" name="nm_supp" id="nm_supp" placeholder="Nama Supplier" class="form-control" required>
										</div>

										<div class="form-group"> 
											<label>Alamat Supplier</label> 
											<textarea name="alamat" placeholder="alamat" class="form-control" rows="3"></textarea> 
										</div>

										<div class="form-group">
											<label for="no_telp">Nomor Telepon</label>
											<input type="text" name="no_telp" id="no_telp" placeholder="Nama Supplier" class="form-control" required>
										</div>

										<div class="form-group pull-right">
											<button type="reset" class="btn btn-danger" style="margin-top: 20px;">Reset</button>
											<button type="submit" class="btn btn-success" name="tambah" style="margin-top: 20px;">Simpan</button>
										</div>

									</div>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include_once('_footer.php'); ?>