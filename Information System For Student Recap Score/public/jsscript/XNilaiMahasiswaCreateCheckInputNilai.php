<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["jenisNilai"]) AND isset($_GET["bobotNilai"]) AND
isset($_GET["bobotSebelumUbah"]) AND isset($_GET["ketentuanNilai"])) // Checked V => Tidak Dipakai
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$Jenis = $MySQLi->real_escape_string($_GET["jenisNilai"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);
	$Bobot = $MySQLi->real_escape_string($_GET["bobotNilai"]);
	$BobotSebelumUbah = $MySQLi->real_escape_string($_GET["bobotSebelumUbah"]);

	$JenisSubStr = substr($Jenis,-3);

	$QueryTotalBobot = "SELECT SUM(Nilai.Bobot) AS 'Bobot' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%$JenisSubStr' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka, Nilai.KP";
	$HasilQueryTotalBobot = $MySQLi->query($QueryTotalBobot);
	$Hasil=$HasilQueryTotalBobot->fetch_assoc();

	$TotalDB = $Hasil['Bobot'];
	$Total = $TotalDB + $Bobot - $BobotSebelumUbah;

	// Keterangan
	// 0 Tidak ada error
	// 1 Error Total Input dan Database

  if ($Total > 100)
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
}
?>
