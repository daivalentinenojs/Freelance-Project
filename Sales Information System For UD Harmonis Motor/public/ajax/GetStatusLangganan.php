<?php
if(isset($_GET["IDPembeli"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDPembeli = $MySQLi->real_escape_string($_GET["IDPembeli"]);
	$QueryGetDataPembeli = "SELECT Pembelis.StatusLangganan AS 'StatusLangganan', 
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

	if ($DataPembeli[0]["StatusLangganan"] == 1) {
		$StatusLangganan = "Langganan";
	} else {
		$StatusLangganan = "Tidak Langganan";
	}

	echo $StatusLangganan;

	mysqli_close($MySQLi);
}
?>
