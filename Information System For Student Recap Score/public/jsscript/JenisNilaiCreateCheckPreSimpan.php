<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["ketentuanNilai"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["jenisNilai"]) AND isset($_GET["bobotNilai"])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$CheckBisaTambahAtauTidak = 0;

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);
	$Ketentuan = $MySQLi->real_escape_string($_GET["ketentuanNilai"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$Jenis = $MySQLi->real_escape_string($_GET["jenisNilai"]);
	$Bobot = $MySQLi->real_escape_string($_GET["bobotNilai"]);

	$QueryCheckKoordinator = "SELECT count(MkBuka.NPK) AS Jumlah FROM MkBuka WHERE KodeMkBuka = '$Kode' AND NPK = '$NPK' AND ThnAkademik = '$ThnAkademik' AND Semester = '$Semester' Group By KodeMkBuka";
	$HasilQueryCheckKoordinator = mysqli_query($MySQLi, $QueryCheckKoordinator);
	$CheckKoordinator = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckKoordinator))
	{
		$CheckKoordinator[] = $Hasil;
	}

	if (empty($CheckKoordinator[0]['Jumlah']))
		$CheckKoordinator[0]['Jumlah'] = 0;

	mysqli_close($MySQLi);

	if ($Bobot == "undefined")
	{
		$CheckBisaTambahAtauTidak = 111;
	}
	else if($Bobot == 0)
	{
			$CheckBisaTambahAtauTidak = 0;
	}
	else if($CheckKoordinator[0]['Jumlah'] == 1)
	{
			if ($Ketentuan == 1)
			{
						require '../../connection/Init.php';
						$MySQLi = mysqli_connect($domain, $username, $password, $database);

						$QueryGetSemuaKPMkBuka = "SELECT DosenAjarMk.KP FROM DosenAjarMk INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE DosenAjarMk.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
						$HasilQueryGetSemuaKPMkBuka = mysqli_query($MySQLi, $QueryGetSemuaKPMkBuka);
						$SemuaKP = array();
						while($Hasil = mysqli_fetch_assoc($HasilQueryGetSemuaKPMkBuka))
						{
							$SemuaKP[] = $Hasil;
						}

						mysqli_close($MySQLi);

						require '../../connection/RekapNilai.php';
						$MySQLi = mysqli_connect($domain, $username, $password, $database);

						// Keterangan
						// 0 Bisa Di Tambah
						// 1 Total Lebih dari 100%
						// 2 Penilaian Ada

						for ($i=0; $i < count($SemuaKP); $i++)
						{
							$SubStrJenisNilai = substr($Jenis, -3);
							$KPDiCheck = $SemuaKP[$i]['KP'];

							$QueryTotalBobotKPTertentu = "SELECT SUM(Nilai.Bobot) AS 'Bobot' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPDiCheck' AND Nilai.Jenis Like '%$SubStrJenisNilai' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
							$HasilQueryTotalBobotKPTertentu = $MySQLi->query($QueryTotalBobotKPTertentu);
							$Hasil=$HasilQueryTotalBobotKPTertentu->fetch_assoc();

							$TotalDB=0;

							if($Hasil['Bobot'] == "")
							{
								$TotalDB=0;
							}
							else
							{
								$TotalDB = $Hasil['Bobot'];
							}

							$Total = $TotalDB + $Bobot;

							if ($Jenis == "UTS" || $Jenis == "UAS")
							{
									$QueryCheckUTSUASAda = "SELECT Count(Nilai.KodeNilai) AS 'Jumlah' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPDiCheck' AND Nilai.Jenis Like '$Jenis' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
									$HasilQueryCheckUTSUASAda = $MySQLi->query($QueryCheckUTSUASAda);
									$Hasil=$HasilQueryCheckUTSUASAda->fetch_assoc();

									if($Hasil['Jumlah'] >= 1)
									{
										if($Total > 100)
										{
											$CheckBisaTambahAtauTidak = 521;
											$i = count($SemuaKP);
										}
										else
										{
											$CheckBisaTambahAtauTidak = 520;
											$i = count($SemuaKP);
										}
									}
									else
									{
										if ($Total > 100)
										{
											$CheckBisaTambahAtauTidak = 510;
											$i = count($SemuaKP);
										}
										else
										{
											$CheckBisaTambahAtauTidak = 51;
										}
									}
							}
							else
							{
								if($Total > 100)
								{
									$CheckBisaTambahAtauTidak = 510;
									$i = count($SemuaKP);
								}
								else
								{
									$CheckBisaTambahAtauTidak = 51;
								}
							}
						}

						mysqli_close($MySQLi);
			}
			else
			{
						require '../../connection/RekapNilai.php';
						$MySQLi = mysqli_connect($domain, $username, $password, $database);

						$SubStrJenisNilai = substr($Jenis, -3);

						$QueryTotalBobot = "SELECT SUM(Nilai.Bobot) AS 'Bobot' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%$SubStrJenisNilai' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
						$HasilQueryTotalBobot = $MySQLi->query($QueryTotalBobot);
						$Hasil = $HasilQueryTotalBobot->fetch_assoc();

						$TotalDB=0;

						if($Hasil['Bobot'] == "")
						{
							$TotalDB=0;
						}
						else
						{
							$TotalDB = $Hasil['Bobot'];
						}

						$Total = $TotalDB + $Bobot;

						if ($Jenis == "UTS" || $Jenis == "UAS")
						{
								$QueryCheckUTSUASAda = "SELECT Count(Nilai.KodeNilai) AS 'Jumlah' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '$Jenis' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
								$HasilQueryCheckUTSUASAda = $MySQLi->query($QueryCheckUTSUASAda);
								$Hasil=$HasilQueryCheckUTSUASAda->fetch_assoc();

								if($Hasil['Jumlah'] >= 1)
								{
									if ($Total > 100)
									{
										$CheckBisaTambahAtauTidak = 21;
									}
									else
									{
										$CheckBisaTambahAtauTidak = 20;
									}
								}
								else
								{
									if ($Total > 100)
									{
										$CheckBisaTambahAtauTidak = 10;
									}
									else
									{
										$CheckBisaTambahAtauTidak = 1;
									}
								}
						}
						else
						{
							if ($Total > 100)
							{
								$CheckBisaTambahAtauTidak = 10;
							}
							else
							{
								$CheckBisaTambahAtauTidak = 1;
							}
						}

						mysqli_close($MySQLi);
			}
	}
	else
	{
					require '../../connection/RekapNilai.php';
					$MySQLi = mysqli_connect($domain, $username, $password, $database);

					$SubStrJenisNilai = substr($Jenis, -3);

					$QueryTotalBobot = "SELECT SUM(Nilai.Bobot) AS 'Bobot' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%$SubStrJenisNilai' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
					$HasilQueryTotalBobot = $MySQLi->query($QueryTotalBobot);
					$Hasil = $HasilQueryTotalBobot->fetch_assoc();

					$TotalDB=0;

					if($Hasil['Bobot'] == "")
					{
						$TotalDB=0;
					}
					else
					{
						$TotalDB = $Hasil['Bobot'];
					}

					$Total = $TotalDB + $Bobot;

					if ($Jenis == "UTS" || $Jenis == "UAS")
					{
							$QueryCheckUTSUASAda = "SELECT Count(Nilai.KodeNilai) AS 'Jumlah' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '$Jenis' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
							$HasilQueryCheckUTSUASAda = $MySQLi->query($QueryCheckUTSUASAda);
							$Hasil=$HasilQueryCheckUTSUASAda->fetch_assoc();

							if($Hasil['Jumlah'] >= 1)
							{
								if ($Total > 100)
								{
									$CheckBisaTambahAtauTidak = 21;
								}
								else
								{
									$CheckBisaTambahAtauTidak = 20;
								}
							}
							else
							{
								if ($Total > 100)
								{
									$CheckBisaTambahAtauTidak = 10;
								}
								else
								{
									$CheckBisaTambahAtauTidak = 1;
								}
							}
					}
					else
					{
						if ($Total > 100)
						{
							$CheckBisaTambahAtauTidak  = 10;
						}
						else
						{
							$CheckBisaTambahAtauTidak = 1;
						}
					}

					mysqli_close($MySQLi);

					require '../../connection/Init.php';
					$MySQLi = mysqli_connect($domain, $username, $password, $database);

					$QueryNPKKoordinator = "SELECT MkBuka.NPK AS 'NPKKoordinator' FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
					$HasilQueryNPKKoordinator = $MySQLi->query($QueryNPKKoordinator);
					$Hasil=$HasilQueryNPKKoordinator->fetch_assoc();
					$NPKKoordinator = $Hasil['NPKKoordinator'] ;

					$QueryKPKoordinator = "SELECT DosenAjarMk.KP AS 'KPKoordinator' FROM DosenAjarMk WHERE DosenAjarMk.KodeMkBuka = '$Kode' AND DosenAjarMk.NPK = '$NPKKoordinator'";
					$HasilQueryKPKoordinator = $MySQLi->query($QueryKPKoordinator);
					$Hasil=$HasilQueryKPKoordinator->fetch_assoc();
					$KPKoordinator = $Hasil['KPKoordinator'];

					mysqli_close($MySQLi);

					require '../../connection/RekapNilai.php';
					$MySQLi = mysqli_connect($domain, $username, $password, $database);

					$QueryNilaiKoordinator = "SELECT count(Nilai.KodeNilai) AS 'JumlahKoor' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPKoordinator' AND Nilai.Jenis = '$Jenis' AND Nilai.Syarat = 1";
					$HasilQueryNilaiKoordinator = $MySQLi->query($QueryNilaiKoordinator);
					$Hasil=$HasilQueryNilaiKoordinator->fetch_assoc();
					$JumlahKoordinator = $Hasil['JumlahKoor'] ;

					$QueryNilaiBukanKoordinator = "SELECT count(Nilai.KodeNilai) AS 'JumlahBukanKoor' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis = '$Jenis' AND Nilai.Syarat = 1";
					$HasilQueryNilaiBukanKoordinator = $MySQLi->query($QueryNilaiBukanKoordinator);
					$Hasil=$HasilQueryNilaiBukanKoordinator->fetch_assoc();
					$JumlahBukanKoordinator = $Hasil['JumlahBukanKoor'];

					if($JumlahKoordinator <= $JumlahBukanKoordinator)
					{
							$CheckBisaTambahAtauTidak = 33;
					}

					mysqli_close($MySQLi);
	}
	echo $CheckBisaTambahAtauTidak;
}
?>
