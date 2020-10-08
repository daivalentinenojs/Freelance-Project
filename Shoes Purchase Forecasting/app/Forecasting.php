<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Forecasting extends Model
{
    // protected $table = '';
    // protected $guarded = [''];
    // protected $fillable = ['', '', '', '', ''];

    public function GetMerek($id)
    {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);
          //print_r($id);
          //exit();
          if($id == 'Pesanan'){
            $QueryGetDataBarang = "SELECT DISTINCT ms.ID AS'ID', ms.Nama AS 'Merek'
            FROM detailsepatucatatpemesanan dscp
            INNER JOIN detailsepatu ds ON dscp.DetailSepatuID = ds.ID
            INNER JOIN tipe t ON ds.TipeID = t.ID
            Inner Join mereksepatu ms ON ms.ID = t.MerekSepatuID";
            $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
            $DataBarang = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
              $DataBarang[] = $Hasil;
            }
          }
          else if($id == 'Penjualan'){
            $QueryGetDataBarang = "SELECT DISTINCT ms.ID AS'ID', ms.Nama AS 'Merek'
            FROM detailsepatucatatpenjualan dscp
            INNER JOIN detailsepatu ds ON dscp.DetailSepatuID = ds.ID
            INNER JOIN tipe t ON ds.TipeID = t.ID
            Inner Join mereksepatu ms ON ms.ID = t.MerekSepatuID";
            $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
            $DataBarang = array();
            while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
              $DataBarang[] = $Hasil;
            }
          }
          return $DataBarang;
    }

    public function GetTipe($id)
    {
          require '../connection/Init.php';
          $MySQLi = mysqli_connect($domain, $username, $password, $database);

          $QueryGetDataBarang = "SELECT t.ID as 'ID', t.Nama as  'Tipe'
          FROM tipe t
          WHERE t.MerekSepatuID  = '$id'";
          //echo $QueryGetDataBarang;
          $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
          $DataBarang = array();
          while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
            $DataBarang[] = $Hasil;
          }
          return $DataBarang;
    }

    public function GetDataAwal()
    {
        $DataAwal = array(112, 118, 132, 129, 121, 135, 148, 148, 136, 119, 104, 118,
        115, 126, 141, 135, 125, 149, 170, 170, 158, 133, 114, 140,
        145, 150, 178, 163, 172, 178, 199, 199, 184, 162, 146, 166,
        171, 180, 193, 181, 183, 218, 230, 242, 209, 191, 172, 194,
        196, 196, 236, 235, 229, 243, 264, 272, 237, 211, 180, 201,
        204, 188, 235, 227, 234, 264, 302, 293, 259, 229, 203, 229,
        242, 233, 267, 269, 270, 315, 364, 347, 312, 274, 237, 278,
        284, 277, 317, 313, 318, 374, 413, 405, 355, 306, 271, 306);
        return $DataAwal;
    }

    public function GetTahunAwal()
    {
        $DataAwal = array(1949, 1950, 1951, 1952, 1953, 1954, 1955, 1956);
        return $DataAwal;
    }

    public function Proses12MA($DataAwal)
    {
        $Hasil12MA;
        for ($i=0; $i < (count($DataAwal)-11); $i++) {
            $Hasil12MA[$i] = round((($DataAwal[$i] + $DataAwal[$i+1] + $DataAwal[$i+2] + $DataAwal[$i+3] + $DataAwal[$i+4] + $DataAwal[$i+5] +
            $DataAwal[$i+6] + $DataAwal[$i+7] + $DataAwal[$i+8] + $DataAwal[$i+9] + $DataAwal[$i+10] + $DataAwal[$i+11])/12),3);
        }
        return $Hasil12MA;
    }

    public function Proses2x12MA($Hasil12MA)
    {
        $Hasil2x12MA;
        for ($i=0; $i < (count($Hasil12MA)-1); $i++) {
            $Hasil2x12MA[$i] = round((($Hasil12MA[$i] + $Hasil12MA[$i+1])/2),3);
        }
        return $Hasil2x12MA;
    }

    public function ProsesRatio($Hasil2x12MA, $DataAwal)
    {
        $Ratio;
        for ($i=0; $i < (count($Hasil2x12MA)); $i++) {
            //$div=0;
            if ($Hasil2x12MA[$i]!=0)
            {
                $Ratio[$i] = round((($DataAwal[$i+6]/$Hasil2x12MA[$i])*100),3);
            }
            else {
                $Ratio[$i]=0;
            }

        }
        return $Ratio;
    }

    public function ProsesTabelAwal($Ratio)
    {
        $TabelAwal = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;

        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            if ($Baris < 6) {
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    array_push($Temp, $Ratio[(6+$i)+(12*$j)]);
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            } else {
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    array_push($Temp, $Ratio[(0+$i-6)+(12*$j)]);
                }
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
            }
            array_push($TabelAwal,$Temp);
            $Baris++;
        }

        for ($i=0; $i < 12; $i++) {
            if ($BarisTabel < 6) {
                for ($j=1; $j < 3; $j++) {
                    $TabelAwal[$i][$j]=round((($TabelAwal[$i][3]+$TabelAwal[$i][4])/2),3);
                }
            } else {
                for ($j=0; $j < 2; $j++) {
                    $TabelAwal[$i][$j]=round((($TabelAwal[$i][2]+$TabelAwal[$i][3])/2),3);
                }
            }
            $BarisTabel++;
        }

        for ($i=0; $i < 12; $i++) {
            if ($BarisTabelTambah < 6) {
                for ($j=10; $j < 12; $j++) {
                    $TabelAwal[$i][$j]=round((($TabelAwal[$i][8]+$TabelAwal[$i][9])/2),3);
                }
            } else {
                for ($j=9; $j < 11; $j++) {
                    $TabelAwal[$i][$j]=round((($TabelAwal[$i][7]+$TabelAwal[$i][8])/2),3);
                }
            }
            $BarisTabelTambah++;
        }
        return $TabelAwal;
    }

    public function ProsesTabel3x3MA($TabelAwal)
    {
        $Tabel3x3MA = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            if ($Baris < 6) {
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    $Isi1 = ($TabelAwal[$i][$j+1]+$TabelAwal[$i][$j+2]+$TabelAwal[$i][$j+3])/3;
                    $Isi2 = ($TabelAwal[$i][$j+2]+$TabelAwal[$i][$j+3]+$TabelAwal[$i][$j+4])/3;
                    $Isi3 = ($TabelAwal[$i][$j+3]+$TabelAwal[$i][$j+4]+$TabelAwal[$i][$j+5])/3;
                    $Hasil = round((($Isi1+$Isi2+$Isi3)/3),3);
                    array_push($Temp, $Hasil);
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            } else {
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    $Isi1 = ($TabelAwal[$i][$j+0]+$TabelAwal[$i][$j+1]+$TabelAwal[$i][$j+2])/3;
                    $Isi2 = ($TabelAwal[$i][$j+1]+$TabelAwal[$i][$j+2]+$TabelAwal[$i][$j+3])/3;
                    $Isi3 = ($TabelAwal[$i][$j+2]+$TabelAwal[$i][$j+3]+$TabelAwal[$i][$j+4])/3;
                    $Hasil = round((($Isi1+$Isi2+$Isi3)/3),3);
                    array_push($Temp, $Hasil);
                }
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
            }
            array_push($Tabel3x3MA,$Temp);
            $Baris++;
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $Tabel3x3MA[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $Tabel3x3MA;
    }

    public function ProsesTabelStandartDeviasi($TabelAwal, $Tabel3x3MA)
    {
        $TabelStandartDeviasi = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            if ($Baris < 6) {
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    $AkartPangkat = round($TabelAwal[$i][$j+3]-$Tabel3x3MA[$i][$j+3],3);
                    $Pangkat = $AkartPangkat * $AkartPangkat;
                    $HasilPangkat = round($Pangkat,3);
                    array_push($Temp, $HasilPangkat);
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            } else {
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    $AkartPangkat = round($TabelAwal[$i][$j+2]-$Tabel3x3MA[$i][$j+2],3);
                    $Pangkat = $AkartPangkat * $AkartPangkat;
                    $HasilPangkat = round($Pangkat,3);
                    array_push($Temp, $HasilPangkat);
                }
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
            }
            array_push($TabelStandartDeviasi,$Temp);
            $Baris++;
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelStandartDeviasi[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelStandartDeviasi;
    }

    public function ProsesRataRataStandartDeviasi($TabelStandartDeviasi)
    {
        $TabelRataRataStandartDeviasi = array();
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            $Sum = 0;
            for ($j=0; $j < 8; $j++) {
                $Sum += $TabelStandartDeviasi[$i][$j+2];
            }
            $Bagi = round($Sum/7,3);
            $Akar = sqrt($Bagi);
            array_push($TabelRataRataStandartDeviasi,round($Akar,3));
        }
        return $TabelRataRataStandartDeviasi;
    }

    public function ProsesTabelCheck($Tabel3x3MA, $TabelAwal, $RataRataStandartDeviasi)
    {
        $TabelCheck = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            if ($Baris < 6) {
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    $Pilih = 0;
                    if($TabelAwal[$i][$j+3] < ($Tabel3x3MA[$i][$j+3]+(2*$RataRataStandartDeviasi[$i])) && $TabelAwal[$i][$j+3] > ($Tabel3x3MA[$i][$j+3]-(2*$RataRataStandartDeviasi[$i]))) {
                        $Pilih = $TabelAwal[$i][$j+3] ;
                    } else {
                        $Pilih = 0;
                    }
                    array_push($Temp, round($Pilih,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            } else {
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    $Pilih = 0;
                    if($TabelAwal[$i][$j+2] < ($Tabel3x3MA[$i][$j+2]+(2*$RataRataStandartDeviasi[$i])) && $TabelAwal[$i][$j+2] > ($Tabel3x3MA[$i][$j+2]-(2*$RataRataStandartDeviasi[$i]))) {
                        $Pilih = $TabelAwal[$i][$j+2] ;
                    } else {
                        $Pilih = 0;
                    }
                    array_push($Temp, round($Pilih,3));
                }
                for ($j=0; $j < 3; $j++) {
                    array_push($Temp,0);
                }
            }
            array_push($TabelCheck,$Temp);
            $Baris++;
        }

        $TabelHasilCheck = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            if ($Baris < 6) {
                for ($j=0; $j < 3; $j++) {
                    if ($j == 2) {
                        array_push($Temp,$TabelCheck[$i][$j+1]);
                    } else {
                        array_push($Temp,0);
                    }
                }
                for ($j=0; $j < 7; $j++) {
                    $Pilih = 0;
                    if($TabelAwal[$i][$j+3] < ($Tabel3x3MA[$i][$j+3]+(2*$RataRataStandartDeviasi[$i])) && $TabelAwal[$i][$j+3] > ($Tabel3x3MA[$i][$j+3]-(2*$RataRataStandartDeviasi[$i]))) {
                        $Pilih = $TabelAwal[$i][$j+3];
                    } else {
                        $Pilih = ($TabelCheck[$i][$j+2]+$TabelCheck[$i][$j+4])/2;
                    }
                    array_push($Temp, round($Pilih,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            } else {
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 7; $j++) {
                    $Pilih = 0;
                    if($TabelAwal[$i][$j+2] < ($Tabel3x3MA[$i][$j+2]+(2*$RataRataStandartDeviasi[$i])) && $TabelAwal[$i][$j+2] > ($Tabel3x3MA[$i][$j+2]-(2*$RataRataStandartDeviasi[$i]))) {
                        $Pilih = $TabelAwal[$i][$j+2] ;
                    } else {
                        $Pilih = ($TabelCheck[$i][$j+1]+$TabelCheck[$i][$j+3])/2;
                    }
                    array_push($Temp, round($Pilih,3));
                }
                for ($j=0; $j < 3; $j++) {
                    if ($j == 0) {
                        array_push($Temp,$TabelCheck[$i][8-$j]);
                    } else {
                        array_push($Temp,0);
                    }
                }
            }
            array_push($TabelHasilCheck,$Temp);
            $Baris++;
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelCheck[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelHasilCheck;
    }

    public function ProsesRataRataCheck($TabelHasilCheck)
    {
        $TabelRataRataCheck = array();
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            $Sum = 0;
            for ($j=0; $j < 12; $j++) {
                $Sum += $TabelHasilCheck[$j][$i];
            }
            $Bagi = round($Sum/12,3);
            array_push($TabelRataRataCheck, $Bagi);
        }
        return $TabelRataRataCheck;
    }

    public function ProsesTabelKuning($TabelHasilCheck, $RataRataCheck)
    {
        $TabelKuning = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 8; $j++) {
                    $Nilai = 0;
                    if ($RataRataCheck[$j+2]!=0)
                    {
                      $Nilai = $TabelHasilCheck[$i][$j+2] / $RataRataCheck[$j+2] * 100;
                    }
                    array_push($Temp, round($Nilai,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            array_push($TabelKuning,$Temp);
            $Baris++;
        }

        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    $TabelKuning[$i][$j] = round(($TabelKuning[$i][2]  + $TabelKuning[$i][3]) / 2 , 3);
                }
                for ($j=0; $j < 2; $j++) {
                    $TabelKuning[$i][$j+10] = round(($TabelKuning[$i][8]  + $TabelKuning[$i][9]) / 2 , 3);
                }
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelKuning[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelKuning;
    }

    public function ProsesTabel3x3MAFaktorMusimanAwal($TabelHasilKuning)
    {
        $Tabel3x3MAFaktorMusimanAwal = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($k=0; $k < 8; $k++) {
                    $Sum1=0;$Sum2=0;$Sum3=0;$Rata1=0;$Rata2=0;$Rata3=0;
                    for ($j=0; $j < 3; $j++) {
                        $Sum1 += $TabelHasilKuning[$i][$j+$k];
                        $Sum2 += $TabelHasilKuning[$i][$j+$k+1];
                        $Sum3 += $TabelHasilKuning[$i][$j+$k+2];
                    }
                    $Rata1 = round($Sum1/3,3);
                    $Rata2 = round($Sum2/3,3);
                    $Rata3 = round($Sum3/3,3);
                    $Sum = $Rata1 + $Rata2 + $Rata3;
                    $Rata = $Sum/3;
                    array_push($Temp, round($Rata,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            array_push($Tabel3x3MAFaktorMusimanAwal,$Temp);
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $Tabel3x3MAFaktorMusimanAwal[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $Tabel3x3MAFaktorMusimanAwal;
    }

    public function ProsesTabelDeretAwalSetelahPenyesuaianMusimAwal($DataAwal, $Tabel3x3MAFaktorMusimanAwal)
    {
        $TabelDeretAwalSetelahPenyesuaianMusimAwal = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Index=0;
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($k=0; $k < 8; $k++) {
                    $Nilai=0;
                    if ($Tabel3x3MAFaktorMusimanAwal[$i][$k+2]>0)
                    {
                        $Nilai = $DataAwal[(12*$k)+$i]/$Tabel3x3MAFaktorMusimanAwal[$i][$k+2]*100;
                    }

                    $Index++;
                    array_push($Temp, round($Nilai,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            array_push($TabelDeretAwalSetelahPenyesuaianMusimAwal,$Temp);
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelDeretAwalSetelahPenyesuaianMusimAwal[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelDeretAwalSetelahPenyesuaianMusimAwal;
    }

    // Musim Akhir
    public function GetDataAkhir()
    {
        $DataAkhir = array(125.7202689, 125.1162966, 125.3534211, 128.2880408, 128.0696328, 126.6007848,
        124.9383887, 125.5739234, 125.7461745, 128.7407615, 128.1175582, 128.8931825,
        127.9545062, 133.2108246, 133.6287251, 135.8497921, 131.2703301, 140.091098,
        143.5304198, 143.8195814, 146.9426136, 144.3147031, 140.2323961, 153.1054431,
        159.37, 159.64, 168.68, 166.31, 176.87, 167.79, 168.77, 167.59, 172.87, 175.22, 179.28, 182.00,
        186.77, 194.51, 184.11, 186.15, 186.52, 204.39, 194.19, 201.88, 198.20, 205.86, 211.14, 213.03,
        213.67, 218.34, 227.31, 241.40, 231.25, 225.23, 219.96, 226.08, 225.20, 226.75, 222.47, 221.18,
        222.36, 214.32, 229.64, 232.34, 237.39, 240.35, 245.97, 243.20, 245.83, 247.63, 252.95, 252.37,
        263.43, 267.58, 264.92, 274.98, 275.16, 282.69, 291.69, 288.42, 295.11, 298.27, 297.74, 306.81,
        308.97, 316.82, 317.98, 320.62, 325.84, 332.34, 328.81, 336.15, 335.60, 335.11, 340.93, 337.99);
        return $DataAkhir;
    }

    public function AwalKeAkhir($TabelDeretAwalSetelahPenyesuaianMusimAwal)
    {
        $DataAwalSatuDimensi = array();
        for ($i=0; $i < 8; $i++) {
            for ($j=0; $j < 12; $j++) {
                $Hasil = $TabelDeretAwalSetelahPenyesuaianMusimAwal[$j][$i+2];
                array_push($DataAwalSatuDimensi,round($Hasil,5));
            }
        }
        return $DataAwalSatuDimensi;
    }

    public function GetDataAwalMusimAwal($DataAkhir)
    {
        $DataAwalMusimAkhir = array();
        for ($i=0; $i < 7; $i++) {
            $Sum = 0;
            for ($j=0; $j < 4; $j++) {
                $Sum += $DataAkhir[$j];
            }
            $Rata = $Sum / 4;
            array_push($DataAwalMusimAkhir,round($Rata,3));
        }
        for ($i=0; $i < count($DataAkhir); $i++) {
            array_push($DataAwalMusimAkhir,round($DataAkhir[$i],3));
        }
        for ($i=0; $i < 7; $i++) {
            $Sum = 0;
            for ($j=0; $j < 4; $j++) {
                $Sum += $DataAkhir[count($DataAkhir)-$j-1];
            }
            $Rata = $Sum / 4;
            array_push($DataAwalMusimAkhir,round($Rata,3));
        }
        return $DataAwalMusimAkhir;
    }

    public function GetDataBantuan()
    {
        $DataBantuan = array(-0.009,	-0.019,	-0.016,	0.009,	0.066,	0.144,	0.209,	0.231,	0.209,	0.144,	0.066,	0.009,	-0.016,	-0.019,	-0.009);
        return $DataBantuan;
    }

    public function ProsesTabel15SpancerAkhir($DataAwalMusimAkhir, $DataBantuan, $DataAwal)
    {
        $Tabel15Spancer = array();
        $Sum = 0;
        for ($i=0; $i < count($DataAwal); $i++) {
            for ($j=0; $j < 15; $j++) {
                $HasilKali = $DataAwalMusimAkhir[$i+$j] * $DataBantuan[$j];
                $Sum += $HasilKali;
            }
            array_push($Tabel15Spancer,round($Sum,3));
            $Sum = 0;
        }
        return $Tabel15Spancer;
    }

    public function ProsesTabelRatioAkhir($DataAwal, $Tabel15Spancer)
    {
        $TabelRatio = array();
        $Sum = 0;
        for ($i=0; $i < count($DataAwal); $i++) {
            $Hasil=0;
            if ($Tabel15Spancer[$i]!=0)
            {
                $Hasil = $DataAwal[$i] / $Tabel15Spancer[$i] * 100;
            }
            array_push($TabelRatio,round($Hasil,3));
        }
        return $TabelRatio;
    }

    public function ProsesTabelTCAkhir($Tabel15Spancer)
    {
        $TabelTC = array();

        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            for ($j=0; $j < 2; $j++) {
                array_push($Temp,0);
            }
            for ($j=0; $j < 8; $j++) {
                array_push($Temp, $Tabel15Spancer[($i)+(12*$j)]);
            }
            for ($j=0; $j < 2; $j++) {
                array_push($Temp,0);
            }
            array_push($TabelTC,$Temp);
        }

        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
           $Temp = array();
               for ($j=0; $j < 2; $j++) {
                   $TabelTC[$i][$j] = round(($TabelTC[$i][2]  + $TabelTC[$i][3]) / 2 , 5);
               }
               for ($j=0; $j < 2; $j++) {
                   $TabelTC[$i][$j+10] = round(($TabelTC[$i][8]  + $TabelTC[$i][9]) / 2 , 5);
               }
        }
        return $TabelTC;
    }

    public function ProsesIndexMusiman($TabelTCAkhir)
    {
        $TabelIndexMusiman = array();

        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            for ($j=0; $j < 2; $j++) {
                array_push($Temp,0);
            }
            $Sum = 0;
            $Jumlah = 0;
            for ($j=0; $j < 8; $j++) {
                $Sum += $TabelTCAkhir[$i][$j+2];
                $Jumlah++;
            }
            $Rata = $Sum / $Jumlah;
            array_push($TabelIndexMusiman,round($Rata,3));
        }
        return $TabelIndexMusiman;
    }

    public function ProsesTabel3x3MAFaktorMusimanAkhir($TabelTCAkhir)
    {
        $Tabel3x3MAFaktorMusimanAkhir = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($k=0; $k < 8; $k++) {
                    $Sum1=0;$Sum2=0;$Sum3=0;$Rata1=0;$Rata2=0;$Rata3=0;
                    for ($j=0; $j < 3; $j++) {
                        $Sum1 += $TabelTCAkhir[$i][$j+$k];
                        $Sum2 += $TabelTCAkhir[$i][$j+$k+1];
                        $Sum3 += $TabelTCAkhir[$i][$j+$k+2];
                    }
                    $Rata1 = round($Sum1/3,3);
                    $Rata2 = round($Sum2/3,3);
                    $Rata3 = round($Sum3/3,3);
                    $Sum = $Rata1 + $Rata2 + $Rata3;
                    $Rata = $Sum/3;
                    array_push($Temp, round($Rata,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            array_push($Tabel3x3MAFaktorMusimanAkhir,$Temp);
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $Tabel3x3MAFaktorMusimanAkhir[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $Tabel3x3MAFaktorMusimanAkhir;
    }

    public function ProsesTabelStandartDeviasiAkhir($TabelTCAkhir, $Tabel3x3MAFaktorMusimanAkhir)
    {
        $TabelStandartDeviasiAkhir = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();

                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,"");
                }
                for ($j=0; $j < 8; $j++) {
                    $AkartPangkat = $TabelTCAkhir[$i][$j+2]-$Tabel3x3MAFaktorMusimanAkhir[$i][$j+2];
                    $Pangkat = $AkartPangkat * $AkartPangkat;
                    $HasilPangkat = round($Pangkat,4);
                    array_push($Temp, $HasilPangkat);
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,"");
                }
            array_push($TabelStandartDeviasiAkhir,$Temp);
            $Baris++;
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelStandartDeviasiAkhir[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelStandartDeviasiAkhir;
    }

    public function ProsesAkarStandartDeviasi($TabelStandartDeviasiAkhir)
    {
        $TabelRataRataStandartDeviasi = array();
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
            $Sum = 0;
            for ($j=0; $j < 8; $j++) {
                $Sum += $TabelStandartDeviasiAkhir[$i][$j+2];
            }
            $Bagi = round($Sum/8,3);
            $Akar = sqrt($Bagi);
            array_push($TabelRataRataStandartDeviasi,round($Akar,3));
        }

        //print_r($TabelRataRataStandartDeviasi);
        return $TabelRataRataStandartDeviasi;
    }

    public function ProsesBesarKecilMusimAkhir($TabelAwal, $Tabel3x3MA, $RataRataStandartDeviasi)
    {
      //print_r($RataRataStandartDeviasi);
        $TabelCheck = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();

                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 8; $j++) {
                    $Pilih = 0;
                    if(($TabelAwal[$i][$j+2] < ($Tabel3x3MA[$i][$j+2]+(2*$RataRataStandartDeviasi[$i]))-2) && ($TabelAwal[$i][$j+2] > ($Tabel3x3MA[$i][$j+2]-(2*$RataRataStandartDeviasi[$i]))+2)) {
                        $Pilih = $TabelAwal[$i][$j+2];
                    } else {
                        $Pilih = 0;
                    }
                    array_push($Temp, round($Pilih,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }

            array_push($TabelCheck,$Temp);
            $Baris++;
        }

        $TabelHasilCheck = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                        array_push($Temp,0);
                }
                for ($j=0; $j < 8; $j++) {
                    $Pilih = 0;
                    if((($TabelAwal[$i][$j+2]) < ($Tabel3x3MA[$i][$j+2]+(2*$RataRataStandartDeviasi[$i]))) && ($TabelAwal[$i][$j+2] > ($Tabel3x3MA[$i][$j+2]-(2*$RataRataStandartDeviasi[$i])))) {
                        $Pilih = $TabelAwal[$i][$j+2];
                        // $Pilih = 1;
                    } else {
                        $Pilih = -100;
                        //($TabelCheck[$i][$j+1]+$TabelCheck[$i][$j+3])/2;
                        // $Pilih = 0;
                    }
                    array_push($Temp, round($Pilih,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            array_push($TabelHasilCheck,$Temp);
            $Baris++;
        }
        //print_r($TabelHasilCheck);

        for ($i=0;$i<count($TabelHasilCheck);$i++)
        {
          for ($j=0;$j<count($TabelHasilCheck[$i]);$j++)
          {
            if ($TabelHasilCheck[$i][$j]==-100)
            {
              $TabelHasilCheck[$i][$j]=($TabelHasilCheck[$i][$j-1]+$TabelHasilCheck[$i][$j+1])/2;
            }
            //echo $TabelHasilCheck[$i][$j];
            //echo "<br/>";
          }
          //print_r($TabelHasilCheck[$i]);
          //echo "<br/>";
          /*
          for ($j=0;$j<count($TabelHasilCheck[$i];$j++))
          {
            echo $TabelHasilCheck[$i][$j]." ";
            echo "<br/>";
          }*/
        }
        //echo $TabelCheck[10][2]." -- ".$TabelCheck[10][4];
        //echo $TabelAwal[10][3]." & ".$Tabel3x3MA[10][3]." & ".$RataRataStandartDeviasi[10];
        //print_r($RataRataStandartDeviasi);
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelCheck[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelHasilCheck;
    }

    public function ProsesRataBesarKecil($TabelBesarKecilMusimAkhir)
    {
        $TabelRata = array();
        $Sum = 0;
        for ($i=0; $i < 8; $i++) {
            $Hasil = 0;
            for ($j=0; $j < 12; $j++) {
                $Hasil += $TabelBesarKecilMusimAkhir[$j][$i+2];
            }
            $Rata = $Hasil/12;
            array_push($TabelRata,round($Rata,3));
            $Sum = 0;
        }
        return $TabelRata;
    }

    public function ProsesTabelKuningKuning($TabelHasilCheck, $RataRataCheck)
    {
        $TabelKuning = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 8; $j++) {
                    $Nilai = 0;
                    $Nilai = $TabelHasilCheck[$i][$j+2] / $RataRataCheck[$j] * 100;
                    array_push($Temp, round($Nilai,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            array_push($TabelKuning,$Temp);
            $Baris++;
        }

        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    $TabelKuning[$i][$j] = round(($TabelKuning[$i][2]  + $TabelKuning[$i][3]) / 2 , 3);
                }
                for ($j=0; $j < 2; $j++) {
                    $TabelKuning[$i][$j+10] = round(($TabelKuning[$i][8]  + $TabelKuning[$i][9]) / 2 , 3);
                }
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelKuning[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelKuning;
    }

    public function ProsesTabel3x3MAFaktorMusimanAkhirFinal($TabelHasilKuning)
    {
        $Tabel3x3MAFaktorMusimanAwal = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($k=0; $k < 8; $k++) {
                    $Sum1=0;$Sum2=0;$Sum3=0;$Rata1=0;$Rata2=0;$Rata3=0;
                    for ($j=0; $j < 3; $j++) {
                        $Sum1 += $TabelHasilKuning[$i][$j+$k];
                        $Sum2 += $TabelHasilKuning[$i][$j+$k+1];
                        $Sum3 += $TabelHasilKuning[$i][$j+$k+2];
                    }
                    $Rata1 = round($Sum1/3,3);
                    $Rata2 = round($Sum2/3,3);
                    $Rata3 = round($Sum3/3,3);
                    $Sum = $Rata1 + $Rata2 + $Rata3;
                    $Rata = $Sum/3;
                    array_push($Temp, round($Rata,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
            array_push($Tabel3x3MAFaktorMusimanAwal,$Temp);
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $Tabel3x3MAFaktorMusimanAwal[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }

        return $Tabel3x3MAFaktorMusimanAwal;
    }

    public function ProsesTabel3x3MARata($Tabel3x3MAFaktorMusimanAkhirFinal)
    {

        //print_r($Tabel3x3MAFaktorMusimanAkhirFinal);
        //echo "<br/><br/>";
        $Data3x3MARata = array();
        for ($i=0; $i < count($Tabel3x3MAFaktorMusimanAkhirFinal); $i++) {

            $ttlData=0;
            $Sum = 0;
            for ($j=0; $j < count($Tabel3x3MAFaktorMusimanAkhirFinal[$i]); $j++) {
                if ($Tabel3x3MAFaktorMusimanAkhirFinal[$i][$j]!=0)
                {
                    $ttlData++;
                    $Sum += $Tabel3x3MAFaktorMusimanAkhirFinal[$i][$j];
                }

            }

            $Rata=0;
            if ($ttlData>0)
            {
                $Rata = $Sum / $ttlData;
            }
            array_push($Data3x3MARata,round($Rata,3));
        }
        //print_r($Data3x3MARata);
        return $Data3x3MARata;
    }

    public function ProsesTabelDeretAwalSetelahPenyesuaianMusimAkhir($DataAwal, $Tabel3x3MAFaktorMusimanAwal)
    {
        $TabelDeretAwalSetelahPenyesuaianMusimAwal = array();
        $Index = 0;
        $Baris = 0;
        $BarisTabel = 0;
        $BarisTabelTambah = 0;
        for ($i=0; $i < 12; $i++) {
            $Index=0;
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,-1);
                }
                for ($k=0; $k < 8; $k++) {
                    $Nilai = $DataAwal[(12*$k)+$i]/$Tabel3x3MAFaktorMusimanAwal[$i][$k+2]*100;
                    $Index++;
                    array_push($Temp, round($Nilai,3));
                }
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,-1);
                }
            array_push($TabelDeretAwalSetelahPenyesuaianMusimAwal,$Temp);
        }
        // for ($i=0; $i < 12; $i++) {
        //     for ($j=0; $j < 12; $j++) {
        //         echo $TabelDeretAwalSetelahPenyesuaianMusimAwal[$i][$j]."   ";
        //     }
        //     echo "<br/>";
        // }
        return $TabelDeretAwalSetelahPenyesuaianMusimAwal;
    }

    /*Taksiran*/
    public function AkhirKeTaksiran($TabelDeretAwalSetelahPenyesuaianMusimAwal)
    {
        $DataAwalSatuDimensi = array();
        for ($i=0; $i < 8; $i++) {
            for ($j=0; $j < 12; $j++) {
                $Hasil = $TabelDeretAwalSetelahPenyesuaianMusimAwal[$j][$i+2];
                array_push($DataAwalSatuDimensi,round($Hasil,5));
            }
        }
        return $DataAwalSatuDimensi;
    }

    public function GetDataAwalMusimAkhir($DataAkhir)
    {
        $DataAwalMusimAkhir = array();
        for ($i=0; $i < 7; $i++) {
            $Sum = 0;
            for ($j=0; $j < 4; $j++) {
                $Sum += $DataAkhir[$j];
            }
            $Rata = $Sum / 4;
            array_push($DataAwalMusimAkhir,round($Rata,3));
        }
        for ($i=0; $i < count($DataAkhir); $i++) {
            array_push($DataAwalMusimAkhir,round($DataAkhir[$i],3));
        }
        for ($i=0; $i < 7; $i++) {
            $Sum = 0;
            for ($j=0; $j < 4; $j++) {
                $Sum += $DataAkhir[count($DataAkhir)-$j-1];
            }
            $Rata = $Sum / 4;
            array_push($DataAwalMusimAkhir,round($Rata,3));
        }
        return $DataAwalMusimAkhir;
    }

    public function GetDataAwalTaksiran($DataAkhir)
    {
        $DataAwalMusimAkhir = array();
        $Sum = 0;
        for ($j=0; $j < 4; $j++) {
            $Sum += $DataAkhir[$j];
        }
        $Rata = $Sum / 4;
        for ($i=0; $i < 7; $i++) {

            array_push($DataAwalMusimAkhir,round($Rata,3));
        }
        for ($i=0; $i < count($DataAkhir); $i++) {
            array_push($DataAwalMusimAkhir,round($DataAkhir[$i],3));
        }
        for ($i=0; $i < 7; $i++) {
            $Sum = 0;
            for ($j=0; $j < 4; $j++) {
                $Sum += $DataAkhir[count($DataAkhir)-$j-1];
            }
            $Rata = $Sum / 4;
            array_push($DataAwalMusimAkhir,round($Rata,3));
        }
        return $DataAwalMusimAkhir;
    }

    public function ProsesTabel15Spancer($DataAwalMusimAkhir, $DataBantuan, $DataAwal)
    {
        $Tabel15Spancer = array();
        $Sum = 0;
        //echo "<br/>Ukuran ".count($DataAwal)."<br/>";

        for ($i=0; $i < count($DataAwal); $i++) {
            for ($j=0; $j < 15; $j++) {
                $HasilKali = $DataAwalMusimAkhir[$i+$j] * $DataBantuan[$j];
                $Sum += $HasilKali;
            }
            array_push($Tabel15Spancer,round($Sum,3));
            $Sum = 0;
        }
        return $Tabel15Spancer;
    }

    public function ProsesTabelRatio($DataAwal, $Tabel15Spancer)
    {
        $TabelRatio = array();
        $Sum = 0;
        for ($i=0; $i < count($DataAwal); $i++) {
            $Hasil=0;
            if ($Tabel15Spancer[$i]!=0)
            {
              $Hasil = $DataAwal[$i] / $Tabel15Spancer[$i] * 100;
            }
            array_push($TabelRatio,round($Hasil,3));
        }
        return $TabelRatio;
    }

    public function ProsesTabelTC($Tabel15Spancer)
    {
        $TabelTC = array();

        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 8; $j++) {
                    array_push($Temp, $Tabel15Spancer[($i)+(12*$j)]);
                }
            array_push($TabelTC,$Temp);
        }
        return $TabelTC;
    }

    public function GetTabelDataAkhir($DataAkhir)
    {
        $TabelDataAkhir = array();

        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 8; $j++) {
                    array_push($Temp, $DataAkhir[($i)+(12*$j)]);
                }
            array_push($TabelDataAkhir,$Temp);
        }
        return $TabelDataAkhir;
    }

    public function ProsesTabelR($TabelDataAkhir, $TabelTC)
    {
        $TabelR = array();

        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                for ($j=0; $j < 8; $j++) {
                    $Hasil=0;
                    if ($TabelTC[$i][$j+2]!=0)
                    {
                      $Hasil = $TabelDataAkhir[$i][$j+2] / $TabelTC[$i][$j+2] * 100;
                    }

                    array_push($Temp, round($Hasil,3));
                }
            array_push($TabelR,$Temp);
        }
        return $TabelR;
    }

    /*PERAMALAN*/
    public function ProsesTabel3MAKomponenTCBantuan0($UbahDataAkhirKeDataTaksiran)
    {
        $Tabel3MAKomponenTC = array();
        array_push($Tabel3MAKomponenTC,0);
        for ($i=0; $i < count($UbahDataAkhirKeDataTaksiran)-2; $i++) {
                $Hasil = round(($UbahDataAkhirKeDataTaksiran[$i] + $UbahDataAkhirKeDataTaksiran[$i+1] + $UbahDataAkhirKeDataTaksiran[$i+2])/3,3);
                array_push($Tabel3MAKomponenTC,round($Hasil,3));
        }
        $idxC=count($UbahDataAkhirKeDataTaksiran)-2;
        $idxC2=count($Tabel3MAKomponenTC)-1;
        $selisih=($Tabel3MAKomponenTC[$idxC2]-$Tabel3MAKomponenTC[$idxC2-1])/2;
        $Hasil= round(($UbahDataAkhirKeDataTaksiran[$idxC] + $UbahDataAkhirKeDataTaksiran[$idxC+1])/2,3)+$selisih;
        array_push($Tabel3MAKomponenTC,round($Hasil,3));
        return $Tabel3MAKomponenTC;
    }

    public function ProsesTabel3MAKomponenTCTanpa0($UbahDataAkhirKeDataTaksiran)
    {
        $Tabel3MAKomponenTC = array();
        for ($i=0; $i < count($UbahDataAkhirKeDataTaksiran)-2; $i++) {
                $Hasil = round(($UbahDataAkhirKeDataTaksiran[$i] + $UbahDataAkhirKeDataTaksiran[$i+1] + $UbahDataAkhirKeDataTaksiran[$i+2])/3,3);
                array_push($Tabel3MAKomponenTC,round($Hasil,3));
        }
        return $Tabel3MAKomponenTC;
    }

    public function RamalanTCI($MAKomponenTC, $FaktorMusimanAkhir3x3){
        $HasilRamalanTCI = array();
        $j=0;
        for ($i=0;$i<count($MAKomponenTC);$i++)
        {
            $hasil=($MAKomponenTC[$i]*$FaktorMusimanAkhir3x3[$j])/100;
            array_push($HasilRamalanTCI,$hasil);
            $j++;
            if ($j>=count($FaktorMusimanAkhir3x3))
            {
                $j=0;
            }
        }
        return $HasilRamalanTCI;
    }

    public function UjiPresentaseDataAkhir($MAKomponenTC){
        $hasil=array();
        array_push($hasil,0);
        array_push($hasil,0);
        for ($i=2;$i<count($MAKomponenTC);$i++)
        {
            $kembalian=0;
            if ($MAKomponenTC[$i-1]!=0)
            {
              $kembalian=(abs($MAKomponenTC[$i-1]-$MAKomponenTC[$i])*100)/$MAKomponenTC[$i-1];
            }
            array_push($hasil,round($kembalian,3));
        }
        $rata=array_sum($hasil)/(count($hasil)-2);
        return $rata;
    }

    public function HasilRamalanMusimAkhirDanKomponenTC($nilaiAkhir,$rata,$nilaiAkhir2,$nilaiAkhir3)
    {
        $kembalian=array();
        $kembalian2=array();

        $operasi=$nilaiAkhir;
        for ($i=0;$i<12;$i++)
        {
            $hasil=$operasi+$operasi*$rata/100;
            array_push($kembalian,$hasil);

            $hasil2=(($hasil+$operasi)/2)+($nilaiAkhir2-$nilaiAkhir3)/2;
            array_push($kembalian2,$hasil2);

            $nilaiAkhir3=$nilaiAkhir2;
            $nilaiAkhir2=$hasil2;
            $operasi=$hasil;
        }
        $return["kembalian"]=$kembalian;
        $return["kembalian2"]=$kembalian2;
        return $return;
    }


    public function HasilAkhirProsesPeramalan($Tabel3x3MA, $KomponenTC){
        $hasilakhir = array();
        for($i=0; $i<12; $i++){
            $hasil=$Tabel3x3MA[$i]*$KomponenTC[$i]/100;
            array_push($hasilakhir, round($hasil,0));
        }
        //echo "<br>";
        //print_r($hasilakhir);
        return $hasilakhir;
    }

    public function MSE($DataAwal, $RamalanTCI){
        $MSE = array();
        for($i=1; $i<count($DataAwal);$i++){
            $tampung = $DataAwal[$i]-$RamalanTCI[$i];
            $hasil=$tampung*$tampung;
            array_push($MSE, round($hasil,3));
        }
        $rata=array_sum($MSE)/count($MSE);
        $rata=round($rata,3);
        return $rata;
    }






    public function ProsesTabelRamalanTCBantuan0($Tabel3MAKomponenTCDenganBantuan0, $Tabel3x3MARata)
    {
        $TabelRamalanTC = array();
        for ($i=0; $i < count($Tabel3MAKomponenTCDenganBantuan0); $i++) {
                $Hasil = $Tabel3MAKomponenTCDenganBantuan0[$i]*$Tabel3x3MARata[$i%12]/100;
                array_push($TabelRamalanTC,round($Hasil,3));
        }
        return $TabelRamalanTC;
    }


    public function ProsesTabelRamalanTCTanpa0($TabelRamalanTCDenganBantuan0)
    {
        $TabelRamalanTC = array();
        for ($i=1; $i < count($TabelRamalanTCDenganBantuan0); $i++) {
                $Hasil = $TabelRamalanTCDenganBantuan0[$i];
                array_push($TabelRamalanTC,round($Hasil,3));
        }
        return $TabelRamalanTC;
    }

    public function ProsesTabelKuadratBantuan0($TabelRamalanTCDenganBantuan0, $DataAwal)
    {
        $TabelKuadratDenganBantuan0 = array();
        for ($i=0; $i < count($TabelRamalanTCDenganBantuan0); $i++) {
                $Minus = $TabelRamalanTCDenganBantuan0[$i]-$DataAwal[$i];
                $Pangkat = $Minus * $Minus;
                array_push($TabelKuadratDenganBantuan0,round($Pangkat,3));
        }
        return $TabelKuadratDenganBantuan0;
    }

    public function ProsesTabelKuadratTanpa0($TabelKuadratDenganBantuan0)
    {
        $TabelKuadratTanpa0 = array();
        for ($i=1; $i < count($TabelKuadratDenganBantuan0); $i++) {
                $Hasil = $TabelKuadratDenganBantuan0[$i];
                array_push($TabelKuadratTanpa0,round($Hasil,3));
        }
        return $TabelKuadratTanpa0;
    }

    public function ProsesTabelRataKuadrat($TabelKuadratTanpa0)
    {
        $Sum = 0;
        for ($i=0; $i < count($TabelKuadratTanpa0); $i++) {
                $Sum += $TabelKuadratTanpa0[$i];
        }
        // $Rata = $Sum / count($TabelKuadratTanpa0);
        $Rata = round($Sum / count($TabelKuadratTanpa0) / 100,3);
        return $Rata;
    }

    public function ProsesTabelTC3MA($Tabel3MAKomponenTCDenganBantuan0)
    {
        $TabelTC3MA = array();
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                if ($i == 11) {
                    for ($j=0; $j < 7; $j++) {
                        array_push($Temp, $Tabel3MAKomponenTCDenganBantuan0[($i)+(12*$j)]);
                    }
                    array_push($Temp, 0);
                } else {
                    for ($j=0; $j < 8; $j++) {
                        array_push($Temp, $Tabel3MAKomponenTCDenganBantuan0[($i)+(12*$j)]);
                    }
                }

            array_push($TabelTC3MA,$Temp);
        }
        return $TabelTC3MA;
    }

    public function ProsesTabelRataKurangBagi($Tabel3MAKomponenTCTanpa0)
    {
        $TabelHasil = array();
        array_push($TabelHasil,0);
        array_push($TabelHasil,0);
        for ($i=1; $i < count($Tabel3MAKomponenTCTanpa0)-1; $i++) {
                $Hasil=0;
                if ($Tabel3MAKomponenTCTanpa0[$i]!=0)
                {
                    $Hasil = ($Tabel3MAKomponenTCTanpa0[$i+1]-$Tabel3MAKomponenTCTanpa0[$i])*100/$Tabel3MAKomponenTCTanpa0[$i];
                }

                array_push($TabelHasil,round($Hasil,3));
        }
        array_push($TabelHasil,0);
        return $TabelHasil;
    }

    public function ProsesTabelHasil($RataKurangBagi)
    {
        $TabelTC3MA = array();
        for ($i=0; $i < 12; $i++) {
            $Temp = array();
                for ($j=0; $j < 2; $j++) {
                    array_push($Temp,0);
                }
                if ($i == 11) {
                    for ($j=0; $j < 7; $j++) {
                        array_push($Temp, $RataKurangBagi[($i)+(12*$j)]);
                    }
                    array_push($Temp, 0);
                } else {
                    for ($j=0; $j < 8; $j++) {
                        array_push($Temp, $RataKurangBagi[($i)+(12*$j)]);
                    }
                }

            array_push($TabelTC3MA,$Temp);
        }
        return $TabelTC3MA;
    }

    public function ProsesTabelRataAkhir($TabelHasil)
    {
        $Sum = 0;
        for ($i=0; $i < count($TabelHasil); $i++) {
                $Sum += $TabelHasil[$i];
        }
        // $Rata = $Sum / count($TabelKuadratTanpa0);
        $Rata = round(($Sum / count($TabelHasil)),3);
        return $Rata;
    }

    public function ProsesTabelRamalan($UbahDataAkhirKeDataTaksiran, $RataRataAkhir)
    {
        $TabelAkhir = array();
        $TabelFinal = array();
        $Index = 0;
        for ($i=0; $i < count($UbahDataAkhirKeDataTaksiran); $i++) {
                array_push($TabelAkhir,round($UbahDataAkhirKeDataTaksiran[$i],3));
                $Index++;
        }
        for ($i=0; $i < 12; $i++) {
                $Hitung = $UbahDataAkhirKeDataTaksiran[$Index-1]-($UbahDataAkhirKeDataTaksiran[$Index-1]*$RataRataAkhir/100);
                array_push($UbahDataAkhirKeDataTaksiran,round($Hitung,3));
                array_push($TabelAkhir,round($Hitung,3));
                array_push($TabelFinal,round($Hitung,3));
                $Index++;
        }
        return $TabelFinal;
    }
}
