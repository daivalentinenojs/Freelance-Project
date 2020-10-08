<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDReturBeli',
		1 => 'Tanggal',
		2 => 'NamaKaryawan',
		3 => 'Detail',
		4 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT ReturBelis.IDReturBeli AS IDReturBeli, 
				ReturBelis.Tanggal AS Tanggal, 
				Karyawans.Nama AS NamaKaryawan, 
				ReturBelis.IDReturBeli AS 'Detail',
				ReturBelis.IDReturBeli AS 'Ubah'
	        FROM ReturBelis INNER JOIN Karyawans ON ReturBelis.KaryawanID = Karyawans.IDKaryawan";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT ReturBelis.IDReturBeli AS IDReturBeli,
				ReturBelis.Tanggal AS Tanggal, 
				Karyawans.Nama AS NamaKaryawan, 
				ReturBelis.IDReturBeli AS 'Detail',
				ReturBelis.IDReturBeli AS 'Ubah'
	        FROM ReturBelis INNER JOIN Karyawans ON ReturBelis.KaryawanID = Karyawans.IDKaryawan";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( ReturBelis.IDReturBeli LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR ReturBelis.Tanggal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.NamaKaryawan LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$nestedData=array();
		$nestedData[] = $row["IDReturBeli"];
		$nestedData[] = $row["Tanggal"];
		$nestedData[] = $row["NamaKaryawan"];
		$nestedData[] = $row["Detail"];
		$nestedData[] = $row["Ubah"];
		$data[] = $nestedData;
	}


	$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $data
				);

	echo json_encode($json_data);
?>
