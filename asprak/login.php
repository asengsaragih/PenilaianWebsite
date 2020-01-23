<?php
session_start();
if (empty($_SESSION['nim_asprak'])) {
	include '../asset/php/connection.php';
	if (isset($_POST['login'])) {
				// $nim_asprak = $_POST['nim'];
				// $password = md5($_POST['password']);
				// $sql = "SELECT * FROM asprak WHERE nim_asprak='$nim_asprak' and password_asprak='$password' ";
				// $qry = mysqli_query($conn,$sql);
				$logiin = mysqli_prepare($conn, "SELECT * FROM asprak WHERE nim_asprak= ? and password_asprak= ?");

				mysqli_stmt_bind_param($logiin, "ss", $_POST['nim'], md5($_POST['password']));
				mysqli_execute($logiin);
				mysqli_stmt_store_result($logiin);

				$cek = mysqli_stmt_num_rows($logiin);

				if ($cek > 0) {
					session_start();
					$_SESSION['nim_asprak'] = 1;
					echo "<script>alert('Berhasil Login!'); window.location.href='index.php';</script>";
				}
				else {
					echo "<script>alert('Username atau Password Salah!');</script>";
					header("location: login.php");
				}
			}
	else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nilai Praktikum</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/login.css">
</head>
<body>
	<div class="container">
		<div class="box">
			<h2>FORM LOGIN ASPRAK</h2>
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
}
else {
	header("location: index.php");
}
?>