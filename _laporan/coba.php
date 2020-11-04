<?php
session_start();
ob_start();
include_once("../_config/koneksi.php"); //buat koneksi ke database

$sql = "SELECT * FROM barang ORDER BY nama_barang ASC";

?>
<html>
<head>
	<title>Cetak coba</title>
	<style>

		table{
			border-collapse: collapse;
			width: 100%;
			color: #717375;
		}
		table strong{
			color: #000;
		}
		h1{
			color: #000;
			margin: 0;
			padding: 0;
		}
		td.right {
			text-align: right;
		}
		table.border td{
			border: 1px solid #CFD1D2;
			padding: 3mm 1mm;
		}
		table.border th{
			background: #000;
			color: #fff;
			font-weight: normal;
		}
	</style>
</head>
<body>
	<page backtop="20mm" backleft="10mm" backright="10mm" backtop="30mm">
	<table>
		<tr>
			<td style="width: 75%; background-color: #717375">
				<strong>Balakosa Coffe & Co</strong><br/>
				Jl. Kedawung, Nologaten, Caturtunggal, Depok, Sleman, Yogyakarta <br/>
			</td>
			<td style="width: 25%">20/20/2020</td>
		</tr>
	</table>

	<table style="vertical-align: bottom: ; margin-top: 20mm;">
		<tr>
			<td style="width: 50%;"> <h1>Data Barang</h1></td>
			<td style="width: 50%;" class="right"> 09/09/2020</td>
		</tr>
	</table>

	<table class="border">
		<tr style="text-align: center;">
			<th >No.</th>
			<th >kode Barang</th>
			<th >Nama Barang</th>
			<th >Jenis Barang</th>
			<th >Stok</th>
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
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$data['kode_barang']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['nama_barang']."</td>";
					echo "<td style='text-align: center;' bgcolor='".$gridcolor."'>".$data['jenis_barang']."</td>";
					echo "<td style='text-align: left;' bgcolor='".$gridcolor."'>".$data['stok_barang']."</td>";
					echo "</tr>";
				}
			}
			?>
		</page>
		</tbody>
	</table>
	

</body>
</html>
<?php
$html = ob_get_contents();
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','fr');

$pdf->pdf->SetDisplayMode('fullpage');

$pdf->WriteHTML($html);
ob_end_clean();
$pdf->Output('coba.pdf', 'FI');
?>