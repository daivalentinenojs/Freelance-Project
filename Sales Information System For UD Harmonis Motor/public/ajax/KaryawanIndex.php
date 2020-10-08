<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDKaryawan',
		1 => 'Nama',
		2 => 'Alamat',
		3 => 'Email',
		4 => 'NoTelepon',
		5 => 'StatusTerdaftar',
		6 => 'Detail',
		7 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Karyawans.IDKaryawan AS IDKaryawan, 
				Karyawans.Nama AS Nama, 
				Karyawans.Alamat AS Alamat, 
				Karyawans.Email AS Email, 
				Karyawans.NoTelepon AS NoTelepon, 
				Karyawans.StatusTerdaftar AS StatusTerdaftar, 
				Karyawans.IDKaryawan AS Detail, 
				Karyawans.IDKaryawan AS Ubah
			FROM Karyawans";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Karyawans.IDKaryawan AS IDKaryawan, 
				Karyawans.Nama AS Nama, 
				Karyawans.Alamat AS Alamat, 
				Karyawans.Email AS Email, 
				Karyawans.NoTelepon AS NoTelepon, 
				Karyawans.StatusTerdaftar AS StatusTerdaftar, 
				Karyawans.IDKaryawan AS Detail, 
				Karyawans.IDKaryawan AS Ubah
			FROM Karyawans";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Karyawans.IDKaryawan LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Alamat LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Email LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.NoTelepon LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.StatusTerdaftar LIKE '%".$requestData['search']['value']."%' )";
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

		$nestedData=array();
		$nestedData[] = $row["IDKaryawan"];
		$nestedData[] = $row["Nama"];
		$nestedData[] = $row["Alamat"];
		$nestedData[] = $row["Email"];
		$nestedData[] = $row["NoTelepon"];
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
