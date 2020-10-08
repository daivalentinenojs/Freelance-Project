<?php
if(isset($_GET["kodeMkBuka"]) AND isset($_GET["NPK"]) AND isset($_GET["ketentuanNilai"]) AND isset($_GET["kpMkBuka"]) AND isset($_GET["jenisNilai"]) AND isset($_GET["bobotNilai"])) // Checked V Y
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET["kodeMkBuka"]);
	$NPK = $MySQLi->real_escape_string($_GET["NPK"]);
	$Ketentuan = $MySQLi->real_escape_string($_GET["ketentuanNilai"]);
	$KP = $MySQLi->real_escape_string($_GET["kpMkBuka"]);
	$Jenis = $MySQLi->real_escape_string($_GET["jenisNilai"]);
	$Bobot = $MySQLi->real_escape_string($_GET["bobotNilai"]);


	$SubStrJenisNilai = substr($Jenis, -3);

	$QueryTotalBobot = "SELECT SUM(Nilai.Bobot) AS 'Bobot' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '%$SubStrJenisNilai' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
	$HasilQueryTotalBobot = $MySQLi->query($QueryTotalBobot);
	$Hasil = $HasilQueryTotalBobot->fetch_assoc();

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

	// Keterangan
	// 0 Tidak ada error
	// 1 Error Total Input dan Database
	// 2 Error Jenis Penilaian sudah pernah diinputkan, cukup satu kali saja.

	if ($Bobot != 0)
	{
			if ($Jenis == "UTS" || $Jenis == "UAS")
		  {
		      $QueryCheckUTSUASAda = "SELECT Count(Nilai.KodeNilai) AS 'Jumlah' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Jenis Like '$Jenis' AND Nilai.Syarat = 1 Group By Nilai.KodeMkBuka";
		      $HasilQueryCheckUTSUASAda = $MySQLi->query($QueryCheckUTSUASAda);
		      $Hasil=$HasilQueryCheckUTSUASAda->fetch_assoc();

		      if($Hasil['Jumlah'] >= 1)
		      {
						if ($Total > 100)
						{
							echo "21";
						}
						else
						{
							echo "20";
						}
		      }
					else
					{
						if ($Total > 100)
						{
							echo "10";
						}
						else
						{
							echo "0";
						}
					}
		  }
		  else
		  {
		    if ($Total > 100)
				{
					echo "10";
				}
				else
				{
					echo "0";
				}
			}
	}
	else if ($Bobot == "undefined")
	{
			echo "111";
	}
	else
	{
			echo "11";
	}
}
?>
