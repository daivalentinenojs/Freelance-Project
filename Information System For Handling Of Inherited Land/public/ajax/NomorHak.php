<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	if (!empty($IDFP)) {
		$QueryGetDesa = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', Pemohon.IDDesa AS 'IDDesa'
							FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
							WHERE FormulirPermohonan.ID = '$IDFP'";
		$HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDesa);
		$DataDesa = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
			$DataDesa[] = $Hasil;
		}
		if (!empty($DataDesa)) {
			$IDDesa = $DataDesa[0]['IDDesa'];
			$SIDDesa;
			if ($IDDesa < 10) {
				$SIDDesa = '0'.$IDDesa;
			} else if ($IDDesa < 100) {
				$SIDDesa = $IDDesa;
			}

			$QueryGetNomorHak = "SELECT COUNT(BerkasPermohonan.Nomor) AS 'NomorHak'
								FROM BerkasPermohonan INNER JOIN FormulirPermohonan ON (BerkasPermohonan.IDPersyaratan = FormulirPermohonan.ID)
								INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
								WHERE Pemohon.IDDesa = '$IDDesa'";
			$HasilQueryGetDataNomorHak = mysqli_query($MySQLi, $QueryGetNomorHak);
			$DataNomorHak = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNomorHak)) {
				$DataNomorHak[] = $Hasil;
			}

			$RunningNumber =  $DataNomorHak[0]['NomorHak'] + 1;
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
			$NomorHak = '1212/30/'.$SIDDesa.'/M'.$SRunningNumber.'/'.date("Y");

		}
		mysqli_close($MySQLi);
	}
}

if (!empty($NomorHak)) {
	echo '<input type="hidden" style="background:white; color:black;" name="NomorHak" readonly value="'.$NomorHak.'" class="form-control" id="NomorHak" >';
?>
<?php } ?>
