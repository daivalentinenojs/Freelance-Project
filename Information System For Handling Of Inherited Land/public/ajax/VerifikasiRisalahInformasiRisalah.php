<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	if ($IDFP > 0) {
		$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', Pemohon.Nama AS 'NamaPemohon', Persyaratan.StatusTanah AS 'StatusTanah',
												Risalah.Nomor AS 'IDRisalah', Risalah.Nomor AS 'NomorRisalah', Risalah.Tanggal AS 'TanggalRisalah', Risalah.Sengketa AS 'SengketaRisalah', Risalah.StatusSengketa AS 'StatusSengketaRisalah',
												Risalah.Proses AS 'ProsesRisalah', Risalah.PenegasanKonversi AS 'PenegasanKonversi', Risalah.CatatanKeberatan AS 'CatatanKeberatan', Risalah.KeteranganSengketa AS 'KeteranganSengketa',
												Risalah.BebanAtasTanah AS 'BebanAtasTanah', Risalah.StatusAlatBukti AS 'StatusAlatBukti', Risalah.StatusPembebanan AS 'StatusPembebanan',
												Risalah.BangunanKepentingan AS 'BangunanKepentingan', Risalah.StatusTanah AS 'StatusTanah',
												Risalah.StatusBagunanAtasTanah AS 'StatusBagunanAtasTanah', Risalah.KeteranganBangunanAtasTanah AS 'KeteranganBangunanAtasTanah',
												Risalah.IDKepalaDesa AS 'IDKepalaDesa', Risalah.IDKenyataan AS 'IDKenyataan',
												Risalah.IDKesimpulanStatusTanah AS 'IDKesimpulanStatusTanah', Risalah.NomorBuktiPerpajakan AS 'NomorBuktiPerpajakan',
												Risalah.IDStatusTanah AS 'IDStatusTanah', Risalah.IDFormulirPermohonan AS 'IDFormulirPermohonan',
												Risalah.IDSanggahan AS 'IDSanggahan',

												Kenyataan.KeteranganTahun AS 'KeteranganTahun', Kenyataan.KeteranganCara AS 'KeteranganCara',
												Kenyataan.KeteranganAlih AS 'KeteranganAlih', Kenyataan.Jenis AS 'Jenis',

												BuktiPerpajakan.Nomor AS 'IDBuktiPerpajakan', BuktiPerpajakan.Tanggal AS 'TanggalBuktiPerpajakan', BuktiPerpajakan.UraianPatokD AS 'UraianPatokD',
												BuktiPerpajakan.UraianVerponding AS 'UraianVerponding', BuktiPerpajakan.UraianIPEDA AS 'UraianIPEDA',
												BuktiPerpajakan.UraianLain AS 'UraianLain', BuktiPerpajakan.Tahun AS 'TahunBuktiPerpajakan',

												StatusTanah.ID AS 'IDStatusTanah', StatusTanah.Nama AS 'NamaStatusTanah', StatusTanah.Uraian AS 'UraianStatusTanah',

												KesimpulanStatusTanah.ID AS 'IDKesimpulanStatusTanah', KesimpulanStatusTanah.Nama AS 'NamaKesimpulanStatusTanah', KesimpulanStatusTanah.Uraian AS 'UraianKesimpulanStatusTanah',
												KesimpulanStatusTanah.Jenis AS 'JenisKesimpulanStatusTanah', KesimpulanStatusTanah.Usulan AS 'UsulanKesimpulanStatusTanah',
												KesimpulanStatusTanah.NamaPenempat AS 'NamaPenempat',

												Sanggahan.ID AS 'Sanggahan.ID', Sanggahan.AlasanPenyanggah AS 'AlasanPenyanggah', Sanggahan.SengketaDengan AS 'SengketaDengan', Sanggahan.AdaSanggahan AS 'AdaSanggahan',
												Sanggahan.NamaPenyanggah AS 'NamaPenyanggah', Sanggahan.AlamatPenyanggah AS 'AlamatPenyanggah', Sanggahan.Penyelesaian AS 'Penyelesaian',

												Desa.Nama AS 'NamaDesa'

												FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
												INNER JOIN FPXP ON (FPXP.IDFormulirPermohonan = FormulirPermohonan.ID)
												INNER JOIN Persyaratan ON (FPXP.IDPersyaratan = Persyaratan.ID)
												INNER JOIN Risalah ON (Risalah.IDFormulirPermohonan = FormulirPermohonan.ID)
												INNER JOIN Kenyataan ON (Risalah.IDKenyataan = Kenyataan.ID)
												INNER JOIN BuktiPerpajakan ON (Risalah.NomorBuktiPerpajakan = BuktiPerpajakan.Nomor)
												INNER JOIN StatusTanah ON (Risalah.IDStatusTanah = StatusTanah.ID)
												INNER JOIN KesimpulanStatusTanah ON (Risalah.IDKesimpulanStatusTanah = KesimpulanStatusTanah.ID)
												LEFT JOIN Sanggahan ON (Risalah.IDSanggahan = Sanggahan.ID)
												INNER JOIN Desa ON (Pemohon.IDDesa = Desa.ID)
												INNER JOIN KepalaDesa ON (KepalaDesa.IDDesa = Desa.ID)
												WHERE FormulirPermohonan.ID = '$IDFP'";
		$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
		$DataFP = array();
		while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
		{
			$DataFP[] = $Hasil;
		}

		$StatusTanah = '';
		if ($DataFP[0]['StatusTanah'] == '1') {
				$StatusTanah = 'Hak Milik';
		} else if ($DataFP[0]['StatusTanah'] == '2') {
				$StatusTanah = 'Hak Guna Bangunan';
		} else {
				$StatusTanah = 'Hak Pakai';
		}

		$TanggalBuktiPerpajakan = $DataFP[0]['TanggalBuktiPerpajakan'];

		$QueryGetDataFPKD = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', KepalaDesa.ID AS 'IDKepalaDesa', KepalaDesa.Nama AS 'NamaKepalaDesa'
							FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
																			INNER JOIN Desa ON (Pemohon.IDDesa = Desa.ID)
																			INNER JOIN KepalaDesa ON (Desa.ID = KepalaDesa.IDDesa)
							WHERE FormulirPermohonan.ID = '$IDFP'";

		$HasilQueryDataFPKD = mysqli_query($MySQLi, $QueryGetDataFPKD);
		$DataFPKD = array();
		while($Hasils = mysqli_fetch_assoc($HasilQueryDataFPKD))
		{
			$DataFPKD[] = $Hasils;
		}
	}
  mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>

