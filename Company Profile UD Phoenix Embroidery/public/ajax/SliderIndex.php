<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'ID',
		1 => 'SliderName',
		2 => 'View',
		3 => 'Edit',
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Slider.ID AS 'ID', Slider.ID AS 'View', Slider.ID AS 'Edit', Slider.Nama AS 'Name' FROM Slider";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Slider.ID AS 'ID', Slider.ID AS 'View', Slider.ID AS 'Edit', Slider.Nama AS 'Name' FROM Slider";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Slider.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Slider.Nama LIKE '%".$requestData['search']['value']."%' )";
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
