<?php 
session_start();
include_once('_header.php'); 
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" >
				<div class="panel panel-primary">
					<div class="panel-heading"> Tambah Barang Keluar</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="dataBarangklr.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<form action="../_proses/proses_barangklr.php" method="post" style="margin-top: 20px; margin-bottom: 20px;" id="myform" onSubmit="return validasi()" name="formbarangkeluar">

							<?php 
							if (isset($_GET['pesan'])) {
								if ($_GET['pesan']){?>

									<div class="alert alert-danger alert-dismissable" role="alert">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<span class="fa fa-exclamation-sign" aria-hiden="true"></span>
										<strong>Upss!</strong> Terjadi kesalahan inputan! Perhatikan jumlah stok saat ini dan jumlah keluar
									</div>
									<?php
								}
							}
							?>
							
							<div class="form-group">
								<label for="tgl_klr">Tanggal</label>
								<input type="date" name="tgl_klr" id="tgl_klr" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly>
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


									while ($row = mysqli_fetch_array($result)) {  
										echo '<option name="nama_barang" value="'.$row['nama_barang'] . '">' . $row['nama_barang'] . '</option>';   
										$a .= "nama_jenis['" . $row['nama_barang'] . "'] = {nama_jenis:'" . addslashes($row['nama_jenis'])."'};\n";  
										$b .= "stok_barang['" . $row['nama_barang'] . "'] = {stok_barang:'" . addslashes($row['stok_barang'])."'};\n";
										$c .= "kode_barang['" . $row['nama_barang'] . "'] = {kode_barang:'" . addslashes($row['kode_barang'])."'};\n";

									}  
									?>
								</select>
							</div>
							<div class="form-group">
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

							<div class="form-group">
								<label for="jml_brg">Jumlah dikeluarkan</label>
								<input type="number" name="jml_brg" id="jml_brg" placeholder="0" class=" form-control" onkeyup="cek_jumlah_keluar(this)" required>
							</div>
							<script type="text/javascript">   
								<?php
								echo $c;
								echo $a;   
								echo $b;


								?>  
								function changeValue(id){  
									document.getElementById('kode_barang').value = kode_barang[id].kode_barang;
									document.getElementById('nama_jenis').value = nama_jenis[id].nama_jenis;
									document.getElementById('stok_barang').value = stok_barang[id].stok_barang;


								};  
							</script>
							<div class="form-group pull-right">
								<button type="reset" class="btn btn-danger" style="margin-top: 20px;">Reset</button>
								<button type="submit" class="btn btn-success" name="tambah" style="margin-top: 20px;">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
	</section>
</div>

<script type="text/javascript">
	function cek_jumlah_keluar(input) {
		jml = document.formbarangkeluar.jml_brg.value;
		var jumlah = eval(jml);
		if(jumlah < 1){
			alert('Jumlah Barang Keluar Tidak Boleh kurang dari 1 !!');
			input.value = input.value.substring(0,input.value.length-1);
		}
	}

	function validasi()
	{
		// validasi stok
		var jml_brg=document.forms["myform"]["jml_brg"].value;
		var numbers=/^[0-9]+$/;
		if (jml_brg==null || jml_brg=="")
		{
			alert("jumlah tidak boleh kosong !");
			return false;
		};
		if (!jml_brg.match(numbers))
		{
			alert("jumlah barang hanya boleh angka 1-10 !");
			return false;
		};
	}
</script>
<?php include_once('_footer.php'); ?>