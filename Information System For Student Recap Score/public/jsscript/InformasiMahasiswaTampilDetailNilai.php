<?php
if(isset($_GET['KodeSubString']) AND isset($_GET['NRP'])) // Checked V Y
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['KodeSubString']);
	$NRP = $MySQLi->real_escape_string($_GET['NRP']);

	$Hasil = explode(",", $Kode);

	$NamaMkBuka = $Hasil[0];
	$KP = $Hasil[1];
	$KodeMkBuka = $Hasil[6];

	$QueryNilaiDaftar = "SELECT RekapNilai.Nilai.KodeNilai AS 'KodeNilaiDaftar', RekapNilai.Nilai.Jenis AS 'JenisNilaiDaftar'
	FROM RekapNilai.Nilai WHERE RekapNilai.Nilai.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.Nilai.KP = '$KP' AND Nilai.Syarat = 1
	AND (RekapNilai.Nilai.Status = 'Daftar' OR RekapNilai.Nilai.Status = 'TelahDiKalkulasi' OR RekapNilai.Nilai.Status = 'SiapUpload' OR RekapNilai.Nilai.Status = 'TelahDiUpload') ORDER BY RekapNilai.Nilai.WaktuBuat ASC";

	$HasilQueryNilaiDaftar = mysqli_query($MySQLi, $QueryNilaiDaftar);
	$NilaiStatusDaftar = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryNilaiDaftar))
	{
		$NilaiStatusDaftar[] = $Hasil;
	}

	if(empty($NilaiStatusDaftar))
	{
	    echo "Belum ada Detail Nilai yang diinputkan";
	}
	else
	{
			echo "<span style='font-size:12px; margin-left:20px;'><strong>Detail Nilai Mahasiswa Mata Kuliah ".$NamaMkBuka."</strong></span><br><br>";
			echo "<table class='table datatable' style='margin-left:20px; width:50%;'><thead><tr>";
			echo "<th style='text-align:center;'>Jenis</th>";
			echo "<th style='text-align:center;'>Nilai</th>";
			echo "<th style='text-align:center;'>Nisbi</th>";
			echo "</tr></thead><tbody>";

			for ($k=0; $k < COUNT($NilaiStatusDaftar); $k++)
			{
					$TempSatuNilai = $NilaiStatusDaftar[$k]['KodeNilaiDaftar'];
					$TempJenisSatuNilai = $NilaiStatusDaftar[$k]['JenisNilaiDaftar'];

					$QueryDetailTiapNilai = "SELECT RekapNilai.Nilai.Jenis AS 'JenisNilai', RekapNilai.NilaiMahasiswa.Nilai AS 'NilaiMahasiswa', RekapNilai.NilaiMahasiswa.KodeNisbi AS 'KodeNisbiMahasiswa'
					FROM RekapNilai.Nilai INNER JOIN RekapNilai.NilaiMahasiswa ON RekapNilai.Nilai.KodeNilai = RekapNilai.NilaiMahasiswa.KodeNilai WHERE RekapNilai.Nilai.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.Nilai.KP = '$KP'
					AND RekapNilai.Nilai.Syarat = 1 AND RekapNilai.NilaiMahasiswa.NRP = '$NRP' AND RekapNilai.Nilai.KodeNilai = '$TempSatuNilai'";
					$HasilQueryDetailTiapNilai = mysqli_query($MySQLi, $QueryDetailTiapNilai);
					$DetailNilai = array();
					while($Hasil = mysqli_fetch_assoc($HasilQueryDetailTiapNilai))
					{
						$DetailNilai[] = $Hasil;
					}
					// print_r($DetailNilai);
					echo "<tr>";
					if(!empty($DetailNilai))
					{
							echo "<td style='text-align:center;'>".$DetailNilai[0]['JenisNilai']."</td>";
							echo "<td style='text-align:center;'>".$DetailNilai[0]['NilaiMahasiswa']."</td>";
							echo "<td style='text-align:center;'>".$DetailNilai[0]['KodeNisbiMahasiswa']."</td>";
					}
					else
					{
							if($TempJenisSatuNilai == 'UTS')
							{
									$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol' FROM BAAK.MhsAmbilMk
									WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP' AND BAAK.MhsAmbilMk.HadirUTS = 'N';";

									$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
									$CheckNRPUTSUASNol = array();
									while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
									{
										$CheckNRPUTSUASNol[] = $Hasil;
									}
							}
							else if($TempJenisSatuNilai == 'UAS')
							{
									$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol' FROM BAAK.MhsAmbilMk
									WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP' AND
									(BAAK.MhsAmbilMk.HadirUAS = 'N' || BAAK.MhsAmbilMk.StatusTilangPresensi = 'Y');";

									$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
									$CheckNRPUTSUASNol = array();
									while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
									{
										$CheckNRPUTSUASNol[] = $Hasil;
									}
							}

							$Print = 0;
							if ($TempJenisSatuNilai == 'UTS' || $TempJenisSatuNilai == 'UAS')
							{
									for ($p=0; $p < COUNT($CheckNRPUTSUASNol); $p++)
									{
											if ($NRP == $CheckNRPUTSUASNol[$p]['NRPUASNol'])
											{
													echo "<td style='text-align:center;'>".$TempJenisSatuNilai."</td>";
													echo "<td style='text-align:center;'>Tidak Hadir</td>";
													echo "<td style='text-align:center;'>Tidak Hadir</td>";
													$p = COUNT($CheckNRPUTSUASNol);
													$Print = 1;
											}
											if ($p == (COUNT($CheckNRPUTSUASNol)-1) && $Print == 0)
											{
													echo "<td style='text-align:center;'>".$TempJenisSatuNilai."</td>";
													echo "<td style='text-align:center;'>0</td>";
													echo "<td style='text-align:center;'>0</td>";
											}
									}
							}
							else
							{
									echo "<td style='text-align:center;'>".$TempJenisSatuNilai."</td>";
									echo "<td style='text-align:center;'>0</td>";
									echo "<td style='text-align:center;'>0</td>";
							}
					}
					echo "</tr>";
			}

			$QueryStatusNTS = "SELECT COUNT(RekapNilai.Nilai.KodeNilai) AS 'JumlahStatusNTS' FROM RekapNilai.Nilai WHERE RekapNilai.Nilai.KodeMkBuka = '$KodeMkBuka'
			AND RekapNilai.Nilai.KP = '$KP' AND RIGHT(RekapNilai.Nilai.Jenis,3) = 'UTS' AND
			(RekapNilai.Nilai.Status = 'TelahDiKalkulasi' || RekapNilai.Nilai.Status = 'SiapUpload' || RekapNilai.Nilai.Status = 'TelahDiUpload')
			GROUP BY RekapNilai.Nilai.KodeNilai";
			$HasilQueryStatusNTS = mysqli_query($MySQLi, $QueryStatusNTS);
			$StatusNTS = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryStatusNTS))
			{
					$StatusNTS[] = $Hasil;
			}

			$QueryStatusNAS = "SELECT COUNT(RekapNilai.Nilai.KodeNilai) AS 'JumlahStatusNAS' FROM RekapNilai.Nilai WHERE RekapNilai.Nilai.KodeMkBuka = '$KodeMkBuka'
			AND RekapNilai.Nilai.KP = '$KP' AND RIGHT(RekapNilai.Nilai.Jenis,3) = 'UAS' AND
			(RekapNilai.Nilai.Status = 'TelahDiKalkulasi' || RekapNilai.Nilai.Status = 'SiapUpload' || RekapNilai.Nilai.Status = 'TelahDiUpload')
			GROUP BY RekapNilai.Nilai.KodeNilai";
			$HasilQueryStatusNAS = mysqli_query($MySQLi, $QueryStatusNAS);
			$StatusNAS = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryStatusNAS))
			{
					$StatusNAS[] = $Hasil;
			}

			if(!empty($StatusNTS))
			{
				if ($StatusNTS[0]['JumlahStatusNTS'] >= 1)
				{
						$QueryNilaiNTS = "SELECT RekapNilai.MhsAmbilMk.NTS AS 'NilaiNTS' FROM RekapNilai.MhsAmbilMk
						WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.MhsAmbilMk.KP = '$KP' AND RekapNilai.MhsAmbilMk.NRP = '$NRP'";
						$HasilQueryNilaiNTS = mysqli_query($MySQLi, $QueryNilaiNTS);
						$NTS = array();
						while($Hasil = mysqli_fetch_assoc($HasilQueryNilaiNTS))
						{
							$NTS[] = $Hasil;
						}

						if(!empty($NTS))
						{
							if ($NTS[0]['NilaiNTS'] >= 81 && $NTS[0]['NilaiNTS'] <= 100)
							{
									$KodeNisbi = "A";
							}
							else if ($NTS[0]['NilaiNTS'] >= 73 && $NTS[0]['NilaiNTS'] < 81)
							{
									$KodeNisbi = "AB";
							}
							else if ($NTS[0]['NilaiNTS'] >= 66 && $NTS[0]['NilaiNTS'] < 73)
							{
									$KodeNisbi = "B";
							}
							else if ($NTS[0]['NilaiNTS'] >= 60 && $NTS[0]['NilaiNTS'] < 66)
							{
									$KodeNisbi = "BC";
							}
							else if ($NTS[0]['NilaiNTS'] >= 55 && $NTS[0]['NilaiNTS'] < 60)
							{
									$KodeNisbi = "C";
							}
							else if ($NTS[0]['NilaiNTS'] >= 40 && $NTS[0]['NilaiNTS'] < 55)
							{
									$KodeNisbi = "D";
							}
							else if ($NTS[0]['NilaiNTS'] >= 0 && $NTS[0]['NilaiNTS'] < 40)
							{
									$KodeNisbi = "E";
							}

							echo "<tr><td style='text-align:center;'>NTS</td>";
							echo "<td style='text-align:center;'>".$NTS[0]['NilaiNTS']."</td>";
							echo "<td style='text-align:center;'>".$KodeNisbi."</td></tr>";
					 }
				 }
			}

			if(!empty($StatusNAS))
			{
				if ($StatusNAS[0]['JumlahStatusNAS'] >= 1)
				{
						$QueryNilaiNAS = "SELECT RekapNilai.MhsAmbilMk.NAS AS 'NilaiNAS' FROM RekapNilai.MhsAmbilMk
						WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.MhsAmbilMk.KP = '$KP' AND RekapNilai.MhsAmbilMk.NRP = '$NRP'";
						$HasilQueryNilaiNAS = mysqli_query($MySQLi, $QueryNilaiNAS);
						$NAS = array();
						while($Hasil = mysqli_fetch_assoc($HasilQueryNilaiNAS))
						{
							$NAS[] = $Hasil;
						}

						if(!empty($NTS))
						{
							if ($NAS[0]['NilaiNAS'] >= 81 && $NAS[0]['NilaiNAS'] <= 100)
							{
									$KodeNisbi = "A";
							}
							else if ($NAS[0]['NilaiNAS'] >= 73 && $NAS[0]['NilaiNAS'] < 81)
							{
									$KodeNisbi = "AB";
							}
							else if ($NAS[0]['NilaiNAS'] >= 66 && $NAS[0]['NilaiNAS'] < 73)
							{
									$KodeNisbi = "B";
							}
							else if ($NAS[0]['NilaiNAS'] >= 60 && $NAS[0]['NilaiNAS'] < 66)
							{
									$KodeNisbi = "BC";
							}
							else if ($NAS[0]['NilaiNAS'] >= 55 && $NAS[0]['NilaiNAS'] < 60)
							{
									$KodeNisbi = "C";
							}
							else if ($NAS[0]['NilaiNAS'] >= 40 && $NAS[0]['NilaiNAS'] < 55)
							{
									$KodeNisbi = "D";
							}
							else if ($NAS[0]['NilaiNAS'] >= 0 && $NAS[0]['NilaiNAS'] < 40)
							{
									$KodeNisbi = "E";
							}

							echo "<tr><td style='text-align:center;'>NAS</td>";
							echo "<td style='text-align:center;'>".$NAS[0]['NilaiNAS']."</td>";
							echo "<td style='text-align:center;'>".$KodeNisbi."</td></tr>";
					 }
				 }
			}

			echo "</tbody></table>";
	}
}
	//
	// $QueryNilaiNTSNAS = "SELECT MhsAmbilMk.NTS AS 'NilaiNTS', MhsAmbilMk.NAS AS 'NilaiNAS', MhsAmbilMk.NA AS 'NilaiNA', MhsAmbilMk.KodeNisbi AS 'KodeNisbi'
	// FROM MhsAmbilMk WHERE MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND MhsAmbilMk.KP = '$KP' AND MhsAmbilMk.NRP = '$NRP'";
	// $HasilQueryNilaiNTSNAS = mysqli_query($MySQLi, $QueryNilaiNTSNAS);
	// $NTSNAS = array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryNilaiNTSNAS))
	// {
	// 	$NTSNAS[] = $Hasil;
	// }
	//
 // 	if(empty($DetailNilai))
	// {
	// 		echo "Belum ada Detail Nilai yang di upload";
	// }
	// else
	// {
	// 	echo "<span style='font-size:12px; margin-left:20px;'><strong>Detail Nilai Mahasiswa Mata Kuliah ".$NamaMkBuka."</strong></span><br><br>";
	// 	echo "<table class='table' style='margin-left:20px; width:50%;'><thead><tr>";
	// 	echo "<th style='text-align:center;'>Jenis</th>";
	// 	echo "<th style='text-align:center;'>Nilai</th>";
	// 	echo "<th style='text-align:center;'>Nisbi</th>";
	// 	echo "</tr></thead><tbody>";
	// 	for ($i=0; $i < count($DetailNilai); $i++)
	// 	{
	// 		echo "<tr>";
	// 		echo "<td style='text-align:center;'>".$DetailNilai[$i]['JenisNilai']."</td>";
	// 		echo "<td style='text-align:center;'>".$DetailNilai[$i]['NilaiMahasiswa']."</td>";
	// 		echo "<td style='text-align:center;'>".$DetailNilai[$i]['KodeNisbiMahasiswa']."</td>";
	// 		echo "</tr>";
	// 	}
	//
	// 	if(!empty($NTSNAS))
	// 	{
	// 		if ($NTSNAS[0]['NilaiNTS'] >= 81 && $NTSNAS[0]['NilaiNTS'] <= 100)
	// 		{
	// 				$KodeNisbi = "A";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNTS'] >= 73 && $NTSNAS[0]['NilaiNTS'] < 81)
	// 		{
	// 				$KodeNisbi = "AB";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNTS'] >= 66 && $NTSNAS[0]['NilaiNTS'] < 73)
	// 		{
	// 				$KodeNisbi = "B";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNTS'] >= 60 && $NTSNAS[0]['NilaiNTS'] < 66)
	// 		{
	// 				$KodeNisbi = "BC";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNTS'] >= 55 && $NTSNAS[0]['NilaiNTS'] < 60)
	// 		{
	// 				$KodeNisbi = "C";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNTS'] >= 40 && $NTSNAS[0]['NilaiNTS'] < 55)
	// 		{
	// 				$KodeNisbi = "D";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNTS'] >= 0 && $NTSNAS[0]['NilaiNTS'] < 40)
	// 		{
	// 				$KodeNisbi = "E";
	// 		}
	//
	// 		echo "<tr>";
	// 		echo "<td style='text-align:center;'>NTS</td>";
	// 		echo "<td style='text-align:center;'>".$NTSNAS[0]['NilaiNTS']."</td>";
	// 		echo "<td style='text-align:center;'>".$KodeNisbi."</td>";
	// 		echo "</tr>";
	//
	// 		if ($NTSNAS[0]['NilaiNAS'] >= 81 && $NTSNAS[0]['NilaiNAS'] <= 100)
	// 		{
	// 				$KodeNisbi = "A";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNAS'] >= 73 && $NTSNAS[0]['NilaiNAS'] < 81)
	// 		{
	// 				$KodeNisbi = "AB";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNAS'] >= 66 && $NTSNAS[0]['NilaiNAS'] < 73)
	// 		{
	// 				$KodeNisbi = "B";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNAS'] >= 60 && $NTSNAS[0]['NilaiNAS'] < 66)
	// 		{
	// 				$KodeNisbi = "BC";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNAS'] >= 55 && $NTSNAS[0]['NilaiNAS'] < 60)
	// 		{
	// 				$KodeNisbi = "C";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNAS'] >= 40 && $NTSNAS[0]['NilaiNAS'] < 55)
	// 		{
	// 				$KodeNisbi = "D";
	// 		}
	// 		else if ($NTSNAS[0]['NilaiNAS'] >= 0 && $NTSNAS[0]['NilaiNAS'] < 40)
	// 		{
	// 				$KodeNisbi = "E";
	// 		}
	//
	// 		echo "<tr>";
	// 		echo "<td style='text-align:center;'>NAS</td>";
	// 		echo "<td style='text-align:center;'>".$NTSNAS[0]['NilaiNAS']."</td>";
	// 		echo "<td style='text-align:center;'>".$KodeNisbi."</td>";
	// 		echo "</tr>";
	//
	// 		echo "<tr>";
	// 		echo "<td style='text-align:center;'>NA</td>";
	// 		echo "<td style='text-align:center;'>".$NTSNAS[0]['NilaiNA']."</td>";
	// 		echo "<td style='text-align:center;'>".$NTSNAS[0]['KodeNisbi']."</td>";
	// 		echo "</tr>";
	// 	}
	// 	echo "</tbody></table>";
// 	}
// }
?>
