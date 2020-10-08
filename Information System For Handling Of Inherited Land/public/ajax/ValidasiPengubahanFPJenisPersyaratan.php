<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
						FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
						Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC', Persyaratan.LuasTanahLetterC AS 'LuasTanahLetterC',
						Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC', Persyaratan.File AS 'File',
						Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP', Persyaratan.PersilNoLetterC AS 'PersilNoLetterC', Persyaratan.KelasLetterC AS 'KelasLetterC',
						Persyaratan.JenisPersyaratan AS 'JenisPersyaratan', Persyaratan.NamaPewaris AS 'NamaPewaris', Persyaratan.TanggalMeninggal AS 'TanggalMeninggal',
						Persyaratan.DesaKecamatan AS 'DesaKecamatan', Persyaratan.TanggalKeteranganWaris AS 'TanggalKeteranganWaris', Persyaratan.StatusSuratWasiat AS 'StatusSuratWasiat',
						Persyaratan.NamaPPAT AS 'NamaPPAT', Persyaratan.PenerimaHibah AS 'PenerimaHibah', Persyaratan.TanggalSuratHibah AS 'TanggalSuratHibah', Persyaratan.NomorSuratHibah AS 'NomorSuratHibah',
						Persyaratan.NomorAktaPPAT AS 'NomorAktaPPAT', Persyaratan.DilakukanDengan AS 'DilakukanDengan', Persyaratan.PembelianDari AS 'PembelianDari', Persyaratan.NomorPPATPembelian AS 'NomorPPATPembelian',
						Persyaratan.NamaPPATPembelian AS 'NamaPPATPembelian', Persyaratan.DijualKepada AS 'DijualKepada', Persyaratan.Cara AS 'Cara', Persyaratan.TanggalJualBeli AS 'TanggalJualBeli',
	   				Persyaratan.TempatLelang AS 'TempatLelang', Persyaratan.WaktuLelang AS 'WaktuLelang', Persyaratan.RisalahLelang AS 'RisalahLelang', Persyaratan.PutusanPemberianHak AS 'PutusanPemberianHak',
						Persyaratan.Persyaratan AS 'Persyaratan', Persyaratan.NomorSuratPemberianHak AS 'NomorSuratPemberianHak', Persyaratan.Pejabat AS 'Pejabat', Persyaratan.TanggalPutusan AS 'TanggalPutusan',
						Persyaratan.NamaPerwakafan AS 'NamaPewakafan', Persyaratan.TanggalWakaf AS 'TanggalWakaf', Persyaratan.AktaPengganti AS 'AktaPengganti', Persyaratan.NamaPPAIW AS 'NamaPPAIW',
						Persyaratan.NomorSuratWakaf AS 'NomorSuratWakaf',
						Persyaratan.BatasUtara AS 'BatasUtara', Persyaratan.BatasBarat AS 'BatasBarat', Persyaratan.BatasTimur AS 'BatasTimur', Persyaratan.BatasSelatan AS 'BatasSelatan'
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

		if ($DataFP[0]['JenisPersyaratan'] == 1) {
			$StatusJenis = 'Warisan';
		} elseif ($DataFP[0]['JenisPersyaratan'] == 2) {
			$StatusJenis = 'Hibah';
		} elseif ($DataFP[0]['JenisPersyaratan'] == 3) {
			$StatusJenis = 'Pembelian';
		} elseif ($DataFP[0]['JenisPersyaratan'] == 4) {
			$StatusJenis = 'Pelelangan';
		} elseif ($DataFP[0]['JenisPersyaratan'] == 5) {
			$StatusJenis = 'Pemberian Hak';
		} elseif ($DataFP[0]['JenisPersyaratan'] == 6) {
			$StatusJenis = 'Wakaf';
		}
	}
	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
		<div class="panel-heading">
			<h3 class="panel-title">Informasi Jenis Persyaratan</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-6">
				<div class="form-group">
					<label for="focusedinput" class="col-sm-4 control-label">Jenis Persyaratan</label>
					<div class="col-sm-3">
						<input type="text" name="JenisPersyaratan" readonly class="form-control" value = '<?php echo $StatusJenis; ?>'required id="JenisPersyaratan" style="color:black; background-color:white;">
					</div>
				</div>
				<div class="form-group">
					<label for="focusedinput" class="col-sm-4 control-label">Batas Utara</label>
					<div class="col-sm-3">
						<input type="text" name="BatasUtara" value="<?php echo $DataFP[0]['BatasUtara']; ?>" class="form-control" required id="BatasUtara">
					</div>
				</div>
				<div class="form-group">
					<label for="focusedinput" class="col-sm-4 control-label">Batas Barat</label>
					<div class="col-sm-3">
						<input type="text" name="BatasBarat" value="<?php echo $DataFP[0]['BatasBarat']; ?>" class="form-control" required id="BatasBarat">
					</div>
				</div>
			</div>
			<div class="col-md-6"><br><br><br>
				<div class="form-group">
					<label for="focusedinput" class="col-sm-4 control-label">Batas Selatan</label>
					<div class="col-sm-3">
						<input type="text" name="BatasSelatan" value="<?php echo $DataFP[0]['BatasSelatan']; ?>" class="form-control" required id="BatasSelatan">
					</div>
				</div>
				<div class="form-group">
					<label for="focusedinput" class="col-sm-4 control-label">Batas Timur</label>
					<div class="col-sm-3">
						<input type="text" value="<?php echo $DataFP[0]['BatasTimur']; ?>" name="BatasTimur" class="form-control" required id="BatasTimur">
					</div>
				</div>
			</div>
			<div class="col-md-12" id="DivJenisPersyaratan">
				<?php
				if ($DataFP[0]['JenisPersyaratan'] == 1) {
				?>

				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nama Pewaris</label>
						<div class="col-sm-6">
							<input type="text"  name="NamaPewaris" value="<?php echo $DataFP[0]['NamaPewaris']; ?>" class="form-control" required id="NamaPewaris" value="" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Tahun Meninggal</label>
						<div class="col-sm-2">
							<input type="text"  name="TanggalMeninggal" value="<?php echo $DataFP[0]['TanggalMeninggal']; ?>" class="form-control" required id="TanggalMeninggal" value="" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Tanggal Surat Keterangan Waris</label>
						<div class="col-sm-4">
							<input type="date"  name="TanggalKeteranganWaris" value="<?php echo $DataFP[0]['TanggalKeteranganWaris']; ?>" class="form-control" required id="TanggalKeteranganWaris" value="" style="background:white; color:black;">
						</div>
					</div>
				</div>
				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Desa / Kecamatan</label>
						<div class="col-sm-4">
							<input type="text"  value="<?php echo $DataFP[0]['DesaKecamatan']; ?>" name="DesaKecamatan" class="form-control" required id="DesaKecamatan" style="background:white; color:black;">
						</div>
					</div>
				</div>

				<?php } else if ($DataFP[0]['JenisPersyaratan'] == 2) {?>

				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nomor Akta PPAT / APHB</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['NomorAktaPPAT']; ?>" name="NomorAktaPPAT" class="form-control" required id="NomorAktaPPAT" value="" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nama PPAT / APHB</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['NamaPPAT']; ?>" name="NamaPPAT" class="form-control" required id="NamaPPAT" value="" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Penerima Hibah</label>
						<div class="col-sm-4">
							<input type="text"  value="<?php echo $DataFP[0]['PenerimaHibah']; ?>" name="PenerimaHibah" class="form-control" required id="PenerimaHibah" value="" style="background:white; color:black;">
						</div>
					</div>
				</div>
				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Hibah</label>
						<div class="col-sm-3">
							<input type="text"  value="<?php echo $DataFP[0]['NomorSuratHibah']; ?>" name="NomorSuratHibah" class="form-control" required id="NomorSuratHibah" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Tanggal Surat Hibah</label>
						<div class="col-sm-4">
							<input type="date"  value="<?php echo $DataFP[0]['TanggalSuratHibah']; ?>" name="TanggalSuratHibah" class="form-control" required id="TanggalSuratHibah" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Dilakukan Dengan</label>
						<div class="col-sm-6">
							<select class="form-control select" name="DilakukanDengan" required id="DilakukanDengan" data-live-search="true">
								<?php if ($DataFP[0]['DilakukanDengan'] == 1) { ?>
									<option value="1" selected>Hibah</option>
							  <?php } else { ?>
									<option value="1">Hibah</option>
							  <?php } ?>

								<?php if ($DataFP[0]['DilakukanDengan'] == 2) { ?>
									<option value="2" selected>Akta Pembagian Hak Bersama Surat Dibawah Tangan</option>
							  <?php } else { ?>
									<option value="2">Akta Pembagian Hak Bersama Surat Dibawah Tangan</option>
							  <?php } ?>

								<?php if ($DataFP[0]['DilakukanDengan'] == 3) { ?>
									<option value="3" selected>Akta PPAT</option>
							  <?php } else { ?>
									<option value="3">Akta PPAT</option>
							  <?php } ?>

								<?php if ($DataFP[0]['DilakukanDengan'] == 4) { ?>
									<option value="4" selected>Lisan</option>
							  <?php } else { ?>
									<option value="4">Lisan</option>
							  <?php } ?>

							</select>
						</div>
					</div>
				</div>

				<?php } else if ($DataFP[0]['JenisPersyaratan'] == 3) {?>

				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nomor PPAT</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['NomorPPATPembelian']; ?>" name="NomorPPATPembelian" class="form-control" required id="NomorPPATPembelian" value="" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nama PPAT</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['NamaPPATPembelian']; ?>" name="NamaPPATPembelian" class="form-control" required id="NamaPPATPembelian" value="" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Cara</label>
						<div class="col-sm-4">
							<select class="form-control select" name="Cara" required id="Cara" data-live-search="true">
								<?php if ($DataFP[0]['Cara'] == 1) { ?>
									<option value="1" selected>Jual Beli</option>
							  <?php } else { ?>
									<option value="1">Jual Beli</option>
							  <?php } ?>

								<?php if ($DataFP[0]['Cara'] == 2) { ?>
									<option value="2" selected>Surat Di Tangan</option>
							  <?php } else { ?>
									<option value="2">Surat Di Tangan</option>
							  <?php } ?>

								<?php if ($DataFP[0]['Cara'] == 3) { ?>
									<option value="3" selected>Kwitansi</option>
							  <?php } else { ?>
									<option value="3">Kwitansi</option>
							  <?php } ?>

								<?php if ($DataFP[0]['Cara'] == 4) { ?>
									<option value="4" selected>Akta PPAT</option>
							  <?php } else { ?>
									<option value="4">Akta PPAT</option>
							  <?php } ?>

								<?php if ($DataFP[0]['Cara'] == 5) { ?>
									<option value="5" selected>Lisan</option>
							  <?php } else { ?>
									<option value="5">Lisan</option>
							  <?php } ?>

							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Tanggal Jual Beli</label>
						<div class="col-sm-3">
							<input type="date"  value="<?php echo $DataFP[0]['TanggalJualBeli']; ?>" name="TanggalJualBeli" class="form-control" required id="TanggalJualBeli" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Pembelian Dari</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['PembelianDari']; ?>" name="PembelianDari" class="form-control" required id="PembelianDari" value="" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Dijual Kepada</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['DijualKepada']; ?>" name="DijualKepada" class="form-control" required id="DijualKepada" value="" style="background:white; color:black;">
						</div>
					</div>
				</div>

				<?php } else if ($DataFP[0]['JenisPersyaratan'] == 4) {?>

				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Tempat Lelang</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['TempatLelang']; ?>" name="TempatLelang" class="form-control" required id="TempatLelang" value="" style="background:white; color:black;">
						</div>
					</div>
				</div>
				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Waktu Lelang</label>
						<div class="col-sm-3">
							<input type="date"  value="<?php echo $DataFP[0]['WaktuLelang']; ?>" name="WaktuLelang" class="form-control" required id="WaktuLelang" style="background:white; color:black;">
						</div>
					</div>
				</div>
				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Risalah Lelang</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['RisalahLelang']; ?>" name="RisalahLelang" class="form-control" required id="RisalahLelang" value="" style="background:white; color:black;">
						</div>
					</div>
				</div>

				<?php } else if ($DataFP[0]['JenisPersyaratan'] == 5) {?>

				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Putusan Pemberian Hak</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['PutusanPemberianHak']; ?>" name="PutusanPemberianHak" class="form-control" required id="PutusanPemberianHak" value="" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Persyaratan</label>
						<div class="col-sm-3">
							<select class="form-control select" name="Persyaratan" required id="Persyaratan" data-live-search="true">
								<?php if ($DataFP[0]['Persyaratan'] == 1) { ?>
									<option value="1" selected>Telah Dipenuhi</option>
								<?php } else { ?>
									<option value="1">Telah Dipenuhi</option>
								<?php } ?>

								<?php if ($DataFP[0]['Persyaratan'] == 2) { ?>
									<option value="2" selected>Belum Dipenuhi</option>
								<?php } else { ?>
									<option value="2">Belum Dipenuhi</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Pejabat</label>
						<div class="col-sm-4">
							<input type="text" value="<?php echo $DataFP[0]['Pejabat']; ?>" name="Pejabat" class="form-control" required id="Pejabat" value="" style="background:white; color:black;">
						</div>
					</div>
				</div>
				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Pemberian Hak</label>
						<div class="col-sm-4">
							<input type="text"  value="<?php echo $DataFP[0]['NomorSuratPemberianHak']; ?>" name="NomorSuratPemberianHak" class="form-control" required id="NomorSuratPemberianHak" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Tanggal Putusan</label>
						<div class="col-sm-3">
							<input type="date"  value="<?php echo $DataFP[0]['TanggalPutusan']; ?>" name="TanggalPutusan" class="form-control" required id="TanggalPutusan" style="background:white; color:black;">
						</div>
					</div>
				</div>

				<?php } else if ($DataFP[0]['JenisPersyaratan'] == 6) {?>

				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nama Pewakafan</label>
						<div class="col-sm-6">
							<input type="text"  value="<?php echo $DataFP[0]['NamaPewakafan']; ?>" name="NamaPerwakafan" class="form-control" required id="NamaPerwakafan" value="" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Tanggal Wakaf</label>
						<div class="col-sm-3">
							<input type="date"  value="<?php echo $DataFP[0]['TanggalWakaf']; ?>" name="TanggalWakaf" class="form-control" required id="TanggalWakaf" style="background:white; color:black;">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Akta Pengganti</label>
						<div class="col-sm-4">
							<input type="text"  value="<?php echo $DataFP[0]['AktaPengganti']; ?>" name="AktaPengganti" class="form-control" required id="AktaPengganti" value="" style="background:white; color:black;">
						</div>
					</div>
				</div>
				<div class="col-md-6"><br><br>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Wakaf</label>
						<div class="col-sm-3">
							<input type="text"  value="<?php echo $DataFP[0]['NomorSuratWakaf']; ?>" name="NomorSuratWakaf" class="form-control" required id="NomorSuratWakaf" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
						</div>
					</div>
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Nama PPAIW</label>
						<div class="col-sm-4">
							<input type="text"  value="<?php echo $DataFP[0]['NamaPPAIW']; ?>" name="NamaPPAIW" class="form-control" required id="NamaPPAIW" style="background:white; color:black;">
						</div>
					</div>
				</div>

				<?php } ?>
			</div>
	</div>
	<div class="panel-body">
		<!-- <div class="col-md-12">
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
			</div> -->
	</div>
</div>
<?php } ?>
