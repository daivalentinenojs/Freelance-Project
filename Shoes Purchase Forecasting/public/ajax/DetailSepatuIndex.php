<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'Nomor',
		1 => 'Tipe',
		2 => 'Warna',
		3 => 'JenisUkuran',
		4 => 'Stok',
		5 => 'HargaBeli',
		6 => 'HargaJual',
		7 => 'Keterangan',
		9 => 'isDelete',
		9 => 'View',
		10 => 'Edit'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT ds.ID AS 'Nomor', t.Nama AS 'Tipe', ds.Stok AS 'Stok', ds.HargaBeliTerakhir AS 'HargaBeli', ds.HargaJual AS 'HargaJual',
	w.Nama AS 'Warna', ds.isDelete AS 'isDelete', ds.Keterangan AS 'Keterangan',sob.Nama AS 'JenisUkuran', ds.ID AS 'View', ds.ID AS 'Edit'
	FROM DetailSepatu ds,  Mereksepatu m, Warna w, Tipe t, SizeOrBox sob Where t.ID = ds.TipeID and t.MereksepatuID = m.ID  and w.ID = ds.WarnaID and ds.SizeOrBoxID = sob.ID";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT ds.ID AS 'Nomor', t.Nama AS 'Tipe', ds.Stok AS 'Stok', ds.HargaBeliTerakhir AS 'HargaBeli', ds.HargaJual AS 'HargaJual',
	w.Nama AS 'Warna', ds.isDelete AS 'isDelete', ds.Keterangan AS 'Keterangan',sob.Nama AS 'JenisUkuran', ds.ID AS 'View', ds.ID AS 'Edit'
	FROM DetailSepatu ds,  Mereksepatu m, Warna w, Tipe t, SizeOrBox sob Where t.ID = ds.TipeID and t.MereksepatuID = m.ID  and w.ID = ds.WarnaID and ds.SizeOrBoxID = sob.ID";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( ds.ID LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR t.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR w.Nama LIKE '%".$requestData['search']['value']."%' )";
		$sql.=" OR sp.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR ds.HargaBeliTerakhir LIKE '%".$requestData['search']['value']."%' )";
		$sql.=" OR ds.HargaJual LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR ds.Stok LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR ds.isDelete LIKE '%".$requestData['search']['value']."%' )";
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

		$nestedData=array();
		$nestedData[] = $row["Nomor"];
		$nestedData[] = $row["Tipe"];
		$nestedData[] = $row["Warna"];
		$nestedData[] = $row["JenisUkuran"];
		$nestedData[] = $row["Stok"];
		$nestedData[] = 'Rp '.formatMoney($row["HargaBeli"]);
		$nestedData[] = 'Rp '.formatMoney($row["HargaJual"]);
		$nestedData[] = $row["Keterangan"];
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
