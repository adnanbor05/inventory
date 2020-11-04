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
<?php error_reporting(E_ALL ^ (E_NOTICE)); ?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Tambah Data Barang Masuk</div>
					<div class="panel-body">
						<div class="pull-right" style="margin-bottom: 5px; padding-right: 18px;">
							<a href="barangmasuk.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<form action="../_proses/proses_barangmsk.php" method="post" style="margin-top: 40px;" id="myform" onSubmit="return validasi()" name="formbarangmasuk">
							<div class="col-lg-12">
								<div class="panel panel-info">
									<div class="panel-heading">Data Barang</div>
									<div class="panel-body">
										<!-- <?php 
										// if (isset($_GET['pesan'])) {
											// if ($_GET['pesan']){?>

												<div class="alert alert-danger alert-dismissable" role="alert">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													<span class="fa fa-exclamation-sign" aria-hiden="true"></span>
													<strong>Upss!</strong> kode barang sudah pernah di input!
												</div>
												<?php
											// }
										// }
												?> -->
												<div hidden>
													<label for="id_user">id user</label>
													<input type="text" name="id_user" id="id_user"  class=" form-control" value="<?php echo $_SESSION['id_user']; ?>">
												</div>

												<!-- tanggal otomatis -->
												<div class="form-group">
													<label for="tgl_msk">Tanggal Masuk</label>
													<input type="text" name="tgl_msk" id="tgl_msk" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly>
												</div>
												<!-- end tgl otomatis -->

										<!-- <div class="form-group">
											<label for="tgl_msk">Tanggal</label>
											<input type="date" name="tgl_msk" id="tgl_msk" value="date" class="form-control" required>
										</div> -->

										<div class="form-group">
											<label for="nm_supp">Nama Supplier</label>
											<select name="kd_supp" value="" class="form-control" required> 
												<option value="">- pilih -</option> 
												<?php  
												$query=mysqli_query($koneksi, "SELECT * from supplier"); 
												while ($result=mysqli_fetch_array($query)) {?>	
													<option value=<?=$result['kode_supp']?>>
														<?=$result['nama_supp']?>
													</option> 
												<?php  } ?> 	
											</select>
										</div>

										<div class="form-group">
											<label for="nm_brg">Nama Kopi</label>
											<select name="nm_brg" id="nm_brg" class="form-control" onchange='changeValue(this.value)' required>
												<option value="">- pilih -</option>
												<?php   
												$query = mysqli_query($koneksi, "SELECT * from barang JOIN tb_jenis ON barang.kode_jenis = tb_jenis.kode_jenis ORDER BY kode_barang DESC");  
												$result = mysqli_query($koneksi, "SELECT * FROM barang JOIN tb_jenis ON barang.kode_jenis = tb_jenis.kode_jenis");  

												$a          = "var nama_jenis = new Array();\n;";
												$b          = "var stok_barang = new Array();\n;";
												$c          = "var kode_barang = new Array();\n;";
												$d          = "var harga_barang = new Array();\n;";


												while ($row = mysqli_fetch_array($result)) {  
													echo '<option name="nama_barang" value="'.$row['nama_barang'] . '">' . $row['nama_barang'] . '</option>';   
													$a .= "nama_jenis['" . $row['nama_barang'] . "'] = {nama_jenis:'" . addslashes($row['nama_jenis'])."'};\n";  
													$b .= "stok_barang['" . $row['nama_barang'] . "'] = {stok_barang:'" . addslashes($row['stok_barang'])."'};\n";
													$c .= "kode_barang['" . $row['nama_barang'] . "'] = {kode_barang:'" . addslashes($row['kode_barang'])."'};\n";
													$d .= "harga_barang['" . $row['nama_barang'] . "'] = {harga_barang:'" . addslashes($row['harga_barang'])."'};\n";

												}  
												?>
											</select>
										</div><div class="form-group">
											<input type="text" name="kode_barang" id="kode_barang" placeholder="0" class=" form-control" readonly="">
										</div>
										<div class="form-group">
											<label for="nama_jenis">Jenis Kopi</label>
											<input type="text" name="nama_jenis" id="nama_jenis" placeholder="0" class=" form-control" readonly>
										</div>
										<div class="form-group">
											<label for="stok_barang">Stok Saat Ini</label>
											<input type="number" name="stok_barang" id="stok_barang" placeholder="0" class=" form-control" readonly>
										</div>

										<!-- <div class="form-group">
											<label>Harga Beli</label>
												<div class="input-group">
													<span class="input-group-addon">Rp.</span>
													<input type="text" class="form-control" id="harga_barang" name="harga_barang" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
												</div>
										</div> -->

										<div class="form-group">
											<label for="harga_barang">Harga Kopi</label>
											<input type="number" name="harga_barang" id="harga_barang" placeholder="0" class=" form-control" readonly>
										</div>

										<!-- <div class="form-group">
											<label for="jml_brg">Jumlah Masuk</label>
											<input type="number" name="jml_brg" id="jml_brg" placeholder="0" class=" form-control" required="">
										</div> -->

										<div class="form-group">
											<label class="col-sm-2 control-label">Jumlah Masuk</label>
											<input type="number" class="form-control" id="jml_brg" name="jml_brg" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Total Stok</label>
											<input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
										</div>

										<script type="text/javascript">   
											<?php
											echo $c;
											echo $a;   
											echo $b;
											echo $d;


											?>  
											function changeValue(id){  
												document.getElementById('kode_barang').value = kode_barang[id].kode_barang;
												document.getElementById('nama_jenis').value = nama_jenis[id].nama_jenis;
												document.getElementById('stok_barang').value = stok_barang[id].stok_barang;
												document.getElementById('harga_barang').value = harga_barang[id].harga_barang;

											};  
										</script>

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

		</div><!-- /.row -->
	</section>
</div>

<script type="text/javascript">
	function cek_jumlah_masuk(input) {
		jml = document.formbarangmasuk.jml_brg.value;
		var jumlah = eval(jml);
		if(jumlah < 1){
			alert('Jumlah Barang Masuk Tidak Boleh kurang dari 1 !!');
			input.value = input.value.substring(0,input.value.length-1);
		}
	}

	function hitung_total_stok() {
		bil1 = document.formbarangmasuk.stok_barang.value;
		bil2 = document.formbarangmasuk.jml_brg.value;

		if (bil2 == "") {
			var hasil = "";
		}
		else {
			var hasil = eval(bil1) + eval(bil2);
		}

		document.formbarangmasuk.total_stok.value = (hasil);
	}

	function validasi()
	{
		// validasi jumlah barang
		var jml_brg=document.forms["myform"]["jml_brg"].value;
		var numbers=/^[0-9]+$/;
		if (jml_brg==null || jml_brg=="")
		{
			alert("jumlah barang masuk tidak boleh kosong !");
			return false;
		};
		if (!jml_brg.match(numbers))
		{
			alert("jumlah barang masuk hanya boleh angka 0-9 !");
			return false;
		};

		// validasi harga
		var hrg_brg=document.forms["myform"]["hrg_brg"].value;
		var numbers=/^[0-9]+$/;
		if (hrg_brg==null || hrg_brg=="")
		{
			alert("harga tidak boleh kosong !");
			return false;
		};
		if (!hrg_brg.match(numbers))
		{
			alert("harga barang hanya boleh angka 0-9 !");
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