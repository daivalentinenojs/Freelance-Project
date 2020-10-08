<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
						FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
						Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
						Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
						Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP'
						FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
						ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.ID = '$IDFP'";

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
			<h3 class="panel-title">Informasi Formulir Permohonan</h3>
		</div>

			<div class="panel-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nama Kuasa</label>
						<div class="col-sm-6">
							<input type="hidden" name="IDFP" value="<?php echo $DataFP[0]['ID']; ?>">
							<input type="text" readonly name="NamaKuasa" class="form-control" required id="NamaKuasa" value="<?php echo $DataFP[0]['NamaKuasa']; ?>" style="background:white; color:black;">
						</div>
					</div>

					<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">File Formulir Permohonan</label>
							<div class="col-md-8">
								<?php echo '<img src="/Pajak/public/foto/FormulirPermohonan/'.$IDFP.'.jpg" alt="" style="border-radius:10px;">'; ?>
							</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Alamat Kuasa</label>
						<div class="col-sm-8">
							<input type="text" readonly value="<?php echo $DataFP[0]['AlamatKuasa']; ?>" name="AlamatKuasa" class="form-control" required id="AlamatKuasa" style="background:white; color:black;">
						</div>
					</div>

					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Alamat Tanah</label>
						<div class="col-sm-8">
							<input type="text" readonly value="<?php echo $DataFP[0]['AlamatTanah']; ?>" name="AlamatTanah" class="form-control" required id="AlamatTanah" style="background:white; color:black;">
						</div>
					</div>
				</div>
		</div>
</div>
<?php } ?>
