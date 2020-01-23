<?php
	include 'asset/php/connection.php';
	if (isset($_POST['login'])) {
				$nim = $_POST['nim'];
				$password = md5($_POST['password']);
				$sql = "SELECT * FROM mahasiswa WHERE nim='$nim' and password_mahasiswa='$password' ";
				$qry = mysqli_query($conn,$sql);
				$cek = mysqli_num_rows($qry);

				if ($cek > 0) {
					session_start();
					$_SESSION['nim'] = $nim;
					echo "<script>alert('Berhasil Login!'); window.location.href='index.php';</script>";
				}
				else {
					echo "<script>alert('Username atau Password Salah!'); window.location.href='login.php';</script>";
				}
			}
	else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nilai Praktikum</title>
	<link rel="stylesheet" type="text/css" href="asset/css/login.css">
</head>
<body>
	<div class="container">
		<div class="box">
			<h2>FORM LOGIN PRAKTIKAN</h2>
			<form method="POST">
				<input type="text" name="nim" placeholder="NIM">
				<input type="password" name="password" placeholder="Password">
				<input type="submit" name="login">
			</form>
			<?php
			
			?>
		</div>
	</div>
</body>
</html>
<?php
	}
?>