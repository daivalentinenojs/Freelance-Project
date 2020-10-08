<?php
if(isset($_GET["IDKaryawan"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDKaryawan = $MySQLi->real_escape_string($_GET["IDKaryawan"]);
	$QueryGetDataKaryawan = "SELECT Pembelis.Nama AS 'Nama', 
							      Pembelis.StatusTerdaftar AS 'StatusTerdaftar'
						   FROM Pembelis 
						   WHERE Pembelis.StatusTerdaftar = 1 AND Pembelis.IDKaryawan = '$IDKaryawan'";

	$HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
	$DataKaryawan = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
		$DataKaryawan[] = $Hasil;
	}

	if ($DataKaryawan[0]["StatusTerdaftar"] == 1) {
		$StatusTerdaftar = "Tersedia";
	} else {
		$StatusTerdaftar = "Tidak Tersedia";
	}

	echo $DataKaryawan[0]["Nama"]; 

	mysqli_close($MySQLi);
}
?>
