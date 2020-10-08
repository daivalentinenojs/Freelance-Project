<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckKoordinator = "SELECT count(MkBuka.NPK) AS Jumlah FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND  MkBuka.NPK = '$NPK' AND  MkBuka.ThnAkademik = '$ThnAkademik' AND  MkBuka.Semester = '$Semester' Group By KodeMkBuka";
	$HasilQueryCheckKoordinator = mysqli_query($MySQLi, $QueryCheckKoordinator);
	$ChecKoordinatorBukan = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckKoordinator))
	{
		$ChecKoordinatorBukan[] = $Hasil;
	}

	if (empty($ChecKoordinatorBukan[0]['Jumlah']))
		$ChecKoordinatorBukan[0]['Jumlah'] = 0;

	if ($ChecKoordinatorBukan[0]['Jumlah'] == 1)
	{
		$QueryGetSemuaKP = "SELECT DosenAjarMk.KP AS KP FROM DosenAjarMk INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik'
		AND MkBuka.Semester = '$Semester'";
	}
	else
	{
		$QueryGetSemuaKP = "SELECT DosenAjarMk.KP AS KP FROM DosenAjarMk INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND DosenAjarMk.NPK = '$NPK'
		AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
	}
	$HasilQueryGetSemuaKP = mysqli_query($MySQLi, $QueryGetSemuaKP);
	$KP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetSemuaKP))
	{
		$KP[] = $Hasil;
	}
	echo "<label class='col-md-3 control-label'>Kelas Pararel</label>";
	echo "<select  name='kpMkBuka' id='kpMkBuka' data-toggle='tooltip' data-placement='right' title='Silahkan Memilih Kelas Pararel' class='form-control' style='width: 45px'>";
	for ($i=0; $i < count($KP); $i++) {
			echo "<option value=".$KP[$i]['KP'].">".$KP[$i]['KP']."</option>";
	}
	echo "</select>";
}
?>
