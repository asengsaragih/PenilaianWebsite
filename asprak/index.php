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
			<h1>Data Nilai Praktikum</h1>
			<h3 id="view_modul"></h3>
			<form method="GET">
				<select name="modul">
					<?php
						$qry_modul = mysqli_query($conn, "select * from modul"); 
						while ($modul = mysqli_fetch_array($qry_modul)) {
							$id_modul = $modul['id_modul'];
							$nama_modul = $modul['nama_modul'];
					?>
				    <option value="<?php echo $id_modul; ?>"><?php echo "Modul $id_modul - $nama_modul"; ?></option>
				    <?php
				    	}
				    ?>
  				</select>
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
			<table width="100%">
				<tr>
					<th>MODUL - KELAS</th>
					<th>NIM</th>
					<th>TP</th>
					<th>TES AWAL</th>
					<th>JURNAL</th>
					<th>TES AKHIR</th>
					<th>UPDATE</th>
				</tr>
			<?php
				if (isset($_GET['cari'])) {
					$tmp_modul = $_GET['modul'];
					$tmp_kelas = $_GET['kelas'];
					$qry_cari = mysqli_query($conn, "SELECT * FROM nilai WHERE id_modul = '$tmp_modul' AND kelas = '$tmp_kelas'");
					while ($tmp_mahasiswa = mysqli_fetch_array($qry_cari)) {
						$nim = $tmp_mahasiswa['nim'];
			?>
				<tr>
					<form method="POST" action="update.php">
					<td><?php echo "Modul ".$tmp_mahasiswa['id_modul']." - D3TK 41-0".$tmp_mahasiswa['kelas']; ?></td>
					<td><?php echo "$nim"; ?></td>
					<input class="hilang" type="number" name="nim" value="<?php echo $nim; ?>">
					<input class="hilang" type="number" name="modul" value="<?php echo $tmp_mahasiswa['id_modul']; ?>">
					<td><input type="number" name="tp" value="<?php echo $tmp_mahasiswa['nilai_tes_pendahuluan']; ?>"></td>
					<td><input type="number" name="tawal" value="<?php echo $tmp_mahasiswa['nilai_tes_awal']; ?>"></td>
					<td><input type="number" name="jurnal" value="<?php echo $tmp_mahasiswa['nilai_jurnal']; ?>"></td>
					<td><input type="number" name="takhir" value="<?php echo $tmp_mahasiswa['nilai_tes_akhir']; ?>"></td>
					<td><input type="submit" name="update" value="UPDATE"></td>
					</form>
				</tr>
			<?php
					}
				}
			// if (isset($_POST['update'])) {
			// 	$tp = $_POST['tp'];
			// 	$tawal = $_POST['tawal'];
			// 	$jurnal = $_POST['jurnal'];
			// 	$takhir = $_POST['takhir'];
			// 	$total = $tp + $tawal + $jurnal + $takhir;
			// 	if ($tp >= 101) {
			// 		echo "<script>alert('Nilai Terlalu Besar!');</script>";
			// 		echo "<h1>$nim</h1>";
			// 	}
			// }
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