<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Karyawan;
use App\JenisNilai;
use Input;
use Auth;
use Validator;
use Redirect;

class AndroidController extends Controller
{
    public function TampilMataKuliahBukaAndroid()
    {
        require "Init.php";
        $mysqli = mysqli_connect($domain, $username, $password, $database);
        $query = "SELECT dosenajarmk.NPK AS NPK, karyawan.Nama AS Nama, dosenajarmk.KodeMkBuka AS KodeMkBuka, dosenajarmk.KP AS KP, matakuliah.Nama AS NamaMk, matakuliah.SKS AS SKS
        FROM karyawan INNER JOIN dosenajarmk ON karyawan.NPK = dosenajarmk.NPK INNER JOIN mkbuka ON dosenajarmk.KodeMkBuka = mkbuka.KodeMkBuka INNER JOIN matakuliah ON mkbuka.KodeMk = matakuliah.KodeMk
        WHERE mkbuka.ThnAkademik = '$ThnAkademik' AND mkbuka.Semester = '$Semester'";

        $result = mysqli_query($mysqli, $query);
        $rows = array();
        while($r = mysqli_fetch_assoc($result))
        {
          $rows[] = $r;
        }
        $associativeArray['result'] = $rows;
        echo json_encode($associativeArray);
    }

    public function TampilDistinctMataKuliahDiajarTanpaLihatKPAndroid($NPK)
    {
        require "Init.php";
        $mysqli = mysqli_connect($domain, $username, $password, $database);
        $query = "SELECT DISTINCT dosenajarmk.KodeMkBuka AS KodeMkBuka, matakuliah.Nama AS NamaMk, matakuliah.SKS AS SKS, karyawan.NPK AS NPK,
        karyawan.Nama AS Nama FROM karyawan INNER JOIN dosenajarmk ON karyawan.NPK = dosenajarmk.NPK INNER JOIN mkbuka ON dosenajarmk.KodeMkBuka = mkbuka.KodeMkBuka
        INNER JOIN matakuliah ON mkbuka.KodeMk = matakuliah.KodeMk WHERE karyawan.NPK = '$NPK' AND mkbuka.ThnAkademik = '$ThnAkademik' AND mkbuka.Semester = '$Semester'";

        $result = mysqli_query($mysqli, $query);
        $rows = array();
        while($r = mysqli_fetch_assoc($result))
        {
          $rows[] = $r;
        }
        $associativeArray['result'] = $rows;
        echo json_encode($associativeArray);
    }

    public function JenisNilaiCreateTampilIndexNilaiPribadiAndroid($Kode)
    {
        require "Init.php";
        $mysqli = mysqli_connect($domain, $username, $password, $database);
        $query = "SELECT  d.KP AS 'KPKoordinator', d.NPK, d.KodeMkBuka FROM dosenajarmk d
        WHERE d.NPK in (SELECT m.NPK FROM mkbuka m  WHERE m.ThnAkademik = '$ThnAkademik'  AND m.Semester = '$Semester'  AND m.KodeMkBuka = '$Kode' )
        AND d.KodeMkBuka = '$Kode'";

        $result = mysqli_query($mysqli, $query);
        $rows = array();
        while($r = mysqli_fetch_assoc($result))
        {
          $rows[] = $r;
        }

        mysqli_close($mysqli);

        require '/../../RekapNilai.php';
        $mysqli = mysqli_connect($domain, $username, $password, $database);
        $temp = $rows[0]['KPKoordinator'];
        $query = "SELECT nilai.Jenis AS 'Jenis', nilai.Bobot AS 'Bobot', nilai.WaktuBuat AS 'WaktuBuat', nilai.DosenPembuat AS 'DosenPembuat', nilai.Status AS 'Status'
        FROM nilai WHERE nilai.KodeMkBuka = '$Kode' AND nilai.KP = '$temp' AND nilai.Syarat = 1";
        $result = mysqli_query($mysqli, $query);
        $Hasil = array();
        while($r = mysqli_fetch_assoc($result))
        {
          $Hasil[] = $r;
        }
        mysqli_close($mysqli);

        print_r($Hasil);
        exit();
        $associativeArray['result'] = $rows;
        echo json_encode($associativeArray);
    }
}
