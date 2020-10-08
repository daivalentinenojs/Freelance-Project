<?php
if(isset($_GET["IDNotaJual"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDNotaJual = $MySQLi->real_escape_string($_GET["IDNotaJual"]);
	$QueryGetDataNotaJual = "SELECT NotaJuals.IDNotaJual AS 'IDNotaJual', 
							      NotaJuals.StatusTerdaftar AS 'StatusTerdaftar'
						   FROM NotaJuals 
						   WHERE NotaJuals.StatusTerdaftar = 1 AND NotaJuals.IDNotaJual = '$IDNotaJual'";

	$HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
	$DataNotaJual = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
		$DataNotaJual[] = $Hasil;
	}

	if ($DataNotaJual[0]["StatusTerdaftar"] == 1) {
		$StatusTerdaftar = "Tersedia";
	} else {
		$StatusTerdaftar = "Tidak Tersedia";
	}

	echo $DataNotaJual[0]["IDNotaJual"]; 

	mysqli_close($MySQLi);
}
?>
