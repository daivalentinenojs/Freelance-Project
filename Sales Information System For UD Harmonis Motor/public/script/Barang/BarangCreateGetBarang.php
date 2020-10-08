<?php
if(isset($_GET["IDBarang"])) {
	require '../../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDBarang = $MySQLi->real_escape_string($_GET["IDBarang"]);

	$QueryGetDataBarangs = "SELECT Barangs.Nama AS Nama, Barangs.IDBarang AS ID, 
                                Kategoris.Nama AS NamaKategori 
                            FROM Barangs INNER JOIN Kategoris ON Barangs.KategoriID = Kategoris.IDKategori
                            WHERE Barangs.IDBarang = '$IDBarang'";

	$HasilQueryGetDataBarangs = mysqli_query($MySQLi, $QueryGetDataBarangs);
	$DataBarang = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarangs)) {
		$DataBarang[] = $Hasil;
	}
	echo $DataBarang[0]['Nama'];
	mysqli_close($MySQLi);
}
?>
