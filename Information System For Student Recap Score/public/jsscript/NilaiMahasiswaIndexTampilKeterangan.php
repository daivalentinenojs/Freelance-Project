<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK']) AND isset($_GET['kodeNilai'])) // Checked V X
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

	if(empty($CheckBatasNTS[0]['BatasInputNTS'])) {
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
								echo "<label class='col-md-3 control-label'>Keterangan</label>";
								echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='right' title='Keterangan'>BAAK belum melakukan cetak presensi UTS</label>";
						}
						else
						{
								echo "<label class='col-md-3 control-label'>Keterangan</label>";
								echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='right' title='Keterangan'>Silahkan Klik Tombol Masukkan Nilai</label>";
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
								echo "<label class='col-md-3 control-label'>Keterangans</label>";
								echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='right' title='Keterangan'>BAAK belum melakukan cetak presensi UAS</label>";
						}
						else
						{
								echo "<label class='col-md-3 control-label'>Keterangan</label>";
								echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='right' title='Keterangan'>Silahkan Klik Tombol Masukkan Nilai</label>";
						}
				}
		}
		else
		{
				echo "<label class='col-md-3 control-label'>Keterangan</label>";
				echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='right' title='Keterangan'>Silahkan Klik Tombol Masukkan Nilai</label>";
		}
	}
	else
	{
				// Jika Tidak Ada Jenis Nilai
				if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
				{
						$QueryJumlahNilaiTelahDiUpload = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND
						Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiUpload'";
				}
				else
				{
						$QueryJumlahNilaiTelahDiUpload = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND
						Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiUpload' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS'";
				}

				$HasilQueryJumlahNilaiTelahDiUpload	= mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiUpload);
				$JumlahTelahDiUpload= array();
				while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiUpload)) {
					$JumlahTelahDiUpload = $Hasil;
				}

				if(empty($JumlahTelahDiUpload['JumlahTelahDiUpload'])) {
						$JumlahTelahDiUpload['JumlahTelahDiUpload'] = 0;
				}

				if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
				{
						$QueryJumlahNilaiSiapUpload = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
						AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload'";
				}
				else
				{
						$QueryJumlahNilaiSiapUpload = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
						AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS'";
				}

				$HasilQueryJumlahNilaiSiapUpload = mysqli_query($MySQLi, $QueryJumlahNilaiSiapUpload);
				$JumlahSiapUpload= array();
				while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiSiapUpload)) {
					$JumlahSiapUpload = $Hasil;
				}

				if(empty($JumlahSiapUpload['JumlahSiapUpload'])) {
						$JumlahSiapUpload['JumlahSiapUpload'] = 0;
				}

				if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
				{
						$QueryJumlahNilaiTelahDiKalkulasi = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasi' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
						AND Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiKalkulasi'";
				}
				else
				{
						$QueryJumlahNilaiTelahDiKalkulasi = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasi' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode'
						AND Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiKalkulasi' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS'";
				}

				$HasilQueryJumlahNilaiTelahDiKalkulasi = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiKalkulasi);
				$JumlahTelahDiKalkulasi= array();
				while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiKalkulasi)) {
					$JumlahTelahDiKalkulasi = $Hasil;
				}

				if(empty($JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'])) {
						$JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'] = 0;
				}

				if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
				{
						$QueryJumlahNilaiDaftar = "SELECT count(Nilai.KodeNilai) AS 'JumlahDaftar' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP'
						AND Nilai.Status = 'Daftar'";
				}
				else
				{
						$QueryJumlahNilaiDaftar = "SELECT count(Nilai.KodeNilai) AS 'JumlahDaftar' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP'
						AND Nilai.Status = 'Daftar' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS'";
				}

				$HasilQueryJumlahNilaiDaftar = mysqli_query($MySQLi, $QueryJumlahNilaiDaftar);
				$JumlahDaftar = array();
				while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiDaftar)) {
					$JumlahDaftar = $Hasil;
				}

				if(empty($JumlahDaftar['JumlahDaftar'])) {
						$JumlahDaftar['JumlahDaftar'] = 0;
				}

				if ($JumlahDaftar['JumlahDaftar'] >= 1)
				{
					echo "<label class='col-md-3 control-label'>Keterangan</label>";
					echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Diinputkan, Belum Ada Jenis Nilai Baru</label>";
				}
				else if ($JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'] >= 1)
				{
					echo "<label class='col-md-3 control-label'>Keterangan</label>";
					echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Dikalkulasi</label>";
				}
				else if ($JumlahSiapUpload['JumlahSiapUpload'] >= 1)
				{
					echo "<label class='col-md-3 control-label'>Keterangan</label>";
					echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Diverifikasi</label>";
				}
				else if ($JumlahTelahDiUpload['JumlahTelahDiUpload'] >= 1)
				{
					echo "<label class='col-md-3 control-label'>Keterangan</label>";
					echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Diunggah</label>";
				}
				else
				{
					echo "<label class='col-md-3 control-label'>Keterangan</label>";
					echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Tidak Ada Jenis Nilai yang telah diinputkan'>Belum ada Jenis Nilai yang diinputkan !</label>";
				}
	}

	mysqli_close($MySQLi);
}
?>
