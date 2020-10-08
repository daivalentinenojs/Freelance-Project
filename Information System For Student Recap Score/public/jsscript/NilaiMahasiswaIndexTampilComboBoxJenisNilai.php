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

	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	{
			$QueryJenisNilai = "SELECT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.WaktuBuat AS 'WaktuBuat', Nilai.Bobot AS 'Bobot'
			FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'BelumInput' AND Nilai.Syarat = 1";
	}
	else
	{
			$QueryJenisNilai = "SELECT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.WaktuBuat AS 'WaktuBuat', Nilai.Bobot AS 'Bobot'
			FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'BelumInput' AND RIGHT(Nilai.Jenis,3) LIKE 'UAS' AND Nilai.Syarat = 1";
	}

	$HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
	$JenisNilais = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai))
	{
			$JenisNilais[] = $Hasil;
	}

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

	mysqli_close($MySQLi);

	if (count($JenisNilais) >= 1)
	{
		echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
		echo "<select  name='kodeNilai' id='jenisNilai' class='form-control' style='width: 75%' data-toggle='tooltip' data-placement='right' title='Silahkan Memilih Jenis Penilaian'>";
		for ($i=0; $i < count($JenisNilais); $i++) {
				$Date = date_create($JenisNilais[$i]['WaktuBuat']);
				$TanggalOutput = date_format($Date, "d F Y")."</td>";
				echo "<option value=".$JenisNilais[$i]['KodeNilai'].">".$JenisNilais[$i]['Jenis']." ".$TanggalOutput." ".$JenisNilais[$i]['Bobot']." %</option>";
		}
		echo "</select>";
	}
	else if ($JumlahDaftar['JumlahDaftar'] >= 1)
	{
		echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
		echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Diinputkan, Belum Ada Jenis Nilai Baru</label>";
	}
	else if ($JumlahTelahDiKalkulasi['JumlahTelahDiKalkulasi'] >= 1)
	{
		echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
		echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Dikalkulasi</label>";
	}
	else if ($JumlahSiapUpload['JumlahSiapUpload'] >= 1)
	{
		echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
		echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Diverifikasi</label>";
	}
	else if ($JumlahTelahDiUpload['JumlahTelahDiUpload'] >= 1)
	{
		echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
		echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Keterangan'>Nilai Mahasiswa Telah Diunggah</label>";
	}
	else
	{
		echo "<label class='col-md-3 control-label'>Jenis Nilai</label>";
		echo "<label class='col-md-9 control-label' style='text-align:left;' data-toggle='tooltip' data-placement='top' title='Tidak Ada Jenis Nilai yang telah diinputkan'>Belum ada Jenis Nilai yang diinputkan !</label>";
	}
}
?>
