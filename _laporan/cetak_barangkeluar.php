<?php
session_start();
ob_start();
include_once("../_config/koneksi.php"); //buat koneksi ke database
if (@$_POST['cetak']) {

	$nm_brg = trim(mysqli_real_escape_string($koneksi, $_POST['nm_brg']));
	$tanggal_awal = trim(mysqli_real_escape_string($koneksi, $_POST['tanggal_awal']));
	$tanggal_akhir = trim(mysqli_real_escape_string($koneksi, $_POST['tanggal_akhir']));

	$sql = "SELECT * FROM brg_kluar JOIN barang ON brg_kluar.kode_barang = barang.kode_barang 
	WHERE nama_barang LIKE '%$nm_brg%'
	AND tanggal_klr BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}
?>
<html>
<head>
	<title>Cetak Data Transaksi Barang Keluar</title>
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

	<h3 style="text-align: center; text-decoration: underline;">Laporan Data Transaksi Barang Keluar</h3><br/>
	<?php 	
	$sql_ = mysqli_query($koneksi, $sql) or die (mysqli_error($koneksi));
	$dt = mysqli_fetch_array($sql_);
	echo "<h5 style='text-align: center; margin-top: -4mm;'>Bahan Baku Kopi $dt[nama_barang]</h5>";		
	?>
	<h5 style="text-align: center; margin-top: -4mm">Tanggal <?php echo $tanggal_awal;?> S/D <?php echo $tanggal_akhir;?></h5>

	<table cellspacing="0" width="90%" align="center">
		<tr style="text-align: center;">
			<th>No.</th>
			<th>Tanggal</th> 
			<th>Nama Barang</th>
			<th>Jumlah</th>
		</tr>

		<tbody>
			<?php
			$i = 1;
			$total = 0;
			$goods = 0;
			$sql_barangklr = mysqli_query($koneksi, $sql) or die (mysqli_error($koneksi));
			if (mysqli_num_rows($sql_barangklr) > 0) {
				while ($data = mysqli_fetch_array($sql_barangklr)) { 
					if($i%2!=0){
						$gridcolor="white";
					}else{
						$gridcolor="lavender";
					}
					echo "<tr>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$i++."</td>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$data['tanggal_klr']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['nama_barang']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['jumlah_brg']."</td>";
					echo "</tr>";
					$goods++;
					$total += $data['jumlah_brg'];
				}
			}
			?>
			<tr>
				<th colspan="3" style="text-align: center;">Rata-rata Barang Keluar</th>
				<th style="text-align: left;"><?php echo number_format((float)$total/$goods, 2, '.', '') ; ?> </th>
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
$pdf->Output('Laporan Data Barang Keluar.pdf', 'FI');
?>