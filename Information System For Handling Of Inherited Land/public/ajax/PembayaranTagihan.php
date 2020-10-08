<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.ID AS 'View', FormulirPermohonan.NamaKuasa AS 'NamaKuasa',
						FormulirPermohonan.AlamatKuasa AS 'AlamatKuasa', FormulirPermohonan.AlamatTanah AS 'AlamatTanah',
						Persyaratan.Nama AS 'NamaPemohon', Persyaratan.NomorBukuHurufC AS 'NomorBukuHurufC',
						Persyaratan.JenisTanahLetterC AS 'JenisTanahLetterC', Persyaratan.LuasDaerahLetterC AS 'LuasDaerahLetterC',
						Persyaratan.StatusTanah AS 'StatusTanah', FormulirPermohonan.Status AS 'StatusFP',
						Tagihan.Uraian AS Uraian, Tagihan.Banyak AS Banyak, Tagihan.Jumlah AS Jumlah, Tagihan.Biaya AS Biaya, Tagihan.Luas AS Luas
						FROM FormulirPermohonan INNER JOIN FPXP ON (FormulirPermohonan.ID = FPXP.IDFormulirPermohonan) INNER JOIN Persyaratan
						ON (Persyaratan.ID = FPXP.IDPersyaratan) INNER JOIN Tagihan ON (Tagihan.IDFormulirPermohonan = FormulirPermohonan.ID) WHERE FormulirPermohonan.ID = '$IDFP'";

	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	mysqli_close($MySQLi);


}

if (!empty($DataFP)) {
?>
<div class="panel panel-success" id="grid_block_5">
		<div class="panel-heading">
			<h3 class="panel-title">Informasi Tagihan</h3>
		</div>
		<div class="panel-body">
				<table class="table" id="DataTableKepalaDesa"
						<thead>
								<tr>
										<th style="text-align:center;">Uraian</th>
										<th style="text-align:center;">Banyak</th>
										<th style="text-align:center;">Biaya</th>
								</tr>
						</thead>
						<tbody>
							<?php for ($i=0; $i < count($DataFP); $i++) {  ?>
								<tr>
										<th style="text-align:left;"><?php echo $DataFP[$i]['Uraian']; ?></th>
										<th style="text-align:center;"><?php echo $DataFP[$i]['Banyak']; ?></th>
										<th style="text-align:right;"><?php echo $DataFP[$i]['Biaya']; ?></th>
								</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							 <tr>
								 <th style="text-align:center;">Uraian</th>
								 <th style="text-align:center;">Banyak</th>
								 <th style="text-align:center;">Biaya</th>
							 </tr>
						</tfoot>
				</table>
		</div>
		<div class="panel-body">
			<div class="col-md-10"></div>
			<div class="col-md-2">

				<div class="form-group">
					<label for="focusedinput" class="col-sm-3 control-label">Jumlah</label>
					<div class="col-sm-9">
						<input type="text" readonly value="<?php echo $DataFP[0]['Jumlah']; ?>" name="Jumlah" class="form-control" required id="Jumlah" style="text-align:right; background:white; color:black;">
					</div>
				</div>
			</div>
	</div>
</div>
<?php } ?>
