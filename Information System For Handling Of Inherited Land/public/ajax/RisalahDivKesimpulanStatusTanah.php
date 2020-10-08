<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', Pemohon.Nama AS 'NamaPemohon',
											Persyaratan.StatusTanah AS 'StatusTanah'
											FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
											INNER JOIN FPXP ON (FPXP.IDFormulirPermohonan = FormulirPermohonan.ID)
											INNER JOIN Persyaratan ON (FPXP.IDPersyaratan = Persyaratan.ID)
											WHERE FormulirPermohonan.ID = '$IDFP'";
	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	$StatusTanah = '';
	if (!empty($DataFP)) {
		if ($DataFP[0]['StatusTanah'] == '1') {
				$StatusTanah = 'Hak Milik';
		} else if ($DataFP[0]['StatusTanah'] == '2') {
				$StatusTanah = 'Hak Guna Bangunan';
		} else {
				$StatusTanah = 'Hak Pakai';
		}
	}

  mysqli_close($MySQLi);
}

?>

<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Jenis Kesimpulan Status Tanah</label>
	<?php if (!empty($DataFP)) { ?>
	<div class="col-sm-5">
		<input type="hidden" readonly style="color:black;background-color:white;" name="NamaKesimpulanStatusTanah" value="<?php echo $DataFP[0]['StatusTanah'] ?>" class="form-control" required id="NamaKesimpulanStatusTanah">
  	<input type="text" name="StrNamaKesimpulanStatusTanah" readonly style="color:black;background-color:white;" value="<?php echo $StatusTanah ?>" class="form-control" required id="StrNamaKesimpulanStatusTanah">
	</div>
	<?php } ?>
</div>
<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Nama Kesimpulan Status Tanah</label>
	<?php if (!empty($DataFP)) { ?>
	<div class="col-sm-5">
		<input type="hidden" readonly style="color:black;background-color:white;" name="JenisKesimpulanStatusTanah" value="HMA" class="form-control" required id="JenisKesimpulanStatusTanah">
		<input type="text" readonly style="color:black;background-color:white;" name="StrJenisKesimpulanStatusTanah" value="HMA" class="form-control" required id="StrJenisKesimpulanStatusTanah">
	</div>
	<?php } ?>
</div>
<div class="form-group">
	<label for="focusedinput" class="col-sm-4 control-label">Nama Penempat</label>
	<?php if (!empty($DataFP)) { ?>
	<div class="col-sm-5">
		<input type="text" readonly style="color:black;background-color:white;" name="NamaPenempat" value="<?php echo $DataFP[0]['NamaPemohon'] ?>" class="form-control" required id="NamaPenempat">
	</div>
	<?php } ?>
</div>
