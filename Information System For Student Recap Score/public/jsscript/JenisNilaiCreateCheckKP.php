<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryTampilKP = "SELECT DosenAjarMk.KP AS KP FROM DosenAjarMk INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik'
	AND MkBuka.Semester = '$Semester'";

	$HasilQueryTampilKP = mysqli_query($MySQLi, $QueryTampilKP);
	$KP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryTampilKP))
	{
		$KP[] = $Hasil;
	}
	echo "<label class='col-md-3 control-label'>Kelas Pararel</label>";
	echo "<select  name='kpMkBuka' id='kpMkBuka' class='form-control' style='width: 15%' data-toggle='tooltip' data-placement='right' title='Silahkan Memilih Kelas Pararel'>";
	for ($i=0; $i < count($KP); $i++) {
			echo "<option value=".$KP[$i]['KP'].">".$KP[$i]['KP']."</option>";
	}
	echo "</select>";
}
?>
