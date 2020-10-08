<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
						FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
						Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
						Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.File AS 'File',
						Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP', Persyaratan.PersilNoLetterC AS 'PersilNoLetterC', Persyaratan.KelasLetterC AS 'KelasLetterC'
						FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
						ON (Persyaratan.ID = FPXP.IDPersyaratan) WHERE FormulirPermohonan.ID = '$IDFP'";

	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	if (!empty($DataFP)) {
		if ($DataFP[0]['StatusTanah'] == 1) {
			$StatusTanah = 'Hak Milik';
		} elseif ($DataFP[0]['StatusTanah'] == 2) {
			$StatusTanah = 'Hak Guna Bangunan';
		} else {
			$StatusTanah = 'Hak Pakai';
		}
	}
	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
		<div class="panel-heading">
			<h3 class="panel-title">Informasi Persyaratan</h3>
		</div>

			<div class="panel-body">
				<div class="col-md-6">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Nama Pemohon</label>
							<div class="col-sm-6">
								<input type="text" name="NamaPemohon" value="<?php echo $DataFP[0]['NamaPemohon']; ?>" readonly class="form-control" required id="NamaPemohon" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Nomor Buku Huruf C</label>
							<div class="col-sm-3">
								<input type="text" name="NomorBukuHurufC" value="<?php echo $DataFP[0]['NomorBukuHurufC']; ?>" readonly class="form-control" required id="NomorBukuHurufC" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Persil No Letter C</label>
							<div class="col-sm-3">
								<input type="text" name="PersilNoLetterC" value="<?php echo $DataFP[0]['PersilNoLetterC']; ?>" readonly class="form-control" required id="PersilNoLetterC" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Kelas Letter C</label>
							<div class="col-sm-3">
								<input type="text" name="KelasLetterC" value="<?php echo $DataFP[0]['KelasLetterC']; ?>" readonly class="form-control" required id="KelasLetterC" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Jenis Tanah Letter C</label>
						<div class="col-sm-6">
							<input type="text" name="JenisTanahLetterC" value="<?php echo $DataFP[0]['JenisTanahLetterC']; ?>" readonly class="form-control" required id="JenisTanahLetterC" style="background:white; color:black;">
						</div>
					</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Luas Daerah Letter C (m2)</label>
							<div class="col-sm-3">
								<input type="text" name="LuasDaerahLetterC" value="<?php echo $DataFP[0]['LuasDaerahLetterC']; ?>" readonly class="form-control" required id="LuasDaerahLetterC" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Luas Tanah Letter C (m2)</label>
							<div class="col-sm-3">
								<input type="text" name="LuasTanahLetterC" value="<?php echo $DataFP[0]['LuasTanahLetterC']; ?>" readonly class="form-control" required id="LuasTanahLetterC" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Status Tanah</label>
							<div class="col-sm-3">
								<input type="text" name="StatusTanah" value="<?php echo $StatusTanah; ?>" readonly class="form-control" required id="StatusTanah" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>
					</div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">File Persyaratan</label>

								<?php
										$ArrFile = explode(';', $DataFP[0]['File']);
										for ($i=0; $i < count($ArrFile); $i++) {
											echo '<div class="col-sm-2">';
											echo '<a href="foto/Persyaratan/'.$ArrFile[$i].'"><img src="foto/Persyaratan/'.$ArrFile[$i].'" alt="" style="border-radius:10px;"></a>';
											echo '</div>';
										}
								?>

						</div>
					</div>
			</div>
</div>
<?php } ?>
