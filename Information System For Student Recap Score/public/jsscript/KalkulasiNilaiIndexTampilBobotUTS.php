<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["kpMkBuka"])) // Checked V
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryTotalBobotUTS = "SELECT SUM(Nilai.Bobot) AS JumlahBobotUTS FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND
	Nilai.Jenis Like '%UTS' AND (Nilai.Status = 'Daftar' || Nilai.Status = 'TelahDiKalkulasi' || Nilai.Status = 'SiapUpload' || Nilai.Status = 'TelahDiUpload') AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
	$HasilQueryTotalBobotUTS = mysqli_query($MySQLi, $QueryTotalBobotUTS);
	$JumlahBobotUTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryTotalBobotUTS))
	{
		$JumlahBobotUTS[] = $Hasil;
	}

	if (empty($JumlahBobotUTS[0]['JumlahBobotUTS']))
			$JumlahBobotUTS[0]['JumlahBobotUTS'] = 0;

	echo "<label class='col-md-4 control-label'>Jumlah Bobot UTS Telah Diinput</label>";
	echo "<label class='control-label' data-toggle='tooltip' data-placement='right' title='Total Bobot UTS Saat Ini'><strong>".$JumlahBobotUTS[0]['JumlahBobotUTS']." %</strong></label>";
	echo "<input type='hidden' readonly size='30' data-toggle='tooltip' data-placement='right' title='Total Bobot UTS Saat Ini' value='".$JumlahBobotUTS[0]['JumlahBobotUTS']."' class='form-control' id='BobotNilaiUTSShow' name='BobotNilaiUTSShow' style='width:85px; font-weight:bold; border-radius:2px; color:grey;'/>";
}
?>
