<?php
session_start();
ob_start();
include_once("../_config/koneksi.php"); //buat koneksi ke database
if (@$_POST['cetak']) {
	$nm_brg = trim(mysqli_real_escape_string($koneksi, $_POST['nm_brg']));
	$tanggal_awal = trim(mysqli_real_escape_string($koneksi, $_POST['tanggal_awal']));
	$tanggal_akhir = trim(mysqli_real_escape_string($koneksi, $_POST['tanggal_akhir']));

	// query tampil
	$sql = "SELECT * FROM brg_masuk JOIN supplier ON brg_masuk.kode_supp = supplier.kode_supp 
									JOIN barang ON barang.kode_barang = brg_masuk.kode_barang 
									WHERE nama_barang LIKE '%$nm_brg%'
									AND tanggal_msk BETWEEN '$tanggal_awal' 
									AND '$tanggal_akhir'";
}
?>
<html>
<head>
	<title>Cetak Data Transaksi Barang Masuk</title>
	<style>
		.table1{
			font-family:sans_serif;
			color:#232323;
			border-collapse:collapse;
		}
		.table1,th,td{
			border:1px solid #999;
			padding:5px 12px;
		}
		table,th,td{
			border: solid #717375;
			width: 100%;
			color: #000;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td style="width: 100%; background-color: #717375">
				<strong style="font-size: 30;">Balakosa Coffe & Co</strong><br/>
			</td>
		</tr>
	</table>
	<p>Jl. Kedawung, Nologaten, Caturtunggal, Depok </p>
	<p style="margin-top: -2mm">Sleman, Yogyakarta, 55284</p>
	<p style="margin-top: -2mm">085645789632</p>

	<h3 style="text-align: center; text-decoration: underline;">Laporan Data Transaksi Barang Masuk</h3>
	<?php 	
	$sql_ = mysqli_query($koneksi, $sql) or die (mysqli_error($koneksi));
	$dt = mysqli_fetch_array($sql_);
	echo "<h5 style='text-align: center; margin-top: -4mm;'>Bahan Baku Kopi $dt[nama_barang]</h5>";		
	?>
	<h5 style="text-align: center; margin-top: -4mm">Tanggal <?php echo $tanggal_awal;?> S/D <?php echo $tanggal_akhir;?></h5>

	<table cellspacing="0" width="90%" align="center">
		<tr style="text-align: center;">
			<th >No.</th>
			<th >Tanggal Masuk</th>
			<th >Kode Kopi</th>
			<th >Nama Kopi</th>
			<th >Nama Supplier</th>
			<!-- <th >Alamat Supplier </th> -->
			<th >Jumlah Masuk</th>
			<th >Total Transaksi</th>
		</tr>

		<tbody>
			<?php
			$i = 1;
			$jml = 0;
			$total = 0;
			$sql_detbarangmsk = mysqli_query($koneksi, $sql) or die (mysqli_error($koneksi));
			if (mysqli_num_rows($sql_detbarangmsk) > 0) {
				while ($data = mysqli_fetch_array($sql_detbarangmsk)) { 
					if($i%2!=0){
						$gridcolor="white";
					}else{
						$gridcolor="lavender";
					}
					echo "<tr>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$i++."</td>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$data['tanggal_msk']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['kode_barang']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['nama_barang']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['nama_supp']."</td>";
					// echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['alamat_supp']."</td>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$data['jumlah_brg']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>Rp. ".number_format($data['total_transaksi'])."</td>";
					echo "</tr>";
					// jmlah brg
					$jml += $data['jumlah_brg'];
					// menjumlahkan
					$total += $data['total_transaksi'];	
				}
			}
			?>

			<tr>
				<th colspan="5" style="text-align: center;">JUMLAH TOTAL</th>
				<th style="text-align: center;"><?php echo $jml; ?></th>
				<th style="text-align: left;">Rp. <?php echo number_format($total, 0, ',', '.'); ?></th>
			</tr>

		</tbody>
	</table>

	<div align="right">
		<br><br>
		<p style="padding-right: 100px;">
			<?php echo "Yogyakarta, ".date('d-m-Y');?><br>
			<?php echo "Mengetahui";?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</p>
		<br><br>
		<p style="padding-right: 100px;"><?php echo"Owner Balakosa Coffe & Co";?></p>
	</div>


</body>
</html>
<?php
$html = ob_get_contents();
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('L','A4','en');
$pdf->WriteHTML($html);
ob_end_clean();
$pdf->Output('Laporan Data Barang Masuk.pdf', 'FI');
?>