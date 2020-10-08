<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Ukuran_Sepatu',
		2 => 'isDelete',
		3 => 'View',
		4 => 'Edit'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT SizeOrBox.ID AS 'Nomor', SizeOrBox.Nama AS 'Ukuran_Sepatu', SizeOrBox.isDelete AS 'isDelete', SizeOrBox.ID AS 'View', SizeOrBox.ID AS 'Edit' FROM SizeOrBox";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT SizeOrBox.ID AS 'Nomor', SizeOrBox.Nama AS 'Ukuran_Sepatu', SizeOrBox.isDelete AS 'isDelete', SizeOrBox.ID AS 'View', SizeOrBox.ID AS 'Edit' FROM SizeOrBox";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( SizeSepatu.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR SizeSepatu.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR SizeSepatu.isDelete LIKE '%".$requestData['search']['value']."%' ";
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
		$nestedData[] = $row["Ukuran_Sepatu"];
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
