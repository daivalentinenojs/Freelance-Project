<?php
if(isset($_GET["NoNotaBeli"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$NoNotaBeli = $MySQLi->real_escape_string($_GET["NoNotaBeli"]);
	$QueryGetDataNotaBeli = "SELECT NotaBelis.NoNotaBeli AS 'NoNotaBeli', 
							      NotaBelis.StatusTerdaftar AS 'StatusTerdaftar'
						   FROM NotaBelis 
						   WHERE NotaBelis.StatusTerdaftar = 1 AND NotaBelis.NoNotaBeli = '$NoNotaBeli'";

	$HasilQueryGetDataNotaBeli = mysqli_query($MySQLi, $QueryGetDataNotaBeli);
	$DataNotaBeli = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaBeli)) {
		$DataNotaBeli[] = $Hasil;
	}

	if ($DataNotaBeli[0]["StatusTerdaftar"] == 1) {
		$StatusTerdaftar = "Tersedia";
	} else {
		$StatusTerdaftar = "Tidak Tersedia";
	}

	echo $DataNotaBeli[0]["NoNotaBeli"]; 

	mysqli_close($MySQLi);
}
?>
