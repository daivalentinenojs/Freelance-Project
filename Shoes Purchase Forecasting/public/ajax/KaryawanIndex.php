<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Nama',
		2 => 'Email',
		3 => 'Jabatan',
		4 => 'Alamat',
		5 => 'Telepon',
		6 => 'TanggalMulaiKerja',
		7 => 'isDelete',
		8 => 'View',
		9 => 'Edit',


	);

	// Ambil Semua Baris Data
	$sql = "SELECT u.IDUser AS 'Nomor', u.Nama AS 'Nama', u.Email AS 'Email', j.Nama AS 'Jabatan', u.Alamat AS 'Alamat', u.TanggalMulaiKerja AS 'TanggalMulaiKerja',
	u.Telepon AS 'Telepon', u.isDelete AS 'isDelete', u.IDUser AS 'View', u.IDUser AS 'Edit' FROM User u, Jabatan j Where u.JabatanID = j.ID";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT u.IDUser AS 'Nomor', u.Nama AS 'Nama', u.Email AS 'Email', j.Nama AS 'Jabatan', u.Alamat AS 'Alamat', u.TanggalMulaiKerja AS 'TanggalMulaiKerja',
	u.Telepon AS 'Telepon', u.isDelete AS 'isDelete', u.IDUser AS 'View', u.IDUser AS 'Edit' FROM User u, Jabatan j Where u.JabatanID = j.ID";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( User.IDUser LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Email LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.JabatanID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Alamat LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.Telepon LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.TanggalMulaiKerja LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR User.isDelete LIKE '%".$requestData['search']['value']."%' )";
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
		$tanggal = $row["TanggalMulaiKerja"];
		$tanggalBaru = date("d-m-Y", strtotime($tanggal));
		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $row["Nama"];
		$nestedData[] = $row["Email"];
		$nestedData[] = $row["Jabatan"];
		$nestedData[] = $row["Alamat"];
		$nestedData[] = $row["Telepon"];
		$nestedData[] = $tanggalBaru;
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
