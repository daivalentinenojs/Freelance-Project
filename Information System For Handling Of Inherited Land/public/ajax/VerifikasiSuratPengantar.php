<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT BerkasPengumuman.NomorFisik AS 'NomorFisik', BerkasPengumuman.NomorBerkasPengumuman AS 'NomorBerkasPengumuman',
						BerkasPengumuman.NomorBidang AS 'NomorBidang', BerkasPengumuman.Tanggal AS 'Tanggal',
						BerkasPengumuman.Sanggahan AS 'Sanggahan', BerkasPengumuman.File AS 'File', BerkasPengumuman.Status AS 'StatusBerkasPengumuman',
						BerkasPengumuman.IDFormulirPermohonan AS 'IDFormulirPermohonan', BerkasPengumuman.IsActive AS 'Status',
						BerkasPengumuman.IDKaryawan AS 'IDKaryawan', BerkasPengumuman.IDKaryawanSatu AS 'IDKaryawanSatu',
						BerkasPengumuman.IDKaryawanDua AS 'IDKaryawanDua', BerkasPengumuman.IDKaryawanTiga AS 'IDKaryawanTiga'
						FROM BerkasPengumuman
						WHERE BerkasPengumuman.IDFormulirPermohonan = '$IDFP'";

	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	if (!empty($DataFP)) {
		if ($DataFP[0]['StatusBerkasPengumuman'] == 1) {
			$StatusBP = 'Pengajuan';
		} elseif ($DataFP[0]['StatusBerkasPengumuman'] == 2) {
			$StatusBP = 'Validasi 1';
		} elseif ($DataFP[0]['StatusBerkasPengumuman'] == 3) {
			$StatusBP = 'Validasi 2';
		} else {
			$StatusBP = 'Validasi 3';
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

		if (!empty($DataFP[0]['IDKaryawanSatu'])) {

			$ID = $DataFP[0]['IDKaryawanSatu'];
			$QueryNama = "SELECT Karyawan.Nama AS 'Nama'
								FROM Karyawan
								WHERE Karyawan.ID = '$ID'";

			$HasilNama = mysqli_query($MySQLi, $QueryNama);
			$Nama = array();
			while($Hasil = mysqli_fetch_assoc($HasilNama))
			{
				$Nama[] = $Hasil;
			}

			$NamaKaryawanSatu = $Nama[0]['Nama'];
		} else {
			$NamaKaryawanSatu = '-';
		}

		if (!empty($DataFP[0]['IDKaryawanDua'])) {

			$ID = $DataFP[0]['IDKaryawanDua'];
			$QueryNama = "SELECT Karyawan.Nama AS 'Nama'
								FROM Karyawan
								WHERE Karyawan.ID = '$ID'";

			$HasilNama = mysqli_query($MySQLi, $QueryNama);
			$Nama = array();
			while($Hasil = mysqli_fetch_assoc($HasilNama))
			{
				$Nama[] = $Hasil;
			}

			$NamaKaryawanDua = $Nama[0]['Nama'];
		} else {
			$NamaKaryawanDua = '-';
		}

		if (!empty($DataFP[0]['IDKaryawanTiga'])) {

			$ID = $DataFP[0]['IDKaryawanTiga'];
			$QueryNama = "SELECT Karyawan.Nama AS 'Nama'
								FROM Karyawan
								WHERE Karyawan.ID = '$ID'";

			$HasilNama = mysqli_query($MySQLi, $QueryNama);
			$Nama = array();
			while($Hasil = mysqli_fetch_assoc($HasilNama))
			{
				$Nama[] = $Hasil;
			}

			$NamaKaryawanTiga = $Nama[0]['Nama'];
		} else {
			$NamaKaryawanTiga = '-';
		}
	}
	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
		<div class="panel-heading">
			<h3 class="panel-title">Informasi Berkas Pengumuman</h3>
		</div>

			<div class="panel-body">
				<div class="col-md-6">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Nomor Fisik</label>
							<div class="col-sm-2">
								<input type="text" name="NomorBerkasPengumuman" value="<?php echo $DataFP[0]['NomorBerkasPengumuman']; ?>" readonly class="form-control" required id="NomorBerkasPengumuman" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Nomor Bidang</label>
							<div class="col-sm-3">
								<input type="text" name="NomorBidang" value="<?php echo $DataFP[0]['NomorBidang']; ?>" readonly class="form-control" required id="NomorBidang" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
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
							<label for="focusedinput" class="col-sm-4 control-label">Verifikasi Satu</label>
							<div class="col-sm-3">
								<input type="text" name="IDKaryawanSatu" value="<?php echo $NamaKaryawanSatu; ?>" readonly class="form-control" required id="IDKaryawanSatu" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Verifikasi Dua</label>
							<div class="col-sm-3">
								<input type="text" name="IDKaryawanDua" value="<?php echo $NamaKaryawanDua; ?>" readonly class="form-control" required id="IDKaryawanDua" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>

						<div class="form-group">
							<label for="focusedinput" class="col-sm-4 control-label">Verifikasi Tiga</label>
							<div class="col-sm-3">
								<input type="text" name="IDKaryawanTiga" value="<?php echo $NamaKaryawanTiga; ?>" readonly class="form-control" required id="IDKaryawanTiga" onkeypress="return isNumberKey(event)" style="background:white; color:black;">
							</div>
						</div>
					</div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">File Bidang Tanah</label>
								<?php
											echo '<div class="col-sm-2">';
											echo '<a href="foto/BerkasPengumuman/'.$DataFP[0]['File'].'"><img src="foto/BerkasPengumuman/'.$DataFP[0]['File'].'" alt="" style="border-radius:10px;"></a>';
											echo '</div>';
								?>
						</div>
					</div>
			</div>
</div>
<?php } ?>
