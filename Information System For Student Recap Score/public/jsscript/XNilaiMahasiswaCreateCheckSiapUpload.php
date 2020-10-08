<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka'])) // Checked V => Tidak Dipakai
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);

	$QueryJumlahNilaiSiapUpload = "SELECT count(Nilai.KodeNilai) AS 'JumlahSiapUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND (Nilai.Status = 'TelahDiKalkulasi' OR Nilai.Status = 'SiapUpload' OR Nilai.Status = 'TelahDiUpload')";

	$HasilQueryJumlahNilaiSiapUpload = mysqli_query($MySQLi, $QueryJumlahNilaiSiapUpload);
	$JumlahSiapUpload= array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiSiapUpload)) {
		$JumlahSiapUpload = $Hasil;
	}

	mysqli_close($MySQLi);

	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$QueryNamaMkBuka = "SELECT MataKuliah.Nama AS 'NamaMkBuka' FROM MataKuliah INNER JOIN MkBuka ON MataKuliah.KodeMk = MkBuka.KodeMk	WHERE MkBuka.KodeMkBuka = '$Kode'";

	$HasilQueryNamaMkBuka = mysqli_query($MySQLi, $QueryNamaMkBuka);
	$NamaMkBuka = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMkBuka)) {
			$NamaMkBuka = $Hasil;
	}

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$QueryTotalBobotUTS = "SELECT SUM(Nilai.Bobot) AS JumlahBobotUTS FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%UTS' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
	$HasilQueryTotalBobotUTS = mysqli_query($MySQLi, $QueryTotalBobotUTS);
	$JumlahBobotUTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryTotalBobotUTS))
	{
		$JumlahBobotUTS[] = $Hasil;
	}

	if (empty($JumlahBobotUTS[0]['JumlahBobotUTS']))
			$JumlahBobotUTS[0]['JumlahBobotUTS'] = 0;

	$QueryTotalBobotUAS = "SELECT SUM(Nilai.Bobot) AS JumlahBobotUAS FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%UAS' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
	$HasilQueryTotalBobotUAS = mysqli_query($MySQLi, $QueryTotalBobotUAS);
	$JumlahBobotUAS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryTotalBobotUAS))
	{
		$JumlahBobotUAS[] = $Hasil;
	}

	if (empty($JumlahBobotUAS[0]['JumlahBobotUAS']))
			$JumlahBobotUAS[0]['JumlahBobotUAS'] = 0;

	if(empty($JumlahSiapUpload['JumlahSiapUpload'])) {
			$JumlahSiapUpload['JumlahSiapUpload'] = 0;
	}

	if ($JumlahSiapUpload['JumlahSiapUpload'] >= 1)
	{
		echo "<label class='col-md-3 control-label'>Keterangan</label>";
		echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Nilai Telah Dikalkulasi' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	}
	else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	{
		echo "<label class='col-md-3 control-label'>Keterangan</label>";
		echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Bobot UTS dan UAS belum 100%' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	}
	else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] == 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] != 100)
	{
		echo "<label class='col-md-3 control-label'>Keterangan</label>";
		echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Bobot UAS belum 100%' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	}
	else if ($JumlahBobotUTS[0]['JumlahBobotUTS'] != 100 && $JumlahBobotUAS[0]['JumlahBobotUAS'] == 100)
	{
		echo "<label class='col-md-3 control-label'>Keterangan</label>";
		echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Bobot UTS belum 100%' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	}
	else
	{
		echo "<label class='col-md-3 control-label'>Keterangan</label>";
		echo "<input type='text' readonly data-toggle='tooltip' data-placement='right' title='Keterangan' value='Silahkan Klik Tombol Kalkulasi' class='form-control' style='width:60%; font-weight:bold; border-radius:2px; color:grey;'/>";
	}
}
?>
