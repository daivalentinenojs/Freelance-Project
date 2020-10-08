<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["kpMkBuka"])) // Checked V
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryTotalBobotUAS = "SELECT SUM(Nilai.Bobot) AS JumlahBobotUAS FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Jenis Like '%UAS' AND (Nilai.Status = 'Daftar' || Nilai.Status = 'TelahDiKalkulasi' || Nilai.Status = 'SiapUpload' || Nilai.Status = 'TelahDiUpload') AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
	$HasilQueryTotalBobotUAS = mysqli_query($MySQLi, $QueryTotalBobotUAS);
	$JumlahBobotUAS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryTotalBobotUAS))
	{
		$JumlahBobotUAS[] = $Hasil;
	}

	if (empty($JumlahBobotUAS[0]['JumlahBobotUAS']))
			$JumlahBobotUAS[0]['JumlahBobotUAS'] = 0;

	echo "<label class='col-md-4 control-label'>Jumlah Bobot UAS Telah Diinput</label>";
	echo "<label class='control-label' data-toggle='tooltip' data-placement='right' title='Total Bobot UAS Saat Ini'><strong>".$JumlahBobotUAS[0]['JumlahBobotUAS']." %</strong></label>";
	echo "<input type='hidden' readonly size='30' data-toggle='tooltip' data-placement='right' title='Total Bobot UAS Saat Ini' value='".$JumlahBobotUAS[0]['JumlahBobotUAS']."' class='form-control' id='BobotNilaiUASShow' name='BobotNilaiUASShow' style='width:85px; font-weight:bold; border-radius:2px; color:grey;'/>";
}
?>
