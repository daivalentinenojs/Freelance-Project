<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK']) AND isset($_GET['Check']))
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);
	$Check = $MySQLi->real_escape_string($_GET['Check']);

	if ($Check == 7 || $Check == 56)
	{
			echo "<input type='button' class='btn btn-success' name='VerifikasiUTS' id='VerifikasiUTS' value='Verifikasi NTS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UTS' style='margin-right:10px; margin-top:5px;'>";
			echo "<input type='button' class='btn btn-success' name='VerifikasiUAS' id='VerifikasiUAS' value='Verifikasi NAS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UAS' style='margin-right:10px; margin-top:5px;'>";
			echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px; margin-top:5px;' class='btn btn-primary'>";
			echo "<input type='button' id='HapusNotifikasi'  onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px; margin-top:5px;' class='btn btn-default'>";
	}
	else if ($Check == 13 || $Check == 23 || $Check == 24 || $Check == 8 || $Check == 9 || $Check == 14)
	{
			echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px;' class='btn btn-primary'>";
			echo "<input type='button' id='HapusNotifikasi' onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px;' class='btn btn-default'>";
	}
	else if ($Check == 16 || $Check == 26 || $Check == 10)
	{
			echo "<input type='button' class='btn btn-success' name='VerifikasiUAS' id='VerifikasiUAS' value='Verifikasi NAS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UAS' style='margin-right:10px;'>";
			echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px;' class='btn btn-primary'>";
			echo "<input type='button' id='HapusNotifikasi'  onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px;' class='btn btn-default'>";
	}

	else if ($Check == 53 || $Check == 54)
	{
			echo "<input type='button' class='btn btn-success' name='VerifikasiUTS' id='VerifikasiUTS' value='Verifikasi NTS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UTS' style='margin-right:10px;'>";
			echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px;' class='btn btn-primary'>";
			echo "<input type='button' id='HapusNotifikasi'  onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px;' class='btn btn-default'>";
	}

	// if ($Check == 1 || $Check == 5)
	// {
	// 		echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px;' class='btn btn-primary'>";
	// 		echo "<input type='button' id='HapusNotifikasi' onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px;' class='btn btn-default'>";
	// }
	// else if ($Check == 2)
	// {
	// 		echo "<input type='button' class='btn btn-success' name='VerifikasiUTS' id='VerifikasiUTS' value='Verifikasi NTS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UTS' style='margin-right:10px;'>";
	// 		echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px;' class='btn btn-primary'>";
	// 		echo "<input type='button' id='HapusNotifikasi'  onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px;' class='btn btn-default'>";
	// }
	// else if ($Check == 3 || $Check == 6)
	// {
	// 		echo "<input type='button' class='btn btn-success' name='VerifikasiUAS' id='VerifikasiUAS' value='Verifikasi NAS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UAS' style='margin-right:10px;'>";
	// 		echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px;' class='btn btn-primary'>";
	// 		echo "<input type='button' id='HapusNotifikasi'  onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px;' class='btn btn-default'>";
	// }
	// else if ($Check == 4)
	// {
	// 		echo "<input type='button' class='btn btn-success' name='VerifikasiUTS' id='VerifikasiUTS' value='Verifikasi NTS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UTS' style='margin-right:10px;'>";
	// 		echo "<input type='button' class='btn btn-success' name='VerifikasiUAS' id='VerifikasiUAS' value='Verifikasi NAS' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai UAS' style='margin-right:10px;'>";
	// 		echo "<input type='reset' id='UlangInput' value='Ulang' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' style='margin-right:10px;' class='btn btn-primary'>";
	// 		echo "<input type='button' id='HapusNotifikasi'  onClick='$.noty.closeAll();' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Menghapus Notifikasi' value='Hapus Notifikasi' style='margin-right:10px;' class='btn btn-default'>";
	// }

	// $QueryJumlahJenisNilaiSiapUpload = "SELECT DISTINCT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', Nilai.WaktuBuat AS 'WaktuBuat'  FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
	// WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'TelahDiKalkulasi' AND Nilai.Syarat = 1 ORDER BY Nilai.KodeNilai";
	//
	// $HasilQueryJumlahJenisNilaiSiapUpload = mysqli_query($MySQLi, $QueryJumlahJenisNilaiSiapUpload);
	// $JumlahJenisNilaiSiapUpload = array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahJenisNilaiSiapUpload)) {
	// 		$JumlahJenisNilaiSiapUpload[] = $Hasil;
	// }
	//
	// echo "<br>";
	// if (!empty($JumlahJenisNilaiSiapUpload))
	// {
	// 	echo "<input type='submit' value='Verifikasi Nilai' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Verifikasi Nilai' style='margin-right:10px;' class='btn btn-success'>";
	// 	echo "<input type='reset' id='UlangInput' data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
	// }
	// else
	// {
	// 	echo "<input type='reset' id='UlangInput'  data-toggle='tooltip' data-placement='bottom' title='Klik untuk Mengulang Halaman' value='Ulang' style='margin-right:10px;' class='btn btn-primary'>";
	// }
}
?>
