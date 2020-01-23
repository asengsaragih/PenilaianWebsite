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
			<h1>Grafik Nilai Assesment</h1>
  			<canvas id="myChart"></canvas>
  		</div>
  		<div class="table_nilai">
  			<h1 style="text-align: center;">Table Nilai Assesment</h1>
  			<table width="100%" border="0">
				<tr>
					<th>Assesment 1</th>
					<th>Assesment 2</th>
					<th>Assesment 3</th>
				</tr>
				<?php
					$qry_table = mysqli_query($conn,"select * from assesment where nim = '$nim'");
					while ($key_table = mysqli_fetch_array($qry_table)) {
				?>
				<tr>
					<td><?php echo $key_table['nilai_ass1']; ?></td>
					<td><?php echo $key_table['nilai_ass2']; ?></td>
					<td><?php echo $key_table['nilai_ass3']; ?></td>
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
			labels: ["Assesment 1", "Assesment 2", "Assesment 3"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$jumlah_assesment1 = mysqli_query($conn,"SELECT * FROM assesment WHERE nim = '$nim'");
					while ($total1 = mysqli_fetch_array($jumlah_assesment1)) {
						echo $total1['nilai_ass1'];
					}
					?>, 
					<?php 
					$jumlah_assesment2 = mysqli_query($conn,"SELECT * FROM assesment WHERE nim = '$nim'");
					while ($total2 = mysqli_fetch_array($jumlah_assesment2)) {
						echo $total2['nilai_ass2'];
					}
					?>, 
					<?php 
					$jumlah_assesment3 = mysqli_query($conn,"SELECT * FROM assesment WHERE nim = '$nim'");
					while ($total13 = mysqli_fetch_array($jumlah_assesment3)) {
						echo $total13['nilai_ass3'];
					}
					?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)'
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