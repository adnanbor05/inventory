<?php 
session_start();
include_once('_header.php'); 
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" >
				<div class="panel panel-primary">
					<div class="panel-heading"> Tambah Perhitungan EOQ</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="eoq.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<form action="../_proses/proses_eoq.php" method="post" style="margin-top: 20px; margin-bottom: 20px;" id="myform" onSubmit="return validasi()">
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


							<!-- hilangkan, ganti nama barang-->
							<!-- <div class="form-group">
								<label for="jenis_barang">Jenis Barang</label>
								<select name="jenis_barang" class="form-control" required>
									<option value="">-pilih-</option>
									<option value="Robusta">Robusta</option>
									<option value="Arabika">Arabika</option>
								</select>
							</div> -->
							<!-- end -->

							<div class="form-group">
								<label for="periode">EOQ untuk Periode Tahun</label>
								<input type="text" name="periode" id="periode" placeholder="periode" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="konv_tahun">Konfigurasi Eoq</label>
								<select name="konv_tahun" id="konv_tahun" class="form-control" onchange='changeValue(this.value)' required>
									<option value="">- pilih -</option>
									<?php   
									$query = mysqli_query($koneksi, "SELECT * FROM konfigurasi_eoq order by tahun esc");  
									$result = mysqli_query($koneksi, "SELECT * FROM konfigurasi_eoq");  
									
									$a          = "var b_pemesanan = new Array();\n;";
									$b          = "var b_penyimpanan = new Array();\n;";
									
									$e          = "var deman = new Array();\n;";
									$f          = "var id_konfigurasi = new Array();\n;";
									$g          = "var nama_barang = new Array();\n;";
									$h          = "var harga = new Array();\n;";

									while ($row = mysqli_fetch_array($result)) {  
										echo '<option name="tahun" value="'.$row['tahun'] . '">' . $row['tahun'] . '</option>';   
										$a .= "b_pemesanan['" . $row['tahun'] . "'] = {b_pemesanan:'" . addslashes($row['b_pemesanan'])."'};\n";  
										$b .= "b_penyimpanan['" . $row['tahun'] . "'] = {b_penyimpanan:'" . addslashes($row['b_penyimpanan'])."'};\n";
										
										$e .= "deman['" . $row['tahun'] . "'] = {deman:'" . addslashes($row['deman'])."'};\n";  
										$f .= "id_konfigurasi['" . $row['tahun'] . "'] = {id_konfigurasi:'" . addslashes($row['id_konfigurasi'])."'};\n";
										$g .= "nama_barang['" . $row['tahun'] . "'] = {nama_barang:'" . addslashes($row['nama_barang'])."'};\n";
										$h .= "harga['" . $row['tahun'] . "'] = {harga:'" . addslashes($row['harga'])."'};\n"; 
									}  
									?>
								</select>
							</div>
							
							<div class="hidden">
								<label for="id_konfigurasi">ID Konvigurasi EOQ</label>
								<input type="number" name="id_konfigurasi" id="id_konfigurasi" class="form-control" readonly="">
							</div>

							<div class="form-group">
								<label for="nama_barang">Nama Barang</label>
								<input type="text" name="nama_barang" id="nama_barang" class="form-control" readonly="">
							</div>

							<div class="form-group">
								<label for="harga">Harga Satuan Barang</label>
								<input type="text" name="harga" id="harga" class="form-control" readonly="">
							</div>

							<div class="form-group">
								<label for="deman">Deman / Pemakaian</label>
								<input type="number" name="deman" id="deman" class="form-control" readonly="">
							</div>

							<div class="form-group">
								<label for="b_pemesanan">Biaya Pemesanan</label>
								<input type="number" name="b_pemesanan" id="b_pemesanan" class="form-control" readonly>
							</div>
							<div class="form-group">
								<label for="b_penyimpanan">Biaya Penyimpanan</label>
								<input type="number" name="b_penyimpanan" id="b_penyimpanan" class="form-control" readonly>
							</div>
							
							<!-- leadtime & total pemakaian pindahkan dari konfigurasi ke tabel eoqrop -->
							<script type="text/javascript">   
								<?php
								echo $f;
								echo $g;
								echo $h;
								echo $e;   
								echo $a;   
								echo $b; 
								
								?>  
								function changeValue(id){  
									document.getElementById('id_konfigurasi').value = id_konfigurasi[id].id_konfigurasi;
									document.getElementById('nama_barang').value = nama_barang[id].nama_barang;
									document.getElementById('harga').value = harga[id].harga;
									document.getElementById('deman').value = deman[id].deman; 
									document.getElementById('b_pemesanan').value = b_pemesanan[id].b_pemesanan;  
									document.getElementById('b_penyimpanan').value = b_penyimpanan[id].b_penyimpanan;

								};  
							</script>
							
							<div class="form-group">
								<label for="hari_kerja">Total Hari Kerja Dalam Periode</label>
								<input type="number" name="hari_kerja" id="hari_kerja" class="form-control" placeholder="hari" required="">
							</div>
							<div class="form-group">
								<label for="jadwal">Tanggal Awal Pemesanan</label>
								<input type="date" name="jadwal" id="jadwal" class="form-control" required>
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
		// nama
		// var pola_nama=/^[a-zA-Z]{6,100}$/;
		// if (!pola_nama.test(nm_brg.value)){
		// 	alert ('nama hanya boleh Huruf a - z !');
		// 	nm_brg.focus();
		// 	return false;
		// };

		// validasi periode
		var periode=document.forms["myform"]["periode"].value;
		var numbers=/^[0-9]{4,50}$/;
		if (periode==null || periode=="")
		{
			alert("periode tidak boleh kosong !");
			return false;
		};
		if (!periode.match(numbers))
		{
			alert("periode tahun minimal panjang 4 karakter dan hanya boleh angka 0-9 !");
			return false;
		};


		// // validasi total pemakaian
		// var total_pemakaian=document.forms["myform"]["total_pemakaian"].value;
		// var numbers=/^[0-9]+$/;
		// if (total_pemakaian==null || total_pemakaian=="")
		// {
		// 	alert("pemakaian / hari tidak boleh kosong !");
		// 	return false;
		// };
		// if (!total_pemakaian.match(numbers))
		// {
		// 	alert("pemakaian / hari hanya boleh angka 0-9 !");
		// 	return false;
		// };

		// // validasi leadtime
		// var leadtime=document.forms["myform"]["leadtime"].value;
		// var numbers=/^[0-9]+$/;
		// if (leadtime==null || leadtime=="")
		// {
		// 	alert("leadtime tidak boleh kosong !");
		// 	return false;
		// };
		// if (!leadtime.match(numbers))
		// {
		// 	alert("leadtime hanya boleh angka 0-9 !");
		// 	return false;
		// };

	}
</script>

<?php include_once('_footer.php'); ?>