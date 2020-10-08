<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'NoNotaStokOpname',
		1 => 'Tanggal',
		2 => 'Nama',
		3 => 'Detail',
		4 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT StokOpnames.NoNotaStokOpname AS NoNotaStokOpname, 
				StokOpnames.Tanggal AS Tanggal, 
				Karyawans.Nama AS Nama, 
				StokOpnames.NoNotaStokOpname AS Detail,
				StokOpnames.NoNotaStokOpname AS Ubah
			FROM StokOpnames INNER JOIN Karyawans ON StokOpnames.KaryawanID = Karyawans.IDKaryawan";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT StokOpnames.NoNotaStokOpname AS NoNotaStokOpname, 
				StokOpnames.Tanggal AS Tanggal, 
				Karyawans.Nama AS Nama, 
				StokOpnames.NoNotaStokOpname AS Detail,
				StokOpnames.NoNotaStokOpname AS Ubah
			FROM StokOpnames INNER JOIN Karyawans ON StokOpnames.KaryawanID = Karyawans.IDKaryawan";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( StokOpnames.NoNotaStokOpname LIKE '%".$requestData['search']['value']."%' ";	
		$sql.=" OR StokOpnames.Tanggal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Nama LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$nestedData=array();
		$nestedData[] = $row["NoNotaStokOpname"];
		$nestedData[] = $row["Tanggal"];
		$nestedData[] = $row["Nama"];
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
