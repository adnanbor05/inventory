<?php 
session_start();
include_once('_header.php');

// kode barang otomatis
$no = mysqli_query($koneksi, "SELECT kode_jenis FROM tb_jenis ORDER BY kode_jenis DESC");
$result = mysqli_query($koneksi, "SELECT * FROM tb_jenis ") or die (mysqli_error($koneksi));

$kd_supplier = mysqli_fetch_array($no);
$kode = $kd_supplier['kode_jenis'];

// SPL001
// 012345
$urut = substr($kode, 3, 3);
$tambah = (int) $urut + 1 ;
if (strlen($tambah) == 1) {
	$format = "JNS"."00".$tambah;
} else if (strlen($tambah) == 2) {
	$format = "JNS"."0".$tambah;
}else{
	$format = "JNS".$tambah;
}

?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading"> Tambah Jenis Kopi</div>
					<div class="panel-body">

						<div class="pull-right">
							<a href="datajenis.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>

						<form action="../_proses_petugas/prosesjenis.php" method="post" style="margin-top: 40px;" id="myform" onSubmit="return validasi()">
							<div class="col-lg-12">
								<div class="panel panel-info">
									<div class="panel-heading">Data Jenis Kopi</div>
									<div class="panel-body">
										<div class="form-group">
											<label for="kode_jenis">Kode Jenis</label>
											<input type="text" name="kode_jenis" id="kode_jenis" placeholder="Kode Jenis" class=" form-control" value="<?php echo $format ; ?>" readonly>
										</div>
										<div class="form-group">
											<label for="nm_jenis">Jenis Kopi</label>
											<input type="text" name="nm_jenis" id="nm_jenis" placeholder="Jenis" class="form-control" required>
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
<script type="text/javascript">
	function validasi()
	{
		// validasi nama jenis
		var pola_nama=/^[a-zA-Z]{6,100}$/;
		if (!pola_nama.test(nm_jenis.value)){
			alert ('nama minimal 6 karakter dan hanya boleh Huruf a - z !');
			nm_jenis.focus();
			return false;
		};
	}
</script>
<?php include_once('_footer.php'); ?>