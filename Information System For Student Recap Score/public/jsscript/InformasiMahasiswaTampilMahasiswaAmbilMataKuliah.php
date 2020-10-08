<?php
if(isset($_GET['NRPMahasiswa']) AND isset($_GET['Semester']) AND isset($_GET['ThnAkademik'])) // Checked V Y
{
	require '../../connection/Init.php';
	$MySQLi = mysqli_connect($domain, $username, $password, $database);

	$NRP = $MySQLi->real_escape_string($_GET['NRPMahasiswa']);
	// $KodeTahunSemester = $MySQLi->real_escape_string($_GET['KodeTahunSemester']);
	// $Hasil = explode("|", $KodeTahunSemester);

	$Semester = $MySQLi->real_escape_string($_GET['Semester']);
	$Tahun = $MySQLi->real_escape_string($_GET['ThnAkademik']);

	$requestData= $_REQUEST;

	$columns = array(
	// Nama Judul
		0 => 'NamaMataKuliah',
		1 => 'KP',
		2 => 'NTS',
		3 => 'NAS',
		4 => 'NA',
		5 => 'KodeNisbi',
		6 => 'KodeMkBuka'
	);

	// Ambil Semua Baris Data
	$sql = "SELECT BAAK.MataKuliah.Nama AS 'NamaMataKuliah', BAAK.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka', BAAK.MhsAmbilMk.KP AS 'KP',

	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%') ORDER BY BAAK.NilaiMahasiswa.KodeNilai) AS 'NTS',


	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) AS 'NAS',


	(((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100)) AS 'NA',


	(CASE WHEN((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 81 AND
	((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) <= 100 THEN 'A' ELSE

	(CASE WHEN ((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) 	* (60/100))) >= 73 AND
	((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 81 THEN 'AB' ELSE

	(CASE WHEN ((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) 	* (60/100))) >= 66 AND
	((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 73 THEN 'B' ELSE

	(CASE WHEN ((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) 	* (60/100))) >= 60 AND
	((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 66 THEN 'BC' ELSE

	(CASE WHEN ((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) 	* (60/100))) >= 55 AND
	((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 60 THEN 'C' ELSE

	(CASE WHEN ((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) 	* (60/100))) >= 40 AND
	((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 55 THEN 'D' ELSE

	(CASE WHEN ((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) 	* (60/100))) >= 0.001 AND
	((((	SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'
	AND BAAK.NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1
	then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) + (SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS'
	FROM BAAK.NilaiMahasiswa WHERE BAAK.NilaiMahasiswa.NRP = '$NRP'	AND BAAK.NilaiMahasiswa.KodeNilai Like
	concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1	then concat('0',BAAK.MhsAmbilMk.KP) else
	BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 40 THEN 'E' ELSE '-' END) END) END) END)END) END)END) AS 'KodeNisbi'

	FROM BAAK.MhsAmbilMk INNER JOIN BAAK.MkBuka ON BAAK.MhsAmbilMk.KodeMkBuka = BAAK.MkBuka.KodeMkBuka INNER JOIN BAAK.MataKuliah ON BAAK.MkBuka.KodeMk =
	BAAK.MataKuliah.KodeMk WHERE BAAK.MhsAmbilMk.NRP = '$NRP' AND BAAK.MkBuka.Semester = '$Semester' AND BAAK.MkBuka.ThnAkademik = '$Tahun';";

	$query=mysqli_query($MySQLi, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;

	// Proses Cari
	$sql = "SELECT BAAK.MataKuliah.Nama AS 'NamaMataKuliah', BAAK.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka', BAAK.MhsAmbilMk.KP AS 'KP',

	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) AS 'NTS',


	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) AS 'NAS',


	(((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100)) AS 'NA',


	(CASE WHEN((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 81 AND
	((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) <= 100 THEN 'A' ELSE

	(CASE WHEN ((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 73 AND
	((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 81 THEN 'AB' ELSE

	(CASE WHEN ((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 66 AND
	((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 73 THEN 'B' ELSE

	(CASE WHEN ((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 60 AND
	((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 66 THEN 'BC' ELSE

	(CASE WHEN ((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 55 AND
	((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 60 THEN 'C' ELSE

	(CASE WHEN ((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 40 AND
	((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 55 THEN 'D' ELSE

	(CASE WHEN ((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) >= 0.001 AND
	((((SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NTS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'T'),'%')) * (40/100)) +
	(SELECT DISTINCT BAAK.NilaiMahasiswa.Nilai AS 'NAS' FROM BAAK.NilaiMahasiswa INNER JOIN BAAK.Nilai
	ON BAAK.NilaiMahasiswa.KodeNilai = BAAK.Nilai.KodeNilai
	WHERE BAAK.NilaiMahasiswa.NRP = '$NRP' AND BAAK.Nilai.Status = 'ValidAdmik' AND BAAK.NilaiMahasiswa.KodeNilai
	Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP)
	else BAAK.MhsAmbilMk.KP end)),'A'),'%')) * (60/100))) < 40 THEN 'E' ELSE '-' END) END) END) END)END) END)END) AS 'KodeNisbi'

	FROM BAAK.MhsAmbilMk INNER JOIN BAAK.MkBuka ON BAAK.MhsAmbilMk.KodeMkBuka = BAAK.MkBuka.KodeMkBuka INNER JOIN BAAK.MataKuliah ON BAAK.MkBuka.KodeMk =
	BAAK.MataKuliah.KodeMk WHERE BAAK.MhsAmbilMk.NRP = '$NRP' AND BAAK.MkBuka.Semester = '$Semester' AND BAAK.MkBuka.ThnAkademik = '$Tahun';";

	if( !empty($requestData['search']['value']) ) {
		$sql.=" AND ( MataKuliah.Nama LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR MhsAmbilMk.KP LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR MhsAmbilMk.NTS LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR MhsAmbilMk.NAS LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR MhsAmbilMk.NA LIKE '%".$requestData['search']['value']."%' )";
		//$sql.=" OR MhsAmbilMk.KodeNisbi LIKE '%".$requestData['search']['value']."%' )";
	}

	$query=mysqli_query($MySQLi, $sql);
	$totalFiltered = mysqli_num_rows($query);
	// $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
// echo $totalFiltered;
// exit();
	$query=mysqli_query($MySQLi, $sql);
	$data = array();

	// if (!mysqli_fetch_array($query)) {
	// 	printf("Error: %s\n", mysqli_error($MySQLi));
	// 	exit();
	// };
	while( $row=mysqli_fetch_array($query) ) {
		if(empty($row["NTS"]))
		{
			$row["NTS"] = "Belum Diverifikasi";
		}

		if(empty($row["NAS"]))
		{
			$row["NAS"] = "Belum Diverifikasi";
		}

		if(empty($row["NA"]))
		{
			$row["NA"] = "Belum Diverifikasi";
		}

		if(empty($row["KodeNisbi"]) || $row["KodeNisbi"] == "-")
		{
			$row["KodeNisbi"] = "Belum Diverifikasi";
		}
		$nestedData=array();
		$nestedData[] = $row["NamaMataKuliah"];
		$nestedData[] = $row["KP"];
		$nestedData[] = $row["NTS"];
		$nestedData[] = $row["NAS"];
		$nestedData[] = $row["NA"];
		$nestedData[] = $row["KodeNisbi"];
		$nestedData[] = $row["KodeMkBuka"];
		$data[] = $nestedData;
	}


	$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $data
				);

	echo json_encode($json_data);
}
?>
