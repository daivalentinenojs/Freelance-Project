<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	if (!empty($IDFP)) {
		$QueryGetNomorBeritaAcara = "SELECT COUNT(BeritaAcara.Nomor) AS 'NomorBeritaAcara'
																		FROM BeritaAcara";
		$HasilQueryGetDataNomorBeritaAcara = mysqli_query($MySQLi, $QueryGetNomorBeritaAcara);
		$DataNomorBeritaAcara = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNomorBeritaAcara)) {
			$DataNomorBeritaAcara[] = $Hasil;
		}

		$RunningNumber =  $DataNomorBeritaAcara[0]['NomorBeritaAcara'] + 1;
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

		$Date = '';
		if (date("m") == 1) {
			$Date = 'I';
		} elseif (date("m") == 2) {
			$Date = 'II';
		} elseif (date("m") == 3) {
			$Date = 'III';
		} elseif (date("m") == 4) {
			$Date = 'IV';
		} elseif (date("m") == 5) {
			$Date = 'V';
		} elseif (date("m") == 6) {
			$Date = 'VI';
		} elseif (date("m") == 7) {
			$Date = 'VII';
		}	elseif (date("m") == 8) {
		 $Date = 'VIII';
	  } elseif (date("m") == 9) {
		 $Date = 'IX';
	  } elseif (date("m") == 10) {
		 $Date = 'X';
	  } elseif (date("m") == 11) {
		 $Date = 'XI';
	  } elseif (date("m") == 12) {
		 $Date = 'XII';
	  }

		$NomorBeritaAcara = $SRunningNumber.'/'.date("Y");
	}
	mysqli_close($MySQLi);
}

if (!empty($NomorBeritaAcara)) {
	echo '<input type="text" name="NomorBeritaAcara" value="'.$NomorBeritaAcara.'" class="form-control" required id="NomorBeritaAcara" readonly style="background-color:white; color:black;">';
?>
<?php } ?>
