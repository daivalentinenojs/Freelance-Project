<?php
if(isset($_GET["IDBarang"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDBarang = $MySQLi->real_escape_string($_GET["IDBarang"]);
	$QueryGetDataBarang = "SELECT Barangs.IDBarang AS 'IDBarang', 
							      Barangs.StatusTerdaftar AS 'StatusTerdaftar'
						   FROM Barangs 
						   WHERE Barangs.StatusTerdaftar = 1 AND Barangs.IDBarang = '$IDBarang'";

	$HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
	$DataBarang = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
		$DataBarang[] = $Hasil;
	}

	if ($DataBarang[0]["StatusTerdaftar"] == 1) {
		$StatusTerdaftar = "Tersedia";
	} else {
		$StatusTerdaftar = "Tidak Tersedia";
	}

	echo $DataBarang[0]["IDBarang"]; 

	mysqli_close($MySQLi);
}
?>
