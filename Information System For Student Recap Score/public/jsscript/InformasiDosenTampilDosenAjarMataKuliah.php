<?php
if(isset($_GET['NPKDosen']) AND isset($_GET['KodeTahunSemester'])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$NPK = $MySQLi->real_escape_string($_GET['NPKDosen']);
	$KodeTahunSemester = $MySQLi->real_escape_string($_GET['KodeTahunSemester']);
	$Hasil = explode("|", $KodeTahunSemester);
	$Semester = $Hasil[0];
	$Tahun = $Hasil[1];

	$requestData= $_REQUEST;

	$columns = array(
	// Nama Judul
		0 => 'NamaMataKuliah',
		1 => 'KP',
		2 => 'SKS'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT MataKuliah.Nama AS 'NamaMataKuliah', DosenAjarMk.KP AS 'KP', MataKuliah.SKS AS 'SKS'
	FROM MkBuka INNER JOIN DosenAjarMk ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk
	WHERE MkBuka.ThnAkademik = '$Tahun' AND MkBuka.Semester = '$Semester' AND DosenAjarMk.NPK = '$NPK'";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT MataKuliah.Nama AS 'NamaMataKuliah', DosenAjarMk.KP AS 'KP', MataKuliah.SKS AS 'SKS'
	FROM MkBuka INNER JOIN DosenAjarMk ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk
	WHERE MkBuka.ThnAkademik = '$Tahun' AND MkBuka.Semester = '$Semester' AND DosenAjarMk.NPK = '$NPK'";	if( !empty($requestData['search']['value']) ) {
		$sql.=" AND ( MataKuliah.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR DosenAjarMk.KP LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR MataKuliah.SKS LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

	$query=mysqli_query($MySQLi, $sql);

	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$nestedData=array();
		$nestedData[] = $row["NamaMataKuliah"];
		$nestedData[] = $row["KP"];
		$nestedData[] = $row["SKS"];
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
