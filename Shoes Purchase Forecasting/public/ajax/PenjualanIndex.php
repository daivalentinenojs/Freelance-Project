<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'TanggalPesan',
		2 => 'TanggalPengiriman',
		3 => 'Customer',
		4 => 'Karyawan',
		5 => 'Status',
		6 => 'View',
	);

	// Ambil Semua Baris Data
	$sql = "SELECT DISTINCT pj.Nomor as 'Nomor', pm.Tanggal as 'TanggalPesan', pj.Tanggal as 'TanggalPengiriman', c.NamaToko as 'Customer', u.Nama as 'Karyawan', pm.Status as 'Status', pj.Nomor as 'View'
	FROM pemesanan pm, penjualan pj, customer c, user u
	WHERE pm.Nomor = pj.NomorPemesanan and pm.CustomerID = c.ID and pm.UserID = u.IDUser and pm.Status = 1";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT DISTINCT pj.Nomor as 'Nomor', pm.Tanggal as 'TanggalPesan', pj.Tanggal as 'TanggalPengiriman', c.NamaToko as 'Customer', u.Nama as 'Karyawan', pm.Status as 'Status', pj.Nomor as 'View'
	FROM pemesanan pm, penjualan pj, customer c, user u
	WHERE pm.Nomor = pj.NomorPemesanan and pm.CustomerID = c.ID and pm.UserID = u.IDUser and pm.Status = 1";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( pj.Nomor LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR pm.TanggalPesan LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR pj.TanggalPengiriman LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR c.NamaToko LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR u.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR pm.Status LIKE '%".$requestData['search']['value']."%' ";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
				if ($row["Status"] == 0)
			$row["Status"] = 'Belum Dikirim';
		else
			$row["Status"] = 'Sudah Dikirim';

		$tanggalPesan = $row["TanggalPesan"];
		$tanggalPesanBaru = date("d-m-Y", strtotime($tanggalPesan));
		$tanggalKirim = $row["TanggalPengiriman"];
		$tanggalKirimBaru = date("d-m-Y", strtotime($tanggalKirim));

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $tanggalPesanBaru;
		$nestedData[] = $tanggalKirimBaru;
		$nestedData[] = $row["Customer"];
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
