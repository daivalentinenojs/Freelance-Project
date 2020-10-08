<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka'])) // Checked V => Tidak Dipakai
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);

	$QueryJumlahNilaiTelahDiUnggah = "SELECT count(Nilai.KodeNilai) AS 'JumlahTelahSiapUpload' FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'SiapUpload'";

	$HasilQueryJumlahNilaiTelahDiUnggah = mysqli_query($MySQLi, $QueryJumlahNilaiTelahDiUnggah);
	$JumlahTelahSiapUpload= array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahNilaiTelahDiUnggah)) {
			$JumlahTelahSiapUpload = $Hasil;
	}

	mysqli_close($MySQLi);

	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$QueryNamaMkBuka = "SELECT MataKuliah.Nama AS 'NamaMkBuka' FROM MataKuliah INNER JOIN MkBuka ON MataKuliah.KodeMk = MkBuka.KodeMk	WHERE MkBuka.KodeMkBuka = '$Kode'";

	$HasilQueryNamaMkBuka = mysqli_query($MySQLi, $QueryNamaMkBuka);
	$NamaMkBuka = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMkBuka)) {
			$NamaMkBuka = $Hasil;
	}

	if(empty($JumlahTelahSiapUpload['JumlahTelahSiapUpload'])) {
			$JumlahTelahSiapUpload['JumlahTelahSiapUpload'] = 0;
	}

	if ($JumlahTelahSiapUpload['JumlahTelahSiapUpload'] >= 1) {
		echo "<span style='font-size:12px; margin-left:30px;'><strong>Penilaian mahasiswa mata kuliah ".$NamaMkBuka['NamaMkBuka']." kelas pararel ".$KP." telah diunngah !</strong></span><br><br>";
	} else {
		echo "0";
	}
}
?>
