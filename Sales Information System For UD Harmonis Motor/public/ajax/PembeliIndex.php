<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDPembeli',
		1 => 'Nama',
		2 => 'NoTelepon',
		3 => 'Kota',
		4 => 'Bank',
		5 => 'StatusLangganan',
		6 => 'StatusJual',
		7 => 'StatusTerdaftar',
		8 => 'Detail',
		9 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Pembelis.IDPembeli AS IDPembeli, 
				Pembelis.Nama AS Nama, 
				Pembelis.NoTelepon AS NoTelepon, 
				Pembelis.Kota AS Kota, 
				Pembelis.Bank AS Bank, 
				Pembelis.StatusLangganan AS StatusLangganan, 
				Pembelis.StatusJual AS StatusJual, 
				Pembelis.StatusTerdaftar AS StatusTerdaftar, 
				Pembelis.IDPembeli AS Detail, 
				Pembelis.IDPembeli AS Ubah
			FROM Pembelis";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Pembelis.IDPembeli AS IDPembeli, 
				Pembelis.Nama AS Nama, 
				Pembelis.NoTelepon AS NoTelepon, 
				Pembelis.Kota AS Kota, 
				Pembelis.Bank AS Bank, 
				Pembelis.StatusLangganan AS StatusLangganan, 
				Pembelis.StatusJual AS StatusJual, 
				Pembelis.StatusTerdaftar AS StatusTerdaftar, 
				Pembelis.IDPembeli AS Detail, 
				Pembelis.IDPembeli AS Ubah
			FROM Pembelis";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Pembelis.IDPembeli LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.NoTelepon LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.Kota LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.Bank LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.StatusLangganan LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.StatusJual LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.StatusTerdaftar LIKE '%".$requestData['search']['value']."%') ";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["StatusLangganan"] == "1") {
			$StatusLangganan = "Langganan";
		} else {
			$StatusLangganan = "Tidak Langganan";
		}

		if ($row["StatusTerdaftar"] == "1") {
			$StatusTerdaftar = "Aktif";
		} else {
			$StatusTerdaftar = "Tidak Aktif";
		}

		if ($row["StatusJual"] == "0") {
			$StatusJual = "Hutang";
		} else {
			$StatusJual = "Lunas";
		} 

		$nestedData=array();
		$nestedData[] = $row["IDPembeli"];
		$nestedData[] = $row["Nama"];
		$nestedData[] = $row["NoTelepon"];
		$nestedData[] = $row["Kota"];
		$nestedData[] = $row["Bank"];
		$nestedData[] = $StatusLangganan;
		$nestedData[] = $StatusJual;
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
