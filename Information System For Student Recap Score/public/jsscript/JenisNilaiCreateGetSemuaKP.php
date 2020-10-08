<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	// Untuk Koordinator
	$QuerySemuaKPDiajar = "SELECT DosenAjarMk.KP AS KP FROM DosenAjarMk INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik'
	AND MkBuka.Semester = '$Semester'";

	$HasilQuerySemuaKPDiajar = mysqli_query($MySQLi, $QuerySemuaKPDiajar);
	$KP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQuerySemuaKPDiajar))
	{
		$KP[] = $Hasil;
	}

	$HasilKPDiajar = "";
	for ($i=0; $i < count($KP); $i++) {
			$Temp = $KP[$i]['KP']."|";
			$HasilKPDiajar .= $Temp;
	}
	echo $HasilKPDiajar;
}
?>
