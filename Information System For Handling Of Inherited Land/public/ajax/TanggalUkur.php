<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT BerkasPermohonan.IDPersyaratan AS 'IDPersyaratan', JadwalUkur.IDKaryawan AS 'IDKaryawan', JadwalUkur.TanggalMulai AS 'TanggalMulai'
						FROM BerkasPermohonan INNER JOIN JadwalUkur ON (BerkasPermohonan.IDJadwalUkur = JadwalUkur.ID)
						WHERE BerkasPermohonan.IDPersyaratan = '$IDFP'";
	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
	$Time = date_format(date_create($DataFP[0]['TanggalMulai']), 'Y-m-d');
?>
<input type="text" readonly name="TanggalUkur" value="<?php echo $Time; ?> " class="form-control" required id="TanggalUkur" style="background:white; color:black;">
<?php } ?>
