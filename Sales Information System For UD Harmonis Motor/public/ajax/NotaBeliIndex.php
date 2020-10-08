<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'NoNotaBeli',
		1 => 'TanggalBuat',
		2 => 'JatuhTempo',
		3 => 'Total',
		4 => 'NamaPemasok',
		5 => 'NamaKaryawan',
		6 => 'StatusBeli',
		7 => 'Detail',
		8 => 'UbahPembayaran' 
	);

	// Ambil Semua Baris Data
	$sql = "SELECT NotaBelis.NoNotaBeli AS NoNotaBeli, 
				NotaBelis.TanggalBuat AS TanggalBuat, 
				NotaBelis.JatuhTempo AS JatuhTempo,
				NotaBelis.Total AS Total, 
				Pemasoks.NamaRekening AS NamaPemasok, 
				Karyawans.Nama AS NamaKaryawan, 
				NotaBelis.StatusBeli AS StatusBeli,  
				NotaBelis.NoNotaBeli AS Detail,
				NotaBelis.NoNotaBeli AS UbahPembayaran
	        FROM Karyawans INNER JOIN NotaBelis ON Karyawans.IDKaryawan = NotaBelis.KaryawanID 
	        	INNER JOIN Pemasoks ON NotaBelis.PemasokID = Pemasoks.IDPemasok";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT NotaBelis.NoNotaBeli AS NoNotaBeli, 
				NotaBelis.TanggalBuat AS TanggalBuat, 
				NotaBelis.JatuhTempo AS JatuhTempo,
				NotaBelis.Total AS Total, 
				Pemasoks.NamaRekening AS NamaPemasok, 
				Karyawans.Nama AS NamaKaryawan, 
				NotaBelis.StatusBeli AS StatusBeli, 
				NotaBelis.NoNotaBeli AS Detail,
				NotaBelis.NoNotaBeli AS UbahPembayaran
	        FROM Karyawans INNER JOIN NotaBelis ON Karyawans.IDKaryawan = NotaBelis.KaryawanID 
	        	INNER JOIN Pemasoks ON NotaBelis.PemasokID = Pemasoks.IDPemasok";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( NotaBelis.NoNotaBeli LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaBelis.TanggalBuat LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaBelis.JatuhTempo LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaBelis.Total LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR NotaBelis.StatusBeli LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pemasoks.NamaRekening LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		if ($row["StatusBeli"] == "Pesan") {
			$StatusBeli = "Pesan";
		} else if ($row["StatusBeli"] == "Dikirim"){
			$StatusBeli = "Dikirim";
		} else {
			$StatusBeli = "Lunas";
		}

		$nestedData=array();
		$nestedData[] = $row["NoNotaBeli"];
		$nestedData[] = $row["TanggalBuat"];
		$nestedData[] = $row["JatuhTempo"];
		$nestedData[] = formatMoney($row["Total"]);
		$nestedData[] = $row["NamaPemasok"];
		$nestedData[] = $row["NamaKaryawan"];
		$nestedData[] = $StatusBeli;
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
