<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT BeritaAcara.Nomor AS 'Nomor', BeritaAcara.NomorBeritaAcara AS 'NomorBeritaAcara',
						BeritaAcara.Tanggal AS 'Tanggal', BeritaAcara.IDKaryawan AS 'IDKaryawan', BeritaAcara.PenjelasanPengesahan AS 'PenjelasanPengesahan',
						BeritaAcara.Sanggahan AS 'Sanggahan', BeritaAcara.Nomor AS 'File', BeritaAcara.Status AS 'StatusBeritaAcara',
						BeritaAcara.IsActive AS 'Status',
						BeritaAcara.IDKaryawanVerifikasi AS 'IDKaryawanVerifikasi', BeritaAcara.IDFormulirPermohonan AS 'IDFormulirPermohonan'
						FROM BeritaAcara
						WHERE BeritaAcara.IDFormulirPermohonan = '$IDFP'";

	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	if (!empty($DataFP)) {
		if ($DataFP[0]['StatusBeritaAcara'] == 1) {
			$StatusBP = 'Permohonan Verifikasi';
		} else {
			$StatusBP = 'Telah Diverifikasi';
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
	}
	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
		<div class="panel-heading">
			<h3 class="panel-title">Informasi Berita Acara</h3>
		</div>

			<div class="panel-body">
				<div class="col-md-6">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Nomor Berita Acara</label>
							<div class="col-sm-2">
								<input type="text" name="NomorBeritaAcara" value="<?php echo $DataFP[0]['NomorBeritaAcara']; ?>" readonly class="form-control" required id="NomorBeritaAcara" style="background:white; color:black;">
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
							<div class="col-sm-3">
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
							<label for="focusedinput" class="col-sm-4 control-label">Penjelasan Pengesahan</label>
							<div class="col-sm-3">
								<input type="text" name="PenjelasanPengesahan" value="<?php echo $DataFP[0]['PenjelasanPengesahan']; ?>" readonly class="form-control" required id="PenjelasanPengesahan" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

					</div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">File Berita Acara</label>
								<?php
											echo '<div class="col-sm-2">';
											echo '<a href="foto/BeritaAcara/'.$DataFP[0]['File'].'"><img src="foto/BeritaAcara/'.$DataFP[0]['File'].'.jpg" alt="" style="border-radius:10px;"></a>';
											echo '</div>';
								?>
						</div>
					</div>
			</div>
</div>

<div class="">
	<div class="col-md-5">
	</div>
	<div class="col-md-4">
		<input type="submit" value="Verifikasi Berita Acara" class="btn btn-success"><br><br>
	</div>
</div>
<?php } ?>
