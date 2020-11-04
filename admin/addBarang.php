<?php 
session_start();
include_once('_header.php');


// kode barang otomatis
$no = mysqli_query($koneksi, "SELECT kode_barang FROM barang ORDER BY kode_barang DESC");
$result = mysqli_query($koneksi, "SELECT * FROM barang ") or die (mysqli_error($koneksi));

$kd_barang = mysqli_fetch_array($no);
$kode = $kd_barang['kode_barang'];

// BRG001
// 012345
$urut = substr($kode, 3, 3);
$tambah = (int) $urut + 1 ;
if (strlen($tambah) == 1) {
	$format = "BRG"."00".$tambah;
} else if (strlen($tambah) == 2) {
	$format = "BRG"."0".$tambah;
}else{
	$format = "BRG".$tambah;
}

?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" >
				<div class="panel panel-primary">
					<div class="panel-heading"> Tambah Data Kopi</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="dataBarang.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<form action="../_proses/proses_barang.php" method="post" style="margin-top: 20px; margin-bottom: 20px;" id="myform" onSubmit="return validasi()">
							<?php 
							if (isset($_GET['pesan'])) {
								if ($_GET['pesan']){?>
									<br>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<span class="fa fa-exclamation-sign" aria-hiden="true"></span>
										<strong>Upss!</strong> kode barang sudah pernah di input!
									</div>
									<?php
								}
							}


							?>
							<!-- <div hidden>
								<label for="id_user">id user</label>
								<input type="text" name="id_user" id="id_user"  class=" form-control" value="<?php //echo $_SESSION['id_user']; ?>">
							</div> -->

							<div class="form-group">
								<label for="kd_brg">Kode Kopi</label>
								<input type="text" name="kd_brg" id="kd_brg" placeholder="Kode Barang" class=" form-control" value="<?php echo $format ; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="nm_brg">Nama Kopi</label>
								<input type="text" name="nm_brg" id="nm_brg" placeholder="Nama Barang" class="form-control" required>
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
								<label for="harga_barang">Harga Kopi</label>
								<input type="number" name="harga_barang" id="harga_barang" placeholder="0" class=" form-control" required>
							</div>
							<div class="form-group pull-right">
								<button type="reset" class="btn btn-danger">Reset</button>
								<input type="submit" name="tambah" value="Simpan" class="btn btn-success">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
	</section>
</div>
<script type="text/javascript">
	function validasi()
	{
		// validasi stok
		var stok=document.forms["myform"]["stok"].value;
		var numbers=/^[0-9]+$/;
		if (stok==null || stok=="")
		{
			alert("stok tidak boleh kosong !");
			return false;
		};
		if (!stok.match(numbers))
		{
			alert("stok barang hanya boleh angka 0-9 !");
			return false;
		};
		// nama
		// var pola_nama=/^[a-zA-Z]{6,100}$/;
		// if (!pola_nama.test(nm_brg.value)){
		// 	alert ('nama hanya boleh Huruf a - z !');
		// 	nm_brg.focus();
		// 	return false;
		// };
	}
</script>
<?php include_once('_footer.php'); ?>