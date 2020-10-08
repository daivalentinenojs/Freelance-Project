<?php
if(isset($_GET["IDPemasokJualBarang"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDPemasokJualBarang = $MySQLi->real_escape_string($_GET["IDPemasokJualBarang"]);
	$QueryGetDataBarang = "SELECT Barangs.Nama AS 'NamaBarang', Mobils.Nama AS 'NamaMobil',
	Kategoris.Nama AS 'NamaMerk', Barangs.Tahun AS 'TahunBarang'
	FROM Barangs INNER JOIN PemasokJualBarangs ON Barangs.IDBarang = PemasokJualBarangs.BarangID
	INNER JOIN Mobils ON Mobils.IDMobil = Barangs.MobilID
	INNER JOIN Kategoris ON Kategoris.IDKategori = Mobils.KategoriID
	WHERE PemasokJualBarangs.IDPemasokJualBarang = '$IDPemasokJualBarang'";

	$HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
	$DataBarang = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
		$DataBarang[] = $Hasil;
	}

	echo'<label class="col-md-5 control-label">Nama Barang Lama</label>';
	echo'<div class="col-md-6">';
			 echo'<input type="text" name="NamaBarang" readonly required class="form-control" value="'.$DataBarang[0]['NamaBarang'].' - '.$DataBarang[0]['NamaMerk'].' - '.$DataBarang[0]['NamaMobil'].' - '.$DataBarang[0]['TahunBarang'].'" placeholder="Nama Barang" style="background:white; color:black;"/>';
	echo'</div>';
	mysqli_close($MySQLi);
}
?>
