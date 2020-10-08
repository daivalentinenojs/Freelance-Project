<?php
if(isset($_GET["IDPemasokEdit"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDPemasok = $MySQLi->real_escape_string($_GET["IDPemasokEdit"]);
	$QueryGetDataPemasok = "SELECT Pemasoks.Alamat AS 'Alamat', Pemasoks.StatusJual AS 'StatusJual',
	Pemasoks.NoKTP AS 'NoKTP', Pemasoks.StatusTerdaftar AS 'StatusTerdaftar'
	FROM Pemasoks WHERE Pemasoks.StatusTerdaftar = 1 AND Pemasoks.IDPemasok = '$IDPemasok'";

	$HasilQueryGetDataPemasok = mysqli_query($MySQLi, $QueryGetDataPemasok);
	$DataPemasok = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemasok)) {
		$DataPemasok[] = $Hasil;
	}

	if ($DataPemasok[0]["StatusTerdaftar"] == "1") {
		$Status = "Aktif";
	} else {
		$Status = "Tidak Aktif";
	}

	if ($DataPemasok[0]["StatusJual"] == "0") {
		$StatusPemasok = "Black List";
	} else if ($DataPemasok[0]["StatusJual"] == "1") {
		$StatusPemasok = "Tidak Pesan";
	}  else if ($DataPemasok[0]["StatusJual"] == "2") {
		$StatusPemasok = "Pesan Lunas";
	} else {
		$StatusPemasok = "Pesan Hutang";
	}



			 echo '<label class="col-md-5 control-label">Alamat</label>';
			 echo '<div class="col-md-5">';
					echo '<input type="text" name="AlamatPemasok" value = "'.$DataPemasok[0]['Alamat'].'" readonly class="form-control" placeholder="Masukkan Alamat" style="background:white; color:black;"/>';
			 echo '</div>';
	mysqli_close($MySQLi);
}
?>
