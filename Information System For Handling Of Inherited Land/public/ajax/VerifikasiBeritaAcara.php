<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT SuratPengantar.Nomor AS 'Nomor', SuratPengantar.NomorSuratPengantar AS 'NomorSuratPengantar',
						SuratPengantar.Tanggal AS 'Tanggal', SuratPengantar.IDKaryawan AS 'IDKaryawan',
						SuratPengantar.Sanggahan AS 'Sanggahan', SuratPengantar.File AS 'File', SuratPengantar.Status AS 'StatusSuratPengantar',
						SuratPengantar.IDKepalaDesa AS 'IDKepalaDesa', SuratPengantar.IsActive AS 'Status',
						SuratPengantar.IDKaryawanVerifikasi AS 'IDKaryawanVerifikasi', SuratPengantar.IDFormulirPermohonan AS 'IDFormulirPermohonan'
						FROM SuratPengantar
						WHERE SuratPengantar.IDFormulirPermohonan = '$IDFP'";

	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	if (!empty($DataFP)) {
		if ($DataFP[0]['StatusSuratPengantar'] == 1) {
			$StatusBP = 'Menunggu Validasi Karyawan';
		} elseif ($DataFP[0]['StatusSuratPengantar'] == 2) {
			$StatusBP = 'Menunggu Validasi Kepala Desa';
		} elseif ($DataFP[0]['StatusSuratPengantar'] == 3) {
			$StatusBP = 'Ada Sanggahan Karyawan';
		} elseif ($DataFP[0]['StatusSuratPengantar'] == 4) {
			$StatusBP = 'Ada Sanggahan Kepala Desa';
		} else {
			$StatusBP = 'Terverifikasi Karyawan dan Kepala Desa';
		}

		if (!empty($DataFP[0]['IDKaryawan'])) {

			$ID = $DataFP[0]['IDKaryawan'];
			$QueryNama = "SELECT Karyawan.Nama AS 'Nama'
								FROM Karyawan
								WHERE Karyawan.ID = '$ID'";

			$HasilNama = mysqli_query($MySQLi, $QueryNama);
			$Nama = array();
			while($Hasil = mysqli_fetch_assoc($HasilNama))
			{
				$Nama[] = $Hasil;
			}

			$NamaPembuat = $Nama[0]['Nama'];
		} else {
			$NamaPembuat = '-';
		}

		if (!empty($DataFP[0]['IDKaryawanVerifikasi'])) {

			$ID = $DataFP[0]['IDKaryawanVerifikasi'];
			$QueryNama = "SELECT Karyawan.Nama AS 'Nama'
								FROM Karyawan
								WHERE Karyawan.ID = '$ID'";

			$HasilNama = mysqli_query($MySQLi, $QueryNama);
			$Nama = array();
			while($Hasil = mysqli_fetch_assoc($HasilNama))
			{
				$Nama[] = $Hasil;
			}

			$NamaKaryawanVerifikasi = $Nama[0]['Nama'];
		} else {
			$NamaKaryawanVerifikasi = '-';
		}

		if (!empty($DataFP[0]['IDKepalaDesa'])) {

			$ID = $DataFP[0]['IDKepalaDesa'];
			$QueryNama = "SELECT KepalaDesa.Nama AS 'Nama'
								FROM KepalaDesa
								WHERE KepalaDesa.ID = '$ID'";

			$HasilNama = mysqli_query($MySQLi, $QueryNama);
			$Nama = array();
			while($Hasil = mysqli_fetch_assoc($HasilNama))
			{
				$Nama[] = $Hasil;
			}

			$NamaKepalaDesa = $Nama[0]['Nama'];
		} else {
			$NamaKepalaDesa = '-';
		}
	}
	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
		<div class="panel-heading">
			<h3 class="panel-title">Informasi Surat Pengantar</h3>
		</div>

			<div class="panel-body">
				<div class="col-md-6">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Nomor Surat Pengantar</label>
							<div class="col-sm-3">
								<input type="text" name="NomorSuratPengantar" value="<?php echo $DataFP[0]['NomorSuratPengantar']; ?>" readonly class="form-control" required id="NomorSuratPengantar" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Tanggal</label>
							<div class="col-sm-3">
								<input type="text" name="Tanggal" value="<?php echo $DataFP[0]['Tanggal']; ?>" readonly class="form-control" required id="Tanggal" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Status</label>
							<div class="col-sm-5">
								<input type="text" name="Status" value="<?php echo $StatusBP; ?>" readonly class="form-control" required id="Status" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="focusedinput" class="col-sm-4 control-label">Pembuat</label>
						<div class="col-sm-6">
							<input type="text" name="IDKaryawan" value="<?php echo $NamaPembuat; ?>" readonly class="form-control" required id="IDKaryawan" style="background:white; color:black;">
						</div>
					</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Karyawan Verifikasi</label>
							<div class="col-sm-3">
								<input type="text" name="IDKaryawanSatu" value="<?php echo $NamaKaryawanVerifikasi; ?>" readonly class="form-control" required id="IDKaryawanSatu" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Kepala Desa</label>
							<div class="col-sm-3">
								<input type="text" name="IDKaryawanDua" value="<?php echo $NamaKepalaDesa; ?>" readonly class="form-control" required id="IDKaryawanDua" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

					</div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">File Surat Pengantar</label>
								<?php
											echo '<div class="col-sm-2">';
											echo '<a href="foto/SuratPengantar/'.$DataFP[0]['File'].'"><img src="foto/SuratPengantar/'.$DataFP[0]['File'].'" alt="" style="border-radius:10px;"></a>';
											echo '</div>';
								?>
						</div>
					</div>
			</div>
</div>
<?php } ?>
