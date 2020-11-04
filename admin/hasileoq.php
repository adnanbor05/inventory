<?php  
session_start();
include_once('_header.php');
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-info">
					<div class="panel-heading"> Detail Perhitungan Economic Order Quantity</div>
					<div class="panel-body">
						
						<?php
						$id = @$_GET['id'];
						$sql_eoq = mysqli_query ($koneksi, "SELECT * FROM eoq_rop JOIN konfigurasi_eoq ON konfigurasi_eoq.id_konfigurasi = eoq_rop.id_konfigurasi WHERE id_eoq = '$id'") or die (mysqli_error($koneksi));
						$data = mysqli_fetch_array($sql_eoq);
						$jadwal = $data['jadwal'];
						?>

						<form style="margin-bottom: 20px; margin-top: 20px;">
							<div class="row">
								<div class="col-md-12">
									<table class="table">
										<tr>
											<th>Total pemakaian selama periode tahun <?php echo $data['konv_tahun'] ?> </th>
											<td><?php echo $data['deman'] ?> Pcs</td>
										</tr>
										<tr>
											<th>Dengan Biaya Pemesanan periode tahun <?php echo $data['konv_tahun'] ?> </th>
											<td>Rp.<?php echo number_format($data['b_pemesanan']) ?></td>
										</tr>
										<tr>
											<th>Biaya Penyimpanan periode tahun <?php echo $data['konv_tahun'] ?></th>
											<td>Rp.<?php echo number_format($data['b_penyimpanan'])?></td>
										</tr>
										<tr>
											<th>Total biaya yang akan diperkirakan pada periode <?php echo $data['periode'] ?></th>
											<td>Rp.<?=number_format($data['tc'], 0, ',', '.')?></td>
										</tr>
										<tr>
											<th>Pemesanan yang optimal untuk setiap pemesanan selama periode tahun <?php echo $data['periode'] ?></th>
											<td><?php echo $data['eoq'] ?> Pcs</td>
										</tr>
										<tr>
											<th>Frekuensi pemesanan selama periode <?php echo $data['periode'] ?></th>
											<td><?php echo $data['frekuensi_pemesanan'] ?> kali</td>
										</tr>
										<tr>
											<th>Jarak antar pesanan</th>
											<td><?php echo $data['jarak_pemesanan'] ?> hari</td>
										</tr>
										<tr>
											<th>Pemesanan pertama dilakukan pada tanggal</th>
											<td><?php echo date('d F Y', strtotime($jadwal)); ?></td>
										</tr>
									</table>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="panel panel-info">
					<div class="panel-heading"> Jadwal Pemesanan</div>
					<div class="panel-body">
						<?php 
						$id = @$_GET['id'];
						$sql_eoq = mysqli_query ($koneksi, "SELECT * FROM eoq_rop JOIN konfigurasi_eoq ON konfigurasi_eoq.id_konfigurasi = eoq_rop.id_konfigurasi WHERE id_eoq = '$id'") or die (mysqli_error($koneksi));
						$data = mysqli_fetch_array($sql_eoq);

						$banyak = $data['frekuensi_pemesanan'];
						$jarak = $data['jarak_pemesanan'];
						$tanggal_ = $data['jadwal'];

						$tgl_i = $tanggal_;
						$tgl=array();
						?>
						<table class="table table-bordered table-striped table-condensed">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Jadwal Pemesanan</th>
								</tr>
							</thead>

							<tbody>
								<?php
								for ($i = 0; $i<$banyak ;$i++){
									echo '<tr>';
									echo '<td class="text-center">'.($i+ 1).'</td>';
									echo '<td class="text-center">'.date('d F Y', strtotime($tgl_i)).'</td>';
									array_push($tgl,$tgl_i);
									$tgl_i=date('d F Y', strtotime('+'.$jarak.'days', strtotime($tgl_i)));
									echo '</tr>';
								}
								echo "</tbody>";
								echo '</table>';
						// echo "<pre>";
						// print_r($tgl); 
								?>
							</div>
						</div>
					</div>
				
				<div class="pull-right" style="margin-bottom: 5px; padding-right: 18px;">
					<a href="eoq.php" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali </a><br>    
				</div>
			</section>
		</div>
		<?php include_once('_footer.php'); ?>