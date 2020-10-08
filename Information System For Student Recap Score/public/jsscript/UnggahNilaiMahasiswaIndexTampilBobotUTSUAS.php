<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["kpMkBuka"])) // Checked V
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
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

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	{
			$QueryTotalBobotUTS = "SELECT SUM(Nilai.Bobot) AS JumlahBobotUTS FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP'
			AND Nilai.Jenis Like '%UTS' AND Nilai.Status = 'SiapUpload' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
			$HasilQueryTotalBobotUTS = mysqli_query($MySQLi, $QueryTotalBobotUTS);
			$JumlahBobotUTS = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryTotalBobotUTS))
			{
				$JumlahBobotUTS[] = $Hasil;
			}

			if (empty($JumlahBobotUTS[0]['JumlahBobotUTS']))
					$JumlahBobotUTS[0]['JumlahBobotUTS'] = 0;
	}

	$QueryTotalBobotUAS = "SELECT SUM(Nilai.Bobot) AS JumlahBobotUAS FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%UAS'
	AND Nilai.Status = 'SiapUpload' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
	$HasilQueryTotalBobotUAS = mysqli_query($MySQLi, $QueryTotalBobotUAS);
	$JumlahBobotUAS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryTotalBobotUAS))
	{
		$JumlahBobotUAS[] = $Hasil;
	}

	if (empty($JumlahBobotUAS[0]['JumlahBobotUAS']))
			$JumlahBobotUAS[0]['JumlahBobotUAS'] = 0;


	$QueryJumlahNilaiTelahDiUploadUTS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiUploadUTS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND
	Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiUpload' AND RIGHT(Nilai.Jenis,3) LIKE 'UTS'";

	$HasilQueryJumlahNilaiTelahDiUploadUTS	= mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiUploadUTS);
	$JumlahTelahDiUploadUTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiUploadUTS)) {
		$JumlahTelahDiUploadUTS = $Hasil;
	}

	if(empty($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'])) {
			$JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] = 0;
	}



	$QueryJumlahNilaiTelahDiUploadUAS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiUploadUAS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND
	Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiUpload' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS'";

	$HasilQueryJumlahNilaiTelahDiUploadUAS	= mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiUploadUAS);
	$JumlahTelahDiUploadUAS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiUploadUAS)) {
		$JumlahTelahDiUploadUAS = $Hasil;
	}

	if(empty($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'])) {
			$JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] = 0;
	}



	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
  {
			if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100)
			{
					echo "7";
			}
			else
			{
					if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100)
					{
								if ($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1)
								{
									 echo "1";
								}
								else
								{
									 echo "2";
								}
					}
					else
					{
								echo "5";
					}

					if ($JumlahBobotUAS[0]['JumlahBobotUAS'] < 100)
					{
								if ($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1)
								{
										echo "3";
								}
								else
								{
										echo "4";
								}
					}
					else
					{
							 echo "6";
					}
			}
  }
  else
  {
			if ($JumlahBobotUAS[0]['JumlahBobotUAS'] < 100)
			{
						 if ($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1)
						 {
								 echo "8";
						 }
						 else
						 {
								 echo "9";
						 }
			}

			if ($JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100)
			{
					echo "10";
			}
  }
}
?>
