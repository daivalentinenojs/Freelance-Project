<?php
	require '../../Classes/PHPExcel.php';
	$url =$_FILES['file']['tmp_name'];
	$filecontent = file_get_contents($url);
	$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
	file_put_contents($tmpfname,$filecontent);
	// $tmpfname = "Nilai.xlsx";
	$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
	$excelObj = $excelReader->load($tmpfname);
	$worksheet = $excelObj->getSheet(0);
	$lastRow = $worksheet->getHighestRow();

	$KodeMkBuka = $_GET['KodeMkBuka'];
	$KP = $_GET['KP'];
	$KodeNilai = $_GET['KodeNilai'];

	require '../../connection/RekapNilai.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$QueryJenisNilai = "SELECT RekapNilai.Nilai.Jenis AS 'JenisNilai' FROM RekapNilai.Nilai
	WHERE RekapNilai.Nilai.KodeMkBuka = '$KodeMkBuka' AND RekapNilai.Nilai.KP = '$KP' AND RekapNilai.Nilai.KodeNilai = '$KodeNilai'";

	$HasilQueryJenisNilai = mysqli_query($MySQLi, $QueryJenisNilai);
	$JenisNilai = array();
	while($Hasil = mysqli_fetch_assoc($HasilQueryJenisNilai))
	{
		$JenisNilai[] = $Hasil;
	}

	$JenisNilaiImport = $JenisNilai[0]['JenisNilai'];

	if ($JenisNilaiImport == 'UTS')
	{
			$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol'  FROM BAAK.MhsAmbilMk
			WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP' AND BAAK.MhsAmbilMk.HadirUTS = 'N';";
			$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
			$CheckNRPUTSUASNol = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
			{
				$CheckNRPUTSUASNol[] = $Hasil;
			}
	}
	else if ($JenisNilaiImport == 'UAS')
	{
			$QueryCheckNRPUTSUASNol = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPUASNol' FROM BAAK.MhsAmbilMk
			WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka'	AND BAAK.MhsAmbilMk.KP = '$KP' AND (BAAK.MhsAmbilMk.HadirUAS = 'N' || BAAK.MhsAmbilMk.StatusTilangPresensi = 'Y');";
			$HasilQueryCheckNRPUTSUASNol = mysqli_query($MySQLi, $QueryCheckNRPUTSUASNol);
			$CheckNRPUTSUASNol = array();
			while($Hasil = mysqli_fetch_assoc($HasilQueryCheckNRPUTSUASNol))
			{
				$CheckNRPUTSUASNol[] = $Hasil;
			}
	}


	mysqli_close($MySQLi);

	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$val=0;
	$NRPTidakAda = "NRP ";
	$JumlahTidakAda = 0;
	$PrintNol = 0;
	$TempCheckNRPAda = array();

	for ($i=2; $i <= $lastRow; $i++)
	{
		$TempNRP = $worksheet->getCell('A'.$i)->getValue();
		$TempCheckNRPAda[] = $TempNRP;
		$QueryCheckNRP = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPMahasiswa' FROM BAAK.MhsAmbilMk
		WHERE BAAK.MhsAmbilMk.NRP = '$TempNRP' AND BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka' AND BAAK.MhsAmbilMk.KP = '$KP'";

		$HasilQueryCheckNRP = mysqli_query($MySQLi, $QueryCheckNRP);
		$TotalData = mysqli_num_rows($HasilQueryCheckNRP);

		if ($TotalData >= 1)
		{
			if ($JenisNilaiImport == 'UTS' || $JenisNilaiImport == 'UAS')
			{
					if(!empty($CheckNRPUTSUASNol))
					{
							for ($k=0; $k < count($CheckNRPUTSUASNol); $k++)
							{
									if ($TempNRP == $CheckNRPUTSUASNol[$k]['NRPUASNol'])
									{
												$nestedData[] = array(
												'NRP' => '<label>'.$worksheet->getCell('A'.$i)->getValue().'</label>',
												'NamaMahasiswa' => '<label>'.$worksheet->getCell('B'.$i)->getValue().'</label>',
												'Nilai' => '<label>Tidak Hadir</label>');

												$k = count($CheckNRPUTSUASNol);
												$PrintNol = 1;
									}
							}
					}
					if ($PrintNol == 0)
					{
							$TempNilai = intval($worksheet->getCell('C'.$i)->getValue());
							if ($TempNilai <= 0)
								$TempNilai = 0;
							else if ($TempNilai >= 100)
								$TempNilai = 100;
							$nestedData[] = array(
								'NRP' => '<label for="NRP[]">'.$worksheet->getCell('A'.$i)->getValue().'</label>'.'<input type="hidden" name="NRP[]" value="'.$worksheet->getCell('A'.$i)->getValue().'" readonly data-toggle="tooltip" data-placement="right" title="NRP Mahasiswa" type="text"style="width:100%; font-weight:bold; border-radius:2px; color:grey;"  class="form-control"/>',
								'NamaMahasiswa' => '<label name="NamaMahasiswa[]">'.$worksheet->getCell('B'.$i)->getValue().'</label>',
								'Nilai' => '<input id="Nilai'.$val.'" value="'.$TempNilai.'" oninput="return Varer(this.id)" onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Nilai Mahasiswa '.$worksheet->getCell('C'.$i)->getValue().'" type="number" step=any required min="1" max="100" size="5" style="width:100%; border-radius:3px;" name="Nilai[]" class="form-control"/>'
							);
					}
					$PrintNol = 0;
					$val++;
			}
			else
			{
					$TempNilai = intval($worksheet->getCell('C'.$i)->getValue());
					if ($TempNilai <= 0)
						$TempNilai = 0;
					else if ($TempNilai >= 100)
						$TempNilai = 100;
					$nestedData[] = array(
						'NRP' => '<label for="NRP[]">'.$worksheet->getCell('A'.$i)->getValue().'</label>'.'<input type="hidden" name="NRP[]" value="'.$worksheet->getCell('A'.$i)->getValue().'" readonly data-toggle="tooltip" data-placement="right" title="NRP Mahasiswa" type="text"style="width:100%; font-weight:bold; border-radius:2px; color:grey;"  class="form-control"/>',
						'NamaMahasiswa' => '<label name="NamaMahasiswa[]">'.$worksheet->getCell('B'.$i)->getValue().'</label>',
						'Nilai' => '<input id="Nilai'.$val.'" value="'.$TempNilai.'" oninput="return Varer(this.id)" onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Nilai Mahasiswa '.$worksheet->getCell('C'.$i)->getValue().'" type="number" step=any required min="1" max="100" size="5" style="width:100%; border-radius:3px;" name="Nilai[]" class="form-control"/>'
					);
					$val++;
			}
		}
		else
		{
				$NRPTidakAda .= $worksheet->getCell('A'.$i)->getValue().", ";
				$JumlahTidakAda ++;
		}
	}

	if($JumlahTidakAda >= 1)
	{
			$NRPTidakAda .= "di Mata Kuliah ".$KodeMkBuka." dan Kelas Pararel ".$KP;
			echo $NRPTidakAda;
			exit();
	}

	// $Test = join(',',array_fill(0,count($TempCheckNRPAda),'?'));
	$Test = implode(',',$TempCheckNRPAda);
	$Test = rtrim($Test,',');
	// echo $Test;
	// exit();

	$NRPDihapus = "SELECT BAAK.MhsAmbilMk.NRP AS 'NRPAmbilMk', BAAK.Mahasiswa.Nama AS 'NamaAmbilMk' FROM BAAK.MhsAmbilMk
	INNER JOIN BAAK.Mahasiswa ON BAAK.MhsAmbilMk.NRP = BAAK.Mahasiswa.NRP
	WHERE BAAK.MhsAmbilMk.KodeMkBuka = '$KodeMkBuka'	AND BAAK.MhsAmbilMk.KP = '$KP' AND BAAK.MhsAmbilMk.NRP NOT IN ($Test);";
	$HasilNRPDihapus = mysqli_query($MySQLi, $NRPDihapus);
	$HasilNRPHilang = array();
	while($Hasil = mysqli_fetch_assoc($HasilNRPDihapus))
	{
		$HasilNRPHilang[] = $Hasil;
	}

	for ($q=0; $q < COUNT($HasilNRPHilang); $q++)
	{
			$nestedData[] = array(
				'NRP' => '<label for="NRP[]">'.$HasilNRPHilang[0]['NRPAmbilMk'].'</label>'.'<input type="hidden" name="NRP[]" value="'.$HasilNRPHilang[0]['NRPAmbilMk'].'" readonly data-toggle="tooltip" data-placement="right" title="NRP Mahasiswa" type="text"style="width:100%; font-weight:bold; border-radius:2px; color:grey;"  class="form-control"/>',
				'NamaMahasiswa' => '<label name="NamaMahasiswa[]">'.$HasilNRPHilang[0]['NamaAmbilMk'].'</label>',
				'Nilai' => '<input id="Nilai'.$val.'" value="0" oninput="return Varer(this.id)" onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="right" title="Silahkan Memasukkan Nilai Mahasiswa '.$HasilNRPHilang[0]['NamaAmbilMk'].'" type="number" step=any required min="1" max="100" size="5" style="width:100%; border-radius:3px;" name="Nilai[]" class="form-control"/>'
			);
			$val++;
	}

	$arr[] = array('title' => 'NRP', 'data'=> 'NRP');
	$arr[] = array('title' => 'NamaMahasiswa', 'data'=>	'NamaMahasiswa');
	$arr[] = array('title' => 'Nilai', 'data'=> 'Nilai' );


	$json_data = array(
				"columns"					=> $arr,
				"data"            => $nestedData
				);
				// print_r($json_data);
				// exit();
	echo json_encode($json_data);


?>
