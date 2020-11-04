<?php 
session_start();
include_once('_header.php'); 
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-left: 150px; padding-right: 150px;">
				<div class="panel panel-primary">
					<div class="panel-heading"> Tambah Pengguna</div>
					<div class="panel-body">
						<div class="pull-right">
							<a href="dataUser.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a>    
						</div>
						<form action="../_proses/proses_user.php" method="post" style="margin-top: 20px; margin-bottom: 20px;" enctype="multipart/form-data" id="myform" onSubmit="return validasi()">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" id="username" placeholder="Username" class=" form-control" required autofocus>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
							</div>
							
							<div class="form-group">
								<label for="nama_user">Nama</label>
								<input type="text" title="Masukkan nama dengan Huruf" name="nama_user" id="nama_user" placeholder="Nama Pengguna" class=" form-control" required>
								<!-- validasi huruf dan spasi menggunakan pattern="[A-Za-z ]+" -->
							</div>
							<div class="form-group"> 
								<label>Jenis Kelamin</label> 
								<br> 
								<label class="radio-inline" > 
									<input type="radio" name="jenis_kelamin" id="optionsRadiosInline1" value="Laki-laki" required>Laki-laki 
								</label> 
								<label class="radio-inline"> 
									<input type="radio" name="jenis_kelamin" id="optionsRadiosInline2" value="Perempuan" required>Perempuan 
								</label> 
							</div>
							<div class="form-group"> 
								<label>Alamat</label> 
								<textarea name="alamat" placeholder="Alamat" class="form-control" rows="3"></textarea> 
							</div>
							<div class="form-group"> 
								<label>Nomor Telepon</label> 
								<input type="number" name="telp" id="telp" title="Masukkan Harus Angka" class="form-control" placeholder="Nomor Telepon">
								<!-- validasi nomor telepon dengan pattern="[0-9 ]+" -->
							</div>
							<div class="form-group">
								<label for="level">Level User</label>
								<select name="level" class="form-control" required>
									<option value="">Pilih</option>
									<option value="Admin">Admin</option>
									<option value="Petugas">Petugas</option>
								</select>
							</div>
							<div class="form-group pull-right">
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
		// nomor telepon
		var telp=document.forms["myform"]["telp"].value;
		var numbers=/^[0-9]+$/;
		if (telp==null || telp=="")
		{
			alert("nomor telepon tidak boleh kosong !");
			return false;
		};
		if (!telp.match(numbers))
		{
			alert("nomor telepon harus angka !");
			return false;
		};
		// nama
		var pola_nama=/^[a-zA-Z]{6,100}$/;
		if (!pola_nama.test(nama_user.value)){
			alert ('nama minimal 6 karakter dan hanya boleh Huruf a - z !');
			nama_user.focus();
			return false;
		};
		// username
		var pola_username=/^[a-zA-Z0-9\_\-]{5,100}$/;
		if (!pola_username.test(username.value)){
			alert ('Username minimal 5 karakter dan hanya boleh Huruf atau Angka!');
			username.focus();
			return false;
		};

	}
</script>
<?php include_once('_footer.php'); ?>
