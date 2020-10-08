<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
						FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
						Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC', GambarUkur.Sanggahan AS 'Sanggahan',
						Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
						Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP', GambarUkur.Nomor AS NomorGambarUkur,
						GambarUkur.NomorSuratTugasUkur AS NomorSuratTugasUkur, GambarUkur.NomorPetaPendaftaran AS NomorPetaPendaftaran, GambarUkur.Tanggal AS Tanggal,
						GambarUkur.TanggalPemetaan AS TanggalPemetaan, GambarUkur.TanggalUkur AS TanggalUkur,
						GambarUkur.PetaGrafikal AS PetaGrafikal, GambarUkur.Status AS StatusGambarUkur, GambarUkur.IDKaryawan AS IDKaryawan, GambarUkur.IDKaryawanPemetaan AS IDKaryawanPemetaan
						FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
						ON (Persyaratan.ID = FPXP.IDPersyaratan) INNER JOIN BerkasPermohonan ON (BerkasPermohonan.IDPersyaratan = Persyaratan.ID)
						INNER JOIN GambarUkur ON (GambarUkur.Nomor = BerkasPermohonan.NomorGambarUkur) WHERE FormulirPermohonan.ID = '$IDFP'";

	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	if (!empty($DataFP)) {
		$IDGambarUkur = $DataFP[0]['NomorGambarUkur'];
		$QueryGetDataGU = "SELECT KaryawanXGambarUkur.IDKaryawan AS IDKaryawan
							FROM KaryawanXGambarUkur WHERE KaryawanXGambarUkur.NomorGambarUkur = '$IDGambarUkur'";

		$HasilQueryDataGU = mysqli_query($MySQLi, $QueryGetDataGU);
		$DataGU = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryDataGU))
		{
			$DataGU[] = $Hasil;
		}

		$IDKaryawanPemetaan = $DataFP[0]['IDKaryawanPemetaan'];
		$QueryGetDataPemetaan = "SELECT Karyawan.Nama AS NamaKaryawan
							FROM Karyawan WHERE Karyawan.ID = '$IDKaryawanPemetaan'";

		$HasilQueryDataPemetaan = mysqli_query($MySQLi, $QueryGetDataPemetaan);
		$DataPemetaan = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryDataPemetaan))
		{
			$DataPemetaan[] = $Hasil;
		}

		$IDKaryawan = $DataFP[0]['IDKaryawan'];
		$QueryGetDataPengukurSatu = "SELECT Karyawan.Nama AS NamaKaryawan
							FROM Karyawan WHERE Karyawan.ID = '$IDKaryawan'";

		$HasilQueryDataPengukurSatu = mysqli_query($MySQLi, $QueryGetDataPengukurSatu);
		$DataPengukurSatu = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryDataPengukurSatu))
		{
			$DataPengukur[] = $Hasil;
		}

		$QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
														 Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, users.name AS Username, users.password AS Password, Karyawan.Jabatan AS Jabatan,
														 Karyawan.IDDaerah AS IDDaerah, users.email AS Email, Daerah.Nama AS NamaDaerah
														 FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah WHERE Karyawan.Jabatan = '4'";
		$HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
		$DataKaryawan = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
			$DataKaryawan[] = $Hasil;
		}
	}
	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Gambar Ukur</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nomor Gambar Ukur</label>
				<div class="col-sm-3">
					<input type="text" name="IDGambarUkur" readonly value="<?php echo $IDGambarUkur; ?>" class="form-control" required id="IDGambarUkur" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat  Tugas Ukur</label>
				<div class="col-sm-2">
					<input type="text" name="NomorSuratTugasUkur" readonly value="<?php echo $DataFP[0]['NomorSuratTugasUkur']; ?>" class="form-control" required id="NomorSuratTugasUkur" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nomor Peta Pendaftaran</label>
				<div class="col-sm-3">
					<input type="text" name="NomorPetaPendaftaran" readonly value="<?php echo $DataFP[0]['NomorPetaPendaftaran']; ?>" onkeypress="return isNumberKey(event)" class="form-control" required id="NomorPetaPendaftaran" style="background:white; color:black;">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Tanggal Pengukuran</label>
				<div class="col-sm-3">
					<input type="date" name="Tanggal" readonly value="<?php echo $DataFP[0]['Tanggal']; ?>" class="form-control" required id="Tanggal" style="background:white; color:black;">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Sanggahan</label>
				<div class="col-sm-7">
					<input type="text" name="Sanggahan" readonly value="<?php echo $DataFP[0]['Sanggahan']; ?>" class="form-control" required id="Sanggahan" style="background:white; color:black;">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Peta Grafikal</label>
				<div class="col-sm-7">
					<input type="text" name="PetaGrafikal" readonly value="<?php echo $DataFP[0]['PetaGrafikal']; ?>" class="form-control" required id="PetaGrafikal" style="background:white; color:black;">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Petugas Pemetaan</label>
				<div class="col-sm-5">
					<select name="IDKaryawanPemetaan" required readonly class="form-control select" data-live-search="true" style="background:white; color:black;">
						<?php foreach ($DataKaryawan as $Karyawan) {
							if ($Karyawan['ID'] == $IDKaryawanPemetaan) {
								echo '<option selected value="'.$Karyawan['ID'].'">'.$Karyawan['Nama'].'</option>';
							} else {
								echo '<option value="'.$Karyawan['ID'].'">'.$Karyawan['Nama'].'</option>';
							}
						} ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Tanggal Pemetaan</label>
				<div class="col-sm-3">
					<input type="date" name="TanggalPemetaan" readonly value="<?php echo $DataFP[0]['TanggalPemetaan']; ?>" class="form-control" required id="TanggalPemetaan" style="background:white; color:black;">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Petugas Ukur</label>
				<div class="col-sm-5">
					<select name="IDKaryawan" required readonly class="form-control select" data-live-search="true" style="background:white; color:black;">
						<?php foreach ($DataKaryawan as $Karyawan) {
							if ($Karyawan['ID'] == $IDKaryawan) {
								 echo '<option selected value="'.$Karyawan['ID'].'">'.$Karyawan['Nama'].'</option>';
							 } else {
								 echo '<option value="'.$Karyawan['ID'].'">'.$Karyawan['Nama'].'</option>';
							 }
					 } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Tanggal Ukur</label>
				<div class="col-sm-3">
					<input type="date" name="TanggalUkur" readonly value="<?php echo $DataFP[0]['TanggalUkur']; ?>" class="form-control" required id="TanggalUkur" style="background:white; color:black;">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="">
	<div class="col-md-5">
	</div>
	<div class="col-md-4">
		<input type="submit" value="Validasi Gambar Ukur Berkas Permohonan" class="btn btn-success"><br><br>
	</div>
</div>
<?php } ?>
