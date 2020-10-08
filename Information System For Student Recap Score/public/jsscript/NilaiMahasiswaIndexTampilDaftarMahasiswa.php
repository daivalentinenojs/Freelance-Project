<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['NPK'])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$NPK = $MySQLi->real_escape_string($_GET['NPK']);

	$requestData= $_REQUEST;

	$columns = array(
	// Nama Judul
		0 => 'NRP',
		1 => 'NamaMahasiswa',
		2 => 'Angkatan'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT MhsAmbilMk.NRP AS 'NRP', Mahasiswa.Nama AS 'NamaMahasiswa', Mahasiswa.ThnAkademikTerima AS 'Angkatan' FROM MhsAmbilMk INNER JOIN Mahasiswa
	ON MhsAmbilMk.NRP = Mahasiswa.NRP	WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP'";
	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT MhsAmbilMk.NRP AS 'NRP', Mahasiswa.Nama AS 'NamaMahasiswa', Mahasiswa.ThnAkademikTerima AS 'Angkatan' FROM MhsAmbilMk INNER JOIN Mahasiswa
	ON MhsAmbilMk.NRP = Mahasiswa.NRP	WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP'";
	if( !empty($requestData['search']['value']) ) {
		$sql.=" AND ( MhsAmbilMk.NRP LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Mahasiswa.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR Mahasiswa.ThnAkademikTerima LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

	$query=mysqli_query($MySQLi, $sql);

	$data = array();

	while( $row=mysqli_fetch_array($query) ) {
		$nestedData=array();
		$nestedData[] = $row["NRP"];
		$nestedData[] = $row["NamaMahasiswa"];
		$nestedData[] = $row["Angkatan"];
		$data[] = $nestedData;
	}


	$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $data
				);

	echo json_encode($json_data);


	// $query = "SELECT MhsAmbilMk.NRP AS 'NRP', Mahasiswa.Nama AS 'NamaMahasiswa', Mahasiswa.ThnAkademikTerima AS 'Angkatan', MataKuliah.Nama AS 'NamaMk' FROM mhsambilmk INNER JOIN mahasiswa
	// ON MhsAmbilMk.NRP = Mahasiswa.NRP	INNER JOIN MkBuka ON MkBuka.KodeMkBuka = MhsAmbilMk.KodeMkBuka INNER JOIN MataKuliah ON MataKuliah.KodeMk = MkBuka.KodeMk
	// WHERE MhsAmbilMk.KodeMkBuka = '$Kode' AND MhsAmbilMk.KP = '$KP'";
	//
	// $result = mysqli_query($MySQLi, $query);
	// $Hasil = array();
	// while($r = mysqli_fetch_assoc($result))
	// {
	// 	$Hasil[] = $r;
	// }
	// mysqli_close($MySQLi);
	//
	// echo "<span style='font-size:11px; margin-left:30px;'><strong>Daftar Mahasiswa Mata Kuliah ".$Hasil[0]['NamaMk']." KP ".$KP."</strong></span><br><br>";
	// echo "<table class='table' style='margin-left:30px;'><thead><tr>";
	// echo "<th style='text-align:center;'>NRP</th>";
	// echo "<th style='text-align:center;'>Nama Mahasiswa</th>";
	// echo "<th style='text-align:center;'>Angkatan</th>";
	// echo "</tr></thead><tbody>";
	// for ($i=0; $i < count($Hasil); $i++)
	// {
	// 	echo "<tr>";
	// 	echo "<td>".$Hasil[$i]['NRP']."</td>";
	// 	echo "<td>".$Hasil[$i]['NamaMahasiswa']."</td>";
	// 	echo "<td>".$Hasil[$i]['Angkatan']."</td>";
	// 	echo "</tr>";
	// }
	// echo "</tbody></table>";
}
?>
