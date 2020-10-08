<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'TanggalBeli',
		2 => 'TanggalTerima',
		3 => 'Supplier',
		4 => 'Karyawan',
		5 => 'Status',
		6 => 'View',
	);

	// Ambil Semua Baris Data
	$sql = "SELECT DISTINCT p.Nomor as 'Nomor', pp.Tanggal as 'TanggalBeli', p.Tanggal as 'TanggalTerima', s.Nama as 'Supplier',
	u.Nama as 'Karyawan', pp.Status as 'Status', p.Nomor as 'View'
	FROM pesanpembelian pp, penerimaan p, supplier s, user u
	WHERE pp.Nomor = p.NomorPesanPembelian and pp.SupplierID = s.ID and pp.UserID = u.IDUser and pp.Status = 1";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT p.Nomor as 'Nomor', pp.Tanggal as 'TanggalBeli', p.Tanggal as 'TanggalTerima', s.Nama as 'Supplier',
	u.Nama as 'Karyawan',  pp.Status as 'Status', p.Nomor as 'View'
	FROM pesanpembelian pp, penerimaan p, supplier s, user u
	WHERE pp.Nomor = p.NomorPesanPembelian and pp.SupplierID = s.ID and pp.UserID = u.IDUser and pp.Status = 1";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( pp.Nomor LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR pp.Tanggal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR p.Tanggal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR s.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR u.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR pp.Status LIKE '%".$requestData['search']['value']."%' ";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
				if ($row["Status"] == 0)
			$row["Status"] = 'Belum Datang';
		else
			$row["Status"] = 'Sudah Datang';

		$tanggalBeli = $row["TanggalBeli"];
		$tanggalBeliBaru = date("d-m-Y", strtotime($tanggalBeli));
		$tanggalTerima = $row["TanggalTerima"];
		$tanggalTerimaBaru = date("d-m-Y", strtotime($tanggalTerima));

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $tanggalBeliBaru;
		$nestedData[] = $tanggalTerimaBaru;
		$nestedData[] = $row["Supplier"];
		$nestedData[] = $row["Karyawan"];
		$nestedData[] = $row["Status"];
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
