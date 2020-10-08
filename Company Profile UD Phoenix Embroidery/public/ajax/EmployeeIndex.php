<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'ID',
		1 => 'NIP',
		2 => 'Name',
		3 => 'Email',
		4 => 'Status',
		5 => 'View',
		6 => 'Change',
	);

	// Ambil Semua Baris Data
	$sql = "SELECT User.ID AS 'ID', User.Name AS 'Name', User.Email AS 'Email', User.NIP AS 'NIP',
	User.IsActive AS 'Status', User.ID AS 'View', User.ID AS 'Change' FROM User";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT User.ID AS 'ID', User.Name AS 'Name', User.Email AS 'Email', User.NIP AS 'NIP',
	User.IsActive AS 'Status', User.ID AS 'View', User.ID AS 'Change' FROM User";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( User.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Name LIKE '%".$requestData['search']['value']."%'";
		$sql.=" OR User.Email LIKE '%".$requestData['search']['value']."%'";
		$sql.=" OR User.NIP LIKE '%".$requestData['search']['value']."%'";
		$sql.=" OR User.IsActive LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["Status"] == 1)
			$row["Status"] = 'Active';
		else
			$row["Status"] = 'Inactive';

		$nestedData=array();
		$nestedData[] = $row["ID"];
		$nestedData[] = $row["NIP"];
		$nestedData[] = $row["Name"];
		$nestedData[] = $row["Email"];
		$nestedData[] = $row["Status"];
		$nestedData[] = $row["View"];
		$nestedData[] = $row["Change"];
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
