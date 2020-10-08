<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Nota Beli')

@section('Title','Sistem Informasi Harmonis Motor')
@section('Nama','Sistem Informasi Harmonis Motor')

@section('FotoLogin',url('foto/karyawan/'.$ID.'.jpg'))

@section('ID')
   
@endsection

@section('NamaLogin')
   {{$Nama}}
@endsection

@section('Navigasi')
   @include('../Navigasi/Navigasi')
@endsection

@section('isi')
<!-- Awal Informasi Dashboard -->

<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Tambah Data Nota Beli</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

     <!-- Awal Informasi Pra Estimasi -->

     <div class="panel-body">
         <p>Halaman ini adalah halaman tambah data nota beli. Halaman Tambah Data Nota Beli digunakan untuk <strong>menambah</strong> data nota beli yang terdaftar pada <strong>UD Harmonis Motor</strong>.</p><br>
         @foreach ($errors->all() as $error)
         <p class="alert alert-danger">{{ $error }}</p>
         @endforeach
         @if (session('status'))
             <div class="alert alert-success">
                 {{ session('status') }}
             </div>
         @endif
            <form action="" role="form" class="form-horizontal" id="FormTambahDataNotaBeli" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
               <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-2 control-label" style="margin-top:3px;">Nama Pemasok:</label>
                        <div class="col-md-2">
                          <select class="form-control select" data-live-search="true" name="IDPemasok">
                               <?php
                               for ($i=0; $i < count($DataPemasok) ; $i++) { 
                                      echo '<option value="'. $DataPemasok[$i]['ID'].'">'.$DataPemasok[$i]['Nama'].'</option>';
                               }                                   
                               ?>
                          </select>
                        </div>
                     <label class="col-md-5 control-label" style="margin-top:3px;">Tanggal Buat:</label>
                       <div class="col-md-2">
                               <div class="input-group">
                                   <input type="date" name="TanggalBuat" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                   <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                       </div>
                    </div>
               </div>
               <div class="form-group">
                 <div class="col-md-12">
                   <label class="col-md-2 control-label" style="margin-top:3px;">Kode Barang:</label>
                      <div class="col-md-1">
                       <input type="text" class="form-control" readonly id="KodeBarang" name="KodeBarang" style="background:white; color:black;"></input>
                      </div> 
                   <label class="col-md-6 control-label" style="margin-top:3px;">Jatuh Tempo:</label>
                       <div class="col-md-2">
                           <div class="input-group">
                               <input type="date" name="JatuhTempo" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                               <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                           </div>
                       </div>
                  </div>
               </div>   
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Nama Barang:</label>
                        <div class="col-md-2">
                        <select class="form-control select" data-live-search="true" name="IDBarang" id="IDBarang">
                             @foreach ($DataBarang AS $Barang)
                                    <?php
                                    $NamaBarang = preg_replace("/[^A-Za-z0-9]/", '', $Barang['Nama']);
                                    $Data = str_replace(" ", "-", $NamaBarang); ?>
                                    <option value="{{$Barang['ID'].'-'.$Data}}">{{$Barang['Nama']}}</option>   
                             @endforeach
                      </select>
                      </div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Kuantiti:</label>
                       <div class="col-md-1">
                         <div class="input-group">
                             <input type="number" name="Kuantiti" onkeypress = "return isNumberKey(event)" id="Kuantiti" required class="form-control" value="0"/>
                        </div>
                       </div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Harga Beli (Rp):</label>
                       <div class="col-md-2">
                         <div class="input-group">
                             <input type="hidden" id="hargabeli1" name="HargaBeli" readonly class="form-control" value="0" placeholder="0" style="text-align:right; background:white; color:black;"/>
                             <input type="text" name="" onkeyup="KomaBeli(this)" onkeypress = "return isNumberKey(event)" id="HargaBeli1" required class="form-control" value="0" style="text-align:right"/>
                        </div>
                       </div>
                    </div>
               </div>
               <div class="form-group">
                  <div class="col-md-5">
                  </div>
                  <div class="col-md-4">
                     <button type="button" id="addRow" class="btn btn-info" name="addRow">Tambah</button>
                     <button type="button" id="deleteRow" class="btn btn-danger" name="deleteRow">Hapus</button>
                  </div>
               </div>
               <div class="row">
                   <div class="col-md-12">
                       <div class="form-group">
                              <table id="DataTableNotaBeli" class="table table-bordered" cellspacing="0" width="100%" style="text-align:right">
                                 <thead>
                                     <tr>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Kuantiti</th>
                                         <th>Harga Beli (Rp)</th>
                                         <th>Sub Total (Rp)</th>
                                     </tr>
                                 </thead>
                                 <tfoot>
                                     <tr>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Kuantiti</th>
                                         <th>Harga Beli (Rp)</th>
                                         <th>Sub Total (Rp)</th>
                                     </tr>
                                 </tfoot>
                              </table>
                        </div>
                        <div class="form-group">
                               <label class="col-md-10 control-label">Total Akhir (Rp):</label>
                               <div class="col-md-2">
                                    <input type="hidden" id="TotalAkhir" name="TotalAkhir" readonly class="form-control" value="0" placeholder="0" style="text-align:right; background:white; color:black;"/>                                    
                                    <input type="text" id="Total" name="" readonly class="form-control" placeholder="0" value="0" style="text-align:right; background:white; color:black;"/>
                               </div>
                        </div>
                        <div class="form-group"><br><br>
                               <label class="col-md-10 control-label">Nama Karyawan:</label>
                               <div class="col-md-2">
                                    <input type="text" id="NamaKaryawan" name="NamaKaryawan" class="form-control" value="{{$Nama}}" readonly style="background:white; color:black;"/>
                               </div>
                        </div>
                        <br><br>
                        <input type="hidden" name="arrKodeBarang" id="arrKodeBarang"/>
                        <input type="hidden" name="arrQty" id="arrQty"/>
                        <input type="hidden" name="arrHargaBeli" id="arrHargaBeli"/>
                        <input type="hidden" name="arrSubTotal" id="arrSubTotal"/>
                        <input type="hidden" id="JumlahPanel" value="1" name="JumlahPanel">
                        <input type="button" id="Simpan" value="Simpan" style="margin-right:10px" class="btn btn-success pull-right">
                    </div>
               </div>
            </div>
           </form>
      </div>
