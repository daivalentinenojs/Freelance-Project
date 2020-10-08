<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka'])) // Checked V => Tidak Dipakai
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);

	$QueryGetSemuaNilai = "SELECT Nilai.KodeNilai AS KodeNilai, Nilai.Jenis AS NamaNilai, Nilai.Bobot AS Bobot, Nilai.WaktuBuat AS WaktuBuat FROM Nilai WHERE Nilai.KodeMkBuka ='$KodeMkBuka' AND Nilai.KP = '$KP'";
	$HasilQueryGetSemuaNilai = mysqli_query($MySQLi, $QueryGetSemuaNilai);
	$DataMahasiswa = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetSemuaNilai))
	{
		$DataMahasiswa[] = $Hasil;
	}
	mysqli_close($MySQLi);

	return $DataMahasiswa;
}
?>
