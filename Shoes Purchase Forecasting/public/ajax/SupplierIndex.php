<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Nama',
		2 => 'Alamat',
		3 => 'Telepon',
		4 => 'isDelete',
		5 => 'View',
		6 => 'Edit',


	);

	// Ambil Semua Baris Data
	$sql = "SELECT Supplier.ID AS 'Nomor', Supplier.Nama AS 'Nama',  Supplier.Alamat AS 'Alamat', Supplier.Telepon AS 'Telepon',
	Supplier.isDelete AS 'isDelete', Supplier.ID AS 'View', Supplier.ID AS 'Edit' FROM Supplier";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Supplier.ID AS 'Nomor', Supplier.Nama AS 'Nama',  Supplier.Alamat AS 'Alamat', Supplier.Telepon AS 'Telepon',
	Supplier.isDelete AS 'isDelete', Supplier.ID AS 'View', Supplier.ID AS 'Edit' FROM Supplier";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( User.IDUser LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Alamat LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Telepon LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.isDelete LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["isDelete"] == 1)
			$row["isDelete"] = 'Aktif';
		else
			$row["isDelete"] = 'Tidak Aktif';

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $row["Nama"];
		$nestedData[] = $row["Alamat"];
		$nestedData[] = $row["Telepon"];
		$nestedData[] = $row["isDelete"];
		$nestedData[] = $row["View"];
		$nestedData[] = $row["Edit"];
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
