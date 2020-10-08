<?php
if(isset($_GET["IDPemasokJualBarang"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDPemasokJualBarang = $MySQLi->real_escape_string($_GET["IDPemasokJualBarang"]);
	$QueryGetDataPemasok = "SELECT Pemasoks.Nama AS 'NamaPemasok'
	FROM Pemasoks INNER JOIN PemasokJualBarangs ON Pemasoks.IDPemasok = PemasokJualBarangs.PemasokID
	WHERE PemasokJualBarangs.IDPemasokJualBarang = '$IDPemasokJualBarang'";

	$HasilQueryGetDataPemasok = mysqli_query($MySQLi, $QueryGetDataPemasok);
	$DataPemasok = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemasok)) {
		$DataPemasok[] = $Hasil;
	}

	echo'<label class="col-md-5 control-label">Nama Pemasok Lama</label>';
	echo'<div class="col-md-6">';
			 echo'<input type="text" name="NamaPemasok" readonly required class="form-control" value="'.$DataPemasok[0]['NamaPemasok'].'" placeholder="Nama Pemasok" style="background:white; color:black;"/>';
	echo'</div>';
	mysqli_close($MySQLi);
}
?>
