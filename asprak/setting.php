<?php
	session_start();
	include '../asset/php/connection.php';
	if (!empty($_SESSION['nim_asprak'])){
		$id = $_SESSION['nim_asprak'];
		$qry = mysqli_query($conn, "SELECT * FROM asprak WHERE nim_asprak = '$id' ");
		while ($key = mysqli_fetch_array($qry)) {
			$nama = $key['nama_asprak'];
			$nim = $key['nim_asprak'];}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nilai Praktikum</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/style.css">
	<link rel="stylesheet" type="text/css" href="../asset/css/setting.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		<h1>Setting</h1>
		<div class="button">
			<button id="name">Change Name</button>
			<button id="password">Change Password</button>
			<button id="add_praktikan">Add Praktikan</button>
			<button id="add_asprak">Add Asprak</button>
			<button id="export">Export Nilai</button>
			<form class="name_field" method="POST">
				<h3>FORM CHANGE NAME</h3>
				<table border="0" width="500px">
					<tr>
						<td>Masukkan Nama Baru</td>
						<td><input type="text" name="nama" placeholder="<?php echo $nama; ?>" required></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="pass_name" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="change_name"></td>
					</tr>
				</table>
			</form>
			<?php
				if (isset($_POST['change_name'])) {
					$nama = $_POST['nama'];
					$password = md5($_POST['pass_name']);
					$qry_check_pass = mysqli_num_rows(mysqli_query($conn,"select * from asprak where nim_asprak = '$nim' and password_asprak = '$password'"));
					if ($qry_check_pass > 0) {
						$pembaca_panjang_karakter = strlen($nama);
						if ($pembaca_panjang_karakter <= 50) {
							$qry_update_name = mysqli_query($conn, "update asprak set nama_asprak = '$nama' where password_asprak = '$password' and nim_asprak = '$nim'");
							if (!$qry_update_name) {
								echo "<script>alert('Error Update Nama!'); window.history.back();</script>";
							}
							else {
								echo "<script>alert('Nama Berhasil Diubah!'); window.history.back();</script>";
							}
						}
						else {
							echo "<script>alert('Maksimum 50 Karakter Termasuk Spasi!'); window.history.back();</script>";
						}
					}
					else {
						echo "<script>alert('Password Salah!'); window.history.back();</script>";
					}
				}
			?>
			<form class="pass_field" method="POST">
				<h3>FORM CHANGE PASSWORD</h3>
				<table border="0" width="500px">
					<tr>
						<td>Password Lama</td>
						<td><input type="password" name="old_pass" required></td>
					</tr>
					<tr>
						<td>Password Baru</td>
						<td><input type="password" name="new_pass" required></td>
					</tr>
					<tr>
						<td>Re-Password Baru</td>
						<td><input type="password" name="new_pass2" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="change_pass" required></td>
					</tr>
				</table>	
			</form>
			<?php
				if (isset($_POST['change_pass'])) {
					$old_pass = md5($_POST['old_pass']);
					$new_pass = md5($_POST['new_pass']);
					$new_pass2 = md5($_POST['new_pass2']);
					$qry_check_pass = mysqli_num_rows(mysqli_query($conn,"select * from asprak where nim_asprak = '$nim' and password_asprak = '$old_pass'"));
					if ($qry_check_pass > 0) {
						if ($new_pass == $new_pass2) {
							$qry_update_pass = mysqli_query($conn, "update asprak set password_asprak = '$new_pass' where nim_asprak = '$nim'");
							if (!$qry_update_pass) {
								echo "<script>alert('Error Update Password!'); window.history.back();</script>";
							}
							else {
								echo "<script>alert('Password Berhasil Diubah!'); window.history.back();</script>";
							}
						}
						else {
							echo "<script>alert('Password Baru 1 dengan 2 Tidak sama!'); window.history.back();</script>";
						}
					}
					else {
						echo "<script>alert('Password Salah!'); window.history.back();</script>";
					}
				}
			?>
			<form class="add_praktikan_field" method="POST">
				<h3>FORM ADD PRAKTIKAN</h3>
				<table border="0" width="500px">
					<tr>
						<td>NIM</td>
						<td><input type="text" name="nim_prak" required></td>
					</tr>
					<tr>
						<td>NAMA</td>
						<td><input type="text" name="nama_prak" placeholder="Nama Lengkap" required></td>
					</tr>
					<tr>
						<td>KELAS</td>
						<td>
							<select name="kelas_prak">
								<?php 
									$qry_search_kelas = mysqli_query($conn,"select * from kelas");
									while ($key = mysqli_fetch_array($qry_search_kelas)) {
								?>
								<option value="<?php echo $key['kelas']; ?>"><?php echo $key['nama_kelas']; ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>PASSWORD Mahasiswa</td>
						<td><input type="password" name="pass_prak" required></td>
					</tr>
					<tr>
						<td>Re-type PASSWORD Mahasiswa</td>
						<td><input type="password" name="pass_prak2" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="add_prak"></td>
					</tr>
				</table>
			</form>
			<?php
				if (isset($_POST['add_prak'])) {
					$nim_prak = $_POST['nim_prak'];
					$nama_prak = $_POST['nama_prak'];
					$kelas_prak = $_POST['kelas_prak'];
					$pwd_prak = md5($_POST['pass_prak']);
					$pwd_prak2 = md5($_POST['pass_prak2']);
					$check = mysqli_num_rows(mysqli_query($conn,"select * from mahasiswa where nim = '$nim_prak' "));
					if ($pwd_prak == $pwd_prak2) {
						if (strlen($nama_prak) <= 50) {
							if (strlen($nim_prak) == 10) {
								if ($check == 0) {
									$insert_data_mhs = "insert into mahasiswa (nim, nama_mahasiswa, kelas, password_mahasiswa) values ('$nim_prak','$nama_prak','$kelas_prak','$pwd_prak')";
									if (mysqli_query($conn, $insert_data_mhs)) {
										$modul1 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','1','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul2 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','2','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul3 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','3','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul4 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','4','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul5 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','5','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul6 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','6','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul7 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','7','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul8 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','8','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul9 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','9','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul10 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','10','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul11 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','11','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul12 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','12','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modul13 = mysqli_query($conn, "insert into nilai (id_nilai, id_modul, nim, kelas, nilai_tes_pendahuluan, nilai_tes_awal, nilai_jurnal, nilai_tes_akhir, total) values ('','13','$nim_prak','$kelas_prak','0','0','0','0','0')");
										$modulass = mysqli_query($conn, "insert into assesment (id_assesment, nim, kelas, nilai_ass1, nilai_ass2, nilai_ass3) values ('','$nim_prak','$kelas_prak','0','0','0')");


										if ($modul1) {
											if ($modul2) {
												if ($modul3) {
													if ($modul4) {
														if ($modul5) {
															if ($modul6) {
																if ($modul7) {
																	if ($modul8) {
																		if ($modul9) {
																			if ($modul10) {
																				if ($modul11) {
																					if ($modul12) {
																						if ($modul13) {
																							if ($modulass) {	
																								echo "<script>alert('Berhasil Menambahkan Mahasiswa!'); window.location.href='setting.php';</script>";
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
									else {
										echo "<script>alert('Error Insert To Database'); window.history.back();</script>";
									}
								}
								else {
									echo "<script>alert('Nim Sudah Terdaftar!'); window.history.back();</script>";
								}
							}
							else {
								echo "<script>alert('Nim Harus 10 Karakter!'); window.history.back();</script>";
							}
							
						}
						else {
							echo "<script>alert('Nama Maksimum 50 Karakter!'); window.history.back();</script>";
						}
						
					}
					else {
						echo "<script>alert('Password Baru 1 dengan 2 Tidak sama!'); window.history.back();</script>";
					}
				}
			?>
			<form class="add_asprak_field" method="POST">
				<h3>FORM ADD ASPRAK</h3>
				<table border="0" width="500px">
					<tr>
						<td>NIM ASPRAK</td>
						<td><input type="text" name="nim_asprak" required></td>
					</tr>
					<tr>
						<td>NAMA ASPRAK</td>
						<td><input type="text" name="nama_asprak" placeholder="Nama Lengkap" required></td>
					</tr>
					<tr>
						<td>PASSWORD ASPRAK</td>
						<td><input type="password" name="pass_asprak" required></td>
					</tr>
					<tr>
						<td>Re-type PASSWORD ASPRAK</td>
						<td><input type="password" name="pass_asprak2" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="add_asprak"></td>
					</tr>
				</table>
			</form>
			<?php
				if (isset($_POST['add_asprak'])) {
					$nim_asprak = $_POST['nim_asprak'];
					$nama_asprak = $_POST['nama_asprak'];
					$pass_asprak = md5($_POST['pass_asprak']);
					$pass_asprak2 = md5($_POST['pass_asprak2']);
					if ($pass_asprak == $pass_asprak2) {
						if (mysqli_query($conn, "insert into asprak (nim_asprak, nama_asprak, password_asprak) values ('$nim_asprak','$nama_asprak','$pass_asprak')")) {
							echo "<script>alert('Berhasil Menambah Asprak!'); window.location.href='setting.php';</script>";
						}
						else {
							echo "<script>alert('Error Database!'); window.history.back();</script>";
						}
					}
					else {
						echo "<script>alert('Field Password 1 dan 2 tidak sama!'); window.history.back();</script>";
					}
				}
			?>
			<form class="expord_field" method="GET" action="datanilai.php" target="_blank">
				<h3>FORM EXPORT DATA</h3>
				<table border="0" width="500px">
					<tr>
						<td>KELAS</td>
						<td>
							<select name="kelas_prak3">
								<?php 
									$qry_search_kelas = mysqli_query($conn,"select * from kelas");
									while ($key = mysqli_fetch_array($qry_search_kelas)) {
								?>
								<option value="<?php echo $key['kelas']; ?>"><?php echo $key['nama_kelas']; ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>MODUL</td>
						<td>
						<select name="modul_prak">
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
						</td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" name="export_data"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
<script>
	$(document).ready(function(){
	  $("#name").click(function(){
	  	$("#add_praktikan").removeClass("button_cc");
	  	$("#name").addClass("button_cc");
	  	$("#password").removeClass("button_cc");
	  	$("#add_praktikan").removeClass("button_cc");
	  	$("#add_asprak").removeClass("button_cc");
	  	$(".add_praktikan_field").hide();
	  	$(".pass_field").hide();
	  	$(".expord_field").hide();
	    $(".add_asprak_field").hide();
	    $(".name_field").slideToggle("slow");
	  });
	  $("#password").click(function(){
	  	$("#add_praktikan").removeClass("button_cc");
	  	$("#password").addClass("button_cc");
	  	$("#name").removeClass("button_cc");
	  	$("#add_praktikan").removeClass("button_cc");
	  	$("#add_asprak").removeClass("button_cc");
	  	$(".name_field").hide();
	  	$(".add_praktikan_field").hide();
	  	$(".expord_field").hide();
	    $(".add_asprak_field").hide();
	    $(".pass_field").slideToggle("slow");
	  });
	  $("#add_praktikan").click(function(){
	  	$("#add_praktikan").addClass("button_cc");
	  	$("#password").removeClass("button_cc");
	  	$("#name").removeClass("button_cc");
	  	$("#export").removeClass("button_cc");
	  	$("#add_asprak").removeClass("button_cc");
	  	$(".name_field").hide();
	    $(".pass_field").hide();
	    $(".expord_field").hide();
	    $(".add_asprak_field").hide();
	    $(".add_praktikan_field").slideToggle("slow");
	  });
	  $("#add_asprak").click(function(){
	  	$("#add_praktikan").removeClass("button_cc");
	  	$("#add_asprak").addClass("button_cc");
	  	$("#password").removeClass("button_cc");
	  	$("#name").removeClass("button_cc");
	  	$("#export").removeClass("button_cc");
	  	$(".name_field").hide();
	    $(".pass_field").hide();
	    $(".add_praktikan_field").hide();
	    $(".expord_field").hide();
	    $(".add_asprak_field").slideToggle("slow");
	  });
	  $("#export").click(function(){
	  	$("#add_praktikan").removeClass("button_cc");
	  	$("#export").addClass("button_cc");
	  	$("#password").removeClass("button_cc");
	  	$("#name").removeClass("button_cc");
	  	$("#add_asprak").removeClass("button_cc");
	  	$(".name_field").hide();
	    $(".pass_field").hide();
	    $(".add_praktikan_field").hide();
	    $(".add_asprak_field").hide();
	    $(".expord_field").slideToggle("slow");
	  });
	});
</script>
</body>
</html>
<?php
}
	else {
		echo "<script>alert('Anda Tidak Dapat Mengakses Ini Tanpa Login!'); window.location.href='login.php';</script>";
	}
?>