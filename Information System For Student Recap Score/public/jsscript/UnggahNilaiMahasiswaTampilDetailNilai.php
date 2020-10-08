<?php
if(isset($_GET['KodeSubString']) AND isset($_GET['KodeMkBuka']) AND isset($_GET['KPMkBuka']) AND isset($_GET['KodeUnggah']))
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['KodeSubString']);
	$KodeMkBuka = $MySQLi->real_escape_string($_GET['KodeMkBuka']);
	$KPMkBuka = $MySQLi->real_escape_string($_GET['KPMkBuka']);
	$KodeUnggah = $MySQLi->real_escape_string($_GET['KodeUnggah']);

	$Hasil = explode(",", $Kode);

	$NRP = $Hasil[4];
	$NamaMahasiswa = $Hasil[5];

	if ($KodeUnggah == 1)
	{
		$QueryDetailNilai = "SELECT Nilai.Jenis AS 'JenisNilai', NilaiMahasiswa.Nilai AS 'NilaiMahasiswa', NilaiMahasiswa.KodeNisbi AS 'KodeNisbiMahasiswa'
		FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND
		Nilai.Syarat = 1 AND NilaiMahasiswa.NRP = '$NRP' AND right(Nilai.Jenis,3) Like 'UTS' ORDER BY Nilai.Jenis";
	}
	else
	{
		$QueryDetailNilai = "SELECT Nilai.Jenis AS 'JenisNilai', NilaiMahasiswa.Nilai AS 'NilaiMahasiswa', NilaiMahasiswa.KodeNisbi AS 'KodeNisbiMahasiswa'
		FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai WHERE Nilai.KodeMkBuka = '$KodeMkBuka' AND Nilai.KP = '$KPMkBuka' AND
		Nilai.Syarat = 1 AND NilaiMahasiswa.NRP = '$NRP' AND right(Nilai.Jenis,3) Like 'UAS' ORDER BY Nilai.Jenis";
	}

	$HasilQueryDetailNilai = mysqli_query($MySQLi, $QueryDetailNilai);
	$DetailNilai = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDetailNilai))
	{
		$DetailNilai[] = $Hasil;
	}

	// mysqli_close($MySQLi);

	if ($KodeUnggah == 1)
	{
			$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol', BAAK.Mahasiswa.Nama AS 'NamaNol'
			FROM BAAK.MhsAmbilMk INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
			WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.HadirUTS = 'N'";

			$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
			$CheckNRPUTSUASNol = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
			{
				$CheckNRPUTSUASNol[] = $Hasil;
			}
	}
	else if ($KodeUnggah == 2)
	{
			$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol', BAAK.Mahasiswa.Nama AS 'NamaNol'
			FROM BAAK.MhsAmbilMk INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
			WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND (BAAK.MhsAmbilMk.HadirUAS = 'N' || BAAK.MhsAmbilMk.StatusTilangPresensi = 'Y')";

			$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
			$CheckNRPUTSUASNol = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
			{
				$CheckNRPUTSUASNol[] = $Hasil;
			}
	}

	if (empty($CheckNRPUTSUASNol))
	{
			$CheckNRPUTSUASNol = 0;
	}

	$CheckEmptyUTSUAS = 0;

 	if(empty($DetailNilai))
	{
			if(!empty($CheckNRPUTSUASNol))
			{
					for ($s=0; $s < count($CheckNRPUTSUASNol); $s++)
					{
						if ($NRP == $CheckNRPUTSUASNol[$s]['NRPUASNol'])
						{
								echo "<span style='font-size:12px; margin-left:20px;'><strong>Detail Nilai Mahasiswa ".$NamaMahasiswa." ( ".$NRP." )</strong></span><br><br>";
								echo "<table class='table' style='margin-left:20px; width:50%;'><thead><tr>";
								echo "<th style='text-align:center;'>Jenis</th>";
								echo "<th style='text-align:center;'>Nilai</th>";
								echo "<th style='text-align:center;'>Nisbi</th>";
								echo "</tr></thead><tbody>";
								echo "<tr>";
								if ($KodeUnggah == 1)
								{
										echo "<td style='text-align:center;'>UTS</td>";
								}
								else
								{
										echo "<td style='text-align:center;'>UAS</td>";
								}
								echo "<td style='text-align:center;'>Tidak Hadir</td>";
								echo "<td style='text-align:center;'>Tidak Hadir</td>";
								echo "</tr>";
								echo "</tbody></table>";
								$s = count($CheckNRPUTSUASNol);
								$CheckEmptyUTSUAS = 1;
						}
					}
					if ($CheckEmptyUTSUAS == 0)
					{
							echo "Tidak Ada Detail Nilai";
					}
			}
	}
	else
	{
		echo "<span style='font-size:12px; margin-left:20px;'><strong>Detail Nilai Mahasiswa ".$NamaMahasiswa." ( ".$NRP." )</strong></span><br><br>";
		echo "<table class='table' style='margin-left:20px; width:50%;'><thead><tr>";
		echo "<th style='text-align:center;'>Jenis</th>";
		echo "<th style='text-align:center;'>Nilai</th>";
		echo "<th style='text-align:center;'>Nisbi</th>";
		echo "</tr></thead><tbody>";
		for ($i=0; $i < count($DetailNilai); $i++)
		{
			echo "<tr>";
			echo "<td style='text-align:center;'>".$DetailNilai[$i]['JenisNilai']."</td>";
			echo "<td style='text-align:center;'>".$DetailNilai[$i]['NilaiMahasiswa']."</td>";
			echo "<td style='text-align:center;'>".$DetailNilai[$i]['KodeNisbiMahasiswa']."</td>";
			echo "</tr>";
		}
		if(!empty($CheckNRPUTSUASNol))
		{
				for ($i=0; $i < count($CheckNRPUTSUASNol); $i++)
				{
					if ($NRP == $CheckNRPUTSUASNol[$i]['NRPUASNol'])
					{
							echo "<tr>";
							if ($KodeUnggah == 1)
							{
									echo "<td style='text-align:center;'>UTS</td>";
							}
							else
							{
									echo "<td style='text-align:center;'>UAS</td>";
							}
							echo "<td style='text-align:center;'>Tidak Hadir</td>";
							echo "<td style='text-align:center;'>Tidak Hadir</td>";
							echo "</tr>";
					}
				}
		}
		echo "</tbody></table>";
	}

  // 	if(empty($DetailNilai))
	// {
	// 		echo "Tidak Ada Detail Nilai";
	// }
	// else
	// {
	// 	echo "<span style='font-size:12px; margin-left:20px;'><strong>Detail Nilai Mahasiswa ".$NamaMahasiswa." ( ".$NRP." )</strong></span><br><br>";
	// 	echo "<table class='table' style='margin-left:20px; width:50%;'><thead><tr>";
	// 	echo "<th style='text-align:center;'>Jenis</th>";
	// 	echo "<th style='text-align:center;'>Nilai</th>";
	// 	echo "<th style='text-align:center;'>Nisbi</th>";
	// 	echo "</tr></thead><tbody>";
	// 	for ($i=0; $i < count($DetailNilai); $i++)
	// 	{
	// 		echo "<tr>";
	// 		echo "<td style='text-align:center;'>".$DetailNilai[$i]['JenisNilai']."</td>";
	// 		echo "<td style='text-align:center;'>".$DetailNilai[$i]['NilaiMahasiswa']."</td>";
	// 		echo "<td style='text-align:center;'>".$DetailNilai[$i]['KodeNisbiMahasiswa']."</td>";
	// 		echo "</tr>";
	// 	}
	// 	echo "</tbody></table>";
	// }
}
?>
