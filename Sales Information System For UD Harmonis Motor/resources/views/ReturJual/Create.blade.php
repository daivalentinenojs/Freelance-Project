<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Retur Jual')

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
         <h3 class="panel-title">Tambah Data Retur Jual</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

     <!-- Awal Informasi Pra Estimasi -->

     <div class="panel-body">
         <p>Halaman ini adalah halaman tambah data retur jual. Halaman Tambah Data Retur Jual digunakan untuk <strong>menambah</strong> data Retur Jual yang terdaftar pada <strong>UD Harmonis Motor</strong>.</p><br>
         @foreach ($errors->all() as $error)
         <p class="alert alert-danger">{{ $error }}</p>
         @endforeach
         @if (session('status'))
             <div class="alert alert-success">
                 {{ session('status') }}
             </div>
         @endif
            <form action="" role="form" class="form-horizontal" id="FormTambahDataReturJual" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
               <div class="form-group">
                <div class="col-md-12">
                     <label class="col-md-2 control-label" style="margin-top:3px;">Nomor Nota Jual:</label>
                       <div class="col-md-2">
                        <select class="form-control select" data-live-search="true" name="NoNotaJual" id="NoNotaJual">
                              @foreach ($DataNotaJual AS $NotaJual)
                                    <?php
                                    $NoNota = preg_replace("/[^A-Za-z0-9]/", '', $NotaJual['NoNotaJual']);
                                    $Data = str_replace(" ", "-", $NoNota); 
                                    ?>
                                    <option value="{{$NotaJual['NoNotaJual'].'-'.$Data}}">{{$NotaJual['NoNotaJual']}}</option>   
                             @endforeach
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
                       <div class="col-md-7" style="margin-top:10px" name="KodeBarang" id="KodeBarang"></div>
                    </div>
               </div>       
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Nama Barang:</label>
                        <div class="col-md-2">
                        <select class="form-control select" data-live-search="true" name="Barang" id="Barang">
                             @foreach ($DataNotaJual AS $Barang)
                                    <?php
                                    $NamaBarangAsal = preg_replace("/[^A-Za-z0-9]/", '', $Barang['Nama']);
                                    $Data = str_replace(" ", "-", $NamaBarangAsal); 
                                    ?>
                                    <option value="{{$Barang['ID'].'-'.$Data}}">{{$Barang['Nama']}}</option>   
                             @endforeach
                      </select>
                      </div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Jumlah Stok:</label>
                       <div class="col-md-7" style="margin-top:10px" id="JumlahStok" name="JumlahStok"></div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Kuantiti Barang:</label>
                       <div class="col-md-1">
                               <div class="input-group">
                                   <input type="number" name="KuantitiBarang" onkeypress = "return isNumberKey(event)" id="KuantitiBarang" required class="form-control" value="0"/>
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
                              <table id="DataTableReturJual" class="table table-bordered" cellspacing="0" width="100%" style="text-align:right">
                                 <thead>
                                     <tr>
                                         <th>Kode Barang</th> 
                                         <th>Nama Barang</th>
                                         <th>Kuantiti Barang</th>
                                     </tr>
                                 </thead>
                                 <tfoot>
                                     <tr>
                                         <th>Kode Barang</th> 
                                         <th>Nama Barang</th>
                                         <th>Kuantiti Barang</th>
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
                        <input type="hidden" name="arrQtyBarang" id="arrQtyBarang"/>
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
var ArrayQtyBarang = new Array();

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

function GetNoNotaJual(NoNotaJual) {
  $.ajax({
    url: "ajax/NoNotaJual.php?NoNotaJual="+NoNotaJual,
    context: document.body, 
    success: function(responseText) {
      $('#NoNotaJual').empty();
      $('#NoNotaJual').html(responseText);
      $('#NoNotaJual').val(responseText);
    } 
  });
}

function GetStokDatabase(IDBarang) {
  $.ajax({
    url: "ajax/GetStokDatabase.php?IDBarang="+IDBarang,
    context: document.body, 
    success: function(responseText) {
      $('#JumlahStok').empty();
      $('#JumlahStok').html(responseText);
      $('#JumlahStok').val(responseText);
    } 
  });
}

function FunctionSet(IDBarang) {
  GetBarang(IDBarang);
}

$(document).ready(function() {
  var t = $('#DataTableReturJual').DataTable();
  Barang = $('#Barang').val();
  GetKodeBarang(Barang);
  GetStokDatabase(Barang);
  NoNotaJual = $('#NoNotaJual').val();
  GetNoNotaJual(NoNotaJual);

  $('#addRow').on('click', function () {
    KodeBarang = $('#KodeBarang').val();
    ArrayKodeBarang.push(FunctionSplit(KodeBarang, 0));
    Barang = $('#Barang').val();
    ArrayBarang.push(FunctionSplit(Barang, 0));
    QtyBarang = $('#KuantitiBarang').val();
    ArrayQtyBarang.push(QtyBarang);

    t.row.add([
      KodeBarang,
      ShowDataTable(Barang),
      QtyBarang
      ]).draw(true);
  });

  $('#DataTableReturJual tbody').on('click', 'tr', function () {
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
    ArrayQtyBarang.splice(Index, 1);
  });

  $('#NoNotaJual').change(function(){
    var NoNotaJual = $(this).find("option:selected").val();
    NoNotaJual = FunctionSplit(NoNotaJual, 0);
    GetNoNotaJual(NoNotaJual);
  });

  $('#Barang').change(function(){
    var Barang = $(this).find("option:selected").val();
    BarangAsal = FunctionSplit(Barang, 0);
    GetKodeBarang(Barang);
    GetStokDatabase(Barang);
  });

  $('#Simpan').click(function () {
    if (ArrayKodeBarang.length<=0)
    {
        alertify.error("Transaksi retur jual harus memiliki detail");
    }
    else{
      if(ArrayQtyBarang > $('#JumlahStok').val()){
        alertify.error("Kuantiti Barang melebihi Jumlah Stok");
      } else {
        alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Data Retur Jual ?",
        function() {
          $("#arrKodeBarang").val(JSON.stringify(ArrayKodeBarang));
          $("#arrQtyBarang").val(JSON.stringify(ArrayQtyBarang));
          $("#FormTambahDataReturJual").submit();
          alertify.success('Data Retur Jual Anda telah disimpan');
        }, 
        function(){
          alertify.error('Proses Menyimpan Data Retur Jual Anda dibatalkan');
        });
      }
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
  var rupiah;
  return parseInt(rupiah.replace(/[^0-9\.]+/g,""));
}
</script>
@endsection


