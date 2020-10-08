<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDKategori',
		1 => 'NamaKategori',
		2 => 'StatusTerdaftar',
		3 => 'Detail',
		4 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Kategoris.IDKategori AS IDKategori, 
				Kategoris.Nama AS NamaKategori, 
	        	Kategoris.StatusTerdaftar AS StatusTerdaftar, 
	        	Kategoris.IDKategori AS Detail, 
	        	Kategoris.IDKategori AS Ubah 
	        FROM Kategoris";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Kategoris.IDKategori AS IDKategori, 
				Kategoris.Nama AS NamaKategori, 
	        	Kategoris.StatusTerdaftar AS StatusTerdaftar, 
	        	Kategoris.IDKategori AS Detail, 
	        	Kategoris.IDKategori AS Ubah 
	        FROM Kategoris";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Kategoris.IDKategori LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Kategoris.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Kategoris.StatusTerdaftar LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["StatusTerdaftar"] == "1") {
			$StatusTerdaftar = "Tersedia";
		} else {
			$StatusTerdaftar = "Kosong";
		}

		$nestedData=array();
		$nestedData[] = $row["IDKategori"];
		$nestedData[] = $row["NamaKategori"];
		$nestedData[] = $StatusTerdaftar;
		$nestedData[] = $row["Detail"];
		$nestedData[] = $row["Ubah"];
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
