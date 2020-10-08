<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	if (!empty($IDFP)) {
		// $QueryGetDesa = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', Pemohon.IDDesa AS 'IDDesa'
		// 					FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
		// 					WHERE FormulirPermohonan.ID = '$IDFP'";
		// $HasilQueryGetDataDesa = mysqli_query($MySQLi, $QueryGetDesa);
		// $DataDesa = array();
		// while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataDesa)) {
		// 	$DataDesa[] = $Hasil;
		// }
		//
		// $IDDesa = $DataDesa[0]['IDDesa'];

		$QueryGetNomorFisik = "SELECT BerkasPengumuman.NomorBerkasPengumuman AS 'NomorBerkasPengumuman', BerkasPengumuman.NomorBidang AS 'NomorBidang',
							BerkasPengumuman.Sanggahan AS 'Sanggahan'
							FROM BerkasPengumuman
							WHERE BerkasPengumuman.IDFormulirPermohonan = '$IDFP'";
		$HasilQueryGetDataNomorFisik = mysqli_query($MySQLi, $QueryGetNomorFisik);
		$DataNomorFisik = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNomorFisik)) {
			$DataNomorFisik[] = $Hasil;
		}
	}
	mysqli_close($MySQLi);
}

if (!empty($DataNomorFisik)) {
?>
<div class="col-md-6">
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nomor Fisik</label>
		<div class="col-sm-3">
			<input type="text" name="NomorBerkasPengumuman" value="<?php echo $DataNomorFisik[0]['NomorBerkasPengumuman']; ?>" class="form-control" required readonly style="color:black; background-color:white;" id="NomorBerkasPengumuman" onkeypress="return isNumberKey(event)">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nomor Bidang</label>
		<div class="col-sm-3">
			<input type="text" name="NomorBidang" value="<?php echo $DataNomorFisik[0]['NomorBidang']; ?>" class="form-control" required readonly style="color:black; background-color:white;" id="NomorBidang" onkeypress="return isNumberKey(event)">
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Sanggahan</label>
		<div class="col-sm-6">
			<input type="text" name="Sanggahan" value="<?php echo $DataNomorFisik[0]['Sanggahan']; ?>" class="form-control" id="Sanggahan">
		</div>
	</div>
	<div class="form-group">
			<label for="focusedinput" class="col-sm-4 control-label">File Bidang Tanah</label>
			<div class="col-md-8">
					<input type="file" name="FileBidangTanah" id="FileBidangTanah" class="file" data-preview-file-type="any"/>
			</div>
	</div>
</div>
<?php } ?>
