<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataPembayaran = "SELECT Pembayaran.ID AS 'ID', Pembayaran.ID AS 'View', Pembayaran.Tanggal AS 'Tanggal',
						Pembayaran.NamaBank AS 'NamaBank', Pembayaran.NamaPemegangKartu AS 'NamaPemegangKartu',
						Pembayaran.NomorKartu AS 'NomorKartu', Pembayaran.IDFormulirPermohonan AS 'IDFormulirPermohonan'
						FROM Pembayaran WHERE Pembayaran.IDFormulirPermohonan = '$IDFP'";
	$HasilQueryGetDataPembayaran = mysqli_query($MySQLi, $QueryGetDataPembayaran);
	$DataPembayaran = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataPembayaran)) {
		$DataPembayaran[] = $Hasil;
	}

	mysqli_close($MySQLi);
}

if (!empty($DataPembayaran)) {
?>
<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Nama Terima</label>
	<div class="col-sm-4">
		<input type="text" name="NamaTerima" readonly value="<?php echo $DataPembayaran[0]['NamaPemegangKartu'] ?>" class="form-control" required id="NamaTerima" style="background:white; color:black;">
	</div>
</div>
<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Bank</label>
	<div class="col-sm-4">
		<input type="text" name="NamaTerima" readonly value="<?php echo $DataPembayaran[0]['NamaBank'] ?>" class="form-control" required id="NamaTerima" style="background:white; color:black;">
	</div>
</div>
<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Nomor Rekening</label>
	<div class="col-sm-4">
		<input type="text" name="NamaTerima" readonly value="<?php echo $DataPembayaran[0]['NomorKartu'] ?>" class="form-control" required id="NamaTerima" style="background:white; color:black;">
	</div>
</div>
<?php } ?>
