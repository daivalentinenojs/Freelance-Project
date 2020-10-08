<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataPembayaran = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
						FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
						Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
						Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
						Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
						FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
						ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.ID = '$IDFP'";
	$HasilQueryGetDataPembayaran = mysqli_query($MySQLi, $QueryGetDataPembayaran);
	$DataPembayaran = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembayaran)) {
		$DataPembayaran[] = $Hasil;
	}

	mysqli_close($MySQLi);
}

if (!empty($DataPembayaran)) {
?>
<input type="text" name="Luas" readonly value="<?php echo $DataPembayaran[0]['LuasDaerahLetterC'] ?>" class="form-control" required id="Luas" style="background:white; color:black;">
<?php } ?>
