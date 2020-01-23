<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$database_name = "progweb";
	$conn = mysqli_connect($server,$username,$password,$database_name);
	if (!$conn) {
		echo "<h3>Error Database</h3>";
	}

?>