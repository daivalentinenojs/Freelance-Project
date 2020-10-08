<?php
if(isset($_GET["NoNotaJual"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$NoNotaJual = $MySQLi->real_escape_string($_GET["NoNotaJual"]);
	$QueryGetDataNotaJual = "SELECT NotaJuals.NoNotaJual AS 'NoNotaJual', 
							      NotaJuals.StatusTerdaftar AS 'StatusTerdaftar'
						   FROM NotaJuals 
						   WHERE NotaJuals.StatusTerdaftar = 1 AND NotaJuals.NoNotaJual = '$NoNotaJual'";

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

	echo $DataNotaJual[0]["NoNotaJual"]; 

	mysqli_close($MySQLi);
}
?>
