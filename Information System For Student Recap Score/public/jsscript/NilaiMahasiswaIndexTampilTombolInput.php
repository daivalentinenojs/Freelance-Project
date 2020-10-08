<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK']) AND isset($_GET['kodeNilai'])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);
	$KodeNilai = $MySQLi->real_escape_string($_GET['kodeNilai']);

	$QueryCheckBatasNTS = "SELECT COUNT(BAAK.SemesterAktif.BatasInputNTS) AS 'BatasInputNTS' FROM BAAK.SemesterAktif
	WHERE now() < BAAK.SemesterAktif.BatasInputNTS AND BAAK.SemesterAktif.ThnAkademik = '$ThnAkademik' AND BAAK.SemesterAktif.Semester = '$Semester'
	GROUP BY BAAK.SemesterAktif.ThnAkademik, BAAK.SemesterAktif.Semester";

	$HasilQueryCheckBatasNTS = mysqli_query($MySQLi, $QueryCheckBatasNTS);
	$CheckBatasNTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckBatasNTS))
	{
		$CheckBatasNTS[] = $Hasil;
	}

	if(empty($CheckBatasNTS[0]['BatasInputNTS']))
	{
			$CheckBatasNTS[0]['BatasInputNTS'] = 0;
	}

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	{
			$QueryCheckAdaJenisNilaiTidak = "SELECT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.WaktuBuat AS 'WaktuBuat', Nilai.Bobot AS 'Bobot'
			FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'BelumInput' AND Nilai.Syarat = 1";
	}
	else
	{
			$QueryCheckAdaJenisNilaiTidak = "SELECT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.WaktuBuat AS 'WaktuBuat', Nilai.Bobot AS 'Bobot'
			FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'BelumInput' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS' AND Nilai.Syarat = 1";
	}

	$HasilQueryCheckAdaJenisNilaiTidak = mysqli_query($MySQLi, $QueryCheckAdaJenisNilaiTidak);
	$HasilJumlahCheckJenisNilai = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckAdaJenisNilaiTidak))
	{
		$HasilJumlahCheckJenisNilai[] = $Hasil;
	}

	if (count($HasilJumlahCheckJenisNilai) >= 1)
	{
		$QueryCheckJenisNilai = "SELECT Nilai.Jenis AS 'Jenis'	FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP'
		AND Nilai.Status = 'BelumInput' AND Nilai.Syarat = 1 AND Nilai.KodeNilai = '$KodeNilai'";

		$HasilQueryCheckJenisNilai = mysqli_query($MySQLi, $QueryCheckJenisNilai);
		$CheckJenisNilai = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryCheckJenisNilai))
		{
			$CheckJenisNilai[] = $Hasil;
		}

		// print_r($CheckJenisNilai);

		if ($CheckJenisNilai[0]['Jenis'] == 'UTS' || $CheckJenisNilai[0]['Jenis'] == 'UAS')
		{

				// Check Berita Acara UTS dan UAS
				if ($CheckJenisNilai[0]['Jenis'] == 'UTS')
				{
						$QueryBeritaAcaraUTS = "SELECT COUNT(BAAK.BeritaAcara.IdBeritaAcara) AS 'CheckBeritaAcaraUTS' FROM BAAK.BeritaAcara
						WHERE BAAK.BeritaAcara.KodeMkBuka = '$Kode' AND BAAK.BeritaAcara.KP = '$KP' AND BAAK.BeritaAcara.UtsUas = 'UTS'
						GROUP BY BAAK.BeritaAcara.IdBeritaAcara;";

						$HasilQueryBeritaAcaraUTS = mysqli_query($MySQLi, $QueryBeritaAcaraUTS);
						$BeritaAcaraUTS = array();
						while($Hasil = mysqli_fetch_assoc($HasilQueryBeritaAcaraUTS))
						{
							$BeritaAcaraUTS[] = $Hasil;
						}

						if (empty($BeritaAcaraUTS[0]['CheckBeritaAcaraUTS']))
						{
								echo "<input type='reset'  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' id='UlangInput' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
						}
						else
						{
								// echo "<input type='button' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menginputkan Nilai Mahasiswa dengan Pemotretan'  value='Masukkan Nilai dengan Camera' style='margin-right:10px;' class='btn btn-info toggle' id='AndroidTesseract'>";
								echo "<input type='submit' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menginputkan Nilai Mahasiswa'  value='Masukkan Nilai' style='margin-right:10px;' class='btn btn-success'>";
								echo "<input type='reset'  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' id='UlangInput' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
						}
				}
				else if ($CheckJenisNilai[0]['Jenis'] == 'UAS')
				{
						$QueryBeritaAcaraUAS = "SELECT COUNT(BAAK.BeritaAcara.IdBeritaAcara) AS 'CheckBeritaAcaraUAS' FROM BAAK.BeritaAcara
						WHERE BAAK.BeritaAcara.KodeMkBuka = '$Kode' AND BAAK.BeritaAcara.KP = '$KP' AND BAAK.BeritaAcara.UtsUas = 'UAS'
						GROUP BY BAAK.BeritaAcara.IdBeritaAcara;";

						// echo $QueryBeritaAcaraUAS;

						$HasilQueryBeritaAcaraUAS = mysqli_query($MySQLi, $QueryBeritaAcaraUAS);
						$BeritaAcaraUAS = array();
						while($Hasil = mysqli_fetch_assoc($HasilQueryBeritaAcaraUAS))
						{
							$BeritaAcaraUAS[] = $Hasil;
						}

						if (empty($BeritaAcaraUAS[0]['CheckBeritaAcaraUAS']))
						{
								echo "<input type='reset'  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' id='UlangInput' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
						}
						else
						{
								// echo "<input type='button' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menginputkan Nilai Mahasiswa dengan Pemotretan'  value='Masukkan Nilai dengan Camera' style='margin-right:10px;' class='btn btn-info toggle' id='AndroidTesseract'>";
								echo "<input type='submit' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menginputkan Nilai Mahasiswa'  value='Masukkan Nilai' style='margin-right:10px;' class='btn btn-success'>";
								echo "<input type='reset'  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' id='UlangInput' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
						}
				}
		}
		else
		{
				// echo "<button class='btn btn-info toggle' id='AndroidTesseract'>Tesseract</button>";
				// echo "<input type='button' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menginputkan Nilai Mahasiswa dengan Pemotretan'  value='Masukkan Nilai dengan Camera' style='margin-right:10px;' class='btn btn-info toggle' id='AndroidTesseract'>";
				echo "<input type='submit' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menginputkan Nilai Mahasiswa'  value='Masukkan Nilai' style='margin-right:10px;' class='btn btn-success'>";
				echo "<input type='reset'  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' id='UlangInput' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
		}
	}
	else
	{
		echo "<input type='reset'  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' id='UlangInput' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
	}

	mysqli_close($MySQLi);
}
?>
