<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'ID',
		1 => 'ProductName',
		2 => 'CategoryName',
		3 => 'Status',
		4 => 'View',
		5 => 'Change',
	);

	// Ambil Semua Baris Data
	$sql = "SELECT ProductXCategory.IDProductXCategory AS 'ID', Product.ID AS 'IDProduct', Product.Name AS 'ProductName', ProductXCategory.IsActive AS 'Status',
				Category.ID AS 'IDCategory', Category.Name AS 'CategoryName', Product.ProductFormat AS 'ProductFormat',
				ProductXCategory.IDProductXCategory AS 'View', ProductXCategory.IDProductXCategory AS 'Edit'
				FROM Product INNER JOIN ProductXCategory ON Product.ID = ProductXCategory.IDProduct
				INNER JOIN Category ON ProductXCategory.IDCategory = Category.ID";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT ProductXCategory.IDProductXCategory AS 'ID', Product.ID AS 'IDProduct', Product.Name AS 'ProductName', ProductXCategory.IsActive AS 'Status',
				Category.ID AS 'IDCategory', Category.Name AS 'CategoryName',
				ProductXCategory.IDProductXCategory AS 'View', ProductXCategory.IDProductXCategory AS 'Edit'
				FROM Product INNER JOIN ProductXCategory ON Product.ID = ProductXCategory.IDProduct
				INNER JOIN Category ON ProductXCategory.IDCategory = Category.ID";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Product.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Product.Name LIKE '%".$requestData['search']['value']."%'";
		$sql.=" OR ProductXCategory.IsActive LIKE '%".$requestData['search']['value']."%'";
		$sql.=" OR Category.ID LIKE '%".$requestData['search']['value']."%'";
		$sql.=" OR Category.Name LIKE '%".$requestData['search']['value']."%' )";
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
		$nestedData[] = $row["ProductName"];
		$nestedData[] = $row["CategoryName"];
		$nestedData[] = $row["Status"];
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
