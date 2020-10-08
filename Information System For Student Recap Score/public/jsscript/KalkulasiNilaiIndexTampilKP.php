<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckKoordinator = "SELECT count(MkBuka.NPK) AS Jumlah FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.NPK = '$NPK' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester' Group By KodeMkBuka";
	$HasilQueryCheckKoordinator = mysqli_query($MySQLi, $QueryCheckKoordinator);
	$ChecKoorBukan = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckKoordinator))
	{
		$ChecKoorBukan[] = $Hasil;
	}

	if (empty($ChecKoorBukan[0]['Jumlah']))
		$ChecKoorBukan[0]['Jumlah'] = 0;

	if ($ChecKoorBukan[0]['Jumlah'] == 1)
	{
		$QueryKP = "SELECT DosenAjarMk.KP AS KP FROM DosenAjarMk INNER JOIN mkbuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik'
		AND MkBuka.Semester = '$Semester'";
	}
	else
	{
		$QueryKP = "SELECT DosenAjarMk.KP AS KP FROM DosenAjarMk INNER JOIN mkbuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND dosenajarmk.NPK = '$NPK'
		AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
	}
	$HasilQueryKP = mysqli_query($MySQLi, $QueryKP);
	$KP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryKP))
	{
		$KP[] = $Hasil;
	}
	echo "<label class='col-md-4 control-label'>Kelas Pararel</label>";
	echo "<select  name='kpMkBuka' id='kpMkBuka' class='form-control' style='width: 45px' data-toggle='tooltip' data-placement='right' title='Silahkan Memilih Kelas Pararel'>";
	for ($i=0; $i < count($KP); $i++) {
			echo "<option value=".$KP[$i]['KP'].">".$KP[$i]['KP']."</option>";
	}
}
?>
