<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK'])) // Checked V X
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

	$QueryCheckBatasNTS = "SELECT COUNT(BAAK.SemesterAktif.BatasInputNTS) AS 'BatasInputNTS' FROM BAAK.SemesterAktif
	WHERE now() < BAAK.SemesterAktif.BatasInputNTS AND BAAK.SemesterAktif.ThnAkademik = '$ThnAkademik' AND BAAK.SemesterAktif.Semester = '$Semester'
	GROUP BY BAAK.SemesterAktif.ThnAkademik, BAAK.SemesterAktif.Semester";

	$HasilQueryCheckBatasNTS = mysqli_query($MySQLi, $QueryCheckBatasNTS);
	$CheckBatasNTS = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckBatasNTS))
	{
		$CheckBatasNTS[] = $Hasil;
	}

	if(empty($CheckBatasNTS[0]['BatasInputNTS'])) {
			$CheckBatasNTS[0]['BatasInputNTS'] = 0;
	}

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);


	$requestData= $_REQUEST;

	$columns = array(
	// Nama Judul
		0 => 'Jenis',
		1 => 'Bobot',
		2 => 'DosenPembuat',
		3 => 'Status',
		4 => 'KodeNilai'
	);

	// Ambil Semua Baris Data
	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	{
		$sql = "SELECT Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', BAAK.Karyawan.Nama AS 'DosenPembuat', Nilai.Status AS 'Status', Nilai.KodeNilai AS 'KodeNilai'
		FROM Nilai INNER JOIN BAAK.Karyawan ON Nilai.DosenPembuat = BAAK.Karyawan.NPK WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Syarat = 1 AND (Nilai.Status = 'BelumInput' OR Nilai.Status = 'Daftar')";
	}
	else
	{
		$sql = "SELECT Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', BAAK.Karyawan.Nama AS 'DosenPembuat', Nilai.Status AS 'Status', Nilai.KodeNilai AS 'KodeNilai'
		FROM Nilai INNER JOIN BAAK.Karyawan ON Nilai.DosenPembuat = BAAK.Karyawan.NPK WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Syarat = 1 AND
		(Nilai.Status = 'BelumInput' OR Nilai.Status = 'Daftar') AND RIGHT(Nilai.Jenis, -3) = 'UAS'";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	if ($CheckBatasNTS[0]['BatasInputNTS'] == 1)
	{
		$sql = "SELECT Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', BAAK.Karyawan.Nama AS 'DosenPembuat', Nilai.Status AS 'Status', Nilai.KodeNilai AS 'KodeNilai'
		FROM Nilai INNER JOIN BAAK.Karyawan ON Nilai.DosenPembuat = BAAK.Karyawan.NPK WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Syarat = 1 AND (Nilai.Status = 'BelumInput' OR Nilai.Status = 'Daftar')";
	}
	else
	{
		$sql = "SELECT Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', BAAK.Karyawan.Nama AS 'DosenPembuat', Nilai.Status AS 'Status', Nilai.KodeNilai AS 'KodeNilai'
		FROM Nilai INNER JOIN BAAK.Karyawan ON Nilai.DosenPembuat = BAAK.Karyawan.NPK WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP' AND Nilai.Syarat = 1 AND
		(Nilai.Status = 'BelumInput' OR Nilai.Status = 'Daftar') AND RIGHT(Nilai.Jenis, -3) = 'UAS'";
	}

	if( !empty($requestData['search']['value']) ) {
		$sql.=" AND ( Nilai.Jenis LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Nilai.Status LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Nilai.Bobot LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR BAAK.Karyawan.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Nilai.KodeNilai LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

	$query=mysqli_query($MySQLi, $sql);

	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["Status"] == 'TelahDiUpload')
			$row["Status"] = 'Telah Di Upload';
		else if ($row["Status"] == 'TelahDiKalkulasi')
			$row["Status"] = 'Telah Di Kalkulasi';
		else if ($row["Status"] == 'BelumInput')
			$row["Status"] = 'Belum Input';
		else if ($row["Status"] == 'SudahUpload')
			$row["Status"] = 'Sudah Upload';

		$nestedData=array();
		$nestedData[] = $row["Jenis"];
		$nestedData[] = $row["Bobot"];
		$nestedData[] = $row["DosenPembuat"];
		$nestedData[] = $row["Status"];
		$nestedData[] = $row["KodeNilai"];
		$data[] = $nestedData;
	}

	$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $data
				);

	echo json_encode($json_data);
}
?>
