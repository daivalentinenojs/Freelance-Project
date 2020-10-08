<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["NPK"])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$KpMkBuka = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckBatasNTS = "SELECT COUNT(BAAK.SemesterAktif.BatasInputNTS) AS 'BatasInputNTS' FROM BAAK.SemesterAktif
	WHERE now() < BAAK.SemesterAktif.BatasInputNTS AND BAAK.SemesterAktif.ThnAkademik = '$ThnAkademik' AND BAAK.SemesterAktif.Semester = '$Semester'
	GROUP BY BAAK.SemesterAktif.ThnAkademik, BAAK.SemesterAktif.Semester";

	$HasilQueryCheckBatasNTS = mysqli_query($MySQLi, $QueryCheckBatasNTS);
	$CheckBatasNTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckBatasNTS))
	{
		$CheckBatasNTS[] = $Hasil;
	}

	if(empty($CheckBatasNTS[0]['BatasInputNTS'])) {
			$CheckBatasNTS[0]['BatasInputNTS'] = 0;
	}

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
	mysqli_close($MySQLi);

	// Kalau Koordinator
	if ($CheckKoordinator == 1)
	{
		require '../../connection/RekapNilai.php';
		$MySQLi = mysqli_connect($domain, $username, $password, $database);

		$QueryJenisNilai = "SHOW COLUMNS FROM Nilai LIKE 'Jenis'";
		$HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
		$JenisNilais = array();

		while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai))
		{
			$JenisNilais[] = $Hasil;
		}
		$IsiEnum = $JenisNilais[0]['Type'];
		$SplitIsi = substr($IsiEnum, 6, -2);
		$ArrayHasil = explode("','", $SplitIsi);
		$TempArray = array();

		if ($CheckBatasNTS[0]['BatasInputNTS'] == 0)
		{
			for ($q=0; $q < COUNT($ArrayHasil); $q++) {
					if(SUBSTR($ArrayHasil[$q],-3) == 'UAS')
					{
							$TempArray[] = $ArrayHasil[$q];
					}
			}
			$ArrayHasil = $TempArray;
		}

		echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
		echo "<select  name='jenisNilai' id='jenisNilai' data-toggle='tooltip' data-placement='right' title='Silahkan Memilih Jenis Penilaian' class='form-control' style='width: 30%'>";
		for ($i=0; $i < count($ArrayHasil); $i++) {
				echo "<option value=".$ArrayHasil[$i].">".$ArrayHasil[$i]."</option>";
		}
		echo "</select>";
		mysqli_close($MySQLi);
	}
	else // Kalau Bukan Koordinator
	{
		require '../../connection/Init.php';
		$MySQLi = mysqli_connect($domain, $username, $password, $database);

		$QueryGetNPKKoordinator = "SELECT MkBuka.NPK AS NPK FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";

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

		if ($CheckBatasNTS[0]['BatasInputNTS'] == 0)
		{
				$QueryNilaiYangDibuatKoordinator = "SELECT DISTINCT Nilai.Jenis AS Jenis FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.DosenPembuat = '$NPKKoordinator' AND Nilai.Syarat = 1 AND RIGHT(Nilai.Jenis,-3) = 'UAS'";
		}
		else
		{
				$QueryNilaiYangDibuatKoordinator = "SELECT DISTINCT Nilai.Jenis AS Jenis FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.DosenPembuat = '$NPKKoordinator' AND Nilai.Syarat = 1";
		}

		$HasilQueryNilaiYangDibuatKoordinator = mysqli_query($MySQLi, $QueryNilaiYangDibuatKoordinator);
		$NilaiYangDibuatKoordinator = array();

		while($Hasil = mysqli_fetch_assoc($HasilQueryNilaiYangDibuatKoordinator))
		{
			$NilaiYangDibuatKoordinator[] = $Hasil;
		}

		if(empty($NilaiYangDibuatKoordinator))
		{
			echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
			echo "<div class='col-md-6 style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Koordinator Belum Pernah Menambah Jenis Nilai'>Belum ada jenis penilaian yang diinputkan oleh Koordinator Mata Kuliah !</div>";
		}
		else
		{
			echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
			echo "<select  id='jenisNilai' name='jenisNilai' class='form-control' style='width: 30%' data-toggle='tooltip' data-placement='right' title='Silahkan Memilih Jenis Penilaian'>";
			for ($i=0; $i < count($NilaiYangDibuatKoordinator); $i++) {
					echo "<option value=".$NilaiYangDibuatKoordinator[$i]['Jenis'].">".$NilaiYangDibuatKoordinator[$i]['Jenis']."</option>";
			}
			echo "</select>";
		}
		mysqli_close($MySQLi);
	}
}
?>
