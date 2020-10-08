<?php
if(isset($_GET["IDPembeli"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDPembeli = $MySQLi->real_escape_string($_GET["IDPembeli"]);
	$QueryGetDataPembeli = "SELECT Pembelis.Kota AS 'Kota', 
							      Pembelis.StatusTerdaftar AS 'StatusTerdaftar'
						   FROM Pembelis 
						   WHERE Pembelis.StatusTerdaftar = 1 AND Pembelis.IDPembeli = '$IDPembeli'";

	$HasilQueryGetDataPembeli = mysqli_query($MySQLi, $QueryGetDataPembeli);
	$DataPembeli = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembeli)) {
		$DataPembeli[] = $Hasil;
	}

	if ($DataPembeli[0]["StatusTerdaftar"] == 1) {
		$StatusTerdaftar = "Tersedia";
	} else {
		$StatusTerdaftar = "Tidak Tersedia";
	}

	echo $DataPembeli[0]["Kota"]; 

	mysqli_close($MySQLi);
}
?>
