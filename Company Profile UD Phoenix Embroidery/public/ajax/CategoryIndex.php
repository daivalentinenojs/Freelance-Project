<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'ID',
		1 => 'CategoryName',
		2 => 'View',
		3 => 'Edit',
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Category.ID AS 'ID', Category.ID AS 'View', Category.ID AS 'Edit', Category.Name AS 'Name', Category.Description AS 'Description' FROM Category";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Category.ID AS 'ID', Category.ID AS 'View', Category.ID AS 'Edit', Category.Name AS 'Name', Category.Description AS 'Description' FROM Category";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Category.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Category.Name LIKE '%".$requestData['search']['value']."%'";
		$sql.=" OR Category.Description LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$nestedData=array();
		$nestedData[] = $row["ID"];
		$nestedData[] = $row["Name"];
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
