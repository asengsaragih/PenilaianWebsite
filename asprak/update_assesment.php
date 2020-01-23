<?php
include '../asset/php/connection.php';
	if (isset($_POST['update'])) {
		$nim = $_POST['nim'];
		$ass1 = $_POST['nilai_ass1'];
		$ass2 = $_POST['nilai_ass2'];
		$ass3 = $_POST['nilai_ass3'];
		if ($ass1 >= 101 || $ass2 >= 101 || $ass3 >= 101) {
			echo "<script>alert('Nilai Terlalu Besar!'); window.history.back();</script>";
		}
		else {
			$qry = mysqli_query($conn,"update assesment set nilai_ass1 = '$ass1', nilai_ass2 = '$ass2', nilai_ass3 = '$ass3' where nim = '$nim'");
			if (!$qry) {
				echo "<script>alert('Error Input Nilai Ke Database'); window.history.back();</script>";
			}
			else {
				echo "<script>alert('Nilai Berhasil Di input!'); window.history.back();</script>";
			}
		}
	}
	else {
		header("location: index.php");
	}
?>