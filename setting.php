<?php
	session_start();
	include 'asset/php/connection.php';
	if (!empty($_SESSION['nim'])) {
		$id = $_SESSION['nim'];
		$qry = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$id' ");
		while ($key = mysqli_fetch_array($qry)) {
			$nama = $key['nama_mahasiswa'];
			$nim = $key['nim'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nilai Praktikum</title>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<link rel="stylesheet" type="text/css" href="asset/css/setting.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		<h1>Setting</h1>
		<div class="button">
			<button id="name">Change Name</button>
			<button id="password">Change Password</button>
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
					$qry_check_pass = mysqli_num_rows(mysqli_query($conn,"select * from mahasiswa where nim = '$nim' and password_mahasiswa = '$password'"));
					if ($qry_check_pass > 0) {
						$pembaca_panjang_karakter = strlen($nama);
						if ($pembaca_panjang_karakter <= 50) {
							$qry_update_name = mysqli_query($conn, "update mahasiswa set nama_mahasiswa = '$nama' where password_mahasiswa = '$password' and nim = '$nim'");
							if (!$qry_update_name) {
								echo "<script>alert('Error Update Nama. Silahkan hubungi Asprak!'); window.history.back();</script>";
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
					$qry_check_pass = mysqli_num_rows(mysqli_query($conn,"select * from mahasiswa where nim = '$nim' and password_mahasiswa = '$old_pass'"));
					if ($qry_check_pass > 0) {
						if ($new_pass == $new_pass2) {
							$qry_update_pass = mysqli_query($conn, "update mahasiswa set password_mahasiswa = '$new_pass' where nim = '$nim'");
							if (!$qry_update_pass) {
								echo "<script>alert('Error Update Password. Silahkan hubungi Asprak!'); window.history.back();</script>";
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
		</div>
	</div>
<script>
	$(document).ready(function(){
	  $("#name").click(function(){
	  	$("#name").addClass("button_cc");
	  	$("#password").removeClass("button_cc");
	  	$(".pass_field").hide();
	    $(".name_field").slideToggle("slow");
	  });
	  $("#password").click(function(){
	  	$("#password").addClass("button_cc");
	  	$("#name").removeClass("button_cc");
	  	$(".name_field").hide();
	    $(".pass_field").slideToggle("slow");
	  });
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