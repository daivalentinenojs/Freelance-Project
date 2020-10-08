<?php
  $domain = "localhost";
  $username = "root";
  $password = "darkangel";
  $database = "myUbaya";

  $MySQLi = mysqli_connect($domain, $username, $password, $database);

  $QuerySemesterAktif = "SELECT BAAK.SemesterAktif.ThnAkademik AS 'TahunAkademik', BAAK.SemesterAktif.Semester AS 'Semester'
  FROM BAAK.SemesterAktif WHERE now() between BAAK.SemesterAktif.TglAwalKuliah AND BAAK.SemesterAktif.BatasInputNAS;";

  $HasilQuerySemesterAktif = mysqli_query($MySQLi, $QuerySemesterAktif);
  $SemesterAktif = array();
  while($Hasil = mysqli_fetch_assoc($HasilQuerySemesterAktif))
  {
    $SemesterAktif[] = $Hasil;
  }

  if (empty($SemesterAktif))
  {
      $SemesterAktif[0]['TahunAkademik'] = "0";
      $SemesterAktif[0]['Semester'] = "0";
  }
  else
  {
      $QueryBlmAturDosenAjarMk = "SELECT BAAK.SemesterAktif.ThnAkademik AS 'DosenThn', BAAK.SemesterAktif.Semester AS 'DosenSemester' FROM BAAK.SemesterAktif
      ORDER BY BAAK.SemesterAktif.ThnAkademik DESC, BAAK.SemesterAktif.Semester DESC LIMIT 1;";

      $HasilQueryBlmAturDosenAjarMk = mysqli_query($MySQLi, $QueryBlmAturDosenAjarMk);
      $CheckDosenAjarMk = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryBlmAturDosenAjarMk))
      {
        $CheckDosenAjarMk[] = $Hasil;
      }

      $CheckDosenThn = $CheckDosenAjarMk[0]['DosenThn'];
      $CheckDosenSemester = $CheckDosenAjarMk[0]['DosenSemester'];
      $AngkaSemester = 1;
      if ($CheckDosenSemester == 'Gasal' || $CheckDosenSemester == 'gasal')
      {
          $AngkaSemester = 1;
      }
      else
      {
          $AngkaSemester = 2;
      }

      $TempThnSemester = $CheckDosenThn.$AngkaSemester;
      $QueryCheckDosenAjarMk = "SELECT BAAK.DosenAjarMk.KodeMkBuka AS 'TotalDosenAjarMk' FROM BAAK.DosenAjarMk WHERE BAAK.DosenAjarMk.KodeMkBuka LIKE '%$TempThnSemester%';";

      $HasilQueryCheckDosenAjarMk = mysqli_query($MySQLi, $QueryCheckDosenAjarMk);
      $CheckDosenAjarMkAda = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryCheckDosenAjarMk))
      {
        $CheckDosenAjarMkAda[] = $Hasil;
      }

      if(empty($CheckDosenAjarMkAda))
      {
        $SemesterAktif[0]['TahunAkademik'] = "0";
        $SemesterAktif[0]['Semester'] = "0";
      }
      else
      {
          $QueryBlmAturMhsAmbilMk = "SELECT BAAK.SemesterAktif.ThnAkademik AS 'DosenThn', BAAK.SemesterAktif.Semester AS 'DosenSemester' FROM BAAK.SemesterAktif
          ORDER BY BAAK.SemesterAktif.ThnAkademik DESC, BAAK.SemesterAktif.Semester DESC LIMIT 1;";

          $HasilQueryBlmAturMhsAmbilMk = mysqli_query($MySQLi, $QueryBlmAturMhsAmbilMk);
          $CheckMhsAmbilMk = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryBlmAturMhsAmbilMk))
          {
            $CheckMhsAmbilMk[] = $Hasil;
          }

          $CheckMhsThn = $CheckMhsAmbilMk[0]['DosenThn'];
          $CheckMhsSemester = $CheckMhsAmbilMk[0]['DosenSemester'];
          $AngkaSemesterMhs = 1;
          if ($CheckMhsSemester == 'Gasal' || $CheckMhsSemester == 'gasal')
          {
              $AngkaSemesterMhs = 1;
          }
          else
          {
              $AngkaSemesterMhs = 2;
          }

          $TempThnSemesterMhs = $CheckMhsThn.$AngkaSemesterMhs;
          $QueryCheckMhsAmbilMk = "SELECT BAAK.MhsAmbilMk.KodeMkBuka AS 'TotalMhsAmbilMk' FROM BAAK.MhsAmbilMk WHERE BAAK.MhsAmbilMk.KodeMkBuka LIKE '%$TempThnSemesterMhs%';";

          $HasilQueryCheckMhsAmbilMk = mysqli_query($MySQLi, $QueryCheckMhsAmbilMk);
          $CheckMhsAmbilMkAda = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryCheckMhsAmbilMk))
          {
            $CheckMhsAmbilMkAda[] = $Hasil;
          }

          if(empty($CheckMhsAmbilMkAda))
          {
            $SemesterAktif[0]['TahunAkademik'] = "0";
            $SemesterAktif[0]['Semester'] = "0";
          }
      }
  }

  $ThnAkademik = $SemesterAktif[0]['TahunAkademik'];
  $Semester = $SemesterAktif[0]['Semester'];
?>
