<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'NoNotaJual',
		1 => 'TanggalBuat',
		2 => 'TanggalBayar',
		3 => 'TotalAkhir',
		4 => 'NamaPembeli',
		5 => 'Kota',
		6 => 'NamaKaryawan',
		7 => 'StatusJual',
		8 => 'Detail',
		9 => 'UbahPembayaran'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT NotaJuals.NoNotaJual AS NoNotaJual, 
				NotaJuals.TanggalBuat AS TanggalBuat, 
				NotaJuals.TanggalBayar AS TanggalBayar, 
				NotaJuals.Total AS TotalAkhir, 
				NotaJuals.StatusJual AS StatusJual, 
				Pembelis.Nama AS NamaPembeli, 
				Pembelis.Kota AS Kota, 
				Karyawans.Nama AS NamaKaryawan, 
				NotaJuals.NoNotaJual AS Detail,
				NotaJuals.NoNotaJual AS UbahPembayaran
	        FROM Karyawans INNER JOIN NotaJuals ON Karyawans.IDKaryawan = NotaJuals.KaryawanID 
	        	INNER JOIN Pembelis ON NotaJuals.PembeliID = Pembelis.IDPembeli";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT NotaJuals.NoNotaJual AS NoNotaJual, 
				NotaJuals.TanggalBuat AS TanggalBuat, 
				NotaJuals.TanggalBayar AS TanggalBayar, 
				NotaJuals.Total AS TotalAkhir, 
				NotaJuals.StatusJual AS StatusJual, 
				Pembelis.Nama AS NamaPembeli, 
				Pembelis.Kota AS Kota, 
				Karyawans.Nama AS NamaKaryawan, 
				NotaJuals.NoNotaJual AS Detail,
				NotaJuals.NoNotaJual AS UbahPembayaran
	        FROM Karyawans INNER JOIN NotaJuals ON Karyawans.IDKaryawan = NotaJuals.KaryawanID 
	        	INNER JOIN Pembelis ON NotaJuals.PembeliID = Pembelis.IDPembeli";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( NotaJuals.NoNotaJual LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaJuals.TanggalBuat LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaJuals.TanggalBayar LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaJuals.Total LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaJuals.StatusJual LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pembelis.Kota LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["StatusJual"] == "Sudah Lunas") {
			$StatusJual = "Sudah Lunas";
		} else if($row["StatusJual"] == "Belum Lunas"){
			$StatusJual = "Belum Lunas";
		} else{
			$StatusJual = "Lewat Jatuh Tempo";
		}

		$nestedData=array();
		$nestedData[] = $row["NoNotaJual"];
		$nestedData[] = $row["TanggalBuat"];
		$nestedData[] = $row["TanggalBayar"];
		$nestedData[] = formatMoney($row["TotalAkhir"]);
		$nestedData[] = $row["NamaPembeli"];
		$nestedData[] = $row["Kota"];
		$nestedData[] = $row["NamaKaryawan"];
		$nestedData[] = $StatusJual;
		$nestedData[] = $row["Detail"];
		$nestedData[] = $row["UbahPembayaran"];
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
