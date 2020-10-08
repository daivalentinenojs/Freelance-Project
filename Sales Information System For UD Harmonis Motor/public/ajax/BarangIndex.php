<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDBarang',
		1 => 'Nama',
		2 => 'Tahun',
		3 => 'Stok',
		4 => 'HargaJual',
		5 => 'Merk',
		6 => 'StatusTerdaftar',
	  	7 => 'Detail',
		8 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Barangs.IDBarang AS IDBarang, 
				Barangs.Nama AS Nama, 
				Barangs.Tahun AS Tahun, 
				Barangs.Stok AS Stok,
				Barangs.HargaJual AS HargaJual, 
				Barangs.StatusTerdaftar AS StatusTerdaftar, 
				Kategoris.Nama AS Merk, 
				Barangs.IDBarang AS Detail, 
				Barangs.IDBarang AS Ubah
			FROM Barangs INNER JOIN Kategoris ON Barangs.KategoriID = Kategoris.IDKategori";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Barangs.IDBarang AS IDBarang, 
				Barangs.Nama AS Nama, 
				Barangs.Tahun AS Tahun, 
				Barangs.Stok AS Stok,
				Barangs.HargaJual AS HargaJual, 
				Barangs.StatusTerdaftar AS StatusTerdaftar, 
				Kategoris.Nama AS Merk, 
				Barangs.IDBarang AS Detail, 
				Barangs.IDBarang AS Ubah
			FROM Barangs INNER JOIN Kategoris ON Barangs.KategoriID = Kategoris.IDKategori";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Barangs.IDBarang LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Barangs.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Barangs.Tahun LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Barangs.Stok LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Barangs.HargaJual LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Barangs.StatusTerdaftar LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Kategoris.Nama LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["StatusTerdaftar"] == 1) {
			$StatusTerdaftar = "Tersedia";
		} else {
			$StatusTerdaftar = "Kosong";
		}

		$nestedData=array();
		$nestedData[] = $row["IDBarang"];
		$nestedData[] = $row["Nama"];
		$nestedData[] = $row["Tahun"];
		$nestedData[] = $row["Stok"];
		$nestedData[] = formatMoney($row["HargaJual"]);
		$nestedData[] = $row["Merk"];
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
