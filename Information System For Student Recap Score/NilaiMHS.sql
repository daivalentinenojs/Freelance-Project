SELECT BAAK.MataKuliah.Nama AS 'NamaMataKuliah', BAAK.MhsAmbilMk.KodeMkBuka AS 'KodeMkBuka', BAAK.MhsAmbilMk.KP AS 'KP', (
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) AS 'NTS', (
    SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
	) AS 'NAS', (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
) * (60/100)) AS 'NA', ( CASE WHEN
	(
		(((	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
		AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
		) * (40/100)) + (
	  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
		AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
		) * (60/100))
	) >= 81 AND
	(
		(((	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
		AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
		) * (40/100)) + (
	  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
		AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
		) * (60/100))
	) <= 100 THEN 'A' ELSE (
		CASE WHEN (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
) 	* (60/100))
        ) >= 73 AND (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
	) * (60/100))
	) <= 80 THEN 'AB' ELSE (
		CASE WHEN (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
) 	* (60/100))
        ) >= 73 AND (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
	) * (60/100))
	) <= 80 THEN 'B' ELSE (
		CASE WHEN (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
) 	* (60/100))
        ) >= 60 AND (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
	) * (60/100))
	) <= 65 THEN 'BC' ELSE (
		CASE WHEN (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
) 	* (60/100))
        ) >= 55 AND (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
	) * (60/100))
	) <= 59 THEN 'C' ELSE (
		CASE WHEN (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
) 	* (60/100))
        ) >= 55 AND (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
	) * (60/100))
	) <= 59 THEN 'D' ELSE (
		CASE WHEN (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
) 	* (60/100))
        ) >= 0.00001 AND (
        (((
	SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'T'),'%')
	) * (40/100)) + (
  SELECT DISTINCT myUbaya.baak_NilaiMahasiswa.Nilai AS 'NTS' FROM myUbaya.baak_NilaiMahasiswa WHERE myUbaya.baak_NilaiMahasiswa.NRP = '6134059'
	AND myUbaya.baak_NilaiMahasiswa.KodeNilai Like concat(concat(concat(concat('%',BAAK.MhsAmbilMk.KodeMkBuka),(case when length(BAAK.MhsAmbilMk.KP) = 1 then concat('0',BAAK.MhsAmbilMk.KP) else BAAK.MhsAmbilMk.KP end)),'A'),'%')
	) * (60/100))
	) <= 40 THEN 'E' ELSE '-' END) END) END) END)END
    ) END)END

	) AS 'KodeNisbi'
	FROM BAAK.MhsAmbilMk INNER JOIN BAAK.MkBuka ON BAAK.MhsAmbilMk.KodeMkBuka = BAAK.MkBuka.KodeMkBuka 
    INNER JOIN BAAK.MataKuliah ON BAAK.MkBuka.KodeMk = BAAK.MataKuliah.KodeMk
    INNER JOIN myUbaya.baak_Nilai ON myUbaya.baak_Nilai.KodeMkBuka = BAAK.MhsAmbilMk.KodeMkBuka
	WHERE BAAK.MhsAmbilMk.NRP = '6134059' AND BAAK.MkBuka.Semester = 'Gasal' AND BAAK.MkBuka.ThnAkademik = '2013' 
    AND myUbaya.baak_Nilai.Status = 'ValidDosen';
	
    select * 
    FROM BAAK.MhsAmbilMk m, myUbaya.baak_Nilai n, BAAK.MkBuka mb, BAAK.MataKuliah mk
    where m.KodeMkBuka = n.KodeMkBuka
    and mk.Kodemk = mb.KodeMk
    and m.KodeMkBuka = mb.KodeMkBuka
    and m.NRP = '6134059'
    and mb.Semester = 'Gasal'
    and mb.ThnAkademik = '2013' 
