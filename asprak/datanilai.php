<?php
	include '../asset/php/connection.php';
	if (isset($_GET['export_data'])) {
		$kelas = $_GET['kelas_prak3'];
		$modul = $_GET['modul_prak'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>DATA NILAI</title>
	<style type="text/css">
		td {
			padding: 3px;
		}
	</style>
</head>
<body>
	<?php
		// $filename = "Nilai Praktikum Modul ".$modul." Kelas ".$kelas;
		// header("Content-type: application/vnd-ms-excel");
		// header("Content-Disposition: attachment; filename=$filename.xls");
	?>
	<table border="1">
		<tr>
			<th colspan="7"><?php echo "KELAS : D3TK41-0".$kelas." MODUL : ".$modul; ?></th>
		</tr>
		<tr>
			<!-- <td>NIM</td>
			<td>NAMA</td> -->
			<td>TP</td>
			<td>TES AWAL</td>
			<td>JURNAL</td>
			<td>TES AKHIR</td>
			<td>TOTAL</td>
		</tr>
		<?php
			$qry = mysqli_query($conn, "select * from nilai where id_modul = '$modul' and kelas = '$kelas'");
			while ($key = mysqli_fetch_array($qry)) {
		?>
		<tr>
			<!-- <td><?php echo $key['nim']; ?></td> -->
			<?php
				$nim = $key['nim'];
				$qry2 = mysqli_query($conn, "select * from mahasiswa where nim = '$nim'");
				while ($key2 = mysqli_fetch_array($qry2)) {
			?>
			<!-- <td><?php echo $key2['nama_mahasiswa']; ?></td> -->
			<?php
				}
			?>
			<td><?php echo $key['nilai_tes_pendahuluan']; ?></td>
			<td><?php echo $key['nilai_tes_awal']; ?></td>
			<td><?php echo $key['nilai_jurnal']; ?></td>
			<td><?php echo $key['nilai_tes_akhir']; ?></td>
			<td><?php echo $key['total']; ?></td>
		</tr>
		<?php
			}
		?>
	</table>
</body>
</html>
<?php
}
else {
	header("location: logout.php");
}
?>