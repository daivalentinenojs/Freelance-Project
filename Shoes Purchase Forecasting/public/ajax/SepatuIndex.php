<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Sepatu',
		2 => 'idDelete',
		3 => 'View',
		4 => 'Edit'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Mereksepatu.ID AS 'Nomor', Mereksepatu.Nama AS 'Sepatu', Mereksepatu.idDelete AS 'idDelete', Mereksepatu.ID AS 'View', Mereksepatu.ID AS 'Edit' FROM Mereksepatu";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Mereksepatu.ID AS 'Nomor', Mereksepatu.Nama AS 'Sepatu', Mereksepatu.idDelete AS 'idDelete', Mereksepatu.ID AS 'View', Mereksepatu.ID AS 'Edit' FROM Mereksepatu";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Sepatu.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Sepatu.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Sepatu.idDelete LIKE '%".$requestData['search']['value']."%' ";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
				if ($row["idDelete"] == 1)
			$row["idDelete"] = 'Aktif';
		else
			$row["idDelete"] = 'Tidak Aktif';

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $row["Sepatu"];
		$nestedData[] = $row["idDelete"];
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
