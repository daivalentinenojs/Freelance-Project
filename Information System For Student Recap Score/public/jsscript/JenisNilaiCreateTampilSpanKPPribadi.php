<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['ketentuanNilai']) AND isset($_GET['NPK'])) // Checked V X
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$Ketentuan = $MySQLi->real_escape_string($_GET['ketentuanNilai']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

	$ArrayKP = explode("|", $KP);
	$KPSekarang = $ArrayKP[0];
	echo $KPSekarang;
}
?>
