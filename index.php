<?php
	session_start();
	include 'asset/php/connection.php';
	if (!empty($_SESSION['nim'])) {
		$id = $_SESSION['nim'];
		$qry = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$id' ");
		while ($key = mysqli_fetch_array($qry)) {
			$nama = $key['nama_mahasiswa'];
			$nim = $key['nim'];
			// $qry_chart = mysqli_query($conn,"select * from nilai where nim = '$nim' ");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nilai Praktikum</title>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="asset/chart/Chart.js"></script>
</head>
<body>
	<ul class="sidenav">
  		<li><a class="title" href="index.php">Nilai Praktikum</a></li>
  		<li class="">
  			<a class="name"><?php echo "$nim - $nama"; ?></a>
  		</li>
  		<li><a href="index.php">Nilai Praktikum</a></li>
  		<li><a href="assesment.php">Nilai Assesment</a></li>
  		<li><a href="setting.php">Setting</a></li>
  		<li><a href="logout.php">Log Out</a></li>
	</ul>

	<div class="content">
		<div class="chart">
			<h1>Grafik Nilai Praktikum</h1>
  			<canvas id="myChart"></canvas>
  		</div>
  		<div class="table_nilai">
  			<h1 style="text-align: center;">Table Nilai Praktikum</h1>
  			<table width="100%" border="0">
				<tr>
					<th>Modul</th>
					<th>Tes Pendahuluan</th>
					<th>Tes Awal</th>
					<th>Jurnal</th>
					<th>Tes Akhir</th>
					<th>Total</th>
				</tr>
				<?php
					$qry_table = mysqli_query($conn,"select * from nilai where nim = '$nim' ");
					while ($key_table = mysqli_fetch_array($qry_table)) {
						$tmp_modul = "Modul ";
						$id_modul = $key_table['id_modul'];
				?>
				<tr>
					<td><?php echo "$tmp_modul $id_modul"; ?></td>
					<td><?php echo $key_table['nilai_tes_pendahuluan']; ?></td>
					<td><?php echo $key_table['nilai_tes_awal']; ?></td>
					<td><?php echo $key_table['nilai_jurnal']; ?></td>
					<td><?php echo $key_table['nilai_tes_akhir']; ?></td>
					<td><?php echo $key_table['total']; ?></td>
				</tr>
				<?php
					}
				?>
			</table>
  		</div>
	</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'bar',
		data: {
			labels: ["Modul 1", "Modul 2", "Modul 3", "Modul 4", "Modul 5", "Modul 6", "Modul 7", "Modul 8", "Modul 9", "Modul 10", "Modul 11", "Modul 12", "Modul 13"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$jumlah_modul1 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '1'");
					while ($total1 = mysqli_fetch_array($jumlah_modul1)) {
						echo $total1['total'];
					}
					?>, 
					<?php 
					$jumlah_modul2 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '2'");
					while ($total2 = mysqli_fetch_array($jumlah_modul2)) {
						echo $total2['total'];
					}
					?>, 
					<?php 
					$jumlah_modul3 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '3'");
					while ($total3 = mysqli_fetch_array($jumlah_modul3)) {
						echo $total3['total'];
					}
					?>,
					<?php 
					$jumlah_modul4 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '4'");
					while ($total4 = mysqli_fetch_array($jumlah_modul4)) {
						echo $total4['total'];
					}
					?>,
					<?php 
					$jumlah_modul5 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '5'");
					while ($total5 = mysqli_fetch_array($jumlah_modul5)) {
						echo $total5['total'];
					}
					?>,
					<?php 
					$jumlah_modul6 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '6'");
					while ($total6 = mysqli_fetch_array($jumlah_modul6)) {
						echo $total6['total'];
					}
					?>, 
					<?php 
					$jumlah_modul7 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '7'");
					while ($total7 = mysqli_fetch_array($jumlah_modul7)) {
						echo $total7['total'];
					}
					?>,
					<?php 
					$jumlah_modul8 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '8'");
					while ($total8 = mysqli_fetch_array($jumlah_modul8)) {
						echo $total8['total'];
					}
					?>,
					<?php 
					$jumlah_modul9 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '9'");
					while ($total9 = mysqli_fetch_array($jumlah_modul9)) {
						echo $total9['total'];
					}
					?>,
					<?php 
					$jumlah_modul10 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '10'");
					while ($total10 = mysqli_fetch_array($jumlah_modul10)) {
						echo $total10['total'];
					}
					?>,
					<?php 
					$jumlah_modul11 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '11'");
					while ($total11 = mysqli_fetch_array($jumlah_modul11)) {
						echo $total11['total'];
					}
					?>,
					<?php 
					$jumlah_modul12 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '12'");
					while ($total12 = mysqli_fetch_array($jumlah_modul12)) {
						echo $total12['total'];
					}
					?>,  
					<?php 
					$jumlah_modul13 = mysqli_query($conn,"SELECT * FROM nilai WHERE nim = '$nim' AND id_modul = '13'");
					while ($total13 = mysqli_fetch_array($jumlah_modul13)) {
						echo $total13['total'];
					}
					?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
</script>

</body>
</html>
<?php
}
	}
	else {
		echo "<script>alert('Anda Tidak Dapat Mengakses Ini Tanpa Login!'); window.location.href='login.php';</script>";
	}
?>