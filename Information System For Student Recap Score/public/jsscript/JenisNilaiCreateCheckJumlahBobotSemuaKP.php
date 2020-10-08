<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["ketentuanNilai"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["jenisNilai"]) AND isset($_GET["bobotNilai"])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$CheckBisaTambahAtauTidak = 0;

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);
	$Ketentuan = $MySQLi->real_escape_string($_GET["ketentuanNilai"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$Jenis = $MySQLi->real_escape_string($_GET["jenisNilai"]);
	$Bobot = $MySQLi->real_escape_string($_GET["bobotNilai"]);

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
	// 0 Bisa Di Tambah
	// 1 Total Lebih dari 100%
	// 2 Penilaian Ada

	for ($i=0; $i < count($SemuaKP); $i++)
	{
		$SubStrJenisNilai = substr($Jenis, -3);
		$KPDiCheck = $SemuaKP[$i]['KP'];

		$QueryTotalBobotKPTertentu = "SELECT SUM(Nilai.Bobot) AS 'Bobot' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPDiCheck' AND Nilai.Jenis Like '%$SubStrJenisNilai' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
		$HasilQueryTotalBobotKPTertentu = $MySQLi->query($QueryTotalBobotKPTertentu);
		$Hasil=$HasilQueryTotalBobotKPTertentu->fetch_assoc();

		$TotalDB=0;

		if($Hasil['Bobot'] == "")
		{
			$TotalDB=0;
		}
		else
		{
			$TotalDB = $Hasil['Bobot'];
		}

		$Total = $TotalDB + $Bobot;

		if ($Jenis == "UTS" || $Jenis == "UAS")
		{
				$QueryCheckUTSUASAda = "SELECT Count(Nilai.KodeNilai) AS 'Jumlah' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPDiCheck' AND Nilai.Jenis Like '$Jenis' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
				$HasilQueryCheckUTSUASAda = $MySQLi->query($QueryCheckUTSUASAda);
				$Hasil=$HasilQueryCheckUTSUASAda->fetch_assoc();

				if($Hasil['Jumlah'] >= 1)
				{
					if($Total > 100)
					{
						$CheckBisaTambahAtauTidak = "21";
						$i = count($SemuaKP);
					}
					else
					{
						$CheckBisaTambahAtauTidak = "20";
						$i = count($SemuaKP);
					}
				}
				else
				{
					if ($Total > 100)
					{
						echo "10";
						$i = count($SemuaKP);
					}
					else
					{
						echo "0";
					}
				}
		}
		else
		{
			if($Total > 100)
			{
				$CheckBisaTambahAtauTidak = "10";
				$i = count($SemuaKP);
			}
			else
			{
				$CheckBisaTambahAtauTidak = "0";
			}
		}
	}

	echo $CheckBisaTambahAtauTidak;
}
?>
