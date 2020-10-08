<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckKoordinator = "SELECT count(MkBuka.NPK) AS Jumlah FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.NPK = '$NPK' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester' Group By KodeMkBuka";
	$HasilQueryCheckKoordinator = mysqli_query($MySQLi, $QueryCheckKoordinator);
	$CheckKoordinator = array();
	while($r = mysqli_fetch_assoc($HasilQueryCheckKoordinator))
	{
		$CheckKoordinator[] = $r;
	}

	if (empty($CheckKoordinator[0]['Jumlah']))
		$CheckKoordinator[0]['Jumlah'] = 0;

	if($CheckKoordinator[0]['Jumlah'] == 1)
	{
		echo "<label class='col-md-6 control-label'>Untuk Semua KP</label>";
		echo "<input type='checkbox' id='ketentuanNilai' data-toggle='tooltip' data-placement='right' title='Centang untuk Semua KP' name='ketentuanNilai' value='0' style='margin-top:10px; margin-left:10px;'>";
	}
}
?>
