<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT FormulirPermohonan.ID AS 'ID', FormulirPermohonan.IDPemohon AS 'IDPemohon', KepalaDesa.ID AS 'IDKepalaDesa', KepalaDesa.Nama AS 'NamaKepalaDesa'
						FROM FormulirPermohonan INNER JOIN Pemohon ON (FormulirPermohonan.IDPemohon = Pemohon.ID)
																		INNER JOIN Desa ON (Pemohon.IDDesa = Desa.ID)
																		INNER JOIN KepalaDesa ON (Desa.ID = KepalaDesa.IDDesa)
						WHERE FormulirPermohonan.ID = '$IDFP'";
	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

  mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
	echo '<input type="hidden" readonly style="background:white; color:black;" name="IDKepalaDesa" value="'.$DataFP[0]['IDKepalaDesa'].'" class="form-control" required id="IDKepalaDesa">';
	echo '<input type="text" readonly style="background:white; color:black;" name="NamaKepalaDesa" value="'.$DataFP[0]['NamaKepalaDesa'].'" class="form-control" required id="NamaKepalaDesa">';
} else {
	echo '<input type="hidden" readonly style="background:white; color:black;" name="IDKepalaDesa" value="1" class="form-control" required id="IDKepalaDesa">';
	echo '<input type="text" readonly style="background:white; color:black;" name="NamaKepalaDesa" value="Belum Ada Kepala Desa Yang Terdaftar" class="form-control" required id="NamaKepalaDesa">';
}
