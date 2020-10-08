<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["NPK"])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$KpMkBuka = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckKoordinator = "SELECT count(MkBuka.KodeMkBuka) AS Jumlah FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.NPK = '$NPK' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'
	Group By MkBuka.KodeMkBuka";

	$HasilQueryCheckKoordinator = mysqli_query($MySQLi, $QueryCheckKoordinator);
	$CheckKoordinators = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckKoordinator))
	{
		$CheckKoordinators[] = $Hasil;
	}

	if (empty($CheckKoordinators[0]['Jumlah']))
		$CheckKoordinators[0]['Jumlah'] = 0;

	$CheckKoordinator = $CheckKoordinators[0]['Jumlah'];

	// Kalau Koordinator
	if ($CheckKoordinator == 1)
	{
		echo "<label class='col-md-3 control-label'>Bobot</label>";
    echo "<div class='col-md-3'>";
    echo "<input id='bobotNilai' value = '0' onkeypress='return isNumberKey(event)' data-toggle='tooltip' data-placement='right' title='Silahkan Memasukkan Bobot Penilaian' type='number' step=any required min='1' max '100' size='5' style='width:65%; margin-left:-10px; border-radius:3px;' name='bobotNilai' class='form-control'/>";
    echo "<span class='help-block'>Contoh : 20</span>";
    echo "</div>";
	}
	else // Kalau Bukan Koordinator
	{
		$QueryGetNPKKoordinator = "SELECT MkBuka.NPK AS NPK FROM mkbuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";

		$HasilQueryGetNPKKoordinator = mysqli_query($MySQLi, $QueryGetNPKKoordinator);
		$NPK = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetNPKKoordinator))
		{
			$NPK[] = $Hasil;
		}
		$NPKKoordinator = $NPK[0]['NPK'];
		mysqli_close($MySQLi);

		require '../../connection/RekapNilai.php';
		$MySQLi = mysqli_connect($domain, $username, $password, $database);

		$QueryNilaiYangDibuatKoordinator = "SELECT DISTINCT Nilai.Jenis AS Jenis FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.DosenPembuat = '$NPKKoordinator' AND Nilai.Syarat = 1";

		$HasilQueryNilaiYangDibuatKoordinator = mysqli_query($MySQLi, $QueryNilaiYangDibuatKoordinator);
		$NilaiYangDibuatKoordinator = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryNilaiYangDibuatKoordinator))
		{
			$NilaiYangDibuatKoordinator[] = $Hasil;
		}

		if(empty($NilaiYangDibuatKoordinator))
		{
			echo "<label class='col-md-3 control-label'>Bobot</label>";
			echo "<div class='col-md-6' style='margin-top:8px;' data-toggle='tooltip' data-placement='top' title='Koordinator Belum Pernah Menambah Jenis Nilai'>Tidak dapat menginputkan bobot !</div>";
	  }
		else
		{
			echo "<label class='col-md-3 control-label'>Bobot</label>";
	    echo "<div class='col-md-3'>";
	    echo "<input id='bobotNilai' value='0' onkeypress='return isNumberKey(event)' type='number' data-toggle='tooltip' data-placement='right' title='Silahkan Memasukkan Bobot Penilaian' step=any required min='1' max '100' size='5' style='width:65%; margin-left:-10px; border-radius:3px;'' name='bobotNilai' class='form-control'/>";
	    echo "<span class='help-block'>Contoh : 20</span>";
	    echo "</div>";
		}
		mysqli_close($MySQLi);
	}
}
?>
