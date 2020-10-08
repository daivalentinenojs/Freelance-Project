<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Merek',
		2 => 'Boxsize',
		3 => 'View'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT dsc.BoxID as 'Nomor', concat(ms.Nama, ' ', t.Nama, ' ', w.Nama) as 'Merek', sob.Nama as 'Boxsize', dsc.BoxID as 'View'
	FROM  detailsepatucatatdetailsepatu dsc, detailsepatu ds, sizeorbox sob, tipe t, mereksepatu ms, warna w
	WHERE ds.SizeorBoxID = sob.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID and dsc.BoxID = ds.ID  and w.ID = ds.WarnaID group by dsc.BoxID";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT dsc.BoxID as 'Nomor', concat(ms.Nama, ' ', t.Nama, ' ', w.Nama) as 'Merek', sob.Nama as 'Boxsize', dsc.BoxID as 'View'
	FROM  detailsepatucatatdetailsepatu dsc, detailsepatu ds, sizeorbox sob, tipe t, mereksepatu ms, warna w
	WHERE ds.SizeorBoxID = sob.ID and ds.TipeID = t.ID and t.MerekSepatuID = ms.ID and dsc.BoxID = ds.ID  and w.ID = ds.WarnaID group by dsc.BoxID";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( ds.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR ms.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR sob.Nama LIKE '%".$requestData['search']['value']."%' ";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		// 		if ($row["isDelete"] == 1)
		// 	$row["isDelete"] = 'Aktif';
		// else
		// 	$row["isDelete"] = 'Tidak Aktif';

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $row["Merek"];
		$nestedData[] = $row["Boxsize"];
		//$nestedData[] = $row["isDelete"];
		$nestedData[] = $row["View"];
		//$nestedData[] = $row["Edit"];
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
