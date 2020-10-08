<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka'])) // Checked V
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);

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
			AND Nilai.Jenis Like '%UTS' AND Nilai.Status = 'TelahDiKalkulasi' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
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
	AND Nilai.Status = 'TelahDiKalkulasi' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
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

	echo "<label class='col-md-4 control-label'>Keterangan</label>";
	$Keterangan = "";
	$PanjangKeterangan = 0;

	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	{
			if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100)
			{
						if ($JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 && $PanjangKeterangan < 2)
						{
							$Keterangan .= "NTS Telah Diverifikasi";
							$PanjangKeterangan++;
						}
						else if ($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1 && $PanjangKeterangan < 2)
						{
							$Keterangan .= "NTS Telah Diunggah";
							$PanjangKeterangan++;
						}
						else
						{
							$Keterangan .= "NTS Belum Dikalkulasi";
							$PanjangKeterangan++;
						}

						if ($PanjangKeterangan == 1)
						{
								$Keterangan .= ", ";
						}
			}

			if ($JumlahBobotUAS[0]['JumlahBobotUAS'] < 100)
			{
						if ($JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 && $PanjangKeterangan < 2)
						{
							$Keterangan .= "NAS Telah Diverifikasi";
							$PanjangKeterangan++;
						}
						else if ($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 && $PanjangKeterangan < 2)
						{
							$Keterangan .= "NAS Telah Diunggah";
							$PanjangKeterangan++;
						}
						else
						{
							$Keterangan .= "NAS Belum Dikalkulasi";
							$PanjangKeterangan++;
						}

						if ($PanjangKeterangan == 1)
						{
								$Keterangan .= ", ";
						}
			}

			if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] < 100 && $PanjangKeterangan < 2)
			{
					$Keterangan .= "Silahkan Klik Tombol Verifikasi NTS ";
					$PanjangKeterangan++;
			}

			if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100 && $PanjangKeterangan < 2)
			{
					$Keterangan .= "Silahkan Klik Tombol Verifikasi NAS ";
					$PanjangKeterangan++;
			}

			if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100 && $PanjangKeterangan < 2)
			{
					$Keterangan .= "Silahkan Klik Tombol Verifikasi NTS atau NAS ";
					$PanjangKeterangan++;
			}
	}
	else
	{
			if ($JumlahBobotUAS[0]['JumlahBobotUAS'] < 100)
			{
						if ($JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 && $PanjangKeterangan < 2)
						{
							$Keterangan .= "NAS Telah Diverifikasi";
							$PanjangKeterangan++;
						}
						else if ($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 && $PanjangKeterangan < 2)
						{
							$Keterangan .= "NAS Telah Diunggah";
							$PanjangKeterangan++;
						}
						else
						{
							$Keterangan .= "NAS Belum Dikalkulasi";
							$PanjangKeterangan++;
						}
			}

			if ($JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100 && $PanjangKeterangan < 2)
			{
					$Keterangan .= "Silahkan Klik Tombol Verifikasi NAS ";
					$PanjangKeterangan++;
			}
	}

	echo "<label class='col-md-5 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>".$Keterangan."</label>";

	mysqli_close($MySQLi);
	
	// echo "<label class='col-md-4 control-label'>Keterangan</label>";
	// $Keterangan = "";
	// $PanjangKeterangan = 0;
	//
	// 	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	// 	{
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] < 100 && $PanjangKeterangan < 2)
	// 		{
	// 				$Keterangan .= "Silahkan Klik Tombol Verifikasi NTS, ";
	// 				$PanjangKeterangan++;
	// 		}
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100 && $PanjangKeterangan < 2)
	// 		{
	// 				$Keterangan .= "Silahkan Klik Tombol Verifikasi NAS, ";
	// 				$PanjangKeterangan++;
	// 		}
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100 && $PanjangKeterangan < 2)
	// 		{
	// 				$Keterangan .= "Silahkan Klik Tombol Verifikasi NTS atau NAS ";
	// 				$PanjangKeterangan++;
	// 		}
	//
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 0 || $JumlahBobotUAS[0]['JumlahBobotUAS'] == 0)
	// 		{
	// 				if ($JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 && $PanjangKeterangan < 2)
	// 				{
	// 					$Keterangan .= "NTS Telah Diverifikasi ";
	// 					$PanjangKeterangan++;
	// 				}
	//
	// 				if ($JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 				{
	// 					$Keterangan .= "NAS Telah Diverifikasi ";
	// 					$PanjangKeterangan++;
	// 				}
	//
	// 				// if ($JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 && $JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 				// {
	// 				// 	$Keterangan .= "NTS dan NAS Telah Diverifikasi ";
	// 				// 	$PanjangKeterangan++;
	// 				// }
	//
	//
	// 				if ($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1 && $PanjangKeterangan < 2)
	// 				{
	// 					$Keterangan .= "NTS Telah Diunggah ";
	// 					$PanjangKeterangan++;
	// 				}
	//
	// 				if ($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 				{
	// 					$Keterangan .= "NAS Telah Diunggah ";
	// 					$PanjangKeterangan++;
	// 				}
	//
	// 				// if ($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1 && $JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 				// {
	// 				// 	$Keterangan .= "NTS dan NAS Telah Diunggah ";
	// 				// 	$PanjangKeterangan++;
	// 				// }
	// 		}
	//
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] >= 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] < 100 && $PanjangKeterangan < 2)
	// 		{
	// 				$Keterangan .= "NAS Belum Dikalkulasi ";
	// 				$PanjangKeterangan++;
	// 		}
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100 && $PanjangKeterangan < 2)
	// 		{
	// 				$Keterangan .= "NTS Belum Dikalkulasi ";
	// 				$PanjangKeterangan++;
	// 		}
	// 		if ($JumlahBobotUTS[0]['JumlahBobotUTS'] < 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] < 100 && $PanjangKeterangan < 2)
	// 		{
	// 				$Keterangan .= "NTS dan NAS Belum Dikalkulasi ";
	// 				$PanjangKeterangan++;
	// 		}
	// }
	// else
	// {
	// 	if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 0 || $JumlahBobotUAS[0]['JumlahBobotUAS'] == 0)
	// 	{
	// 			// if ($JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] >= 1 && $PanjangKeterangan < 2)
	// 			// {
	// 			// 	$Keterangan .= "NTS Telah Dikalkulasi, ";
	// 			// 	$PanjangKeterangan++;
	// 			// }
	// 			//
	// 			// if ($JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] >= 1 && $PanjangKeterangan < 2)
	// 			// {
	// 			// 	$Keterangan .= "NAS Telah Dikalkulasi ";
	// 			// 	$PanjangKeterangan++;
	// 			// }
	//
	// 			// if ($JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] >= 1 && $JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] >= 1 && $PanjangKeterangan < 2)
	// 			// {
	// 			// 	$Keterangan .= "NTS dan NAS Telah Dikalkulasi ";
	// 			// 	$PanjangKeterangan++;
	// 			// }
	//
	//
	// 			if ($JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 && $PanjangKeterangan < 2)
	// 			{
	// 				$Keterangan .= "NTS Telah Diverifikasi, ";
	// 				$PanjangKeterangan++;
	// 			}
	//
	// 			if ($JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 			{
	// 				$Keterangan .= "NAS Telah Diverifikasi ";
	// 				$PanjangKeterangan++;
	// 			}
	//
	// 			// if ($JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 && $JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 			// {
	// 			// 	$Keterangan .= "NTS dan NAS Telah Diverifikasi ";
	// 			// 	$PanjangKeterangan++;
	// 			// }
	//
	//
	// 			if ($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1 && $PanjangKeterangan < 2)
	// 			{
	// 				$Keterangan .= "NTS Telah Diunggah, ";
	// 				$PanjangKeterangan++;
	// 			}
	//
	// 			if ($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 			{
	// 				$Keterangan .= "NAS Telah Diunggah ";
	// 				$PanjangKeterangan++;
	// 			}
	//
	// 			// if ($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1 && $JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 && $PanjangKeterangan < 2)
	// 			// {
	// 			// 	$Keterangan .= "NTS dan NAS Telah Diunggah ";
	// 			// 	$PanjangKeterangan++;
	// 			// }
	// 	}
	//
	// 	if ($JumlahBobotUAS[0]['JumlahBobotUAS'] < 100 && $PanjangKeterangan < 2)
	// 	{
	// 			$Keterangan .= "NAS Belum Dikalkulasi";
	// 			$PanjangKeterangan++;
	// 	}
	// 	if ($JumlahBobotUAS[0]['JumlahBobotUAS'] >= 100 && $PanjangKeterangan < 2)
	// 	{
	// 			$Keterangan .= "Silahkan Klik Tombol Verifikasi NAS";
	// 			$PanjangKeterangan++;
	// 	}
	// }
	//
	// echo "<label class='col-md-5 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>".$Keterangan."</label>";
	//
	// mysqli_close($MySQLi);


	// $QueryJumlahNilaiTelahDiUpload = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiUpload'";
	//
	// $HasilQueryJumlahNilaiTelahDiUpload	= mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiUpload);
	// $JumlahTelahDiUpload= array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiUpload)) {
	// 	$JumlahTelahDiUpload = $Hasil;
	// }
	//
	// if(empty($JumlahTelahDiUpload['JumlahTelahDiUpload'])) {
	// 		$JumlahTelahDiUpload['JumlahTelahDiUpload'] = 0;
	// }
	//
	// $QueryJumlahNilaiSiapUpload = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload'";
	//
	// $HasilQueryJumlahNilaiSiapUpload = mysqli_query($MySQLi, $QueryJumlahNilaiSiapUpload);
	// $JumlahSiapUpload= array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiSiapUpload)) {
	// 	$JumlahSiapUpload = $Hasil;
	// }
	//
	// if(empty($JumlahSiapUpload['JumlahSiapUpload'])) {
	// 		$JumlahSiapUpload['JumlahSiapUpload'] = 0;
	// }
	//
	// mysqli_close($MySQLi);
	//
	// require '../../connection/Init.php';
	// $MySQLi = mysqli_connect($domain, $username, $password, $database);
	//
	// $QueryNamaMkBuka = "SELECT MataKuliah.Nama AS 'NamaMkBuka' FROM MataKuliah INNER JOIN MkBuka ON MataKuliah.KodeMk = MkBuka.KodeMk	WHERE MkBuka.KodeMkBuka = '$Kode'";
	//
	// $HasilQueryNamaMkBuka = mysqli_query($MySQLi, $QueryNamaMkBuka);
	// $NamaMkBuka = array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMkBuka)) {
	// 		$NamaMkBuka = $Hasil;
	// }
	//
	// mysqli_close($MySQLi);
	//
	// require '../../connection/RekapNilai.php';
	// $MySQLi = mysqli_connect($domain, $username, $password, $database);
	//
	// $QueryJumlahNilaiTelahDiKalkulasi = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasi' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiKalkulasi'";
	//
	// $HasilQueryJumlahNilaiTelahDiKalkulasi = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiKalkulasi);
	// $JumlahTelahDiKalkulasi= array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiKalkulasi)) {
	// 	$JumlahTelahDiKalkulasi = $Hasil;
	// }
	//
	// if(empty($JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'])) {
	// 		$JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'] = 0;
	// }
	//
	// if ($JumlahTelahDiUpload['JumlahTelahDiUpload'] >= 1)
	// {
	// 	echo "<label class='col-md-4 control-label'>Keterangan</label>";
	// 	echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Nilai Mahasiswa Telah Diunggah' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	// }
	// else if ($JumlahSiapUpload['JumlahSiapUpload'] >= 1)
	// {
	// 	echo "<label class='col-md-4 control-label'>Keterangan</label>";
	// 	echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Nilai Mahasiswa Telah Diverifikasi' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	// }
	// else if ($JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'] >= 1)
	// {
	// 	echo "<label class='col-md-4 control-label'>Keterangan</label>";
	// 	echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Silahkan Klik Tombol Verifikasi' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	// }
	// else
	// {
	// 	echo "<label class='col-md-4 control-label'>Keterangan</label>";
	// 	echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Nilai Mahasiswa Belum Dikalkulasi' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	// }
}
?>
