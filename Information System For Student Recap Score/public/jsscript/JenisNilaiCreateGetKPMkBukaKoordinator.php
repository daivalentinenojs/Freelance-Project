<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryGetNPKKoordinator = "SELECT MkBuka.NPK AS NPKKoordinator FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
	$HasilQueryGetNPKKoordinator = mysqli_query($MySQLi, $QueryGetNPKKoordinator);
	$NPK = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetNPKKoordinator))
	{
		$NPK[] = $Hasil;
	}
	$NPKKoordinator = $NPK[0]['NPKKoordinator'];

	$QueryKPDiajarKoordinator = "SELECT DosenAjarMk.KP AS KPKoordinator FROM DosenAjarMk WHERE DosenAjarMk.KodeMkBuka = '$Kode' AND DosenAjarMk.NPK = '$NPKKoordinator'";
	$HasilQueryKPDiajarKoordinator = mysqli_query($MySQLi, $QueryKPDiajarKoordinator);
	$KP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryKPDiajarKoordinator))
	{
		$KP[] = $Hasil;
	}
	$KPKoordinator = $KP[0]['KPKoordinator'];
	echo $KPKoordinator;
}
?>
