<?php
if(isset($_GET["IDProduk"])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDBarang = $MySQLi->real_escape_string($_GET["IDProduk"]);
	$QueryGetDataBarang = "SELECT Barangs.Tahun AS 'Tahun', Barangs.HargaBeli AS 'HargaBeliStandart',
	Barangs.Deskripsi AS 'Deskripsi', Barangs.StatusTerdaftar AS 'StatusTerdaftar',
	Mobils.Nama AS 'NamaMobil', Kategoris.Nama AS 'NamaMerk'
	FROM Barangs INNER JOIN Mobils ON Barangs.MobilID = Mobils.IDMobil
	INNER JOIN Kategoris ON Mobils.KategoriID = Kategoris.IDKategori
	WHERE Barangs.StatusTerdaftar = 1 AND Barangs.IDBarang = '$IDBarang'";

	$HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
	$DataBarang = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
		$DataBarang[] = $Hasil;
	}

	if ($DataBarang[0]["StatusTerdaftar"] == "1") {
		$Status = "Aktif";
	} else {
		$Status = "Tidak Aktif";
	}

			 echo '<label class="col-md-4 control-label">Harga Beli Standart</label>';
			 echo '<div class="col-md-4">';
					echo '<input type="text" name="AlamatBarang" value = "Rp. '.number_format($DataBarang[0]["HargaBeliStandart"], 2, ",", ".").'" readonly class="form-control" placeholder="Masukkan Alamat" style="background:white; color:black;"/>';
			 echo '</div>';
	mysqli_close($MySQLi);
}
?>
