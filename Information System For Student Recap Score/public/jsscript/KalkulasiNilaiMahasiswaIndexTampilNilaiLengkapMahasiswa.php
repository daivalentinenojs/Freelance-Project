<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK'])) // Checked V
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

	$QueryMahasiswaAmbilMk = "SELECT MhsAmbilMk.NRP AS 'NRP', MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka', MataKuliah.Nama AS 'NamaMkBuka', MhsAmbilMk.KP AS 'KP'
	FROM MhsAmbilMk INNER JOIN MkBuka ON MhsAmbilMk.KodeMkBuka = MkBuka.KodeMkBuka INNER JOIN MataKuliah ON MataKuliah.KodeMk = MkBuka.KodeMk
	WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP'";
	// echo $queryMahasiswaAmbilMk;
	$HasilQueryMahasiswaAmbilMk = mysqli_query($MySQLi, $QueryMahasiswaAmbilMk);
	$HasilMahasiswaAmbilMk = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryMahasiswaAmbilMk))
	{
		$HasilMahasiswaAmbilMk[] = $Hasil;
	}

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$QueryJumlahJenisNilai = "SELECT DISTINCT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', Nilai.WaktuBuat AS ' WaktuBuat'  FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
	WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 ORDER BY Nilai.KodeNilai";
	// echo $queryJumlahJenisNilai;
	$HasilQueryJumlahJenisNilai = mysqli_query($MySQLi, $QueryJumlahJenisNilai);
	$HasilTampilJumlahJenisNilai = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahJenisNilai))
	{
		$HasilTampilJumlahJenisNilai[] = $Hasil;
	}

	echo "<span style='font-size:11px; margin-left:30px;'><strong>Daftar Nilai Mahasiswa Mata Kuliah ".$HasilMahasiswaAmbilMk[0]['NamaMkBuka']." KP ".$KP."</strong></span><br><br>";
	
	if (!empty($HasilTampilJumlahJenisNilai))
	{
						echo "<table class='table' style='margin-left:30px;'><thead><tr>";
						echo "<th style='text-align:center; vertical-align:middle;'>NRP</th>";
						echo "<th style='text-align:center; vertical-align:middle;'>Nama Mahasiswa</th>";

						for ($i=0; $i < count($HasilTampilJumlahJenisNilai); $i++) {
								$Date = date_create($HasilTampilJumlahJenisNilai[$i]['WaktuBuat']);

								$TempDate = date_format($Date, "d F Y");
								echo "<th style='text-align:center;'>Nilai ".$HasilTampilJumlahJenisNilai[$i]['Jenis']."<br>".$TempDate."<br>".$HasilTampilJumlahJenisNilai[$i]['Bobot']." % </th>";
						}
						echo "</tr></thead><tbody>";

						mysqli_close($MySQLi);

						for ($i=0; $i < count($HasilMahasiswaAmbilMk); $i++)
						{
								echo "<tr>";
								$Temp = $HasilMahasiswaAmbilMk[$i]['NRP'];
								$QueryJenisNilai = "SELECT Nilai.KodeMkBuka AS 'KodeMkBuka', Nilai.KP AS 'KP', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', NilaiMahasiswa.NRP AS 'NRP', NilaiMahasiswa.NRP AS 'Nama',
								NilaiMahasiswa.Nilai AS 'Nilai', NilaiMahasiswa.KodeNisbi AS 'KodeNisbi' FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
								WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 AND NilaiMahasiswa.NRP = '$Temp' ORDER BY Nilai.KodeNilai";

								require '../../connection/RekapNilai.php';
								$MySQLi = mysqli_connect($domain, $username, $password, $database);
								$HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
								$HasilTampilNilai = array();
								while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai)) {
									$HasilTampilNilai[] = $Hasil;
								}

								mysqli_close($MySQLi);
								require '../../connection/Init.php';
								$MySQLi = mysqli_connect($domain, $username, $password, $database);

								$QueryNamaMahasiswa = "SELECT Mahasiswa.Nama FROM Mahasiswa WHERE Mahasiswa.NRP = '$Temp'";

								$HasilQueryNamaMahasiswa = mysqli_query($MySQLi, $QueryNamaMahasiswa);
								$HasilNamaMahasiswa = array();
								while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMahasiswa)) {
									$HasilNamaMahasiswa = $Hasil;
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
								echo "</tr>";
						}

		} else {
					echo "<table class='table' style='margin-left:30px;'><thead><tr>";
					echo "<th style='text-align:center; vertical-align:middle;'>NRP</th>";
					echo "<th style='text-align:center; vertical-align:middle;'>Nama Mahasiswa</th>";

					for ($i=0; $i < count($HasilMahasiswaAmbilMk); $i++) {
							echo "<tr>";
							$Temp = $HasilMahasiswaAmbilMk[$i]['NRP'];

							require '../../connection/Init.php';
							$MySQLi = mysqli_connect($domain, $username, $password, $database);

							$QueryNamaMahasiswa = "SELECT Mahasiswa.Nama FROM Mahasiswa WHERE Mahasiswa.NRP = '$Temp'";

							$HasilQueryNamaMahasiswa = mysqli_query($MySQLi, $QueryNamaMahasiswa);
							$HasilNamaMahasiswa = array();
							while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMahasiswa))
							{
								$HasilNamaMahasiswa = $Hasil;
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
