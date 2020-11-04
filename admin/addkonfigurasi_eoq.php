<?php 
session_start();
include_once('_header.php'); 
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" >
				<div class="panel panel-primary">
					<div class="panel-heading"> Tambah Konvigurasi EOQ</div>
					<div class="panel-body">
						<div class="pull-right" style="margin-bottom: 5px; padding-right: 18px;">
							<a href="konfigurasi_eoq.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<form action="../_proses/proses_konfigurasi_eoq.php" method="post" style="margin-top: 40px;" id="myform" onSubmit="return validasi()">
							<div class="col-lg-6">
								<div class="panel panel-info">
									<div class="panel-heading"> Konvigurasi</div>
									<div class="panel-body">
										<div class="form-group">
											<label for="tahun">Konvigurasi Tahun</label>
											<input type="text" name="tahun" id="tahun" placeholder="masukan tahun" class="form-control" required>
										</div>
										
										<!-- <div class="form-group">
											<label for="nama_barang">Nama Barang</label>
											<input type="text" name="nama_barang" id="nama_barang" placeholder="masukan nama" class="form-control" required>
										</div> -->
										<div class="form-group">
											<label for="nama_barang"> Nama Barang</label>
											<select name="nama_barang" id="nama_barang" class="form-control" onchange='changeValue(this.value)' required>
												<option value="">- pilih -</option>
												<?php   
												$query = mysqli_query($koneksi, "SELECT * FROM barang order by nama_barang desc");  
												$result = mysqli_query($koneksi, "SELECT * FROM barang");  

												$b          = "var kode_barang = new Array();\n;";
												$a          = "var harga_barang = new Array();\n;";


												while ($row = mysqli_fetch_array($result)) {  
													echo '<option name="nama_barang" value="'.$row['nama_barang'] . '">' . $row['nama_barang'] . '</option>';   
													$b .= "kode_barang['" . $row['nama_barang'] . "'] = {kode_barang:'" . addslashes($row['kode_barang'])."'};\n";
													$a .= "harga_barang['" . $row['nama_barang'] . "'] = {harga_barang:'" . addslashes($row['harga_barang'])."'};\n";
													
												}  
												?>
											</select>
										</div>

										<!-- belum ada validasi -->
										<div class="hidden">
											<label for="kode_barang">kode_barang</label>
											<input type="text" name="kode_barang" id="kode_barang" class="form-control" readonly>
										</div>
										<div class="form-group">
											<label for="harga_barang">Harga barang Per Unit</label>
											<input type="number" name="harga" id="harga_barang" placeholder="Rp." class="form-control" readonly>
										</div>
										<script type="text/javascript">   
											<?php  
											echo $b;
											echo $a;   

											?>  
											function changeValue(id){  
												document.getElementById('kode_barang').value = kode_barang[id].kode_barang;
												document.getElementById('harga_barang').value = harga_barang[id].harga_barang;
											};  
										</script>

										<!-- <div class="form-group">
											<label for="deman">Deman / Total pemakaian selama periode 1 tahu</label>
											<input type="number" name="deman" id="deman" placeholder="Pcs" class="form-control" required>
										</div> -->

										<div class="form-group">
											<label for="deman">Deman / Total pemakaian selama periode 1 tahu</label>
											<select name="deman" value="" class="form-control" required> 
												<option value="">- Pilih -</option> 
												<?php  
												$qry = mysqli_query($koneksi, "SELECT kode_barang, SUM(jumlah_brg) AS total FROM brg_masuk GROUP BY kode_barang"); 
												while ($result=mysqli_fetch_array($qry)) {?>	
													<option value=<?=$result['total']?>>
														<?=$result['total']?> Pcs
													</option> 
												<?php  } ?> 	
											</select>
										</div>

										<div class="form-group">
											<label for="pemesanan_bulan">Pemesanan Per Bulan Selama Periode 1 tahun</label>
											<input type="number" name="pemesanan_bulan" id="pemesanan_bulan" placeholder="0 kali" class=" form-control" required>
										</div>
										
										
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="panel panel-info">
									<div class="panel-heading">Biaya Pemesanan</div>
									<div class="panel-body">
										<p><b> Biaya Telepon</b></p>									
										<div class="form-group">
											<label for="jml_panggilan">Jumlah Panggilan Selama 1 Periode Tahun</label>
											<input type="number" name="jml_panggilan" id="jml_panggilan" placeholder="0 Kali" class=" form-control" required>
										</div>
										<div class="form-group">
											<label for="b_telepon">Biaya Telepon Setiap Panggilan</label>
											<input type="number" name="b_telepon" id="b_telepon" placeholder="Rp." class=" form-control" required>
										</div>
										
										<p><b> Biaya Jasa</b></p>	
										<div class="form-group">
											<label for="jml_kirim">Jumlah Pengiriman Selama 1 Periode Tahun</label>
											<input type="number" name="jml_kirim" id="jml_kirim" placeholder="0 Kali" class=" form-control" required>
										</div>
										<div class="form-group">
											<label for="b_jasa">Biaya Jasa per Pengiriman Barang</label>
											<input type="number" name="b_jasa" id="b_jasa" placeholder="Rp." class=" form-control" required>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="panel panel-info">
									<div class="panel-heading">Biaya Penyimpanan</div>
									<div class="panel-body">
										<div class="form-group">
											<label for="b_listrik">Biaya Pemakaian Listrik per bulan Selama Periode</label>
											<input type="number" name="b_listrik" id="b_listrik" placeholder="Rp." class=" form-control" required>
										</div>
										<div class="form-group">
											<label for="b_tenaga">Biaya Tenaga Kerja per bulan Selama Periode</label>
											<input type="number" name="b_tenaga" id="b_tenaga" placeholder="Rp." class=" form-control" required>
										</div>
									</div>
								</div>
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

		// validasi tahun
		// var tahun=document.forms["myform"]["tahun"].value;
		// var numbers=/^[0-9]{4,50}$/;
		// if (tahun==null || tahun=="")
		// {
		// 	alert("tahun tidak boleh kosong !");
		// 	return false;
		// };
		// if (!tahun.match(numbers))
		// {
		// 	alert("tahun minimal panjang 4 karakter dan hanya boleh angka 0-9 !");
		// 	return false;
		// };

		// validasi deman
		var deman=document.forms["myform"]["deman"].value;
		var numbers=/^[0-9]+$/;
		if (deman==null || deman=="")
		{
			alert("deman tidak boleh kosong !");
			return false;
		};
		if (!deman.match(numbers))
		{
			alert("deman hanya boleh angka 0-9 !");
			return false;
		};

		// validasi pemesanan per bulan
		var pemesanan_bulan=document.forms["myform"]["pemesanan_bulan"].value;
		var numbers=/^[0-9]+$/;
		if (pemesanan_bulan==null || pemesanan_bulan=="")
		{
			alert("pemesanan bulan tidak boleh kosong !");
			return false;
		};
		if (!pemesanan_bulan.match(numbers))
		{
			alert("pemesanan bulan hanya boleh angka 0-9 !");
			return false;
		};

		// validasi total pemakaian
		var total_pemakaian=document.forms["myform"]["total_pemakaian"].value;
		var numbers=/^[0-9]+$/;
		if (total_pemakaian==null || total_pemakaian=="")
		{
			alert("pemakaian / hari tidak boleh kosong !");
			return false;
		};
		if (!total_pemakaian.match(numbers))
		{
			alert("pemakaian / hari hanya boleh angka 0-9 !");
			return false;
		};

		// validasi leadtime
		var leadtime=document.forms["myform"]["leadtime"].value;
		var numbers=/^[0-9]+$/;
		if (leadtime==null || leadtime=="")
		{
			alert("leadtime tidak boleh kosong !");
			return false;
		};
		if (!leadtime.match(numbers))
		{
			alert("leadtime hanya boleh angka 0-9 !");
			return false;
		};

		// validasi jml_panggilan
		var jml_panggilan=document.forms["myform"]["jml_panggilan"].value;
		var numbers=/^[0-9]+$/;
		if (jml_panggilan==null || jml_panggilan=="")
		{
			alert("jumlah panggilan tidak boleh kosong !");
			return false;
		};
		if (!jml_panggilan.match(numbers))
		{
			alert("jumlah panggilan hanya boleh angka 0-9 !");
			return false;
		};

		// validasi b_telepon
		var b_telepon=document.forms["myform"]["b_telepon"].value;
		var numbers=/^[0-9]+$/;
		if (b_telepon==null || b_telepon=="")
		{
			alert("biaya telepon tidak boleh kosong !");
			return false;
		};
		if (!b_telepon.match(numbers))
		{
			alert("biaya telepon hanya boleh angka 0-9 !");
			return false;
		};

		// validasi jml_kirim
		var jml_kirim=document.forms["myform"]["jml_kirim"].value;
		var numbers=/^[0-9]+$/;
		if (jml_kirim==null || jml_kirim=="")
		{
			alert("jumlah pengiriman tidak boleh kosong !");
			return false;
		};
		if (!jml_kirim.match(numbers))
		{
			alert("jumlah pengiriman hanya boleh angka 0-9 !");
			return false;
		};

		// validasi b_jasa
		var b_jasa=document.forms["myform"]["b_jasa"].value;
		var numbers=/^[0-9]+$/;
		if (b_jasa==null || b_jasa=="")
		{
			alert("biaya jasa pengiriman tidak boleh kosong !");
			return false;
		};
		if (!b_jasa.match(numbers))
		{
			alert("biaya jasa pengiriman hanya boleh angka 0-9 !");
			return false;
		};

		// validasi b_listrik
		var b_listrik=document.forms["myform"]["b_listrik"].value;
		var numbers=/^[0-9]+$/;
		if (b_listrik==null || b_listrik=="")
		{
			alert("biaya pemakaian listrik tidak boleh kosong !");
			return false;
		};
		if (!b_listrik.match(numbers))
		{
			alert("biaya pemakaian listrik hanya boleh angka 0-9 !");
			return false;
		};

		// validasi b_tenaga
		var b_tenaga=document.forms["myform"]["b_tenaga"].value;
		var numbers=/^[0-9]+$/;
		if (b_tenaga==null || b_tenaga=="")
		{
			alert("biaya tenaga kerja tidak boleh kosong !");
			return false;
		};
		if (!b_tenaga.match(numbers))
		{
			alert("biaya tenaga kerja hanya boleh angka 0-9 !");
			return false;
		};



	}
</script>
<?php include_once('_footer.php'); ?>