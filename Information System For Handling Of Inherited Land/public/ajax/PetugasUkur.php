<?php
if(isset($_GET['IDFP'])) {
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$IDFP = $MySQLi->real_escape_string($_GET['IDFP']);

	$QueryGetDataFP = "SELECT BerkasPermohonan.IDPersyaratan AS 'IDPersyaratan', JadwalUkur.IDKaryawan AS 'IDKaryawan', JadwalUkur.IDKaryawanPemetaan AS 'IDKaryawanPemetaan'
						FROM BerkasPermohonan INNER JOIN JadwalUkur ON (BerkasPermohonan.IDJadwalUkur = JadwalUkur.ID)
						WHERE BerkasPermohonan.IDPersyaratan = '$IDFP'";
	$HasilQueryDataFP = mysqli_query($MySQLi, $QueryGetDataFP);
	$DataFP = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryDataFP))
	{
		$DataFP[] = $Hasil;
	}

	$QueryGetDataKaryawan = "SELECT Karyawan.ID AS ID, Karyawan.NIK AS NIK, Karyawan.Nama AS Nama, Karyawan.Alamat AS Alamat,
													 Karyawan.Telepon AS Telepon, Karyawan.IDUser AS IDUser, users.name AS Username, users.password AS Password, Karyawan.Jabatan AS Jabatan,
													 Karyawan.IDDaerah AS IDDaerah, users.email AS Email, Daerah.Nama AS NamaDaerah
													 FROM Karyawan INNER JOIN users ON users.id = Karyawan.IDUser INNER JOIN Daerah ON Daerah.ID = Karyawan.IDDaerah
													 WHERE Karyawan.Jabatan = '4'";
	$HasilQueryGetDataKaryawan = mysqli_query($MySQLi, $QueryGetDataKaryawan);
	$DataKaryawan = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataKaryawan)) {
		$DataKaryawan[] = $Hasil;
	}

	mysqli_close($MySQLi);
}

if (!empty($DataFP)) {
?>
<select name="IDKaryawan" required class="form-control select" data-live-search="true">
<?php
	 foreach ($DataKaryawan as $Karyawan) {
		 $ID = $Karyawan['ID'];
		 $Nama = $Karyawan['Nama'];
		 if ($ID == $DataFP[0]['IDKaryawan']) {
			 echo '<option selected value="'.$ID.'">'.$Nama.'</option>';
		 } else {
			 	echo '<option value="'.$ID.'">'.$Nama.'</option>';
		 }
	 }
?>
</select>
<?php } ?>
