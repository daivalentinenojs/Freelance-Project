<?php
if(isset($_GET["IDPemasokJualBarang"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDPemasokJualBarang = $MySQLi->real_escape_string($_GET["IDPemasokJualBarang"]);
	$QueryGetDataPemasok = "SELECT PemasokJualBarangs.HargaBeli AS 'HargaBeli'
	FROM PemasokJualBarangs WHERE PemasokJualBarangs.IDPemasokJualBarang = '$IDPemasokJualBarang'";

	$HasilQueryGetDataPemasok = mysqli_query($MySQLi, $QueryGetDataPemasok);
	$DataPemasok = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPemasok)) {
		$DataPemasok[] = $Hasil;
	}

	echo'<label class="col-md-5 control-label">Harga Beli Pemasok Lama</label>';
	echo'<div class="col-md-4">';
			 echo'<input type="text" name="HargaBeli" readonly onkeypress="return isNumberKey(event)" required class="form-control" value="Rp. '.number_format($DataPemasok[0]['HargaBeli'], 2, ",", ".").'" placeholder="Harga Beli Pemasok" style="background:white; color:black;"/>';
	echo'</div>';
	mysqli_close($MySQLi);
}
?>
