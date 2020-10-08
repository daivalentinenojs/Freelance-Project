<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Forecasting')

@section('Title','Sistem Informasi Forecasting')
@section('Nama','Sistem Informasi Forecasting')

@section('FotoLogin',url('foto/perusahaan.png'))

<!--@section('ID')
   A0001
@endsection-->
@section('NamaLogin')
   Rheza Vallian Sayoga
@endsection

@section('Navigasi')
   @include('../Navigasi/Navigasi')
@endsection

@section('isi')
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
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Halaman ini berisi hasil forecasting dari data yang telah diinputkan sebelumnya.</p><br>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

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

               // Tahap 3 Standart Deviasi
               /*echo '<h1>Standart Deviasi Akhir</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<tbody><tr><td style="width:10%;"><b><h4>Standart Deviasi</b></h4></td>';
               $Index = 1;
               foreach ($RataRataStandartDeviasiAkhir as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                   $Index++;
               }
               echo '</tr></tbody></table>';*/

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


               //Hasil Akar
               echo '<h1>Hasil Akar</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<thead>
               <tr>
               <th rowspan="2" style="width:10%;">Hasil Ramalan</th>
               <th>1949</th>
               <th>1950</th>
               <th>1951</th>
               <th>1952</th>
               <th>1953</th>
               <th>1954</th>
               <th>1955</th>
               <th>1956</th>
               </tr>
               </thead>';
               echo '<tbody><tr><h1><td><strong>1957</strong></h1>
               </td>';
               $Index = 1;
               foreach ($TabelRataBesarKecil as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                   $Index++;
               }
               echo '</tr></tbody></table>';

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
               echo '<h1>Tahap 1 MSE</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<tbody><tr><td style="width:10%;"><b><h4>MSE</b></h4></td>';
               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$RataRata.' %</b></h4></td>';
               echo '</tr></tbody></table>';

               // Tahap 2 Tabel TC 3 MA
               echo '<h1>Tahap 2 Tabel TC 3 MA</h1>';
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

               // Tahap 3 Uji Persentase Data Akhir
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
               echo '<h1>Tahap 4 Rata Rata Uji Persentase Data Akhir</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<tbody><tr><td style="width:10%;"><b><h4>MSE</b></h4></td>';
               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$RataRataAkhir.' %</b></h4></td>';
               echo '</tr></tbody></table>';

               // Tahap 5 Hasil Ramalan
               echo '<h1>Hasil Ramalan</h1>';
               echo '<table border="2px;" class="table table-bordered">';
               echo '<thead>
               <tr>
               <th rowspan="2" style="width:10%;">Hasil Ramalan</th>
               <th>Januari</th>
               <th>Febuari</th>
               <th>Maret</th>
               <th>April</th>
               <th>Mei</th>
               <th>Juni</th>
               <th>Juli</th>
               <th>Agustus</th>
               <th>September</th>
               <th>Oktober</th>
               <th>November</th>
               <th>Desember</th>
               </tr>
               </thead>';
               echo '<tbody><tr><h1><td><strong>1957</strong></h1>
               </td>';
               $Index = 1;
               foreach ($HasilRamalan as $Isi) {
                            if ($Isi == "") {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b></b></h4></td>';
                            } else {
                               echo '<td style="width:50px;"><h4 style="color:black; font-size:15px;"><b>'.$Isi.'</b></h4></td>';
                            }
                   $Index++;
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

<script type="text/javascript">

</script>
@endsection
