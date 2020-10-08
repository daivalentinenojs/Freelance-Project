<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);

	$QueryCheckKoordinator = "SELECT count(MkBuka.NPK) AS Jumlah FROM MkBuka WHERE KodeMkBuka = '$Kode' AND NPK = '$NPK' AND ThnAkademik = '$ThnAkademik' AND Semester = '$Semester' Group By KodeMkBuka";
	$HasilQueryCheckKoordinator = mysqli_query($MySQLi, $QueryCheckKoordinator);
	$CheckKoordinator = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckKoordinator))
	{
		$CheckKoordinator[] = $Hasil;
	}

	if (empty($CheckKoordinator[0]['Jumlah']))
		$CheckKoordinator[0]['Jumlah'] = 0;

	if($CheckKoordinator[0]['Jumlah'] == 1)
	{
		echo "<label class='col-md-3 control-label'>Untuk Semua KP</label>";
		echo "<input type='checkbox' checked id='ketentuanNilai' name='ketentuanNilai' value='1' style='margin-top:10px;' data-toggle='tooltip' data-placement='right' title='Centang untuk Semua KP'>";
	}
	else
	{
		$QueryKPDiajar = "SELECT DosenAjarMk.KP AS KP FROM DosenAjarMk INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik'
		AND MkBuka.Semester = '$Semester' AND DosenAjarMk.NPK = '$NPK'";

		$HasilQueryKPDiajar = mysqli_query($MySQLi, $QueryKPDiajar);
		$MkBukaDiajar = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryKPDiajar))
		{
			$MkBukaDiajar[] = $Hasil;
		}
		echo "<label class='col-md-3 control-label'>Kelas Pararel</label>";
		echo "<select  name='kpMkBuka' id='kpMkBuka' class='form-control' style='width: 15%' data-toggle='tooltip' data-placement='right' title='Silahkan Memilih Kelas Pararel'>";
		for ($i=0; $i < count($MkBukaDiajar); $i++) {
				echo "<option value=".$MkBukaDiajar[$i]['KP'].">".$MkBukaDiajar[$i]['KP']."</option>";
		}
		echo "</select>";
	}
}
?>
