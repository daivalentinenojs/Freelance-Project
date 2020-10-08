<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK'])) // Checked V X
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

	$QueryInformasiNilai = "SELECT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', Nilai.WaktuBuat AS 'WaktuBuat', Nilai.DosenPembuat AS 'DosenPembuat', Nilai.Status AS 'Status'
	FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Syarat = 1";
	$HasilQueryInformasiNilai = mysqli_query($MySQLi, $QueryInformasiNilai);
	$InformasiNilai = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryInformasiNilai))
	{
		$InformasiNilai[] = $Hasil;
	}
	mysqli_close($MySQLi);

	echo "<span style='font-size:12px; margin-left:20px;'><strong>Jenis Penilaian Kelas Pararel Anda</strong></span><br><br>";
	echo "<table class='table' style='margin-left:20px;'><thead><tr>";
	echo "<th style='text-align:center;'>Jenis</th>";
	echo "<th style='text-align:center;'>Bobot</th>";
	echo "<th style='text-align:center;'>Waktu Buat</th>";
	echo "<th style='text-align:center;'>Dosen Pembuat</th>";
	echo "<th style='text-align:center;'>Status</th>";
	echo "</tr></thead><tbody>";
	for ($i=0; $i < count($InformasiNilai); $i++)
	{
		echo "<tr>";
		echo "<td>".$InformasiNilai[$i]['Jenis']."</td>";
		echo "<td style='text-align:right;'>".$InformasiNilai[$i]['Bobot']."</td>";
		$Date = date_create($InformasiNilai[$i]['WaktuBuat']);
		echo "<td>".date_format($Date, "d F Y")."</td>";

		require '../../connection/Init.php';
		$MySQLi = mysqli_connect($domain, $username, $password, $database);
		$Temp = $InformasiNilai[$i]['DosenPembuat'];
		$QueryNamaKaryawan = "SELECT Karyawan.Nama AS 'Nama' FROM karyawan WHERE karyawan.NPK = '$Temp'";

		$HasilQueryNamaKaryawan = $MySQLi->query($QueryNamaKaryawan);
		$Hasil=$HasilQueryNamaKaryawan->fetch_assoc();
		$NamaTampil = $Hasil['Nama'] ;

		echo "<td>".$NamaTampil."</td>";
		echo "<td>".$InformasiNilai[$i]['Status']."</td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
}
?>
