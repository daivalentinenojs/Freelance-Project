<?php
if(isset($_GET['kodeMkBuka']) AND isset($_GET['kpMkBuka']) AND isset($_GET['kodeNilai'])) // Checked
{
	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$Kode = $MySQLi->real_escape_string($_GET['kodeMkBuka']);
	$KP = $MySQLi->real_escape_string($_GET['kpMkBuka']);
	$KodeNilai = $MySQLi->real_escape_string($_GET['kodeNilai']);

	// $requestData= $_REQUEST;
	//
	// $columns = array(
	// // Nama Judul
	// 	0 => 'NRP ',
	// 	1 => 'NamaMahasiswa',
	// 	2 => 'Nilai'
	// );
	//
	// // Ambil Semua Baris Data
	// $sql = "SELECT Mahasiswa.NRP AS NRP, Mahasiswa.Nama AS NamaMahasiswa, Mahasiswa.Nama AS Nilai	FROM Mahasiswa INNER JOIN MhsAmbilMk ON Mahasiswa.NRP = MhsAmbilMk.NRP WHERE MhsAmbilMk.KodeMkBuka ='$Kode' AND MhsAmbilMk.KP = '$KP'";
	// $query=mysqli_query($MySQLi, $sql);
	// $totalData = mysqli_num_rows($query);
	// $totalFiltered = $totalData;
	//
	// // Proses Cari
	// $sql = "SELECT Mahasiswa.NRP AS NRP, Mahasiswa.Nama AS NamaMahasiswa, Mahasiswa.Nama AS Nilai	FROM Mahasiswa INNER JOIN MhsAmbilMk ON Mahasiswa.NRP = MhsAmbilMk.NRP WHERE MhsAmbilMk.KodeMkBuka ='$Kode' AND MhsAmbilMk.KP = '$KP'";
	// if( !empty($requestData['search']['value']) ) {
	// 	$sql.=" AND ( Mahasiswa.NRP LIKE '%".$requestData['search']['value']."%' ";
	// 	$sql.=" OR Mahasiswa.Nama LIKE '%".$requestData['search']['value']."%' )";
	// }
	//
	// $query=mysqli_query($MySQLi, $sql);
	// $totalFiltered = mysqli_num_rows($query);
	// $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	//
	// $query=mysqli_query($MySQLi, $sql);
	//
	// $data = array();
	// $val=0;
	// while( $row=mysqli_fetch_array($query) ) {
	// 	$nestedData=array();
	// 	$nestedData[] = $row["NRP"];
	// 	$nestedData[] = $row["NamaMahasiswa"];
	// 	// $nestedData[] = '<input id="Nilai'.$val.'" onchange="return Varer(this.id)" onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Nilai Mahasiswa '.$row["NamaMahasiswa"].' type="number" step=any required min="1" max="100" size="5" style="width:100%; border-radius:3px;" name="Nilai[]" class="form-control"/>';
	// 	$nestedData[] = $row["NamaMahasiswa"];
	// 	$data[] = $nestedData;
	// 	$val++;
	// }
	//
	// $json_data = array(
	// 			"draw"            => intval( $requestData['draw'] ),
	// 			"recordsTotal"    => intval( $totalData ),
	// 			"recordsFiltered" => intval( $totalFiltered ),
	// 			"data"            => $data
	// 			);
	//
	// echo json_encode($json_data);

	$QueryCheckJenisNilai = "SELECT Nilai.Jenis AS 'Jenis'	FROM Nilai WHERE Nilai.KodeMkBuka = '$Kode' AND Nilai.KP = '$KP'
	AND Nilai.Status = 'Daftar' AND Nilai.Syarat = 1 AND Nilai.KodeNilai = '$KodeNilai'";

	$HasilQueryCheckJenisNilai = mysqli_query($MySQLi, $QueryCheckJenisNilai);
	$CheckJenisNilai = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryCheckJenisNilai))
	{
		$CheckJenisNilai[] = $Hasil;
	}

	// print_r($CheckJenisNilai);
	mysqli_close($MySQLi);

	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	if ($CheckJenisNilai[0]['Jenis'] == 'UTS')
	{
			// tambahi if empty

			$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol', BAAK.Mahasiswa.Nama AS 'NamaNol'  FROM BAAK.MhsAmbilMk INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$Kode' AND BAAK.MhsAmbilMk.KP = '$KP' AND BAAK.MhsAmbilMk.HadirUTS = 'N'";

			$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
			$CheckNRPUTSUASNol = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
			{
				$CheckNRPUTSUASNol[] = $Hasil;
			}
	}
	else if ($CheckJenisNilai[0]['Jenis'] == 'UAS')
	{
			$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol', BAAK.Mahasiswa.Nama AS 'NamaNol' FROM BAAK.MhsAmbilMk INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$Kode' AND BAAK.MhsAmbilMk.KP = '$KP' AND (BAAK.MhsAmbilMk.HadirUAS = 'N' || BAAK.MhsAmbilMk.StatusTilangPresensi = 'Y')";

			$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
			$CheckNRPUTSUASNol = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
			{
				$CheckNRPUTSUASNol[] = $Hasil;
			}
	}

	if (empty($CheckNRPUTSUASNol))
	{
			$CheckNRPUTSUASNol = 0;
	}

	// echo $QueryCheckNRPUTSUASNol;
	// $sql = "SELECT Mahasiswa.NRP AS NRP, Mahasiswa.Nama AS NamaMahasiswa, RekapNilai.NilaiMahasiswa.Nilai AS NilaiLama, RekapNilai.NilaiMahasiswa.KodeNisbi AS KodeNisbiLama, Mahasiswa.Nama AS NilaiBaru	FROM Mahasiswa INNER JOIN MhsAmbilMk ON Mahasiswa.NRP = MhsAmbilMk.NRP INNER JOIN RekapNilai.NilaiMahasiswa ON Mahasiswa.NRP = RekapNilai.NilaiMahasiswa.NRP WHERE MhsAmbilMk.KodeMkBuka ='$Kode' AND MhsAmbilMk.KP = '$KP' AND RekapNilai.NilaiMahasiswa.KodeNilai = '$KodeNilai'";
	$sql = "SELECT BAAK.Mahasiswa.NRP AS NRP, BAAK.Mahasiswa.Nama AS NamaMahasiswa, RekapNilai.NilaiMahasiswa.Nilai AS NilaiLama, RekapNilai.NilaiMahasiswa.KodeNisbi AS KodeNisbiLama, BAAK.Mahasiswa.Nama AS NilaiBaru	FROM BAAK.Mahasiswa INNER JOIN BAAK.MhsAmbilMk ON BAAK.Mahasiswa.NRP = BAAK.MhsAmbilMk.NRP INNER JOIN RekapNilai.NilaiMahasiswa ON BAAK.Mahasiswa.NRP = RekapNilai.NilaiMahasiswa.NRP
	WHERE RekapNilai.NilaiMahasiswa.KodeNilai = '$KodeNilai' AND BAAK.MhsAmbilMk.KodeMkBuka = '$Kode' AND BAAK.MhsAmbilMk.KP = '$KP'";

	$query=mysqli_query($MySQLi, $sql);
	$val=0;
	$CetakUTSUASNol = 0;

	if (!empty($CheckNRPUTSUASNol))
	{
		for ($i=0; $i < count($CheckNRPUTSUASNol); $i++) {
				$nestedData[] = array(
					'NRP' => '<label for="NRP[]">'.$CheckNRPUTSUASNol[$i]["NRPUASNol"].'</label>',
					'NamaMahasiswa' => '<label for="NRP[]">'.$CheckNRPUTSUASNol[$i]["NamaNol"].'</label>',
					'NilaiLama' => '<label>Tidak Hadir</label>',
					'KodeNisbiLama' => '<label>Tidak Hadir</label>',
					'NilaiBaru' => '<label>Tidak Hadir</label>'
				);
		}
	}

	// onkeypress="return isNumberKey(event)" onchange="return Varer(this.id)"
	while( $row=mysqli_fetch_assoc($query) )
	{
			$nestedData[] = array(
				'NRP' => '<label for="NRP[]">'.$row["NRP"].'</label>'.'<input value="'.$row["NRP"].'" readonly data-toggle="tooltip" data-placement="right" title="NRP Mahasiswa" type="hidden" style="width:100%; font-weight:bold; border-radius:2px; color:grey;" name="NRP[]" class="form-control"/>',
				'NamaMahasiswa' => '<label name="NamaMahasiswa[]">'.$row["NamaMahasiswa"].'</label>',
				'NilaiLama' => '<label for="NilaiLama[]">'.$row["NilaiLama"].'</label>'.'<input value="'.$row["NilaiLama"].'" readonly data-toggle="tooltip" data-placement="right" title="Nilai Lama Mahasiswa" type="hidden" style="width:100%; font-weight:bold; text-align:center; border-radius:2px; color:grey;" name="NilaiLama[]" class="form-control"/>',
				'KodeNisbiLama' => '<label for="KodeNisbiLama[]">'.$row["KodeNisbiLama"].'</label>'.'<input value="'.$row["KodeNisbiLama"].'" readonly data-toggle="tooltip" data-placement="right" title="Kode Nisbi Lama Mahasiswa" type="hidden" style="width:100%; font-weight:bold; text-align:center; border-radius:2px; color:grey;" name="KodeNisbiLama[]" class="form-control"/>',
				'NilaiBaru' => '<input id="Nilai'.$val.'" value="'.$row["NilaiLama"].'" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Nilai Baru Mahasiswa '.$row["NamaMahasiswa"].'" type="number" step=any required min="1" max="100" size="5" style="width:100%; border-radius:3px;" name="Nilai[]" class="form-control UbahBaru"/>'
			);
			$val++;
	}

	while ($fieldinfo=mysqli_fetch_field($query))
	{
		$arr[] = array('title' => $fieldinfo->name,'data'=> $fieldinfo->name);

	}

	mysqli_free_result($query);
	$json_data = array(
				"columns"					=> $arr,
				"data"            => $nestedData,
				"sScrollX"=> "100%",
        "bScrollCollapse"=> "true",
				);
	echo json_encode($json_data);
}
?>
