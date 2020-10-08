<?php
if(isset($_GET['kodeMkBuka'])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);

	$QueryNPKKoordinator = "SELECT MkBuka.NPK AS 'NPKKoordinator' FROM MkBuka WHERE MkBuka.KodeMkBuka = '$Kode' AND MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
	$HasilQueryNPKKoordinator = $MySQLi->query($QueryNPKKoordinator);
	$Hasil=$HasilQueryNPKKoordinator->fetch_assoc();
	$NPKKoordinator = $Hasil['NPKKoordinator'] ;

	$QueryKPKoordinator = "SELECT DosenAjarMk.KP AS 'KPKoordinator' FROM DosenAjarMk WHERE DosenAjarMk.KodeMkBuka = '$Kode' AND DosenAjarMk.NPK = '$NPKKoordinator'";
	$HasilQueryKPKoordinator = $MySQLi->query($QueryKPKoordinator);
	$Hasil=$HasilQueryKPKoordinator->fetch_assoc();
	$KPKoordinator = $Hasil['KPKoordinator'];

	mysqli_close($MySQLi);

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;

	$columns = array(
	// Nama Judul
		0 =>'Jenis',
		1 => 'Bobot',
		2 => 'DosenPembuat',
		3 => 'Status'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', BAAK.Karyawan.Nama AS 'DosenPembuat', Nilai.Status AS 'Status'
	FROM Nilai INNER JOIN BAAK.Karyawan ON Nilai.DosenPembuat = BAAK.Karyawan.NPK WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPKoordinator' AND Nilai.Syarat = 1";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Nilai.Jenis AS 'Jenis', Nilai.Bobot AS 'Bobot', BAAK.Karyawan.Nama AS 'DosenPembuat', Nilai.Status AS 'Status'
	FROM Nilai INNER JOIN BAAK.Karyawan ON Nilai.DosenPembuat = BAAK.Karyawan.NPK WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KPKoordinator' AND Nilai.Syarat = 1";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" AND ( Nilai.Jenis LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Nilai.Bobot LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR BAAK.Karyawan.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Nilai.Status LIKE '%".$requestData['search']['value']."%' )";
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
