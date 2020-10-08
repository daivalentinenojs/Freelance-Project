<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Merek',
		2 => 'Tipe',
		3 => 'isDelete',
		4 => 'View',
		5 => 'Edit'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT t.ID AS 'Nomor', ms.Nama AS 'Merek', t.Nama AS 'Tipe', t.isDelete AS 'isDelete',
	t.ID AS 'View', t.ID AS 'Edit' FROM Tipe t, MerekSepatu ms Where t.MerekSepatuID = ms.ID";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT t.ID AS 'Nomor', ms.Nama AS 'Merek', t.Nama AS 'Tipe', t.isDelete AS 'isDelete',
	t.ID AS 'View', t.ID AS 'Edit' FROM Tipe t, MerekSepatu ms Where t.MerekSepatuID = ms.ID";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( t.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR ms.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR t.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR t.isDelete LIKE '%".$requestData['search']['value']."%' ";
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
		$nestedData[] = $row["Merek"];
		$nestedData[] = $row["Tipe"];
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
