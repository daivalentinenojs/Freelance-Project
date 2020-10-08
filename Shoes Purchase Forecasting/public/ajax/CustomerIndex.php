<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'NamaPemilik',
		2 => 'NamaToko',
		3 => 'Alamat',
		4 => 'Telepon',
		5 => 'isDelete',
		6 => 'View',
		7 => 'Edit'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Customer.ID AS 'Nomor', Customer.NamaPemilik AS 'NamaPemilik', Customer.NamaToko AS 'NamaToko', Customer.Alamat
	AS 'Alamat', Customer.Telepon AS 'Telepon', Customer.isDelete AS 'isDelete', Customer.ID AS 'View', Customer.ID AS 'Edit' FROM Customer";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Customer.ID AS 'Nomor', Customer.NamaPemilik AS 'NamaPemilik', Customer.NamaToko AS 'NamaToko', Customer.Alamat
	AS 'Alamat', Customer.Telepon AS 'Telepon', Customer.isDelete AS 'isDelete', Customer.ID AS 'View', Customer.ID AS 'Edit' FROM Customer";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Customer.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Customer.NamaPemilik LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Customer.NamaToko LIKE '%".$requestData['search']['value']."%' )";
		$sql.=" OR Customer.Alamat LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Customer.Telepon LIKE '%".$requestData['search']['value']."%' )";
		$sql.=" OR Customer.isDelete LIKE '%".$requestData['search']['value']."%' ";
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
		$nestedData[] = $row["NamaPemilik"];
		$nestedData[] = $row["NamaToko"];
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
