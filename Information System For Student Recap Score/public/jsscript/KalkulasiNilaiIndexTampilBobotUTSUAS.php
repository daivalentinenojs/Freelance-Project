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
			AND Nilai.Jenis Like '%UTS' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
			$HasilQueryTotalBobotUTS = mysqli_query($MySQLi, $QueryTotalBobotUTS);
			$JumlahBobotUTS = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryTotalBobotUTS))
			{
				$JumlahBobotUTS[] = $Hasil;
			}

			if (empty($JumlahBobotUTS[0]['JumlahBobotUTS']))
					$JumlahBobotUTS[0]['JumlahBobotUTS'] = 0;
	}

	$QueryTotalBobotUAS = "SELECT SUM(Nilai.Bobot) AS JumlahBobotUAS FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%UAS' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
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



	$QueryJumlahNilaiSiapUploadUTS = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUploadUTS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
	AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload' AND RIGHT(Nilai.Jenis,3) LIKE 'UTS'";

	$HasilQueryJumlahNilaiSiapUploadUTS = mysqli_query($MySQLi, $QueryJumlahNilaiSiapUploadUTS);
	$JumlahSiapUploadUTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiSiapUploadUTS)) {
		$JumlahSiapUploadUTS = $Hasil;
	}

	if(empty($JumlahSiapUploadUTS['JumlahSiapUploadUTS'])) {
			$JumlahSiapUploadUTS['JumlahSiapUploadUTS'] = 0;
	}



	$QueryJumlahNilaiSiapUploadUAS = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUploadUAS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
	AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS'";

	$HasilQueryJumlahNilaiSiapUploadUAS = mysqli_query($MySQLi, $QueryJumlahNilaiSiapUploadUAS);
	$JumlahSiapUploadUAS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiSiapUploadUAS)) {
		$JumlahSiapUploadUAS = $Hasil;
	}

	if(empty($JumlahSiapUploadUAS['JumlahSiapUploadUAS'])) {
			$JumlahSiapUploadUAS['JumlahSiapUploadUAS'] = 0;
	}




	$QueryJumlahNilaiTelahDiKalkulasiUTS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasiUTS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
	AND Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiKalkulasi' AND RIGHT(Nilai.Jenis,3) LIKE 'UTS'";

	$HasilQueryJumlahNilaiTelahDiKalkulasiUTS = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiKalkulasiUTS);
	$JumlahTelahDiKalkulasiUTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiKalkulasiUTS)) {
		$JumlahTelahDiKalkulasiUTS = $Hasil;
	}

	if(empty($JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'])) {
			$JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] = 0;
	}



	$QueryJumlahNilaiTelahDiKalkulasiUAS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasiUAS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
	AND Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiKalkulasi' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS'";

	$HasilQueryJumlahNilaiTelahDiKalkulasiUAS = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiKalkulasiUAS);
	$JumlahTelahDiKalkulasiUAS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiKalkulasiUAS)) {
		$JumlahTelahDiKalkulasiUAS = $Hasil;
	}

	if(empty($JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'])) {
			$JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] = 0;
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
								if ($JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] >= 1 || $JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 || $JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1)
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
								if ($JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] >= 1 || $JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 || $JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1)
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
						 if ($JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] >= 1 || $JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 || $JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1)
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
	// if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	// {
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] < 100)
	// 		{
	// 				echo "1";
	// 		}
	// 		else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] < 100)
	// 		{
	// 				echo "2";
	// 		}
	// 		else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100)
	// 		{
	// 				echo "3";
	// 		}
	// 		else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100)
	// 		{
	// 				echo "4";
	// 		}
	// }
	// else
	// {
	// 		if ($JumlahBobotUAS[0]['JumlahBobotUAS'] < 100)
	// 		{
	// 				echo "5";
	// 		}
	// 		else if ($JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100)
	// 		{
	// 				echo "6";
	// 		}
	// }

	// if (!($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1 ||	$JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 || $JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 ||	$JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 || $JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] >= 1 || $JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] >= 1))
	// {
	// 		if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	// 		{
	// 				if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 				{
	// 						echo "11";
	// 				}
	// 				else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 				{
	// 						echo "22";
	// 				}
	// 				else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	// 				{
	// 						echo "33";
	// 				}
	// 				else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	// 				{
	// 						echo "44";
	// 				}
	// 		}
	// 		else
	// 		{
	// 				if ($JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 				{
	// 						echo "5";
	// 				}
	// 				else if ($JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	// 				{
	// 						echo "6";
	// 				}
	// 		}
	// }
	// else
	// {
	// 		if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	// 		{
	// 				if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 				{
	// 						echo "1";
	// 				}
	// 				else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 				{
	// 						echo "2";
	// 				}
	// 				else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	// 				{
	// 						echo "3";
	// 				}
	// 				else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	// 				{
	// 						echo "4";
	// 				}
	// 		}
	// 		else
	// 		{
	// 				if ($JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 				{
	// 						echo "5";
	// 				}
	// 				else if ($JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	// 				{
	// 						echo "6";
	// 				}
	// 		}
	// }

	// $QueryJumlahNilaiTelahDiKalkulasi= "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasi' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND (Nilai.Status = 'TelahDiKalkulasi' OR Nilai.Status = 'SiapUpload' OR Nilai.Status = 'TelahDiUpload')";
	//
	// $HasilQueryJumlahNilaiTelahDiKalkulasi = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiKalkulasi);
	// $JumlahTelahDiKalkulasi = array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiKalkulasi)) {
	// 	$JumlahTelahDiKalkulasi = $Hasil;
	// }
	//
	// if(empty($JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'])) {
	// 		$JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'] = 0;
	// }
	//
	// if ($JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'] >= 1)
	// {
	// 	  echo "5";
	// }
	// else
	// {
	// 	if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 	{
	// 			echo "1";
	// 	}
	// 	else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	// 	{
	// 			echo "2";
	// 	}
	// 	else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	// 	{
	// 			echo "3";
	// 	}
	// 	else
	// 	{
	// 			echo "4";
	// 	}
	// }
}
?>
