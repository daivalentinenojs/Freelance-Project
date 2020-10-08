<?php
if(isset($_GET["IDBarang"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDBarang = $MySQLi->real_escape_string($_GET["IDBarang"]);
	$QueryGetDataBarang = "SELECT Barangs.HPP AS 'HargaBeli', 
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

	//echo "<div style='margin-top:12px;'>".number_format($DataBarang[0]["HargaBeli"], 2, ',', '.')."</div>"; 

	echo $DataBarang[0]["HargaBeli"];

	mysqli_close($MySQLi);
}

	function formatMoney($number, $fractional = false){
		if($fractional){
			$number= sprintf('%.2f', $number);
		}
		while(true){
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if ($replaced != $number){
				$number = $replaced;
			}
			else{
				break;
			}
		}
		return $number;
	}
?>
