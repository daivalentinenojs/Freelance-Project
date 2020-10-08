<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Stok Opname')

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
         <h3 class="panel-title">Tambah Data Stok Opname</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

     <!-- Awal Informasi Pra Estimasi -->

     <div class="panel-body">
         <p>Halaman ini adalah halaman tambah data stok opname. Halaman Tambah Data Stok Opname digunakan untuk <strong>menambah</strong> data stok opname yang terdaftar pada <strong>UD Harmonis Motor</strong>.</p><br>
         @foreach ($errors->all() as $error)
         <p class="alert alert-danger">{{ $error }}</p>
         @endforeach
         @if (session('status'))
             <div class="alert alert-success">
                 {{ session('status') }}
             </div>
         @endif
            <form action="" role="form" class="form-horizontal" id="FormTambahDataStokOpname" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
               <div class="form-group">
                  <div class="col-md-12">
                     <label class="col-md-2 control-label" style="margin-top:3px;">Kode Barang:</label>
                      <div class="col-md-1">
                       <input type="text" class="form-control" readonly id="KodeBarang" name="KodeBarang" style="background:white; color:black;"></input>
                      </div> 
                     <label class="col-md-6 control-label" style="margin-top:3px;">Tanggal Buat:</label>
                       <div class="col-md-2">
                               <div class="input-group">
                                   <input type="date" name="Tanggal" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
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
                       <label class="col-md-2 control-label" style="margin-top:3px;">Stok Database:</label>
                       <div class="col-md-7" style="margin-top:10px" id="StokDB" name="StokDB"></div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Jumlah Selisih (+/-):</label>
                       <div class="col-md-1">
                               <div class="input-group">
                                   <input type="number" name="JumlahSelisih" onkeypress = "return isNumberKey(event)" id="JumlahSelisih" required class="form-control" value="0"/>
                              </div>
                       </div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Alasan:</label>
                       <div class="col-md-4">
                               <div class="input-group">
                                   <textarea name="Alasan" id="Alasan" name="Alasan" required class="form-control" value=""/></textarea>
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
                              <table id="DataTableStokOpname" class="table table-bordered" cellspacing="0" width="100%" style="text-align:right">
                                 <thead>
                                     <tr>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Stok Database</th>
                                         <th>Jumlah Selisih (+/-)</th>
                                         <th>Alasan</th>
                                     </tr>
                                 </thead>
                                 <tfoot>
                                     <tr>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Stok Database</th>
                                         <th>Jumlah Selisih (+/-)</th>
                                         <th>Alasan</th>
                                     </tr>
                                 </tfoot>
                              </table>
                        </div>
                        <div class="form-group"><br><br>
                               <label class="col-md-10 control-label">Nama Karyawan:</label>
                               <div class="col-md-2">
                                    <input type="text" id="NamaKaryawan" name="NamaKaryawan" class="form-control" value="{{$Nama}}" readonly style="background:white; color:black;"/>
                               </div>
                        </div>
                        <br><br>
                        <input type="hidden" name="arrKodeBarang" id="arrKodeBarang"/>
                        <input type="hidden" name="arrJumlahSelisih" id="arrJumlahSelisih"/>
                        <input type="hidden" name="arrAlasan" id="arrAlasan"/>

                        <input type="hidden" id="JumlahPanel" name="JumlahPanel">
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
var ArrayStokDB = new Array();
var ArrayJumlahSelisih = new Array();
var ArrayAlasan = new Array();
// function GetBarang(IDBarang) {
//   $.ajax({
//     url: "ajax/GetBarang.php?IDBarang="+IDBarang,
//     context: document.body, 
//     success: function(responseText) {
//       NamaBarang = responseText;
//     } 
//   });
// }

function GetStokDatabase(IDBarang) {
  $.ajax({
    url: "ajax/GetStokDatabase.php?IDBarang="+IDBarang,
    context: document.body, 
    success: function(responseText) {
      $('#StokDB').empty();
      $('#StokDB').html(responseText);
      $('#StokDB').val(responseText);
    } 
  });
}

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

$(document).ready(function() {
  var t = $('#DataTableStokOpname').DataTable();
  IDBarang = $('#IDBarang').val();
  GetStokDatabase(IDBarang);
  GetKodeBarang(IDBarang);

  $('#addRow').on('click', function () {
    KodeBarang = $('#KodeBarang').val();
    ArrayKodeBarang.push(KodeBarang);
    IDBarang = $('#IDBarang').val();
    ArrayBarang.push(FunctionSplit(IDBarang, 0));
    StokDB = $('#StokDB').val();
    ArrayStokDB.push(StokDB);
    JumlahSelisih = $('#JumlahSelisih').val();
    ArrayJumlahSelisih.push(JumlahSelisih);
    Alasan = $('#Alasan').val();
    ArrayAlasan.push(Alasan);
    
    t.row.add([
      KodeBarang,
      ShowDataTable(IDBarang),
      StokDB,
      JumlahSelisih,
      Alasan
      ]).draw(true);
  });

  $('#DataTableStokOpname tbody').on('click', 'tr', function () {
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
    ArrayBarang.splice(Index, 1);
    ArrayStokDB.splice(Index, 1);
    ArrayJumlahSelisih.splice(Index, 1);
    ArrayAlasan.splice(Index, 1);
  });

  $('#IDBarang').change(function(){
    var IDBarang = $(this).find("option:selected").val();
    IDBarang = FunctionSplit(IDBarang, 0);
    GetStokDatabase(IDBarang);
    GetKodeBarang(IDBarang);
  });

  $('#Simpan').click(function () {
    if (ArrayKodeBarang.length<=0)
    {
        alertify.error("Transaksi stok opname harus memiliki detail");
    }
    else{
      alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Data Stok Opname ?",
      function() {
        $("#arrKodeBarang").val(JSON.stringify(ArrayKodeBarang));
        $("#arrJumlahSelisih").val(JSON.stringify(ArrayJumlahSelisih));
        $("#arrAlasan").val(JSON.stringify(ArrayAlasan));
        $("#FormTambahDataStokOpname").submit();
        alertify.success('Data Stok Opname Anda telah disimpan');
      }, 
      function(){
        alertify.error('Proses Menyimpan Data Stok Opname Anda dibatalkan');
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
</script>
@endsection


