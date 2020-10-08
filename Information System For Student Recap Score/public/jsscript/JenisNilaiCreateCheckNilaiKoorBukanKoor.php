<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["jenisNilai"])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPKBukanKoor = $MySQLi->real_escape_string($_GET["NPK"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$Jenis = $MySQLi->real_escape_string($_GET["jenisNilai"]);

	$QueryNPKKoordinator = "SELECT MkBuka.NPK AS 'NPKKoordinator' FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
	$HasilQueryNPKKoordinator = $MySQLi->query($QueryNPKKoordinator);
	$Hasil=$HasilQueryNPKKoordinator->fetch_assoc();
	$NPKKoordinator = $Hasil['NPKKoordinator'] ;

	$QueryKPKoordinator = "SELECT DosenAjarMk.KP AS 'KPKoordinator' FROM DosenAjarMk WHERE DosenAjarMk.KodeMkBuka = '$Kode' AND DosenAjarMk.NPK = '$NPKKoordinator'";
	$HasilQueryKPKoordinator = $MySQLi->query($QueryKPKoordinator);
	$Hasil=$HasilQueryKPKoordinator->fetch_assoc();
	$KPKoordinator = $Hasil['KPKoordinator'];

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$QueryNilaiKoordinator = "SELECT count(Nilai.KodeNilai) AS 'JumlahKoor' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPKoordinator' AND Nilai.Jenis = '$Jenis' AND Nilai.Syarat = 1";
	$HasilQueryNilaiKoordinator = $MySQLi->query($QueryNilaiKoordinator);
	$Hasil=$HasilQueryNilaiKoordinator->fetch_assoc();
	$JumlahKoordinator = $Hasil['JumlahKoor'] ;

	$QueryNilaiBukanKoordinator = "SELECT count(Nilai.KodeNilai) AS 'JumlahBukanKoor' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis = '$Jenis' AND Nilai.Syarat = 1";
	$HasilQueryNilaiBukanKoordinator = $MySQLi->query($QueryNilaiBukanKoordinator);
	$Hasil=$HasilQueryNilaiBukanKoordinator->fetch_assoc();
	$JumlahBukanKoordinator = $Hasil['JumlahBukanKoor'];

	if($JumlahKoordinator <= $JumlahBukanKoordinator)
	{
		echo "3";
	}
	else
	{
		echo "0";
	}
}
?>
