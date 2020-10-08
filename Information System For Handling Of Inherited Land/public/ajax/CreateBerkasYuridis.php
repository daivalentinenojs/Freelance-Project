<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	if (!empty($IDFP)) {
		// $QueryGetDesa = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', Pemohon.IDDesa AS 'IDDesa'
		// 					FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
		// 					WHERE FormulirPermohonan.ID = '$IDFP'";
		// $HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDesa);
		// $DataDesa = array();
		// while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
		// 	$DataDesa[] = $Hasil;
		// }
		//
		// $IDDesa = $DataDesa[0]['IDDesa'];

		$QueryGetNomorFisik = "SELECT COUNT(BerkasPengumuman.NomorFisik) AS 'NomorFisik'
							FROM BerkasPengumuman
							WHERE BerkasPengumuman.NomorFisik != ''";
		$HasilQueryGetDataNomorFisik = mysqli_query($MySQLi, $QueryGetNomorFisik);
		$DataNomorFisik = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNomorFisik)) {
			$DataNomorFisik[] = $Hasil;
		}

		$RunningNumber =  $DataNomorFisik[0]['NomorFisik'] + 1;
		$SRunningNumber = '';
		if ($RunningNumber < 10) {
			$SRunningNumber = '0000'.$RunningNumber;
		} else if ($RunningNumber < 100) {
			$SRunningNumber = '000'.$RunningNumber;
		} else if ($RunningNumber < 1000) {
			$SRunningNumber = '00'.$RunningNumber;
		} else if ($RunningNumber < 10000) {
			$SRunningNumber = '0'.$RunningNumber;
		}
		$NomorFisik = $SRunningNumber.'/'.date("Y");

		$QueryGetNIB = "SELECT BerkasPermohonan.NIB AS 'NIB'
							FROM BerkasPermohonan
							WHERE BerkasPermohonan.IDPersyaratan = '$IDFP'";
		$HasilQueryGetDataNIB = mysqli_query($MySQLi, $QueryGetNIB);
		$DataNIB = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNIB)) {
			$DataNIB[] = $Hasil;
		}

		$NIB = '';
		if (!empty($DataNIB[0]['NIB'])) {
			$NIB =  $DataNIB[0]['NIB'];
		}

	}
	mysqli_close($MySQLi);
}

if (!empty($NomorFisik)) {
?>
<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Nomor Fisik</label>
	<div class="col-sm-3">
		<input type="text" name="NomorBerkasPengumuman" value="<?php echo $NomorFisik; ?>" class="form-control" required readonly style="color:black; background-color:white;" id="NomorBerkasPengumuman" onkeypress="return isNumberKey(event)">
	</div>
</div>
<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Nomor Bidang</label>
	<div class="col-sm-3">
		<input type="text" name="NomorBidang" value="<?php echo $NIB; ?>" class="form-control" required readonly style="color:black; background-color:white;" id="NomorBidang" onkeypress="return isNumberKey(event)">
	</div>
</div>
<?php } ?>