</div>

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

<!-- Akhir Informasi Dashboard -->
<script type="text/javascript">
var ArrayKodeBarang = new Array();
var ArrayBarang = new Array();
var ArrayQty = new Array();
var ArrayHargaBeli = new Array();
var ArraySubTotal = new Array();
var TotalAkhir = 0;
var idBarang = null;

// function GetHargaBeli(IDBarang) {
//   $.ajax({
//     url: "ajax/GetHargaBeli.php?IDBarang="+IDBarang,
//     context: document.body, 
//     success: function(responseText) {
//       $('#HargaBeli').empty();
//       $('#HargaBeli').html(responseText);
//       $('#HargaBeli').val(responseText);
//     } 
//   });
// }

function GetKodeBarang(IDBarang) {
  $.ajax({
    url: "ajax/GetKodeBarang.php?IDBarang="+IDBarang,
    context: document.body, 
    success: function(responseText) {
      $('#KodeBarang').empty();
      $('#KodeBarang').html(responseText);
      $('#KodeBarang').val(responseText);
    } 
  });
}

function FunctionSet(IDBarang) {
  GetBarang(IDBarang);
}

function hitungTotalAkhir(){
  var total = 0;
  var harga = 0;
  for (var i=0; i<ArrayQty.length; i++)
  {
    harga = convertToAngka(ArrayHargaBeli[i]);
    total = total + (ArrayQty[i]*harga);
  }
  var ts = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  $("#Total").val(ts);
  $("#TotalAkhir").val(total);
}

$(document).ready(function() {
  var t = $('#DataTableNotaBeli').DataTable();
  IDBarang = $('#IDBarang').val();
  GetKodeBarang(IDBarang);

  $('#addRow').on('click', function () {
    KodeBarang = $('#KodeBarang').val();
    ArrayKodeBarang.push(KodeBarang); 
    IDBarang = $('#IDBarang').val();
    ArrayBarang.push(FunctionSplit(IDBarang, 0));
    Kuantiti = $('#Kuantiti').val();
    ArrayQty.push(Kuantiti);
    HargaBeli = $('#hargabeli1').val();
    ArrayHargaBeli.push(HargaBeli);
    SubTotal = Kuantiti * HargaBeli;
    ArraySubTotal.push(SubTotal);

      t.row.add([
        KodeBarang,
        ShowDataTable(IDBarang),
        Kuantiti,
        HargaBeli,
        SubTotal
        ]).draw(true);
    hitungTotalAkhir();
  });

  $('#DataTableNotaBeli tbody').on('click', 'tr', function () {
    if($(this).hasClass('selected')){
      $(this).removeClass('selected');
    } else {
      t.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
      Index = t.row(this).index();
    }
  });

  $('#deleteRow').click(function() {
    t.row('.selected').remove().draw(false);
    ArrayKodeBarang.splice(Index, 1);
    ArrayBarang.splice(Index, 1);//untuk menghapus isi array pada index yang dipilih
    ArrayQty.splice(Index, 1);
    ArrayHargaBeli.splice(Index, 1);
    ArraySubTotal.splice(Index, 1);
    hitungTotalAkhir();
  });

  $('#IDBarang').change(function(){
    var IDBarang = $(this).find("option:selected").val();
    IDBarang = FunctionSplit(IDBarang, 0);
    GetKodeBarang(IDBarang);
  });

   $('#Simpan').click(function () {
    if (ArrayKodeBarang.length<=0)
    {
        alertify.error("Transaksi nota beli harus memiliki detail");
    }
    else{
      alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Data Nota Beli ?",
      function() {
        $("#arrKodeBarang").val(JSON.stringify(ArrayKodeBarang));
        $("#arrQty").val(JSON.stringify(ArrayQty));
        $("#arrHargaBeli").val(JSON.stringify(ArrayHargaBeli));
        $("#arrSubTotal").val(JSON.stringify(ArraySubTotal));
        $("#FormTambahDataNotaBeli").submit();
        alertify.success('Data Nota Beli Anda telah disimpan');
      }, 
      function(){
        alertify.error('Proses Menyimpan Data Nota Beli Anda dibatalkan');
      });
    }
  });
});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

function FunctionSplit(Data, Angka){
  var res = Data.split("-");
  return res[Angka];
}

function ShowDataTable(IDIndex){
  var Hasil = '';
  var res = IDIndex.split("-");
  for(var i=1; i < res.length; i++){
    Hasil += res[i]+' ';
  }
  return Hasil;
}

function convertToAngka(rupiah)
{
  return parseInt(rupiah.replace(/[^\d]/g,""));
}

function KomaBeli(param){
  var sum = param.value;
  var id = param.id;
  var nomor = id.split('HargaBeli');

  if(sum!= 0){
    sums = parseFloat(sum.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#HargaBeli'+nomor[1]).val(sums);
    $('#hargabeli'+nomor[1]).val(sums.replace(/,/g, ""));
  }
}
</script>
@endsection


