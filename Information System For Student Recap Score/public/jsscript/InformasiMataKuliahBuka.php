<?php

// Checked V Y

require '../../connection/Init.php';
$MySQLi = mysqli_connect($domain, $username, $password, $database);

$requestData= $_REQUEST;

$columns = array(
// Nama Judul
	0 => 'NamaMk',
	1 => 'KP',
	2 => 'SKS',
	3 => 'Nama'
);

// Ambil Semua Baris Data
$sql = "SELECT Karyawan.Nama AS Nama, DosenAjarMk.KP AS KP, MataKuliah.Nama AS NamaMk, MataKuliah.SKS AS SKS
FROM Karyawan INNER JOIN DosenAjarMk ON Karyawan.NPK = DosenAjarMk.NPK INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk
WHERE MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
$query=mysqli_query($MySQLi, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

// Proses Cari
$sql = "SELECT Karyawan.Nama AS Nama, DosenAjarMk.KP AS KP, MataKuliah.Nama AS NamaMk, MataKuliah.SKS AS SKS
FROM Karyawan INNER JOIN DosenAjarMk ON Karyawan.NPK = DosenAjarMk.NPK INNER JOIN MkBuka ON DosenAjarMk.KodeMkBuka = MkBuka.KodeMkBuka INNER JOIN MataKuliah ON MkBuka.KodeMk = MataKuliah.KodeMk
WHERE MkBuka.ThnAkademik = '$ThnAkademik' AND MkBuka.Semester = '$Semester'";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( Karyawan.Nama LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR DosenAjarMk.KP LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR MataKuliah.Nama LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR MataKuliah.SKS LIKE '%".$requestData['search']['value']."%' )";
}

$query=mysqli_query($MySQLi, $sql);
$totalFiltered = mysqli_num_rows($query);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($MySQLi, $sql);

$data = array();

while( $row=mysqli_fetch_array($query) ) {
	$nestedData=array();
	$nestedData[] = $row["NamaMk"];
	$nestedData[] = $row["KP"];
	$nestedData[] = $row["SKS"];
	$nestedData[] = $row["Nama"];
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
