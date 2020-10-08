<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'NamaBox',
		2 => 'TanggalBuka',
		3 => 'JumlahBuka',
		4 => 'View'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT k.ID as 'Nomor', concat(m.Nama, ' ', t.Nama, ' ', sob.Nama, ' ', w.Nama) as 'NamaBox', k.Tanggal as 'TanggalBuka', k.Kuantiti as 'JumlahBuka', k.ID as 'View'
	FROM konversi k, detailsepatu ds, tipe t, mereksepatu m, warna w, sizeorbox sob
	WHERE k.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = m.ID and ds.WarnaID = w.ID and ds.SizeorBoxID = sob.ID";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT k.ID as 'Nomor', concat(m.Nama, ' ', t.Nama, ' ', sob.Nama, ' ', w.Nama) as 'NamaBox', k.Tanggal as 'TanggalBuka', k.Kuantiti as 'JumlahBuka', k.ID as 'View'
	FROM konversi k, detailsepatu ds, tipe t, mereksepatu m, warna w, sizeorbox sob
	WHERE k.DetailSepatuID = ds.ID and ds.TipeID = t.ID and t.MerekSepatuID = m.ID and ds.WarnaID = w.ID and ds.SizeorBoxID = sob.ID";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Jabatan.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Jabatan.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Jabatan.isDelete LIKE '%".$requestData['search']['value']."%' ";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$tanggal = $row["TanggalBuka"];
		$tanggalBaru = date("d-m-Y", strtotime($tanggal));

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $row["NamaBox"];
		$nestedData[] = $tanggalBaru;
		$nestedData[] = $row["JumlahBuka"];
		$nestedData[] = $row["View"];
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
