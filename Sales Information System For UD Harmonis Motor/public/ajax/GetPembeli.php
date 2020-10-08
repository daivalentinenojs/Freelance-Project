<?php
if(isset($_GET["IDPembeli"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDPembeli = $MySQLi->real_escape_string($_GET["IDPembeli"]);
	$QueryGetDataPembeli = "SELECT Pembelis.Kota AS Kota, Pembelis.Bank AS Bank, 
								   Pembelis.StatusLangganan AS 'StatusLangganan', 
							       Pembelis.StatusTerdaftar AS 'StatusTerdaftar'
						    FROM Pembelis 
						    WHERE Pembelis.StatusTerdaftar = 1,
						          Pembelis.IDPembeli = '$IDPembeli'";

	$HasilQueryGetDataPembeli = mysqli_query($MySQLi, $QueryGetDataPembeli);
	$DataPembeli = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembeli)) {
		$DataPembeli[] = $Hasil;
	}

	if ($DataPembeli[0]["StatusTerdaftar"] == 1) {
		$StatusTerdaftar = "Aktif";
	} else {
		$StatusTerdaftar = "Tidak Aktif";
	}

	echo $DataPembeli[0]["Kota"];
	echo $DataPembeli[0]["Bank"];
	echo $DataPembeli[0]["StatusLangganan"];

	mysqli_close($MySQLi);
}
?>