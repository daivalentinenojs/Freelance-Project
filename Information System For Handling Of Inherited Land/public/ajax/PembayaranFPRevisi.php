<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT Pembayaran.ID AS 'ID', Pembayaran.ID AS 'View', Pembayaran.Tanggal AS 'Tanggal',
						Pembayaran.NamaBank AS 'NamaBank', Pembayaran.NamaPemegangKartu AS 'NamaPemegangKartu',
						Pembayaran.NomorKartu AS 'NomorKartu'
						FROM Pembayaran
						WHERE Pembayaran.IDFormulirPermohonan = '$IDFP'";

	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Pembayaran</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nama Bank</label>
				<div class="col-sm-2">
					<input type="text" name="NamaBank" value="<?php echo $DataFP[0]['NamaBank']; ?>" class="form-control" required id="NamaBank">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Tanggal</label>
				<div class="col-sm-3">
					<input type="date" name="Tanggal" value="<?php echo $DataFP[0]['Tanggal']; ?>" class="form-control" required id="Tanggal">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nomor Kartu</label>
				<div class="col-sm-3">
					<input type="text" name="NomorKartu" value="<?php echo $DataFP[0]['NomorKartu']; ?>" onkeypress="return isNumberKey(event)" class="form-control" required id="NomorKartu">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nama Pemegang Kartu</label>
				<div class="col-sm-4">
					<input type="text" name="NamaPemegangKartu" value="<?php echo $DataFP[0]['NamaPemegangKartu']; ?>" class="form-control" required id="NamaPemegangKartu">
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
