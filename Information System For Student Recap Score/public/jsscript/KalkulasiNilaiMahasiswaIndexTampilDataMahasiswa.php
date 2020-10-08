<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK'])) // Checked V
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

	$QueryMahasiswaAmbilMk = "SELECT MhsAmbilMk.NRP AS 'NRP', MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka', matakuliah.Nama AS 'NamaMkBuka', MhsAmbilMk.KP AS 'KP'
	FROM MhsAmbilMk INNER JOIN mkbuka ON MhsAmbilMk.KodeMkBuka = mkbuka.KodeMkBuka INNER JOIN matakuliah ON matakuliah.KodeMk = mkbuka.KodeMk
	WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP'";

	$HasilQueryMahasiswaAmbilMk = mysqli_query($MySQLi, $QueryMahasiswaAmbilMk);
	$HasilMahasiswaAmbilMk = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryMahasiswaAmbilMk))
	{
		$HasilMahasiswaAmbilMk[] = $Hasil;
	}
	mysqli_close($MySQLi);

	echo "<span style='font-size:11px; margin-left:30px;'><strong>Daftar Nilai Mahasiswa Mata Kuliah ".$HasilMahasiswaAmbilMk[0]['NamaMkBuka']." KP ".$KP."</strong></span><br><br>";
	echo "<table class='table' style='margin-left:30px;'><thead><tr>";
	echo "<th style='text-align:center; vertical-align:middle;'>NRP</th>";
	echo "<th style='text-align:center; vertical-align:middle;'>Nama Mahasiswa</th>";

	echo "</tr></thead><tbody>";
	for ($i=0; $i < count($HasilMahasiswaAmbilMk); $i++) {
		echo "<tr>";
		echo "<td style='text-align:center; vertical-align:middle;'>".$HasilMahasiswaAmbilMk[$i]['NRP']."</td>";
		echo "<td style='text-align:center; vertical-align:middle;'>".$HasilMahasiswaAmbilMk[$i]['NRP']."</td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
}
?>
