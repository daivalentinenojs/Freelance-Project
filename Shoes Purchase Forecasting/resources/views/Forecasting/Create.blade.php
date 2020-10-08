<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Forecasting')

@section('Title','Sistem Informasi Forecasting')
@section('Nama','Sistem Informasi Forecasting')

@section('FotoLogin',url('foto/perusahaan.png'))

@section('ID')
   {{$Name}}
@endsection

@section('NamaLogin')
   {{$Jabatan}}
@endsection


@section('Navigasi')
   @include('../Navigasi/Navigasi')
@endsection

@section('isi')
<script type="text/javascript">
$(document).ready(function()
{
  //alert("ready");
  $('#CheckTipe').change(function() {
        //alert("tipe change");
        if(this.checked) {
          $("#tipeS").show();
        }
        else {
          $("#tipeS").hide();
        }
  });
});
function PilihMerek(param){
  var id = param.value;
  $.get(
  'Merek/'+id,function(data){
    $('#Merek').html('');
    $('#Merek').html(data);

  })
}

function PilihTipe()
{
  var id = $("#Merek").val();
  console.log(id);
  $.get(
  'Tipe/'+id,function(data){
    //console.log(data);
    $('#Tipe').html('');
    $('#Tipe').html(data);

  })
}

// function show() {
//   if(document.getElementById('Tipe').style.display=='none') {
//       document.getElementById('Tipe').style.display='block';
//   }
//   return false;
// }
// function hide() {
//   if(document.getElementById('Tipe').style.display=='block') {
//       document.getElementById('Tipe').style.display='none';
//   }
//   return false;
// }
// hide('#Tipe');
// function validate() {
//
//   if (document.getElementById('CheckTipe').checked) {
//       show('#Tipe');
//   } else {
//       hide('#Tipe');
//   }
// }
</script>
<!-- Awal Group Box Daftar Estimasi -->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Forecasting</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Halaman ini akan menampilkan hasil forecasting dari data yang telah diinputkan sebelumnya. Mohon melakukan pengaturan forecasting terlebih dahulu untuk menampilkan hasil forecasting.</p><br>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <form role="form" class="form-horizontal" id="FormNotaBeli" method="GET">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                   <div class="form-group">
                        <label class="col-md-5 control-label">Data yang digunakan</label>
                        <div class="col-md-3">
                          <select name="DataDigunakan" id="DataDigunakan" onchange="PilihMerek(this)" class="form-control" data-live-search="true">
                                <option value="">Silahkan Pilih Data</option>
                                <option value="Pesanan">Pesanan</option>
                                <option value="Penjualan">Penjualan</option>
                         </select>
                        </div>
                   </div>

                   <div class="form-group">
                        <label class="col-md-5 control-label">Merek Sepatu</label>
                        <div class="col-md-3">
                          <select name="Merek" id="Merek" class="form-control" onchange="PilihTipe();" data-live-search="true">
                                <option value="">Silahkan Pilih Merek</option>
                         </select>
                        </div>
                   </div>

                   <div class="form-group">
                        <label class="col-md-5 control-label">Ingin berdasarkan tipe?</label>
                        <div class="col-md-3">
                          <label><input type="checkbox" value="Ya" name="CheckTipe" id="CheckTipe">Ya</label>
                        </div>
                   </div>

                   <div class="form-group" id="tipeS" style="display:none">
                        <label class="col-md-5 control-label">Tipe Sepatu</label>
                        <div class="col-md-3">
                          <select name="Tipe" id="Tipe" class="form-control" data-live-search="true">
                                <option value="">Silahkan Pilih Tipe</option>
                         </select>
                        </div>
                   </div>

                   <div class="form-group" >
                        <label class="col-md-5 control-label">Jumlah Bulan</label>
                        <div class="col-md-3">
                          <select name="Bulan" class="form-control" data-live-search="true">
                                <?php
                                  for ($i=12;$i>=1;$i--)
                                  {
                                    ?>
                                      <option value="<?php echo $i;?>">
                                        <?php
                                          echo $i;
                                        ?>
                                      </option>
                                    <?php
                                  }
                                ?>
                         </select>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-md-5 control-label">Data Akhir Peramalan</label>
                        <div class="col-md-3">
                          <select name="DataAwalPeramalan" id="DataAwalPeramalan" class="form-control" data-live-search="true">
                                <?php
                                    //$dataDigunakan=array();
                                    $tgl=date("Y-m-d");
                                    for ($i=0;$i<96;$i++)
                                    {
                                      $per=date("Y-m",strtotime($tgl));
                                      $perT=date("M-Y",strtotime($tgl));
                                      ?>
                                        <option value="<?php echo $per;?>"><?php echo $perT;?></option>
                                      <?php
                                      $tgl = date("Y-m-d",strtotime("-1 month",strtotime($tgl)));
                                    }
                                ?>
                         </select>
                        </div>
                   </div>

                   <div class="form-group" style="text-align:center;">
                     <button type="submit" id="addRow" class="btn btn-info" name="addRow">Proses Forecasting</button>
                   </div>
                </form>

          <?php

          ?>

          <div id="chartDataAsli" style="height: 250px;">

          </div>

          <?php
               $iAwal=0;
               $dataTulis=array();
               for ($i=0;$i<count($dataPer);$i++)
               {
                 $dataTulis[$dataPer[$i]]=$DataAwal[$i];
               }

               $tahunAwal=explode("-",$dataPer[0]);
               if (count($tahunAwal)>=2)
               {
                 $iAwal=$tahunAwal[0]*1;
               }
               /*
               echo "<br/>";
               print_r($dataPer);
               echo "<br/>";
               print_r($DataAwal);
               echo "<br/>";*/
          ?>
          <table class="table table-bordered">
              <tr>
                <td>
                </td>
              <?php
                for ($i=0;$i<8;$i++)
                {
                  ?>
                    <td>
                      <?php
                        echo $iAwal+$i;
                      ?>
                    </td>
                  <?php
                }
              ?>
              </tr>
              <?php
                $namaBulan=array();
                array_push($namaBulan,"Januari");
                array_push($namaBulan,"Februari");
                array_push($namaBulan,"Maret");
                array_push($namaBulan,"April");
                array_push($namaBulan,"Mei");
                array_push($namaBulan,"Juni");
                array_push($namaBulan,"Juli");
                array_push($namaBulan,"Agustus");
                array_push($namaBulan,"September");
                array_push($namaBulan,"Oktober");
                array_push($namaBulan,"Nobember");
                array_push($namaBulan,"Desember");
                for ($i=1;$i<=12;$i++)
                {
                  echo "<tr>";
                  echo "<td>". $namaBulan[$i-1]."</td>";
                  for ($j=0;$j<8;$j++)
                  {
                    $tahunCheck=$iAwal+$j;
                    $blnCheck=$i;
                    if ($i<10)
                    {
                      $blnCheck="0".$i;
                    }
                    ?>
                      <td>

                          <?php
                            $iCheck=$tahunCheck."-".$blnCheck;

                            if (isset($dataTulis[$iCheck]))
                            {
                                echo $dataTulis[$iCheck];
                            }
                            else {
                              echo "0";
                            }

                          ?>
                      </td>
                    <?php
                  }
                  echo "</tr>";
                }
              ?>
          </table>

          <?php
               echo '<h1>Tahap 1 Tabel Awal</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               <th></th>
               <th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelAwal as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 2 3x3MA
               echo '<h1>Tahap 2 3X3 MA</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>';

               for ($ix=0;$ix<count($tahun);$ix++)
               {
                 ?>
                       <th><b><h4><?php echo $tahun[$ix];?></b></h4></th>
                 <?php
               }


               echo '
               <th></th>
               <th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($Tabel3x3MA as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 3 Standart Deviasi
               echo '<h1>Tahap 3 Standart Deviasi</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               <th></th>
               <th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelStandartDeviasi as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 3 Standart Deviasi
               echo '<h1>Standart Deviasi</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<tbody><tr><td style="width:10%;"><b><h4>Standart Deviasi</b></h4></td>';
               $Index = 1;
               foreach ($RataRataStandartDeviasi as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                   $Index++;
               }
               echo '</tr></tbody></table>';

               // Tahap 4 Check Standart Deviasi
               echo '<h1>Tahap 4 Check Standart Deviasi</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               <th></th>
               <th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelHasilCheck as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 4 Check
               echo '<h1>Check</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<tbody><tr><td style="width:10%;"><b><h4>Rata - Rata</b></h4></td>';
               $Index = 1;
               foreach ($RataRataCheck as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                   $Index++;
               }
               echo '</tr></tbody></table>';

               // Tahap 5 Tabel Kuning
               echo '<h1>Tahap 5 Tabel Kuning</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               <th></th>
               <th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelHasilKuning as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 6 Tabel 3X3 MA Faktor Musiman Awal
               echo '<h1>Tahap 6 Tabel 3X3 MA Faktor Musiman Awal</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               <th></th>
               <th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($Tabel3x3MAFaktorMusimanAwal as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 7 Tabel Deret Awal Setelah Penyesuaian Musim Awal
               echo '<h1>Tahap 7 Tabel Deret Awal Setelah Penyesuaian Musim Awal</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               <th></th>
               <th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelDeretAwalSetelahPenyesuaianMusimAwal as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';


               /*-----------------------------Akhir------------------------------*/
               // Tahap 1 Tabel Awal Musim Akhir
               echo '<h1>Tahap 1 Tabel Awal Musim Akhir</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th><th></th><th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelTCAkhir as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 2 3X3 MA
               echo '<h1>Tahap 2 3X3 MA</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th><th></th><th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($Tabel3x3MAFaktorMusimanAkhir as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 3 Standart Deviasi
               echo '<h1>Tahap 3 Standart Deviasi</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th><th></th><th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelStandartDeviasiAkhir as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 4 Tabel Biru
               echo '<h1>Tahap 4 Tabel Biru</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th><th></th><th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelBesarKecilMusimAkhir as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 5 Tabel Kuning Kuning
               echo '<h1>Tahap 5 Tabel Kuning Kuning</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th><th></th><th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelKuningKuning as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 6 Tabel 3x3 MA Faktor Musiman Akhir
               echo '<h1>Tahap 6 Tabel 3x3 MA Faktor Musiman Akhir</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th><th></th><th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($Tabel3x3MAFaktorMusimanAkhirFinal as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 7 Tabel Deret Akhir Setelah Penyesuain Musim Akhir
               echo '<h1>Tahap 7 Tabel Deret Akhir Setelah Penyesuain Musim Akhir</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th><th></th><th></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelDeretAwalSetelahPenyesuaianMusimAkhir as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               /*-----------------------------Taksiran------------------------------*/
               // Tahap 1 Tabel TC
               echo '<h1>Tahap 1 Tabel TC</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelTC as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 2 Tabel R
               echo '<h1>Tahap 2 Tabel R</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelR as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // 3MA
               // Tahap 1 MSE
               /*echo '<h1>Tahap 1 MSE</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<tbody><tr><td style="width:10%;"><b><h4>MSE</b></h4></td>';
               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$RataRata.' %</b></h4></td>';
               echo '</tr></tbody></table>';*/

               // Tahap 2 Tabel TC 3 MA
               echo '<h1>Tahap 1 Tabel TC 3 MA</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelTC3MA as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 2 Uji Persentase Data Akhir
               echo '<h1>Tahap 3 Uji Persentase Data Akhir</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo'<thead>
               <th style="width:10%;"></th><th></th><th></th>
               <th><b><h4>1949</b></h4></th>
               <th><b><h4>1950</b></h4></th>
               <th><b><h4>1951</b></h4></th>
               <th><b><h4>1952</b></h4></th>
               <th><b><h4>1953</b></h4></th>
               <th><b><h4>1954</b></h4></th>
               <th><b><h4>1955</b></h4></th>
               <th><b><h4>1956</b></h4></th>
               </thead>';
               echo '<tbody>';
               $Index = 1;
               foreach ($TabelHasil as $IsiTabel) {
                   echo '<tr>';
                        if ($Index == 1) {
                           echo '<td><b><h4>Januari</b></h4></td>';
                        } else if ($Index == 2) {
                           echo '<td><b><h4>Febuari</b></h4></td>';
                        } else if ($Index == 3) {
                           echo '<td><b><h4>Maret</b></h4></td>';
                        } else if ($Index == 4) {
                           echo '<td><b><h4>April</b></h4></td>';
                        } else if ($Index == 5) {
                           echo '<td><b><h4>Mei</b></h4></td>';
                        } else if ($Index == 6) {
                           echo '<td><b><h4>Juni</b></h4></td>';
                        } else if ($Index == 7) {
                           echo '<td><b><h4>Juli</b></h4></td>';
                        } else if ($Index == 8) {
                           echo '<td><b><h4>Agustus</b></h4></td>';
                        } else if ($Index == 9) {
                           echo '<td><b><h4>September</b></h4></td>';
                        } else if ($Index == 10) {
                             echo '<td><b><h4>Oktober</b></h4></td>';
                          } else if ($Index == 11) {
                            echo '<td><b><h4>November</b></h4></td>';
                         } else if ($Index == 12) {
                           echo '<td><b><h4>Desember</b></h4></td>';
                           }
                        foreach ($IsiTabel as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                        }
                   echo '</tr>';
                   $Index++;
               }
               echo '</tbody></table>';

               // Tahap 4 Rata Rata Uji Persentase Data Akhir
               echo '<h1>Mean Square Error</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<tbody><tr><td style="width:10%;"><b><h4>MSE</b></h4></td>';
               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$TabelMSE.'</b></h4></td>';
               echo '</tr></tbody></table>';

               // Tahap 5 Hasil Ramalan
               echo '<h1>Hasil Ramalan</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<thead>
               <tr>
               <th rowspan="2" style="width:10%;">Hasil Ramalan</th>';

               $tahunC=date("Y",strtotime($tglC));

               $blnRamal=12;
               if (isset($_GET["Bulan"]))
               {
                  if ($_GET["Bulan"]!="")
                  {
                    $blnRamal=$_GET["Bulan"]*1;
                  }
               }
               for ($i=0;$i<$blnRamal;$i++)
               {
                 $bln=date("M",strtotime($tglC));
                 ?>
                   <th>
                      <?php echo $bln;?>
                   </th>
                 <?php

                 $tglC=date("Y-m-d",strtotime("+1 month",strtotime($tglC)));
               }

               echo '</tr>
               </thead>';



               echo '<tbody><tr><h1><td><strong>'. $tahunC.'</strong></h1>
               </td>';
               $Index = 1;
               foreach ($TabelHasilAkhirProsesPeramalan as $Isi) {
                  if ($Index<=$blnRamal)
                  {
                    if ($Isi == "") {
                       echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                    } else {
                       echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                    }
                    $Index++;
                  }

               }
               echo '</tr></tbody></table>';
          ?>
      </div>
   </div>
</div>
<!-- Akhir Group Box Daftar Estimasi -->

<!-- Awal Group Box Help dan Hint-->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-info" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Help dan Hint</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Status Info -->
      <div class="panel-body">
          <!-- Awal Isi Konten -->
          <form class="form-horizontal" id="FormHelpHint" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="panel-body">
                  <div class="col-md-4">
                     <div class="form-group">
                           <span class="fa fa-eye"></span>&nbsp;&nbsp;&nbsp;<b>Untuk melihat detail Forecasting.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-pencil"></span>&nbsp;&nbsp;&nbsp;<b>Untuk mengubah Forecasting.</b>
                     </div>
                     <div class="form-group">
                           <span class="fa fa-trash-o"></span>&nbsp;&nbsp;&nbsp;<b>Untuk menghapus Forecasting.</b>
                     </div>
                  </div>

                  <div class="col-md-8">
                     <div class="form-group">
                           <b>1. Setiap Daftar hanya muncul 10 items dari daftar.</b>
                     </div>
                     <div class="form-group">
                           <b>2. Bila ingin melihat halaman berikutnya, silahkan klik bagian bawah kanan dari tabel Anda.</b>
                     </div>
                     <div class="form-group">
                           <b>3. Fitur [Cari] pada kanan atas dari tabel dapat diisi apapun berkaitan dengan kolom tabel yang muncul.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help dan Hint -->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<script type="text/javascript">
  $(document).ready(function()
  {
     //Awal
     <?php
        //$TabelHasilAkhirProsesPeramalan

        $hasil="";
        for($i=0;$i<count($TabelHasilAkhirProsesPeramalan);$i++)
        {
            $tengah="";
            for ($j=0;$j<8;$j++)
            {
                $dTengah="value".$j." : ".$DataAwal[($j*12)+$i];
                if ($tengah=="")
                {
                  $tengah=$dTengah;
                }
                else {
                  $tengah=$tengah.",".$dTengah;
                }
            }

            $detail="{periode :'".($i+1)."', ".$tengah.",valueRamal:". $TabelHasilAkhirProsesPeramalan[$i] ."}";

            if ($hasil=="")
            {
              $hasil=$detail;
            }
            else {
              $hasil=$hasil.",".$detail;
            }
            //echo "<br>".$DataAsli."</br>";
        }
     ?>
     new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'chartDataAsli',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
          <?php echo $hasil;?>
        ],
        // The name of the data record attribute that contains x-values.
        xkey: 'periode',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value0','value1','value2','value3','value4','value5','value6','value7','valueRamal'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Data Asli Tahun ke 1','Data Asli Tahun ke 2','Data Asli Tahun ke 3','Data Asli Tahun ke 4','Data Asli Tahun ke 5','Data Asli Tahun ke 6','Data Asli Tahun ke 7','Data Asli Tahun ke 8','Data Peramalan'],
        parseTime: false
      });
     //Akhir
  });
</script>
@endsection
