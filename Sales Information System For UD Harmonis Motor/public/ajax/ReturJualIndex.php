<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDReturJual',
		1 => 'Tanggal',
		2 => 'NamaKaryawan',
		3 => 'Detail',
		4 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT ReturJuals.IDReturJual AS IDReturJual, 
				ReturJuals.Tanggal AS Tanggal, 
				Karyawans.Nama AS NamaKaryawan, 
				ReturJuals.IDReturJual AS Detail,
				ReturJuals.IDReturJual AS Ubah
	        FROM ReturJuals INNER JOIN Karyawans ON ReturJuals.KaryawanID = Karyawans.IDKaryawan";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT ReturJuals.IDReturJual AS IDReturJual, 
				ReturJuals.Tanggal AS Tanggal, 
				Karyawans.Nama AS NamaKaryawan, 
				ReturJuals.IDReturJual AS Detail,
				ReturJuals.IDReturJual AS Ubah
	        FROM ReturJuals INNER JOIN Karyawans ON ReturJuals.KaryawanID = Karyawans.IDKaryawan";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( ReturJuals.IDReturJual LIKE '%".$requestData['search']['value']."%' ";	
		$sql.=" OR ReturJuals.Tanggal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Nama LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$nestedData=array();
		$nestedData[] = $row["IDReturJual"];
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
