<?php
	include '../asset/php/connection.php';
	if (isset($_POST['update'])) {
		$nim = $_POST['nim'];
		$modul = $_POST['modul'];
		$tp = $_POST['tp'];
		$tawal = $_POST['tawal'];
		$jurnal = $_POST['jurnal'];
		$takhir = $_POST['takhir'];
		$total = $tp + $tawal + $jurnal + $takhir;
		if ($total >= 101) {
			echo "<script>alert('Nilai Terlalu Besar!'); window.history.back();</script>";
		}
		else {
			$qry = mysqli_query($conn,"update nilai set nilai_tes_pendahuluan ='$tp', nilai_tes_awal = '$tawal', nilai_jurnal = '$jurnal', nilai_tes_akhir = '$takhir', total = '$total' where nim = '$nim' AND id_modul = '$modul' ");
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