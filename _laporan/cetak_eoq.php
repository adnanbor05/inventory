<?php
session_start();
ob_start();
include_once("../_config/koneksi.php"); //buat koneksi ke database

$sql = "SELECT * FROM eoq_rop ORDER BY nama_barang ASC";

?>
<html>
<head>
	<title>Cetak Data Perhitungan EOQk</title>
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

	<h3 style="text-align: center; text-decoration: underline;">Laporan Data Perhitungan Menggunakan Metode Economic Order Quantity</h3><br/>

	<table cellspacing="0" width="100%" align="center">
		<tr style="text-align: center;">
			<th >No.</th>
			<th class="text-center">Kode EOQ</th>
			<th class="text-center">Nama Barang</th>
			<th class="text-center">Jenis Barang</th>
			<th class="text-center">Periode</th>
			<th class="text-center">Deman</th>
			<th class="text-center">B_pemesanan</th>
			<th class="text-center">B_penyimpanan</th>
			<th class="text-center">Pemakaian/hari</th>
			<th class="text-center">Leadtime</th>
			<th class="text-center">EOQ</th>
			<th class="text-center">ROP</th>
		</tr>

		<tbody>
			<?php
			$i = 1;
			$total = 0;
			$sql_lapbarang = mysqli_query($koneksi, $sql) or die (mysqli_error($koneksi));
			if (mysqli_num_rows($sql_lapbarang) > 0) {
				while ($data = mysqli_fetch_array($sql_lapbarang)) { 
					if($i%2!=0){
						$gridcolor="white";
					}else{
						$gridcolor="lavender";
					}
					echo "<tr>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$i++."</td>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$data['kode_eoq']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['nama_barang']."</td>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$data['jenis_barang']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['periode']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['deman']." Pcs</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>Rp. ".$data['b_pemesanan']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>Rp. ".$data['b_penyimpanan']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['total_pemakaian']." Pcs</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['leadtime']." Hari</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['eoq']." Pcs</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['rop']." Pcs</td>";
					echo "</tr>";
				}
			}
			?>

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
$pdf = new HTML2PDF('L','A3','en');
$pdf->WriteHTML($html);
ob_end_clean();
$pdf->Output('Laporan Data Perhitungan.pdf', 'FI');
?>