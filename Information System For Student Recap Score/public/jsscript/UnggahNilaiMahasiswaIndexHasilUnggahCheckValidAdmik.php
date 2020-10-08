<?php
if(isset($_GET['KodeMkBuka']) AND isset($_GET['KPMkBuka']) AND isset($_GET['KodeUnggah'])) // Checked V
{
	require '../../connection/MyUbaya.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['KodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['KPMkBuka']);
	$KodeUnggah = $MySQLi->real_escape_string($_GET['KodeUnggah']);

	if ($KodeUnggah == 1)
	{
			$QueryJenisNilaiMax = "SELECT myUbaya.baak_Nilai.Status AS 'StatusJenisNilai'	FROM myUbaya.baak_Nilai
			WHERE myUbaya.baak_Nilai.KodeMkBuka = '$Kode' AND myUbaya.baak_Nilai.KP = '$KP' AND myUbaya.baak_Nilai.Jenis = 'NTS'
			AND myUbaya.baak_Nilai.KodeNilai = (SELECT MAX(myUbaya.baak_Nilai.KodeNilai) AS 'MaxJenisNilai'
			FROM myUbaya.baak_Nilai WHERE myUbaya.baak_Nilai.KodeMkBuka = '$Kode' AND myUbaya.baak_Nilai.KP = '$KP' AND
			myUbaya.baak_Nilai.Jenis = 'NTS')";

			$HasilQueryJenisNilaiMax = mysqli_query($MySQLi, $QueryJenisNilaiMax);
			$StatusMax = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiMax))
			{
				$StatusMax[] = $Hasil;
			}
	}
	else
	{
			$QueryJenisNilaiMax = "SELECT myUbaya.baak_Nilai.Status AS 'StatusJenisNilai'	FROM myUbaya.baak_Nilai
			WHERE myUbaya.baak_Nilai.KodeMkBuka = '$Kode' AND myUbaya.baak_Nilai.KP = '$KP' AND myUbaya.baak_Nilai.Jenis = 'NAS'
			AND myUbaya.baak_Nilai.KodeNilai = (SELECT MAX(myUbaya.baak_Nilai.KodeNilai) AS 'MaxJenisNilai'
			FROM myUbaya.baak_Nilai WHERE myUbaya.baak_Nilai.KodeMkBuka = '$Kode' AND myUbaya.baak_Nilai.KP = '$KP' AND
			myUbaya.baak_Nilai.Jenis = 'NAS')";

			$HasilQueryJenisNilaiMax = mysqli_query($MySQLi, $QueryJenisNilaiMax);
			$StatusMax = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilaiMax))
			{
				$StatusMax[] = $Hasil;
			}
	}

	// echo $QueryJenisNilaiMax;

	if (!empty($StatusMax))
		$CheckValidAdmik = $StatusMax[0]['StatusJenisNilai'];
	else
		$CheckValidAdmik = "DapatUnggah";

	if($CheckValidAdmik == 'ValidAdmik')
		echo "0";
	else
		echo "1";

	mysqli_close($MySQLi);
}
?>
