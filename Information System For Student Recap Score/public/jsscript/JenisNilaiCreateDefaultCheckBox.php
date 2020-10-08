<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckKoordinator = "SELECT count(MkBuka.NPK) AS Jumlah FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.NPK = '$NPK' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester' Group By MkBuka.KodeMkBuka";
	$HasilQueryCheckKoordinator = mysqli_query($MySQLi, $QueryCheckKoordinator);
	$CheckKoordinator = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckKoordinator))
	{
		$CheckKoordinator[] = $Hasil;
	}

	if (empty($CheckKoordinator[0]['Jumlah']))
		$CheckKoordinator[0]['Jumlah'] = 0;

	echo $CheckKoordinator[0]['Jumlah'];
}
?>
