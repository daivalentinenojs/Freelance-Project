<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK'])) // Checked V => Tidak Dipakai
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

	$queryMahasiswaAmbilMk = "SELECT MhsAmbilMk.NRP AS 'NRP', MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka', MataKuliah.Nama AS 'NamaMkBuka', MhsAmbilMk.KP AS 'KP'
	FROM MhsAmbilMk INNER JOIN MkBuka ON MhsAmbilMk.KodeMkBuka = mkbuka.KodeMkBuka INNER JOIN MataKuliah ON MataKuliah.KodeMk = MkBuka.KodeMk
	WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP'";
	// echo $queryMahasiswaAmbilMk;
	$result = mysqli_query($MySQLi, $queryMahasiswaAmbilMk);
	$HasilMahasiswaAmbilMk = array();
	while($r = mysqli_fetch_assoc($result)) {
			$HasilMahasiswaAmbilMk[] = $r;
	}

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$queryJumlahJenisNilaiSiapUpload = "SELECT DISTINCT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', Nilai.WaktuBuat AS 'WaktuBuat'  FROM Nilai INNER JOIN nilaimahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
	WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload' AND Nilai.Syarat = 1 ORDER BY Nilai.KodeNilai";

	$result = mysqli_query($MySQLi, $queryJumlahJenisNilaiSiapUpload);
	$JumlahJenisNilaiSiapUpload = array();
	while($r = mysqli_fetch_assoc($result)) {
		$JumlahJenisNilaiSiapUpload[] = $r;
	}

	if (empty($JumlahJenisNilaiSiapUpload)) {
			$queryJumlahJenisNilai = "SELECT DISTINCT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', Nilai.WaktuBuat AS ' WaktuBuat'  FROM Nilai INNER JOIN nilaimahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
			WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 ORDER BY Nilai.KodeNilai";
	} else {
			$queryJumlahJenisNilai = "SELECT DISTINCT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', Nilai.WaktuBuat AS ' WaktuBuat'  FROM Nilai INNER JOIN nilaimahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
			WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload' AND Nilai.Syarat = 1 ORDER BY Nilai.KodeNilai";
	}

	$result = mysqli_query($MySQLi, $queryJumlahJenisNilai);
	$HasilTampilJumlahJenisNilai = array();
	while($r = mysqli_fetch_assoc($result)) {
		$HasilTampilJumlahJenisNilai[] = $r;
	}

	echo "<span style='font-size:11px; margin-left:30px;'><strong>Daftar Nilai Mahasiswa Mata Kuliah ".$HasilMahasiswaAmbilMk[0]['NamaMkBuka']." KP ".$KP."</strong></span><br><br>";

	if (!empty($HasilTampilJumlahJenisNilai)) {
				echo "<table class='table' style='margin-left:30px;'><thead><tr>";
				echo "<th style='text-align:center; vertical-align:middle;'>NRP</th>";
				echo "<th style='text-align:center; vertical-align:middle;'>Nama Mahasiswa</th>";

				for ($i=0; $i < count($HasilTampilJumlahJenisNilai); $i++) {
						$date = date_create($HasilTampilJumlahJenisNilai[$i]['WaktuBuat']);

						$tempDate = date_format($date, "d F Y");
						echo "<th style='text-align:center;'>Nilai ".$HasilTampilJumlahJenisNilai[$i]['Jenis']."<br>".$tempDate."<br>".$HasilTampilJumlahJenisNilai[$i]['Bobot']." % </th>";
				}

				if (!empty($JumlahJenisNilaiSiapUpload)) {
					echo "<th style='text-align:center; vertical-align:middle;'> NTS </th>";
					echo "<th style='text-align:center; vertical-align:middle;'> NAS </th>";
					echo "<th style='text-align:center; vertical-align:middle;'> Nilai Akhir </th>";
					echo "<th style='text-align:center; vertical-align:middle;'> Kode Nisbi </th>";
				}

				echo "</tr></thead><tbody>";

				mysqli_close($MySQLi);

				for ($i=0; $i < count($HasilMahasiswaAmbilMk); $i++) {
						echo "<tr>";
						$temp = $HasilMahasiswaAmbilMk[$i]['NRP'];

						if (empty($JumlahJenisNilaiSiapUpload)) {
								$queryJenisNilai = "SELECT Nilai.KodeMkBuka AS 'KodeMkBuka', Nilai.KP AS 'KP', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', NilaiMahasiswa.NRP AS 'NRP', NilaiMahasiswa.NRP AS 'Nama',
								NilaiMahasiswa.Nilai AS 'Nilai', NilaiMahasiswa.KodeNisbi AS 'KodeNisbi' FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
								WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 AND NilaiMahasiswa.NRP = '$temp' ORDER BY Nilai.KodeNilai";
						} else {
								$queryJenisNilai = "SELECT Nilai.KodeMkBuka AS 'KodeMkBuka', Nilai.KP AS 'KP', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', NilaiMahasiswa.NRP AS 'NRP', NilaiMahasiswa.NRP AS 'Nama',
								NilaiMahasiswa.Nilai AS 'Nilai', NilaiMahasiswa.KodeNisbi AS 'KodeNisbi' FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
								WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload' AND Nilai.Syarat = 1 AND NilaiMahasiswa.NRP = '$temp' ORDER BY Nilai.KodeNilai";
						}

						require '../../connection/RekapNilai.php';
						$MySQLi = mysqli_connect($domain, $username, $password, $database);
						$result = mysqli_query($MySQLi, $queryJenisNilai);
						$HasilTampilNilai = array();
						while($r = mysqli_fetch_assoc($result)) {
							$HasilTampilNilai[] = $r;
						}

						mysqli_close($MySQLi);
						require '../../connection/Init.php';
						$MySQLi = mysqli_connect($domain, $username, $password, $database);

						$queryNamaMahasiswa = "SELECT Mahasiswa.Nama FROM Mahasiswa WHERE Mahasiswa.NRP = '$temp'";

						$result = mysqli_query($MySQLi, $queryNamaMahasiswa);
						$HasilNamaMahasiswa = array();
						while($r = mysqli_fetch_assoc($result)) {
							$HasilNamaMahasiswa = $r;
						}
						$HasilTampilNilai[0]['Nama'] = $HasilNamaMahasiswa['Nama'];

						if (!empty($HasilTampilNilai)) {
									echo "<td style='text-align:center; vertical-align:middle;'>".$HasilTampilNilai[0]['NRP']."</td>";
									echo "<td style='text-align:center; vertical-align:middle;'>".$HasilTampilNilai[0]['Nama']."</td>";

									foreach ($HasilTampilNilai as $key => $value) {
										echo "<td style='text-align:center; vertical-align:middle;'>".$value['Nilai']."</td>";
									}
						}

						mysqli_close($MySQLi);

						if (!empty($JumlahJenisNilaiSiapUpload)) {
								require '../../connection/RekapNilai.php';
								$MySQLi = mysqli_connect($domain, $username, $password, $database);

								$queryNTSNAS = "SELECT MhsAmbilMk.NTS AS 'NTS', MhsAmbilMk.NAS AS 'NAS', MhsAmbilMk.NA AS 'NA', MhsAmbilMk.KodeNisbi AS 'KodeNisbi'
								FROM MhsAmbilMk WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP' AND MhsAmbilMk.NRP = '$temp'";
								$result = mysqli_query($MySQLi, $queryNTSNAS);
								$HasilNTSNAS = array();
								while($r = mysqli_fetch_assoc($result)) {
										$HasilNTSNAS = $r;
								}

								echo "<td style='text-align:center; vertical-align:middle;'>".$HasilNTSNAS['NTS']."</td>";
								echo "<td style='text-align:center; vertical-align:middle;'>".$HasilNTSNAS['NAS']."</td>";
								echo "<td style='text-align:center; vertical-align:middle;'>".$HasilNTSNAS['NA']."</td>";
								echo "<td style='text-align:center; vertical-align:middle;'>".$HasilNTSNAS['KodeNisbi']."</td>";

								mysqli_close($MySQLi);
						}
						echo "</tr>";
				}

	} else {
			echo "<table class='table' style='margin-left:30px;'><thead><tr>";
			echo "<th style='text-align:center; vertical-align:middle;'>NRP</th>";
			echo "<th style='text-align:center; vertical-align:middle;'>Nama Mahasiswa</th>";

			for ($i=0; $i < count($HasilMahasiswaAmbilMk); $i++) {
					echo "<tr>";
					$temp = $HasilMahasiswaAmbilMk[$i]['NRP'];

					require '../../connection/Init.php';
					$mysqli = mysqli_connect($domain, $username, $password, $database);

					$queryNamaMahasiswa = "SELECT Mahasiswa.Nama FROM Mahasiswa WHERE Mahasiswa.NRP = '$temp'";

					$result = mysqli_query($mysqli, $queryNamaMahasiswa);
					$HasilNamaMahasiswa = array();
					while($r = mysqli_fetch_assoc($result))
					{
						$HasilNamaMahasiswa = $r;
					}
					$HasilMahasiswaAmbilMk[$i]['Nama'] = $HasilNamaMahasiswa['Nama'];
					echo "<td style='text-align:center; vertical-align:middle;'>".$HasilMahasiswaAmbilMk[$i]['NRP']."</td>";
					echo "<td style='text-align:center; vertical-align:middle;'>".$HasilMahasiswaAmbilMk[$i]['Nama']."</td>";
					echo "</tr>";
			}
			echo "</tbody></table>";
	}
}
?>