<div class="panel panel-success" id="grid_block_5">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Risalah</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<!-- <div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Tanggal Risalah</label>
				<div class="col-sm-3">
					<input type="date" name="TanggalRisalah" value="" class="form-control" required id="TanggalRisalah">
				</div>
			</div> -->
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Sengketa</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" type="hidden" readonly name="IDRisalah" value="<?php echo $DataFP[0]['IDRisalah']; ?>" class="form-control" id="IDRisalah">
					<input style="color:black; background-color:white;" type="text" readonly name="Sengketa" value="<?php echo $DataFP[0]['SengketaRisalah']; ?>" class="form-control" id="Sengketa">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Status Sengketa</label>
				<div class="col-sm-3">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="StatusSengketa" required id="StatusSengketa" data-live-search="true">
						<?php if ($DataFP[0]['ProsesRisalah'] == '1') { ?>
							<option value="1" selected>Sedang Dalam Sengketa</option>
							<option value="2">Tidak Ada Sengketa</option>
						<?php } elseif ($DataFP[0]['ProsesRisalah'] == '2') {?>
							<option value="1">Sedang Dalam Sengketa</option>
							<option value="2" selected>Tidak Ada Sengketa</option>
						<?php } ?>

					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Proses</label>
				<div class="col-sm-3">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="Proses" required id="Proses" data-live-search="true">
						<?php if ($DataFP[0]['ProsesRisalah'] == '1') { ?>
							<option value="1" selected>Diproses</option>
							<option value="2">Pemberian Hak</option>
						<?php } elseif ($DataFP[0]['ProsesRisalah'] == '2') {?>
							<option value="1">Diproses</option>
							<option value="2" selected>Pemberian Hak</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<!-- <div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Penegasan Konversi</label>
				<div class="col-sm-5">
					<input type="text" name="PenegasanKonversi" value="" class="form-control" required id="PenegasanKonversi">
				</div>
			</div> -->
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Catatan Keberatan</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="CatatanKeberatan" value="<?php echo $DataFP[0]['CatatanKeberatan']; ?>" class="form-control" required id="CatatanKeberatan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Keterangan Sengketa</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="KeteranganSengketa" value="<?php echo $DataFP[0]['KeteranganSengketa']; ?>" class="form-control" required id="KeteranganSengketa">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Beban Atas Tanah</label>
				<div class="col-sm-5">
					<input style="color:black; background-color:white;" readonly type="text" name="BebanAtasTanah" value="<?php echo $DataFP[0]['BebanAtasTanah']; ?>" class="form-control" required id="BebanAtasTanah">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Status Alat Bukti</label>
				<div class="col-sm-3">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="StatusAlatBukti" required id="StatusAlatBukti" data-live-search="true">
						<?php if ($DataFP[0]['StatusAlatBukti'] == '1') { ?>
							<option value="1" selected>Lengkap</option>
							<option value="2">Tidak Lengkap</option>
							<option value="3">Tidak Ada</option>
						<?php } elseif ($DataFP[0]['StatusAlatBukti'] == '2') {?>
							<option value="1">Lengkap</option>
							<option value="2" selected>Tidak Lengkap</option>
							<option value="3">Tidak Ada</option>
						<?php } elseif ($DataFP[0]['StatusAlatBukti'] == '3') {?>
							<option value="1">Lengkap</option>
							<option value="2">Tidak Lengkap</option>
							<option value="3" selected>Tidak Ada</option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Status Pembebanan</label>
				<div class="col-sm-3">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="StatusPembebanan" required id="StatusPembebanan" data-live-search="true">
						<?php if ($DataFP[0]['StatusPembebanan'] == '1') { ?>
							<option value="1" selected>Sedang Digunakan</option>
							<option value="2">Tidak Digunakan</option>
						<?php } elseif ($DataFP[0]['StatusPembebanan'] == '2') {?>
							<option value="1">Sedang Digunakan</option>
							<option value="2" selected>Tidak Digunakan</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Bangunan Kepentingan</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="BangunanKepentingan" value="<?php echo $DataFP[0]['BangunanKepentingan']; ?>" class="form-control" id="BangunanKepentingan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Status Tanah</label>
				<div class="col-sm-5">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="StatusTanah" required id="StatusTanah" data-live-search="true">
						<?php if ($DataFP[0]['StatusTanah'] == '1') { ?>
							<option value="1" selected>Tanah Dengan Hak Adat Perorangan</option>
							<option value="2">Tanah Bagi Kepentingan Umum</option>
							<option value="3">Lain - Lain</option>
						<?php } elseif ($DataFP[0]['StatusTanah'] == '2') {?>
							<option value="1">Tanah Dengan Hak Adat Perorangan</option>
							<option value="2" selected>Tanah Bagi Kepentingan Umum</option>
							<option value="3">Lain - Lain</option>
						<?php } elseif ($DataFP[0]['StatusTanah'] == '3') {?>
							<option value="1">Tanah Dengan Hak Adat Perorangan</option>
							<option value="2">Tanah Bagi Kepentingan Umum</option>
							<option value="3" selected>Lain - Lain</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Status Bagunan Atas Tanah</label>
				<div class="col-sm-3">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="StatusBagunanAtasTanah" required id="StatusBagunanAtasTanah" data-live-search="true">
						<?php if ($DataFP[0]['StatusBagunanAtasTanah'] == '1') { ?>
							<option value="1" selected>Rumah Hunian</option>
							<option value="2">Toko</option>
							<option value="3">Gudang</option>
							<option value="4">Pagar</option>
							<option value="5">Kantor</option>
							<option value="6">Rumah Ibadah</option>
							<option value="7">Bengkel</option>
							<option value="8">Tidak Ada Bangunan</option>
						<?php } elseif ($DataFP[0]['StatusBagunanAtasTanah'] == '2') {?>
							<option value="1">Rumah Hunian</option>
							<option value="2" selected>Toko</option>
							<option value="3">Gudang</option>
							<option value="4">Pagar</option>
							<option value="5">Kantor</option>
							<option value="6">Rumah Ibadah</option>
							<option value="7">Bengkel</option>
							<option value="8">Tidak Ada Bangunan</option>
						<?php } elseif ($DataFP[0]['StatusBagunanAtasTanah'] == '3') {?>
							<option value="1">Rumah Hunian</option>
							<option value="2">Toko</option>
							<option value="3" selected>Gudang</option>
							<option value="4">Pagar</option>
							<option value="5">Kantor</option>
							<option value="6">Rumah Ibadah</option>
							<option value="7">Bengkel</option>
							<option value="8">Tidak Ada Bangunan</option>
						<?php } elseif ($DataFP[0]['StatusBagunanAtasTanah'] == '4') {?>
							<option value="1">Rumah Hunian</option>
							<option value="2">Toko</option>
							<option value="3">Gudang</option>
							<option value="4" selected>Pagar</option>
							<option value="5">Kantor</option>
							<option value="6">Rumah Ibadah</option>
							<option value="7">Bengkel</option>
							<option value="8">Tidak Ada Bangunan</option>
						<?php } elseif ($DataFP[0]['StatusBagunanAtasTanah'] == '5') {?>
							<option value="1">Rumah Hunian</option>
							<option value="2">Toko</option>
							<option value="3">Gudang</option>
							<option value="4">Pagar</option>
							<option value="5" selected>Kantor</option>
							<option value="6">Rumah Ibadah</option>
							<option value="7">Bengkel</option>
							<option value="8">Tidak Ada Bangunan</option>
						<?php } elseif ($DataFP[0]['StatusBagunanAtasTanah'] == '6') {?>
							<option value="1">Rumah Hunian</option>
							<option value="2">Toko</option>
							<option value="3">Gudang</option>
							<option value="4">Pagar</option>
							<option value="5">Kantor</option>
							<option value="6" selected>Rumah Ibadah</option>
							<option value="7">Bengkel</option>
							<option value="8">Tidak Ada Bangunan</option>
						<?php } elseif ($DataFP[0]['StatusBagunanAtasTanah'] == '7') {?>
							<option value="1">Rumah Hunian</option>
							<option value="2">Toko</option>
							<option value="3">Gudang</option>
							<option value="4">Pagar</option>
							<option value="5">Kantor</option>
							<option value="6">Rumah Ibadah</option>
							<option value="7" selected>Bengkel</option>
							<option value="8">Tidak Ada Bangunan</option>
						<?php } elseif ($DataFP[0]['StatusBagunanAtasTanah'] == '8') {?>
							<option value="1">Rumah Hunian</option>
							<option value="2">Toko</option>
							<option value="3">Gudang</option>
							<option value="4">Pagar</option>
							<option value="5">Kantor</option>
							<option value="6">Rumah Ibadah</option>
							<option value="7">Bengkel</option>
							<option value="8" selected>Tidak Ada Bangunan</option>
						<?php } ?>

					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Keterangan Bangunan Atas Tanah</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="KeteranganBangunanAtasTanah" value="<?php echo $DataFP[0]['KeteranganBangunanAtasTanah']; ?>" class="form-control" id="KeteranganBangunanAtasTanah">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nama Kepala Desa</label>
				<div class="col-sm-5" id="DivIDKepalaDesa">
					<?php
					if (!empty($DataFPKD)) {
						echo '<input type="hidden" readonly style="background:white; color:black;" name="IDKepalaDesa" value="'.$DataFPKD[0]['IDKepalaDesa'].'" class="form-control" required id="IDKepalaDesa">';
						echo '<input type="text" readonly style="background:white; color:black;" name="NamaKepalaDesa" value="'.$DataFPKD[0]['NamaKepalaDesa'].'" class="form-control" required id="NamaKepalaDesa">';
					} else {
						echo '<input type="hidden" readonly style="background:white; color:black;" name="IDKepalaDesa" value="1" class="form-control" required id="IDKepalaDesa">';
						echo '<input type="text" readonly style="background:white; color:black;" name="NamaKepalaDesa" value="Belum Ada Kepala Desa Yang Terdaftar" class="form-control" required id="NamaKepalaDesa">';
					}
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nama Desa</label>
				<div class="col-sm-3">
					<input style="color:black; background-color:white;" readonly type="text" name="NamaDesa" value="<?php echo $DataFP[0]['NamaDesa']; ?>" class="form-control" id="NamaDesa">
				</div>
			</div>
			<!-- <div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">File Sengketa</label>
				<div class="col-sm-3">
					<input type="file" name="FotoSengketa" value="" class="form-control" id="FotoSengketa">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Sketsa Bidang</label>
				<div class="col-sm-3">
					<input type="file" name="SketsaBidang" value="" class="form-control" id="SketsaBidang">
				</div>
			</div> -->


			<!-- <div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">ID Kenyataan</label>
				<div class="col-sm-5">
					<input type="text" name="IDKenyataan" value="" class="form-control" required id="IDKenyataan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nomor Bukti Pemilikan</label>
				<div class="col-sm-5">
					<input type="text" name="NomorBuktiPemilikan" value="" class="form-control" required id="NomorBuktiPemilikan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">ID Kesimpulan Status Tanah</label>
				<div class="col-sm-5">
					<input type="text" name="IDKesimpulanStatusTanah" value="" class="form-control" required id="IDKesimpulanStatusTanah">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nomor Bukti Sanggahan</label>
				<div class="col-sm-3">
					<input type="text" name="NomorBuktiSanggahan" value="" class="form-control" required id="NomorBuktiSanggahan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nomor Bukti Perpajakan</label>
				<div class="col-sm-3">
					<input type="text" name="NomorBuktiPerpajakan" value="" class="form-control" required id="NomorBuktiPerpajakan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">ID Status Tanah</label>
				<div class="col-sm-3">
					<input type="text" name="IDStatusTanah" value="" class="form-control" required id="IDStatusTanah">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">ID Formulir Permohonan</label>
				<div class="col-sm-5">
					<input type="text" name="IDFormulirPermohonan" value="" class="form-control" required id="IDFormulirPermohonan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">ID Sanggahan</label>
				<div class="col-sm-5">
					<input type="text" name="IDSanggahan" value="" class="form-control" required id="IDSanggahan">
				</div>
			</div> -->
		</div>
	</div>
</div>

<div class="panel panel-success" id="grid_block_5">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Bukti Perpajakan</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Tanggal Bukti Perpajakan</label>
				<div class="col-sm-3">
					<input style="color:black; background-color:white;" readonly type="hidden" name="IDBuktiPerpajakan" value="<?php echo $DataFP[0]['IDBuktiPerpajakan']; ?>" class="form-control" required id="IDBuktiPerpajakan">
					<input style="color:black; background-color:white;" readonly type="date" name="TanggalBuktiPerpajakan" value="<?php echo $TanggalBuktiPerpajakan; ?>" class="form-control" required id="TanggalBuktiPerpajakan">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Uraian Patok D</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="UraianPatokD" value="<?php echo $DataFP[0]['UraianPatokD']; ?>" class="form-control" required id="UraianPatokD">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Uraian Verponding</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="UraianVerponding" value="<?php echo $DataFP[0]['UraianVerponding']; ?>" class="form-control" required id="UraianVerponding">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Uraian IPEDA</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="UraianIPEDA" value="<?php echo $DataFP[0]['UraianIPEDA']; ?>" class="form-control" required id="UraianIPEDA">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Uraian Lain</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="UraianLain" value="<?php echo $DataFP[0]['UraianLain']; ?>" class="form-control" required id="UraianLain">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Tahun Bukti Perpajakan</label>
				<div class="col-sm-3">
					<input style="color:black; background-color:white;" readonly type="text" name="TahunBuktiPerpajakan" value="<?php echo $DataFP[0]['TahunBuktiPerpajakan']; ?>" class="form-control" required id="TahunBuktiPerpajakan">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-success" id="grid_block_5">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Kenyataan</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Keterangan Tahun</label>
				<div class="col-sm-3">
					<input style="color:black; background-color:white;" readonly type="hidden" name="IDKenyataan" value="<?php echo $DataFP[0]['IDBuktiPerpajakan']; ?>" class="form-control" required id="IDKenyataan">
					<input style="color:black; background-color:white;" readonly type="text" name="KeteranganTahun" value="<?php echo $DataFP[0]['KeteranganTahun']; ?>" class="form-control" required id="KeteranganTahun">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Keterangan Cara</label>
				<div class="col-sm-5">
					<input style="color:black; background-color:white;" readonly type="text" name="KeteranganCara" value="<?php echo $DataFP[0]['KeteranganCara']; ?>" class="form-control" required id="KeteranganCara">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Keterangan Alih</label>
				<div class="col-sm-5">
					<input style="color:black; background-color:white;" readonly type="text" name="KeteranganAlih" value="<?php echo $DataFP[0]['KeteranganAlih']; ?>" class="form-control" required id="KeteranganAlih">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Jenis Kenyataan</label>
				<div class="col-sm-3">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="JenisKenyataan" required id="JenisKenyataan" data-live-search="true">
						<?php if ($DataFP[0]['Jenis'] == '1') { ?>
							<option value="1" selected>Sawah</option>
							<option value="2">Perumahan</option>
							<option value="3">Ladang</option>
							<option value="4">Industri</option>
							<option value="5">Kebun</option>
							<option value="6">Perkebunan</option>
							<option value="7">Kolam Ikan</option>
							<option value="8">Lapangan Umum</option>
						<?php } elseif ($DataFP[0]['Jenis'] == '2') {?>
							<option value="1">Sawah</option>
							<option value="2" selected>Perumahan</option>
							<option value="3">Ladang</option>
							<option value="4">Industri</option>
							<option value="5">Kebun</option>
							<option value="6">Perkebunan</option>
							<option value="7">Kolam Ikan</option>
							<option value="8">Lapangan Umum</option>
						<?php } elseif ($DataFP[0]['Jenis'] == '3') {?>
							<option value="1">Sawah</option>
							<option value="2">Perumahan</option>
							<option value="3" selected>Ladang</option>
							<option value="4">Industri</option>
							<option value="5">Kebun</option>
							<option value="6">Perkebunan</option>
							<option value="7">Kolam Ikan</option>
							<option value="8">Lapangan Umum</option>
						<?php } elseif ($DataFP[0]['Jenis'] == '4') {?>
							<option value="1">Sawah</option>
							<option value="2">Perumahan</option>
							<option value="3">Ladang</option>
							<option value="4" selected>Industri</option>
							<option value="5">Kebun</option>
							<option value="6">Perkebunan</option>
							<option value="7">Kolam Ikan</option>
							<option value="8">Lapangan Umum</option>
						<?php } elseif ($DataFP[0]['Jenis'] == '5') {?>
							<option value="1">Sawah</option>
							<option value="2">Perumahan</option>
							<option value="3">Ladang</option>
							<option value="4">Industri</option>
							<option value="5" selected>Kebun</option>
							<option value="6">Perkebunan</option>
							<option value="7">Kolam Ikan</option>
							<option value="8">Lapangan Umum</option>
						<?php } elseif ($DataFP[0]['Jenis'] == '6') {?>
							<option value="1">Sawah</option>
							<option value="2">Perumahan</option>
							<option value="3">Ladang</option>
							<option value="4">Industri</option>
							<option value="5">Kebun</option>
							<option value="6" selected>Perkebunan</option>
							<option value="7">Kolam Ikan</option>
							<option value="8">Lapangan Umum</option>
						<?php } elseif ($DataFP[0]['Jenis'] == '7') {?>
							<option value="1">Sawah</option>
							<option value="2">Perumahan</option>
							<option value="3">Ladang</option>
							<option value="4">Industri</option>
							<option value="5">Kebun</option>
							<option value="6">Perkebunan</option>
							<option value="7" selected>Kolam Ikan</option>
							<option value="8">Lapangan Umum</option>
						<?php } elseif ($DataFP[0]['Jenis'] == '8') {?>
							<option value="1">Sawah</option>
							<option value="2">Perumahan</option>
							<option value="3">Ladang</option>
							<option value="4">Industri</option>
							<option value="5">Kebun</option>
							<option value="6">Perkebunan</option>
							<option value="7">Kolam Ikan</option>
							<option value="8" selected>Lapangan Umum</option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-success" id="grid_block_5">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Status Tanah</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nama Status Tanah</label>
				<div class="col-sm-5">
  				<input style="color:black; background-color:white;" readonly type="hidden" name="IDStatusTanah" value="<?php echo $DataFP[0]['IDStatusTanah']; ?>" class="form-control" required id="IDStatusTanah">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="NamaStatusTanah" required id="NamaStatusTanah" data-live-search="true">
						<option value="1">Tanah Dengan Hak Perorangan</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Uraian Status Tanah</label>
				<div class="col-sm-7">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="UraianStatusTanah" required id="UraianStatusTanah" data-live-search="true">
						<?php if ($DataFP[0]['UraianStatusTanah'] == '1') { ?>
							<option value="1" selected>Hak Milik Adat</option>
							<option value="2">Hak Sanggahan</option>
							<option value="3">Hak Anggaduh</option>
							<option value="4">Hak Norowito</option>
							<option value="5">Hak Gogol</option>
							<option value="6">Hak Yasan</option>
							<option value="7">Hak Pekulen</option>
						<?php } elseif ($DataFP[0]['UraianStatusTanah'] == '2') {?>
							<option value="1">Hak Milik Adat</option>
							<option value="2" selected>Hak Sanggahan</option>
							<option value="3">Hak Anggaduh</option>
							<option value="4">Hak Norowito</option>
							<option value="5">Hak Gogol</option>
							<option value="6">Hak Yasan</option>
							<option value="7">Hak Pekulen</option>
						<?php } elseif ($DataFP[0]['UraianStatusTanah'] == '3') {?>
							<option value="1">Hak Milik Adat</option>
							<option value="2">Hak Sanggahan</option>
							<option value="3" selected>Hak Anggaduh</option>
							<option value="4">Hak Norowito</option>
							<option value="5">Hak Gogol</option>
							<option value="6">Hak Yasan</option>
							<option value="7">Hak Pekulen</option>
						<?php } elseif ($DataFP[0]['UraianStatusTanah'] == '4') {?>
							<option value="1">Hak Milik Adat</option>
							<option value="2">Hak Sanggahan</option>
							<option value="3">Hak Anggaduh</option>
							<option value="4" selected>Hak Norowito</option>
							<option value="5">Hak Gogol</option>
							<option value="6">Hak Yasan</option>
							<option value="7">Hak Pekulen</option>
						<?php } elseif ($DataFP[0]['UraianStatusTanah'] == '5') {?>
							<option value="1">Hak Milik Adat</option>
							<option value="2">Hak Sanggahan</option>
							<option value="3">Hak Anggaduh</option>
							<option value="4">Hak Norowito</option>
							<option value="5" selected>Hak Gogol</option>
							<option value="6">Hak Yasan</option>
							<option value="7">Hak Pekulen</option>
						<?php } elseif ($DataFP[0]['UraianStatusTanah'] == '6') {?>
							<option value="1">Hak Milik Adat</option>
							<option value="2">Hak Sanggahan</option>
							<option value="3">Hak Anggaduh</option>
							<option value="4">Hak Norowito</option>
							<option value="5">Hak Gogol</option>
							<option value="6" selected>Hak Yasan</option>
							<option value="7">Hak Pekulen</option>
						<?php } elseif ($DataFP[0]['UraianStatusTanah'] == '7') {?>
							<option value="1">Hak Milik Adat</option>
							<option value="2">Hak Sanggahan</option>
							<option value="3">Hak Anggaduh</option>
							<option value="4">Hak Norowito</option>
							<option value="5">Hak Gogol</option>
							<option value="6">Hak Yasan</option>
							<option value="7" selected>Hak Pekulen</option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-success" id="grid_block_5">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Kesimpulan Status Tanah</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-6" id="DivKesimpulanStatusTanah">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Jenis Kesimpulan Status Tanah</label>
				<div class="col-sm-5">
					<input style="color:black; background-color:white;" readonly type="hidden" name="IDKesimpulanStatusTanah" value="<?php echo $DataFP[0]['IDKesimpulanStatusTanah']; ?>" class="form-control" required id="IDKesimpulanStatusTanah">
					<input style="color:black; background-color:white;" readonly type="hidden" readonly style="color:black;background-color:white;" name="NamaKesimpulanStatusTanah" value="<?php echo $DataFP[0]['StatusTanah'] ?>" class="form-control" required id="NamaKesimpulanStatusTanah">
			  	<input style="color:black; background-color:white;" readonly type="text" name="StrNamaKesimpulanStatusTanah" readonly style="color:black;background-color:white;" value="<?php echo $StatusTanah ?>" class="form-control" required id="StrNamaKesimpulanStatusTanah">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nama Kesimpulan Status Tanah</label>
				<div class="col-sm-5">
					<input style="color:black; background-color:white;" readonly type="hidden" readonly style="color:black;background-color:white;" name="JenisKesimpulanStatusTanah" value="HMA" class="form-control" required id="JenisKesimpulanStatusTanah">
					<input style="color:black; background-color:white;" readonly type="text" readonly style="color:black;background-color:white;" name="StrJenisKesimpulanStatusTanah" value="HMA" class="form-control" required id="StrJenisKesimpulanStatusTanah">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Nama Penempat</label>
				<div class="col-sm-5">
					<input style="color:black; background-color:white;" readonly type="text" readonly style="color:black;background-color:white;" name="NamaPenempat" value="<?php echo $DataFP[0]['NamaPemohon'] ?>" class="form-control" required id="NamaPenempat">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Uraian</label>
				<div class="col-sm-7">
					<input style="color:black; background-color:white;" readonly type="text" name="Uraian" value="<?php echo $DataFP[0]['UraianKesimpulanStatusTanah']; ?>" class="form-control" required id="Uraian">
				</div>
			</div>
			<div class="form-group">
				<label for="focusedinput" class="col-sm-4 control-label">Usulan</label>
				<div class="col-sm-2">
					<select style="color:black; background-color:white;" readonly class="form-control select" name="Usulan" required id="Usulan" data-live-search="true">
						<?php if ($DataFP[0]['UsulanKesimpulanStatusTanah'] == 1) { ?>
							<option value="1" selected>Dapat</option>
							<option value="2">Tidak Dapat</option>
						<?php } else {?>
							<option value="1">Dapat</option>
							<option value="2" selected>Tidak Dapat</option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
}
?>
