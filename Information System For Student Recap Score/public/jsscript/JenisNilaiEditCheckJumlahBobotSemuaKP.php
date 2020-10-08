<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["ketentuanNilai"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["jenisNilai"]) AND isset($_GET["bobotNilai"])  AND isset($_GET["bobotSebelumUbah"])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$CheckBisaUbahAtauTidak = 0;

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);
	$Ketentuan = $MySQLi->real_escape_string($_GET["ketentuanNilai"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$Jenis = $MySQLi->real_escape_string($_GET["jenisNilai"]);
	$Bobot = $MySQLi->real_escape_string($_GET["bobotNilai"]);
	$BobotSebelumUbah = $MySQLi->real_escape_string($_GET["bobotSebelumUbah"]);

	$QueryGetSemuaKPMkBuka = "SELECT DosenAjarMk.KP FROM DosenAjarMk INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka WHERE DosenAjarMk.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
	$HasilQueryGetSemuaKPMkBuka = mysqli_query($MySQLi, $QueryGetSemuaKPMkBuka);
	$SemuaKP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetSemuaKPMkBuka))
	{
		$SemuaKP[] = $Hasil;
	}

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	// Keterangan
	// 0 Bisa Di Ubah
	// 1 Salah Satu KP Tidak Bisa Di Ubah

	for ($i=0; $i < count($SemuaKP); $i++) {
		$SubStrJenisNilai = substr($Jenis, -3);

		$QueryTotalBobotSatuKP = "SELECT SUM(Nilai.Bobot) AS 'Bobot' FROM nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP[0]' AND Nilai.Jenis Like '%$SubStrJenisNilai' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
		$HasilQueryTotalBobotSatuKP = $MySQLi->query($QueryTotalBobotSatuKP);
		$Hasil=$HasilQueryTotalBobotSatuKP->fetch_assoc();

		$TotalDB=0;

		if($Hasil['Bobot'] == "")
		{
			$TotalDB=0;
		}
		else
		{
			$TotalDB = $Hasil['Bobot'];
		}

		$Total = $TotalDB + $Bobot - $BobotSebelumUbah;

		if($Total >= 100)
		{
			$CheckBisaUbahAtauTidak = 1;
			$i = count($SemuaKP);
		}
	}

	echo $CheckBisaUbahAtauTidak;
}
?>
