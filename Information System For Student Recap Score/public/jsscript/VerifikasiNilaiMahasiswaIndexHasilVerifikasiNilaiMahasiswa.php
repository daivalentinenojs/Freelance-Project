<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK']) AND isset($_GET['KodeVerifikasi']))
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	date_default_timezone_set('UTC');
	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);
	$KodeVerifikasi = $MySQLi->real_escape_string($_GET['KodeVerifikasi']);

	$requestData= $_REQUEST;

	if ($KodeVerifikasi == 1)
	{
		$columns = array(
		// Nama Judul
			0 => 'NRP',
			1 => 'NTS',
			2 => 'KodeMkBuka',
			3 => 'NRPTampil',
			4 => 'NamaMahasiswa',
			5 => 'KodeNisbi'
		);
	}
	else
	{
		$columns = array(
		// Nama Judul
			0 => 'NRP',
			1 => 'NAS',
			2 => 'KodeMkBuka',
			3 => 'NRPTampil',
			4 => 'NamaMahasiswa',
			5 => 'KodeNisbi'
		);
	}

	// Ambil Semua Baris Data
	if ($KodeVerifikasi == 1)
	{
		$sql = "SELECT BAAK.Mahasiswa.NRP AS 'NRP', BAAK.Mahasiswa.NRP AS 'NRPTampil', BAAK.Mahasiswa.Nama AS 'NamaMahasiswa', RekapNilai.MhsAmbilMk.NTS AS 'NTS',
		RekapNilai.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka',

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 81 AND	(
		RekapNilai.MhsAmbilMk.NTS
		) <= 100 THEN 'A' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 73 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 81 THEN 'AB' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 66 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 73 THEN 'B' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 60 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 66 THEN 'BC' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 55 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 60 THEN 'C' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 40 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 55 THEN 'D' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 0 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 40 THEN 'E' ELSE '-' END) END) END) END)END) END)END) AS 'KodeNisbi'

		FROM BAAK.Mahasiswa INNER JOIN RekapNilai.MhsAmbilMk ON RekapNilai.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
		WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$Kode' AND RekapNilai.MhsAmbilMk.KP = '$KP'";
	}
	else
	{
		$sql = "SELECT BAAK.Mahasiswa.NRP AS 'NRP', BAAK.Mahasiswa.NRP AS 'NRPTampil', BAAK.Mahasiswa.Nama AS 'NamaMahasiswa', RekapNilai.MhsAmbilMk.NAS AS 'NAS',
		RekapNilai.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka',

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 81 AND	(
		RekapNilai.MhsAmbilMk.NAS
		) <= 100 THEN 'A' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 73 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 81 THEN 'AB' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 66 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 73 THEN 'B' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 60 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 66 THEN 'BC' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 55 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 60 THEN 'C' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 40 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 55 THEN 'D' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 0 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 40 THEN 'E' ELSE '-' END) END) END) END)END) END)END) AS 'KodeNisbi'

		FROM BAAK.Mahasiswa INNER JOIN RekapNilai.MhsAmbilMk ON RekapNilai.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
		WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$Kode' AND RekapNilai.MhsAmbilMk.KP = '$KP'";
	}

	// echo $sql;
	// // Ambil Semua Baris Data
	// $sql = "SELECT DISTINCT BAAK.Mahasiswa.NRP AS 'NRP', BAAK.Mahasiswa.Nama AS 'NamaMahasiswa', RekapNilai.MhsAmbilMk.NTS AS 'NTS', RekapNilai.MhsAmbilMk.NAS AS 'NAS',
	// RekapNilai.MhsAmbilMk.NA AS 'NA', RekapNilai.MhsAmbilMk.KodeNisbi AS 'KodeNisbi',	RekapNilai.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka'
	// FROM BAAK.Mahasiswa INNER JOIN RekapNilai.MhsAmbilMk ON RekapNilai.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
	// WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$Kode' AND RekapNilai.MhsAmbilMk.KP = '$KP'";

	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	if ($KodeVerifikasi == 1)
	{
		$sql = "SELECT BAAK.Mahasiswa.NRP AS 'NRP', BAAK.Mahasiswa.NRP AS 'NRPTampil', BAAK.Mahasiswa.Nama AS 'NamaMahasiswa', RekapNilai.MhsAmbilMk.NTS AS 'NTS',
		RekapNilai.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka',

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 81 AND	(
		RekapNilai.MhsAmbilMk.NTS
		) <= 100 THEN 'A' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 73 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 81 THEN 'AB' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 66 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 73 THEN 'B' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 60 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 66 THEN 'BC' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 55 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 60 THEN 'C' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 40 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 55 THEN 'D' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NTS
		) >= 0 AND (
		RekapNilai.MhsAmbilMk.NTS
		) < 40 THEN 'E' ELSE '-' END) END) END) END)END) END)END) AS 'KodeNisbi'

		FROM BAAK.Mahasiswa INNER JOIN RekapNilai.MhsAmbilMk ON RekapNilai.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
		WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$Kode' AND RekapNilai.MhsAmbilMk.KP = '$KP'";
	}
	else
	{
		$sql = "SELECT BAAK.Mahasiswa.NRP AS 'NRP', BAAK.Mahasiswa.NRP AS 'NRPTampil', BAAK.Mahasiswa.Nama AS 'NamaMahasiswa', RekapNilai.MhsAmbilMk.NAS AS 'NAS',
		RekapNilai.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka',

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 81 AND	(
		RekapNilai.MhsAmbilMk.NAS
		) <= 100 THEN 'A' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 73 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 81 THEN 'AB' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 66 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 73 THEN 'B' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 60 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 66 THEN 'BC' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 55 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 60 THEN 'C' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 40 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 55 THEN 'D' ELSE

		(CASE WHEN (
		RekapNilai.MhsAmbilMk.NAS
		) >= 0 AND (
		RekapNilai.MhsAmbilMk.NAS
		) < 40 THEN 'E' ELSE '-' END) END) END) END)END) END)END) AS 'KodeNisbi'

		FROM BAAK.Mahasiswa INNER JOIN RekapNilai.MhsAmbilMk ON RekapNilai.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
		WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$Kode' AND RekapNilai.MhsAmbilMk.KP = '$KP'";
	}

	// $sql = "SELECT DISTINCT BAAK.Mahasiswa.NRP AS 'NRP', BAAK.Mahasiswa.Nama AS 'NamaMahasiswa', RekapNilai.MhsAmbilMk.NTS AS 'NTS', RekapNilai.MhsAmbilMk.NAS AS 'NAS',
	// RekapNilai.MhsAmbilMk.NA AS 'NA', RekapNilai.MhsAmbilMk.KodeNisbi AS 'KodeNisbi',	RekapNilai.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka'
	// FROM BAAK.Mahasiswa INNER JOIN RekapNilai.MhsAmbilMk ON RekapNilai.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
	// WHERE RekapNilai.MhsAmbilMk.KodeMkBuka = '$Kode' AND RekapNilai.MhsAmbilMk.KP = '$KP'";

	if( !empty($requestData['search']['value']) ) {
		$sql.=" AND ( BAAK.Mahasiswa.NRP LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR BAAK.Mahasiswa.Nama LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$nestedData=array();

		if ($KodeVerifikasi == 1)
		{
				$nestedData[] = '<label for="NRP[]">'.$row["NRP"].'</label>'.'<input value="'.$row["NRP"].'" readonly data-toggle="tooltip" data-placement="right" title="NRP Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey;" name="NRP[]" class="form-control"/>';
				$nestedData[] = '<label>'.$row["NamaMahasiswa"].'</label>';
				$nestedData[] = '<label for="NTS[]">'.round($row["NTS"],3).'</label>'.'<input value="'.round($row["NTS"],3).'" readonly data-toggle="tooltip" data-placement="right" title="NTS Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="NTS[]" class="form-control"/>';
				// $nestedData[] = '<label for="NAS[]">'.round($row["NAS"],3).'</label>'.'<input value="'.round($row["NAS"],3).'" readonly data-toggle="tooltip" data-placement="right" title="NAS Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="NAS[]" class="form-control"/>';
				// $nestedData[] = '<label for="NA[]">'.round($row["NA"],3).'</label>'.'<input value="'.round($row["NA"],3).'" readonly data-toggle="tooltip" data-placement="right" title="NA Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="NA[]" class="form-control"/>';
				$nestedData[] = $row["KodeMkBuka"];
				$nestedData[] = $row["NRPTampil"];
				$nestedData[] = $row["NamaMahasiswa"];
				$nestedData[] = '<label>'.$row["KodeNisbi"].'</label>'.'<input value="'.$row["KodeNisbi"].'" readonly data-toggle="tooltip" data-placement="right" title="NTS Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="KodeNisbiNTS[]" class="form-control"/>';
		}
		else
		{
				$nestedData[] = '<label for="NRP[]">'.$row["NRP"].'</label>'.'<input value="'.$row["NRP"].'" readonly data-toggle="tooltip" data-placement="right" title="NRP Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey;" name="NRP[]" class="form-control"/>';
				$nestedData[] = '<label>'.$row["NamaMahasiswa"].'</label>';
				// $nestedData[] = '<label for="NTS[]">'.round($row["NTS"],3).'</label>'.'<input value="'.round($row["NTS"],3).'" readonly data-toggle="tooltip" data-placement="right" title="NTS Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="NTS[]" class="form-control"/>';
				$nestedData[] = '<label for="NAS[]">'.round($row["NAS"],3).'</label>'.'<input value="'.round($row["NAS"],3).'" readonly data-toggle="tooltip" data-placement="right" title="NAS Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="NAS[]" class="form-control"/>';
				// $nestedData[] = '<label for="NA[]">'.round($row["NA"],3).'</label>'.'<input value="'.round($row["NA"],3).'" readonly data-toggle="tooltip" data-placement="right" title="NA Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="NA[]" class="form-control"/>';
				$nestedData[] = $row["KodeMkBuka"];
				$nestedData[] = $row["NRPTampil"];
				$nestedData[] = $row["NamaMahasiswa"];
				$nestedData[] = '<label>'.$row["KodeNisbi"].'</label>'.'<input value="'.$row["KodeNisbi"].'" readonly data-toggle="tooltip" data-placement="right" title="NTS Mahasiswa" type="hidden" style="width:50%; font-weight:bold; border-radius:2px; color:grey; text-align:center;" name="KodeNisbiNAS[]" class="form-control"/>';
		}

		// $nestedData[] = $row["NRP"];
		// $nestedData[] = $row["NTS"];
		// $nestedData[] = $row["NAS"];
		// $nestedData[] = $row["NA"];
		// $nestedData[] = $row["KodeNisbi"];
		// $nestedData[] = $row["KodeMkBuka"];
		// $nestedData[] = $row["NamaMahasiswa"];

		$data[] = $nestedData;
	}

	$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $data
				);

	echo json_encode($json_data);

	// echo "<input type='hidden' id='KodeMkBuka' name='KodeMkBuka' value='$Kode'>";
	// echo "<input type='hidden' id='KPMkBuka' name='KPMkBuka' value='$KP'>";
	//
	// $QueryMahasiswaAmbilMk = "SELECT MhsAmbilMk.NRP AS 'NRP', MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka', matakuliah.Nama AS 'NamaMkBuka', MhsAmbilMk.KP AS 'KP'
	// FROM MhsAmbilMk INNER JOIN MkBuka ON MhsAmbilMk.KodeMkBuka = MkBuka.KodeMkBuka INNER JOIN MataKuliah ON MataKuliah.KodeMk = MkBuka.KodeMk
	// WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP'";
	//
	// $HasilQueryMahasiswaAmbilMk = mysqli_query($MySQLi, $QueryMahasiswaAmbilMk);
	// $HasilMahasiswaAmbilMk = array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryMahasiswaAmbilMk))
	// {
	// 	$HasilMahasiswaAmbilMk[] = $Hasil;
	// }
	//
	// mysqli_close($MySQLi);
	//
	// require '../../connection/RekapNilai.php';
	// $MySQLi = mysqli_connect($domain, $username, $password, $database);
	//
	// $QueryJumlahJenisNilai = "SELECT DISTINCT Nilai.KodeNilai AS 'KodeNilai', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', Nilai.WaktuBuat AS ' WaktuBuat'  FROM Nilai INNER JOIN NilaiMahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
	// WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 ORDER BY Nilai.KodeNilai";
	//
	// $HasilQueryJumlahJenisNilai = mysqli_query($MySQLi, $QueryJumlahJenisNilai);
	// $HasilTampilJumlahJenisNilai = array();
	// while($Hasil = mysqli_fetch_assoc($HasilQueryJumlahJenisNilai))
	// {
	// 	$HasilTampilJumlahJenisNilai[] = $Hasil;
	// }
	// mysqli_close($MySQLi);
	//
	// echo "<span style='font-size:11px; margin-left:30px;'><strong>Daftar Nilai Mahasiswa Mata Kuliah ".$HasilMahasiswaAmbilMk[0]['NamaMkBuka']." KP ".$KP."</strong></span><br><br>";
	// echo "<table class='table' style='margin-left:30px;'><thead><tr>";
	// echo "<th style='text-align:center; vertical-align:middle;'>NRP</th>";
	// echo "<th style='text-align:center; vertical-align:middle;'>Nama Mahasiswa</th>";
	//
	// for ($i=0; $i < count($HasilTampilJumlahJenisNilai); $i++) {
	// 		$Date = date_create($HasilTampilJumlahJenisNilai[$i]['WaktuBuat']);
	//
	// 		$TempDate = date_format($Date, "d F Y");
	// 		echo "<th style='text-align:center;'>Nilai ".$HasilTampilJumlahJenisNilai[$i]['Jenis']."<br>".$TempDate."<br>(".round($HasilTampilJumlahJenisNilai[$i]['Bobot'],2)." %)</th>";
	// }
	// echo "<th style='text-align:center; vertical-align:middle;'>NTS <br>".date("j F Y")."<br> ".$PersentaseNTS." %</th>";
	// echo "<th style='text-align:center; vertical-align:middle;'>NAS <br>".date("j F Y")."<br> ".(100-$PersentaseNTS)." %</th>";
	// echo "<th style='text-align:center; vertical-align:middle;'>Nilai Akhir</th>";
	// echo "<th style='text-align:center; vertical-align:middle;'>Kode Nisbi</th>";
	// echo "</tr></thead><tbody>";
	//
	// for ($i=0; $i < count($HasilMahasiswaAmbilMk); $i++) {
	// 	require '../../connection/RekapNilai.php';
	// 	$MySQLi = mysqli_connect($domain, $username, $password, $database);
	//
	// 	echo "<tr>";
	// 	$Temp = $HasilMahasiswaAmbilMk[$i]['NRP'];
	// 	$QueryJenisNilai = "SELECT Nilai.KodeMkBuka AS 'KodeMkBuka', Nilai.KP AS 'KP', Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', NilaiMahasiswa.NRP AS 'NRP', NilaiMahasiswa.NRP AS 'Nama',
	// 	NilaiMahasiswa.Nilai AS 'Nilai', NilaiMahasiswa.KodeNisbi AS 'KodeNisbi' FROM nilai INNER JOIN nilaimahasiswa ON Nilai.KodeNilai = NilaiMahasiswa.KodeNilai
	// 	WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 AND NilaiMahasiswa.NRP = '$Temp' ORDER BY Nilai.KodeNilai";
	//
	// 	$MySQLi = mysqli_connect($domain, $username, $password, $database);
	// 	$HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
	// 	$HasilTampilNilai = array();
	// 	while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai))
	// 	{
	// 		$HasilTampilNilai[] = $Hasil;
	// 	}
	//
	// 	mysqli_close($MySQLi);
	//
	// 	require '../../connection/Init.php';
	// 	$MySQLi = mysqli_connect($domain, $username, $password, $database);
	//
	// 	$NRP = $HasilTampilNilai[0]['NRP'];
	// 	$QueryNamaMahasiswa = "SELECT Mahasiswa.Nama FROM Mahasiswa WHERE Mahasiswa.NRP = '$NRP'";
	// 	$HasilQueryNamaMahasiswa = mysqli_query($MySQLi, $QueryNamaMahasiswa);
	// 	$NamaMahasiswa = array();
	//
	// 	while($Hasil = mysqli_fetch_assoc($HasilQueryNamaMahasiswa))
	// 	{
	// 		$NamaMahasiswa[] = $Hasil;
	// 	}
	// 	$HasilTampilNilai[0]['Nama'] = $NamaMahasiswa[0]['Nama'];
	//
	// 	if (!empty($HasilTampilNilai)) {
	// 				echo "<td style='text-align:center; vertical-align:middle;'>";
	// 				$TempNRP = $HasilTampilNilai[0]['NRP'];
	// 				echo "<input id = 'NRPMahasiswa' name='NRPMahasiswa[]' type='text' readonly value='$TempNRP' required style='cursor:not-allowed; background-color:#eee; height: 30px;
	// 				font-size: 12px; line-height: 18px; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; -webkit-appearance: none; border: 1px solid #D5D5D5;
	// 				background: #F9F9F9; opacity:1; width:75px; text-align:center; font-weight:bold; border-radius:2px; color:grey;'/>";
	// 				echo "</td>";
	// 				echo "<td style='text-align:center; vertical-align:middle;'>".$HasilTampilNilai[0]['Nama']."</td>";
	//
	// 				foreach ($HasilTampilNilai as $key => $value) {
	// 					echo "<td style='text-align:center; vertical-align:middle;'>".$value['Nilai']."</td>";
	// 				}
	// 	}
	// 	mysqli_close($MySQLi);
	//
	// 	require '../../connection/RekapNilai.php';
	// 	$MySQLi = mysqli_connect($domain, $username, $password, $database);
	//
	// 	$QueryNTS = "SELECT SUM((NilaiMahasiswa.Nilai * Nilai.Bobot)/100) AS 'NTS' FROM nilaimahasiswa INNER JOIN nilai ON NilaiMahasiswa.KodeNilai =
	// 	Nilai.KodeNilai WHERE Nilai.Jenis LIKE '%UTS' AND NilaiMahasiswa.NRP = $Temp AND Nilai.KodeMkBuka = '$Kode' GROUP BY NilaiMahasiswa.NRP";
	// 	$HasilQueryNTS = mysqli_query($MySQLi, $QueryNTS);
	// 	$HasilNTS = array();
	//
	// 	while($Hasil = mysqli_fetch_assoc($HasilQueryNTS))
	// 	{
	// 		$HasilNTS[] = $Hasil;
	// 	}
	//
	// 	$TempNTS = round($HasilNTS[0]['NTS'],2);
	// 	echo "<td style='text-align:center; vertical-align:middle;'>";
	// 	echo "<input id = 'NTSMahasiswa' name='NTSMahasiswa[]' type='text' readonly value='$TempNTS' required style='cursor:not-allowed; background-color:#eee; height: 30px;
	// 	font-size: 12px; line-height: 18px; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; -webkit-appearance: none; border: 1px solid #D5D5D5;
	// 	background: #F9F9F9; opacity:1; width:50px; text-align:center; font-weight:bold; border-radius:2px; color:grey;'/>";
	// 	echo "</td>";
	//
	// 	$QueryNAS = "SELECT SUM((NilaiMahasiswa.Nilai * Nilai.Bobot)/100) AS 'NAS' FROM nilaimahasiswa INNER JOIN nilai ON NilaiMahasiswa.KodeNilai =
	// 	Nilai.KodeNilai WHERE Nilai.Jenis LIKE '%UAS' AND NilaiMahasiswa.NRP = $Temp AND Nilai.KodeMkBuka = '$Kode' GROUP BY NilaiMahasiswa.NRP";
	// 	$HasilQueryNAS = mysqli_query($MySQLi, $QueryNAS);
	// 	$HasilNAS = array();
	// 	while($Hasil = mysqli_fetch_assoc($HasilQueryNAS))
	// 	{
	// 		$HasilNAS[] = $Hasil;
	// 	}
	// 	$TempNAS = round($HasilNAS[0]['NAS'],2);
	// 	echo "<td style='text-align:center; vertical-align:middle;'>";
	// 	echo "<input id = 'NASMahasiswa' name='NASMahasiswa[]' type='text' readonly value='$TempNAS' required style='cursor:not-allowed; background-color:#eee; height: 30px;
	// 	font-size: 12px; line-height: 18px; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; -webkit-appearance: none; border: 1px solid #D5D5D5;
	// 	background: #F9F9F9; opacity:1; width:50px; text-align:center; font-weight:bold; border-radius:2px; color:grey;'/>";
	// 	echo "</td>";
	//
	// 	$NilaiAkhir = (($PersentaseNTS/100) * $HasilNTS[0]['NTS']) + (((100-$PersentaseNTS)/100) * $HasilNAS[0]['NAS']);
	//
	// 	$TempNA = round($NilaiAkhir,2);
	// 	echo "<td style='text-align:center; vertical-align:middle;'>";
	// 	echo "<input id = 'NAMahasiswa' name='NAMahasiswa[]' type='text' readonly value='$TempNA' required style='cursor:not-allowed; background-color:#eee; height: 30px;
	// 	font-size: 12px; line-height: 18px; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; -webkit-appearance: none; border: 1px solid #D5D5D5;
	// 	background: #F9F9F9; opacity:1; width:50px; text-align:center; font-weight:bold; border-radius:2px; color:grey;'/>";
	// 	echo "</td>";
	//
	// 	if ($NilaiAkhir >= 81 && $NilaiAkhir <= 100) {
	// 			$KodeNisbi = "A";
	// 	} else if ($NilaiAkhir >= 73 && $NilaiAkhir <= 80) {
	// 			$KodeNisbi = "AB";
	// 	} else if ($NilaiAkhir >= 66 && $NilaiAkhir <= 72) {
	// 			$KodeNisbi = "B";
	// 	} else if ($NilaiAkhir >= 60 && $NilaiAkhir <= 65) {
	// 			$KodeNisbi = "BC";
	// 	} else if ($NilaiAkhir >= 55 && $NilaiAkhir <= 59) {
	// 			$KodeNisbi = "C";
	// 	} else if ($NilaiAkhir >= 40 && $NilaiAkhir <= 54) {
	// 			$KodeNisbi = "D";
	// 	} else if ($NilaiAkhir >= 0 && $NilaiAkhir <= 40) {
	// 			$KodeNisbi = "E";
	// 	}
	//
	// 	$TempNA = round($NilaiAkhir,2);
	// 	echo "<td style='text-align:center; vertical-align:middle;'>";
	// 	echo "<input id = 'KodeNisbiMahasiswa' name='KodeNisbiMahasiswa[]' type='text' readonly value='$KodeNisbi' required style='cursor:not-allowed; background-color:#eee; height: 30px;
	// 	font-size: 12px; line-height: 18px; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; -webkit-appearance: none; border: 1px solid #D5D5D5;
	// 	background: #F9F9F9; opacity:1; width:50px; text-align:center; font-weight:bold; border-radius:2px; color:grey;'/>";
	// 	echo "</td>";
	//
	// 	mysqli_close($MySQLi);
	// 	echo "</tr>";
	// }
	// echo "</tbody></table>";
}
?>
