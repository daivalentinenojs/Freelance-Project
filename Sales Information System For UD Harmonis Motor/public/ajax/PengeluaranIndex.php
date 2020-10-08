<?php
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$requestData= $_REQUEST;
	$columns = array(
	// Nama Judul
		0 => 'IDPengeluaran',
		1 => 'Tanggal',
		2 => 'Nama',
		3 => 'Nominal',
		4 => 'Keterangan',
		5 => 'StatusTerdaftar',
		6 => 'NamaKaryawan',
		7 => 'Detail',
		8 => 'Ubah'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT Pengeluarans.IDPengeluaran AS IDPengeluaran, 
				Pengeluarans.Tanggal AS Tanggal, 
				Pengeluarans.Nama AS Nama, 
				Pengeluarans.Nominal AS Nominal, 
				Pengeluarans.Keterangan AS Keterangan,
				Pengeluarans.StatusTerdaftar AS StatusTerdaftar, 
				Karyawans.Nama AS NamaKaryawan,
				Pengeluarans.IDPengeluaran AS Detail, 
				Pengeluarans.IDPengeluaran AS Ubah
			FROM Pengeluarans 
				INNER JOIN Karyawans ON Pengeluarans.KaryawanID = Karyawans.IDKaryawan";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT Pengeluarans.IDPengeluaran AS IDPengeluaran, 
				Pengeluarans.Tanggal AS Tanggal, 
				Pengeluarans.Nama AS Nama, 
				Pengeluarans.Nominal AS Nominal, 
				Pengeluarans.Keterangan AS Keterangan,
				Pengeluarans.StatusTerdaftar AS StatusTerdaftar, 
				Karyawans.Nama AS NamaKaryawan,
				Pengeluarans.IDPengeluaran AS Detail, 
				Pengeluarans.IDPengeluaran AS Ubah
			FROM Pengeluarans 
				INNER JOIN Karyawans ON Pengeluarans.KaryawanID = Karyawans.IDKaryawan";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" WHERE ( Pengeluarans.IDPengeluaran LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pengeluarans.Tanggal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pengeluarans.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pengeluarans.Nominal LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pengeluarans.Keterangan LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Pengeluarans.StatusTerdaftar LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Karyawans.Nama LIKE '%".$requestData['search']['value']."%' )";
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
		$nestedData[] = $row["IDPengeluaran"];
		$nestedData[] = $row["Tanggal"];
		$nestedData[] = $row["Nama"];
		$nestedData[] = formatMoney($row["Nominal"]);
		$nestedData[] = $row["Keterangan"];
		$nestedData[] = $StatusTerdaftar;
		$nestedData[] = $row["NamaKaryawan"];
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
