<?php
if(isset($_GET['IDJP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);
	$IDJP = $MySQLi->real_escape_string($_GET['IDJP']);
}
mysqli_close($MySQLi);
if ($IDJP == 1) {
?>

<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nama Pewaris</label>
		<div class="col-sm-6">
			<input type="text"  name="NamaPewaris" class="form-control" required id="NamaPewaris" value="" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Tahun Meninggal</label>
		<div class="col-sm-2">
			<input type="text"  name="TanggalMeninggal" class="form-control" required id="TanggalMeninggal" value="" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Tanggal Surat Keterangan Waris</label>
		<div class="col-sm-4">
			<input type="date"  name="TanggalKeteranganWaris" class="form-control" required id="TanggalKeteranganWaris" value="" style="background:white; color:black;">
		</div>
	</div>
</div>
<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Desa / Kecamatan</label>
		<div class="col-sm-4">
			<input type="text"  value="" name="DesaKecamatan" class="form-control" required id="DesaKecamatan" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Surat Wasiat</label>
		<div class="col-sm-6">
			<input type="file" name="SuratWasiat" id="SuratWasiat" class="file" data-preview-file-type="any"/>
		</div>
	</div>
	<!-- <div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Status Surat Wasiat</label>
		<div class="col-sm-2">
			<select class="form-control select" name="StatusSuratWasiat" required id="StatusSuratWasiat" data-live-search="true">
				<option value="1">Ada</option>
				<option value="2">Tidak Ada</option>
			</select>
		</div>
	</div> -->
</div>

<?php } else if ($IDJP == 2) {?>

<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nomor Akta PPAT / APHB</label>
		<div class="col-sm-6">
			<input type="text"  name="NomorAktaPPAT" class="form-control" required id="NomorAktaPPAT" value="" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nama PPAT / APHB</label>
		<div class="col-sm-6">
			<input type="text"  name="NamaPPAT" class="form-control" required id="NamaPPAT" value="" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Penerima Hibah</label>
		<div class="col-sm-4">
			<input type="text"  name="PenerimaHibah" class="form-control" required id="PenerimaHibah" value="" style="background:white; color:black;">
		</div>
	</div>
</div>
<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Hibah</label>
		<div class="col-sm-3">
			<input type="text"  value="" name="NomorSuratHibah" class="form-control" required id="NomorSuratHibah" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Tanggal Surat Hibah</label>
		<div class="col-sm-4">
			<input type="date"  value="" name="TanggalSuratHibah" class="form-control" required id="TanggalSuratHibah" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Dilakukan Dengan</label>
		<div class="col-sm-6">
			<select class="form-control select" name="DilakukanDengan" required id="DilakukanDengan" data-live-search="true">
				<option value="1">Hibah</option>
				<option value="2">Akta Pembagian Hak Bersama Surat Dibawah Tangan</option>
				<option value="3">Akta PPAT</option>
				<option value="4">Lisan</option>
			</select>
		</div>
	</div>
</div>

<?php } else if ($IDJP == 3) {?>

<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nomor PPAT</label>
		<div class="col-sm-6">
			<input type="text"  name="NomorPPATPembelian" class="form-control" required id="NomorPPATPembelian" value="" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nama PPAT</label>
		<div class="col-sm-6">
			<input type="text"  name="NamaPPATPembelian" class="form-control" required id="NamaPPATPembelian" value="" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Cara</label>
		<div class="col-sm-4">
			<select class="form-control select" name="Cara" required id="Cara" data-live-search="true">
				<option value="1">Jual Beli</option>
				<option value="2">Surat Di Tangan</option>
				<option value="3">Kwitansi</option>
				<option value="4">Akta PPAT</option>
				<option value="5">Lisan</option>
			</select>
		</div>
	</div>
</div>
<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Tanggal Jual Beli</label>
		<div class="col-sm-3">
			<input type="date"  value="" name="TanggalJualBeli" class="form-control" required id="TanggalJualBeli" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Pembelian Dari</label>
		<div class="col-sm-6">
			<input type="text"  name="PembelianDari" class="form-control" required id="PembelianDari" value="" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Dijual Kepada</label>
		<div class="col-sm-6">
			<input type="text"  name="DijualKepada" class="form-control" required id="DijualKepada" value="" style="background:white; color:black;">
		</div>
	</div>
</div>

<?php } else if ($IDJP == 4) {?>

<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Tempat Lelang</label>
		<div class="col-sm-6">
			<input type="text"  name="TempatLelang" class="form-control" required id="TempatLelang" value="" style="background:white; color:black;">
		</div>
	</div>
</div>
<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Waktu Lelang</label>
		<div class="col-sm-3">
			<input type="date"  value="" name="WaktuLelang" class="form-control" required id="WaktuLelang" style="background:white; color:black;">
		</div>
	</div>
</div>
<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Risalah Lelang</label>
		<div class="col-sm-6">
			<input type="text"  name="RisalahLelang" class="form-control" required id="RisalahLelang" value="" style="background:white; color:black;">
		</div>
	</div>
</div>

<?php } else if ($IDJP == 5) {?>

<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Putusan Pemberian Hak</label>
		<div class="col-sm-6">
			<input type="text"  name="PutusanPemberianHak" class="form-control" required id="PutusanPemberianHak" value="" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Persyaratan</label>
		<div class="col-sm-3">
			<select class="form-control select" name="Persyaratan" required id="Persyaratan" data-live-search="true">
				<option value="1">Telah Dipenuhi</option>
				<option value="2">Belum Dipenuhi</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Pejabat</label>
		<div class="col-sm-4">
			<input type="text"  name="Pejabat" class="form-control" required id="Pejabat" value="" style="background:white; color:black;">
		</div>
	</div>
</div>
<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Pemberian Hak</label>
		<div class="col-sm-4">
			<input type="text"  value="" name="NomorSuratPemberianHak" class="form-control" required id="NomorSuratPemberianHak" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Tanggal Putusan</label>
		<div class="col-sm-3">
			<input type="date"  value="" name="TanggalPutusan" class="form-control" required id="TanggalPutusan" style="background:white; color:black;">
		</div>
	</div>
</div>

<?php } else if ($IDJP == 6) {?>

<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nama Pewakafan</label>
		<div class="col-sm-6">
			<input type="text"  name="NamaPerwakafan" class="form-control" required id="NamaPerwakafan" value="" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Tanggal Wakaf</label>
		<div class="col-sm-3">
			<input type="date"  value="" name="TanggalWakaf" class="form-control" required id="TanggalWakaf" style="background:white; color:black;">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Akta Pengganti</label>
		<div class="col-sm-4">
			<input type="text"  name="AktaPengganti" class="form-control" required id="AktaPengganti" value="" style="background:white; color:black;">
		</div>
	</div>
</div>
<div class="col-md-6"><br><br>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Wakaf</label>
		<div class="col-sm-3">
			<input type="text"  value="" name="NomorSuratWakaf" class="form-control" required id="NomorSuratWakaf" style="background:white; color:black;" onkeypress="return isNumberKey(event)">
		</div>
	</div>
	<div class="form-group">
		<label for="focusedinput" class="col-sm-4 control-label">Nama PPAIW</label>
		<div class="col-sm-4">
			<input type="text"  value="" name="NamaPPAIW" class="form-control" required id="NamaPPAIW" style="background:white; color:black;">
		</div>
	</div>
</div>

<?php } ?>
