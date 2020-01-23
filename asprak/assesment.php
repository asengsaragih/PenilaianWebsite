<?php
	session_start();
	include '../asset/php/connection.php';
	if (!empty($_SESSION['nim_asprak'])) {
		$id = $_SESSION['nim_asprak'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nilai Praktikum</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<ul class="sidenav">
  		<li><a class="title" href="index.php">Nilai Praktikum</a></li>
  		<li><a href="index.php">Input Nilai Praktikum</a></li>
  		<li><a href="assesment.php">Input Nilai Assesment</a></li>
  		<li><a href="setting.php">Setting</a></li>
  		<li><a href="logout.php">Log Out</a></li>
	</ul>

	<div class="content">
		<div class="table_nilai">
			<h1>Data Nilai Assesment</h1>
			<h3 id="view_modul"></h3>
			<form method="GET">
				<select name="kelas">
				    <?php
						$qry_kelas = mysqli_query($conn, "select * from kelas"); 
						while ($kelas = mysqli_fetch_array($qry_kelas)) {
							$id_kelas = $kelas['kelas'];
							$nama_kelas = $kelas['nama_kelas'];
					?>
				    <option value="<?php echo $id_kelas; ?>"><?php echo $nama_kelas; ?></option>
				    <?php
				    	}
				    ?>
  				</select>
				<input type="submit" name="cari">
			</form>
			<?php
				if (isset($_GET['cari'])) {
					$tmp_kelas = $_GET['kelas'];
					$qry_cari = mysqli_query($conn, "SELECT * FROM assesment WHERE kelas = '$tmp_kelas'");
			?>
			<table width="100%">
				<tr>
					<th colspan="5" style="font-size: 20px; color: white; padding: 2%;"><?php echo "D3 Teknik Komputer 41-0".$tmp_kelas;?></th>
				</tr>
				<tr>
					<th>NIM</th>
					<th>ASSESMENT 1</th>
					<th>ASSESMENT 2</th>
					<th>ASSESMENT 3</th>
					<th>UPDATE</th>
				</tr>
			<?php
					while ($tmp_mahasiswa = mysqli_fetch_array($qry_cari)) {
						$nim = $tmp_mahasiswa['nim'];
			?>
				<tr>
					<form method="POST" action="update_assesment.php">
					<td><?php echo "$nim"; ?></td>
					<td><input type="number" name="nilai_ass1" value="<?php echo $tmp_mahasiswa['nilai_ass1']; ?>"></td>
					<td><input type="number" name="nilai_ass2" value="<?php echo $tmp_mahasiswa['nilai_ass2']; ?>"></td>
					<td><input type="number" name="nilai_ass3" value="<?php echo $tmp_mahasiswa['nilai_ass3']; ?>"></td>
					<td><input type="submit" name="update" value="UPDATE"></td>

					<input class="hilang" type="number" name="nim" value="<?php echo $nim; ?>">
					</form>
				</tr>
			<?php
					}
				}
			?>
		</table>
		</div>
	</div>
</body>
</html>
<?php
	}
	else {
		echo "<script>alert('Anda Tidak Dapat Mengakses Ini Tanpa Login!'); window.location.href='login.php';</script>";
	}
?>