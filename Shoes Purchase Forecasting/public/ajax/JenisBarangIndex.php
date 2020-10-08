<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'JenisBarang',
		2 => 'isDelete',
		3 => 'View',
		4 => 'Edit'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT JenisBarang.ID AS 'Nomor', JenisBarang.Nama AS 'JenisBarang', JenisBarang.isDelete AS 'isDelete', JenisBarang.ID AS 'View', JenisBarang.ID AS 'Edit' FROM JenisBarang";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT JenisBarang.ID AS 'Nomor', JenisBarang.Nama AS 'JenisBarang', JenisBarang.isDelete AS 'isDelete', JenisBarang.ID AS 'View', JenisBarang.ID AS 'Edit' FROM JenisBarang";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( JenisBarang.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR JenisBarang.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR JenisBarang.isDelete LIKE '%".$requestData['search']['value']."%' ";
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
		$nestedData[] = $row["JenisBarang"];
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
