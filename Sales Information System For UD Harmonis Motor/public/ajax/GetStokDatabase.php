<?php
if(isset($_GET["IDBarang"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDBarang = $MySQLi->real_escape_string($_GET["IDBarang"]);
	$QueryGetDataBarang = "SELECT Barangs.Stok AS 'Stok', 
							      Barangs.StatusTerdaftar AS 'StatusTerdaftar'
						   FROM Barangs 
						   WHERE Barangs.StatusTerdaftar = 1 AND Barangs.IDBarang = '$IDBarang'";

	$HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
	$DataBarang = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
		$DataBarang[] = $Hasil;
	}

	if ($DataBarang[0]["StatusTerdaftar"] == 1) {
		$StatusTerdaftar = "Aktif";
	} else {
		$StatusTerdaftar = "Tidak Aktif";
	}

	// echo "<div style='margin-top:12px;'> Rp ".number_format($DataBarang[0]["HargaJual"], 2, ',', '.')."</div>"; 

	echo $DataBarang[0]["Stok"];

	mysqli_close($MySQLi);
}
?>
