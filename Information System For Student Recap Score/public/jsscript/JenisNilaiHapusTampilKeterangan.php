<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK'])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

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

	$QueryJumlahNilaiTelahDiUploadUTS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiUploadUTS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Status = 'TelahDiUpload' AND right(Nilai.Jenis,3) = 'UTS'";

	$HasilQueryJumlahNilaiTelahDiUploadUTS	= mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiUploadUTS);
	$JumlahTelahDiUploadUTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiUploadUTS)) {
		$JumlahTelahDiUploadUTS = $Hasil;
	}

	if(empty($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'])) {
			$JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] = 0;
	}

	$QueryJumlahNilaiTelahDiUploadUAS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiUploadUAS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Status = 'TelahDiUpload' AND right(Nilai.Jenis,3) = 'UAS'";

	$HasilQueryJumlahNilaiTelahDiUploadUAS	= mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiUploadUAS);
	$JumlahTelahDiUploadUAS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiUploadUAS)) {
		$JumlahTelahDiUploadUAS = $Hasil;
	}

	if(empty($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'])) {
			$JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] = 0;
	}



	$QueryJumlahNilaiSiapUploadUTS = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUploadUTS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Status = 'SiapUpload' AND right(Nilai.Jenis,3) = 'UTS'";

	$HasilQueryJumlahNilaiSiapUploadUTS = mysqli_query($MySQLi, $QueryJumlahNilaiSiapUploadUTS);
	$JumlahSiapUploadUTS= array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiSiapUploadUTS)) {
		$JumlahSiapUploadUTS = $Hasil;
	}

	if(empty($JumlahSiapUploadUTS['JumlahSiapUploadUTS'])) {
			$JumlahSiapUploadUTS['JumlahSiapUploadUTS'] = 0;
	}

	$QueryJumlahNilaiSiapUploadUAS = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUploadUAS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Status = 'SiapUpload' AND right(Nilai.Jenis,3) = 'UAS'";

	$HasilQueryJumlahNilaiSiapUploadUAS = mysqli_query($MySQLi, $QueryJumlahNilaiSiapUploadUAS);
	$JumlahSiapUploadUAS= array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiSiapUploadUAS)) {
		$JumlahSiapUploadUAS = $Hasil;
	}

	if(empty($JumlahSiapUploadUAS['JumlahSiapUploadUAS'])) {
			$JumlahSiapUploadUAS['JumlahSiapUploadUAS'] = 0;
	}



	$QueryJumlahNilaiTelahDiKalkulasiUTS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasiUTS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Status = 'TelahDiKalkulasi' AND right(Nilai.Jenis,3) = 'UTS'";

	$HasilQueryJumlahNilaiTelahDiKalkulasiUTS = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiKalkulasiUTS);
	$JumlahTelahDiKalkulasiUTS= array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiKalkulasiUTS)) {
		$JumlahTelahDiKalkulasiUTS = $Hasil;
	}

	if(empty($JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'])) {
			$JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] = 0;
	}

	$QueryJumlahNilaiTelahDiKalkulasiUAS = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahDiKalkulasiUAS' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Status = 'TelahDiKalkulasi' AND right(Nilai.Jenis,3) = 'UAS'";

	$HasilQueryJumlahNilaiTelahDiKalkulasiUAS = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiKalkulasiUAS);
	$JumlahTelahDiKalkulasiUAS= array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiKalkulasiUAS)) {
		$JumlahTelahDiKalkulasiUAS = $Hasil;
	}

	if(empty($JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'])) {
			$JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] = 0;
	}

	$Keterangan = "";
	$PanjangKeterangan = 0;
	echo "<label class='col-md-3 control-label'>Keterangan</label>";
	if ($JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1)
	{
		if($PanjangKeterangan < 2)
		{
			$Keterangan .= "NTS Mahasiswa Telah Diunggah, ";
			$PanjangKeterangan++;
		}
	}
	if ($JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1)
	{
		if($PanjangKeterangan < 2)
		{
			$Keterangan .= "NAS Mahasiswa Telah Diunggah ";
			$PanjangKeterangan++;
		}
	}
	if ($JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1)
	{
		if($PanjangKeterangan < 2)
		{
			$Keterangan .= "NTS Mahasiswa Telah Diverifikasi, ";
			$PanjangKeterangan++;
		}
	}
	if ($JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1)
	{
		if($PanjangKeterangan < 2)
		{
			$Keterangan .= "NAS Mahasiswa Telah Diverifikasi ";
			$PanjangKeterangan++;
		}
	}
	if ($JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] >= 1)
	{
		if($PanjangKeterangan < 2)
		{
			$Keterangan .= "NTS Mahasiswa Telah Dikalkulasi, ";
			$PanjangKeterangan++;
		}
	}
	if ($JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] >= 1)
	{
		if($PanjangKeterangan < 2)
		{
			$Keterangan .= "NAS Mahasiswa Telah Dikalkulasi ";
			$PanjangKeterangan++;
		}
	}
	if(!($JumlahTelahDiKalkulasiUTS['JumlahTelahDiKalkulasiUTS'] >= 1 && $JumlahTelahDiKalkulasiUAS['JumlahTelahDiKalkulasiUAS'] >= 1 && $JumlahTelahDiUploadUTS['JumlahTelahDiUploadUTS'] >= 1 && $JumlahTelahDiUploadUAS['JumlahTelahDiUploadUAS'] >= 1 && $JumlahSiapUploadUTS['JumlahSiapUploadUTS'] >= 1 && $JumlahSiapUploadUAS['JumlahSiapUploadUAS'] >= 1))
	{
		if($PanjangKeterangan < 2)
		{
			if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
			{
					$QueryJenisNilai = "SELECT count(Nilai.KodeNilai) AS 'JumlahJenisNilai' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Syarat = '1' AND
					(Nilai.Status = 'Daftar' || Nilai.Status = 'BelumInput')";
			}
			else
			{
					$QueryJenisNilai = "SELECT count(Nilai.KodeNilai) AS 'JumlahJenisNilai' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Syarat = '1' AND
					(Nilai.Status = 'Daftar' || Nilai.Status = 'BelumInput') AND right(Nilai.Jenis,3) = 'UAS'";
			}

			$HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
			$JumlahJenisNilai = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai)) {
				$JumlahJenisNilai = $Hasil;
			}

			if(empty($JumlahJenisNilai['JumlahJenisNilai']))
			{
					$Keterangan .= "Tidak Ada Jenis Nilai yang Dapat Dihapus";
					$PanjangKeterangan++;
			}
			else
			{
					$Keterangan .= "Silahkan Klik Tombol Hapus";
					$PanjangKeterangan++;
			}
		}
	}
		mysqli_close($MySQLi);
	echo "<label data-toggle='tooltip' data-placement='right' title='Keterangan' style='margin-top:8px;'>".$Keterangan."</label>";
}
?>
