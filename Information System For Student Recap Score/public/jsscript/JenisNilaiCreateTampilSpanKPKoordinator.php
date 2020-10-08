<?php
if(isset($_GET['kodeMkBuka'])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);

	$QueryNPKKoordinator = "SELECT MkBuka.NPK AS 'NPKKoordinator' FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
	$HasilQueryNPKKoordinator = $MySQLi->query($QueryNPKKoordinator);
	$Hasil=$HasilQueryNPKKoordinator->fetch_assoc();
	$NPKKoordinator = $Hasil['NPKKoordinator'] ;

	$QueryKPKoordinator = "SELECT DosenAjarMk.KP AS 'KPKoordinator' FROM DosenAjarMk WHERE DosenAjarMk.KodeMkBuka = '$Kode' AND DosenAjarMk.NPK = '$NPKKoordinator'";
	$HasilQueryKPKoordinator = $MySQLi->query($QueryKPKoordinator);
	$Hasil=$HasilQueryKPKoordinator->fetch_assoc();
	$KPKoordinator = $Hasil['KPKoordinator'];

	echo $KPKoordinator;
}
?>
