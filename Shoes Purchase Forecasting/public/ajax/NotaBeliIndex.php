<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Tanggal',
		2 => 'Supplier',
		3 => 'Karyawan',
		4 => 'Total',
		5 => 'Status',
		6 => 'View',
	);

	// Ambil Semua Baris Data
	$sql = "SELECT pp.Nomor AS 'Nomor', pp.Tanggal AS 'Tanggal', s.Nama AS 'Supplier', u.Nama AS 'Karyawan',
	pp.Total as 'Total', pp.Status as 'Status', pp.Nomor as 'View' FROM PesanPembelian pp, Supplier s, User u
	Where pp.SupplierID = s.id and pp.UserID = u.IDUser";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT pp.Nomor AS 'Nomor', pp.Tanggal AS 'Tanggal', s.Nama AS 'Supplier', u.Nama AS 'Karyawan',
	pp.Total as 'Total', pp.Status as 'Status', pp.Nomor as 'View' FROM PesanPembelian pp, Supplier s, User u
	Where pp.SupplierID = s.id and pp.UserID = u.IDUser";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( pp.Nomor LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR pp.Tanggal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR s.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR u.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR pp.Total LIKE '%".$requestData['search']['value']."%' ";
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

		$tanggal = $row["Tanggal"];
		$tanggalBaru = date("d-m-Y", strtotime($tanggal));

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $tanggalBaru;
		$nestedData[] = $row["Supplier"];
		$nestedData[] = $row["Karyawan"];
		$nestedData[] = 'Rp '.formatMoney($row["Total"]);
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

	function formatMoney($number, $fractional = false){
		if($fractional){
			$number= sprintf('%.2f', $number);
		}
		while(true){
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if ($replaced != $number){
				$number = $replaced;
			}
			else{
				break;
			}
		}
		return $number;
	}
?>
