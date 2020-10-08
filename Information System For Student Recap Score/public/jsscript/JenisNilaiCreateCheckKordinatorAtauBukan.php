<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckKoordinatorAtauBukan = "SELECT count(MkBuka.NPK) AS Jumlah FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.NPK = '$NPK' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester' Group By KodeMkBuka";
	$HasilQueryCheckKoordinatorAtauBukan = mysqli_query($MySQLi, $QueryCheckKoordinatorAtauBukan);
	$ChecKoordinatorBukan = array();

	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckKoordinatorAtauBukan))
	{
			$ChecKoordinatorBukan[] = $Hasil;
	}

	if (empty($ChecKoordinatorBukan[0]['Jumlah']))
	{
			$ChecKoordinatorBukan[0]['Jumlah'] = 0;
	}

	echo $ChecKoordinatorBukan[0]['Jumlah'];
}
?>
