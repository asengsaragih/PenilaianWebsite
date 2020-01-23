<?php
	include 'asset/php/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>LIST</title>
</head>
<body>
	<table width="50%" border="1">
		<tr>
			<th>Modul</th>
			<th>TES PENDAHULUAN</th>
			<th>TES AWAL</th>
			<th>JURNAL</th>
			<th>TES AKHIR</th>
			<th>TOTAL</th>
		</tr>
		<?php
			$nim = "6706174098";
			$qry = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '6702170077'");
			while ($key = mysqli_fetch_array($qry)) {
				$modul = $key['id_modul'];
				$tp = $key['nilai_tes_pendahuluan'];
				$ta = $key['nilai_tes_awal'];
				$jurnal = $key['nilai_jurnal'];
				$takhir = $key['nilai_tes_akhir'];
				$total = $key['total'];
		?>
		<tr>
			<td><?php echo $modul; ?></td>
			<td><?php echo $tp; ?></td>
			<td><?php echo $ta; ?></td>
			<td><?php echo $jurnal; ?></td>
			<td><?php echo $takhir; ?></td>
			<td><?php echo $total; ?></td>
		</tr>
		<?php
			}
		?>
	</table>
</body>
</html>