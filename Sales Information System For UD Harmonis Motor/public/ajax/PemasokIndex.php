<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDPemasok',
		1 => 'NoRekening',
		2 => 'NamaRekening',
		3 => 'Bank',
		4 => 'Alamat',
		5 => 'NoTelepon',
		6 => 'StatusBeli',
		7 => 'StatusTerdaftar',
		8 => 'Detail',
		9 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Pemasoks.IDPemasok AS IDPemasok, 
				Pemasoks.NoRekening AS NoRekening, 
	        	Pemasoks.NamaRekening AS NamaRekening, 
	        	Pemasoks.Bank AS Bank, 
	        	Pemasoks.Alamat AS Alamat, 
	        	Pemasoks.NoTelepon AS NoTelepon, 
				Pemasoks.StatusBeli AS StatusBeli, 
				Pemasoks.StatusTerdaftar AS StatusTerdaftar, 
				Pemasoks.IDPemasok AS Detail, 
				Pemasoks.IDPemasok AS Ubah
			FROM Pemasoks";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Pemasoks.IDPemasok AS IDPemasok, 
				Pemasoks.NoRekening AS NoRekening, 
	        	Pemasoks.NamaRekening AS NamaRekening, 
	        	Pemasoks.Bank AS Bank, 
	        	Pemasoks.Alamat AS Alamat, 
	        	Pemasoks.NoTelepon AS NoTelepon, 
				Pemasoks.StatusBeli AS StatusBeli, 
				Pemasoks.StatusTerdaftar AS StatusTerdaftar, 
				Pemasoks.IDPemasok AS Detail, 
				Pemasoks.IDPemasok AS Ubah
			FROM Pemasoks";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Pemasoks.IDPemasok LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.NoRekening LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.NamaRekening LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.Bank LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.Alamat LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.NoTelepon LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.StatusBeli LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.StatusTerdaftar LIKE '%".$requestData['search']['value']."%') ";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["StatusTerdaftar"] == "1") {
			$StatusTerdaftar = "Aktif";
		} else {
			$StatusTerdaftar = "Tidak Aktif";
		}

		if ($row["StatusBeli"] == "0") {
			$StatusBeli = "Hutang";
		} else {
			$StatusBeli = "Lunas";
		} 

		$nestedData=array();
		$nestedData[] = $row["IDPemasok"];
		$nestedData[] = $row["NoRekening"];
		$nestedData[] = $row["NamaRekening"];
		$nestedData[] = $row["Bank"];
		$nestedData[] = $row["Alamat"];
		$nestedData[] = $row["NoTelepon"];
		$nestedData[] = $StatusBeli;
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
