<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Informasi Nota Jual')

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
         <h3 class="panel-title">Tambah Data Nota Jual</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

     <!-- Awal Informasi Pra Estimasi -->

     <div class="panel-body">
         <p>Halaman ini adalah halaman tambah data nota jual. Halaman Tambah Data Nota Jual digunakan untuk <strong>menambah</strong> data nota jual yang terdaftar pada <strong>UD Harmonis Motor</strong>.</p><br>
         @foreach ($errors->all() as $error)
         <p class="alert alert-danger">{{ $error }}</p>
         @endforeach
         @if (session('status'))
             <div class="alert alert-success">
                 {{ session('status') }}
             </div>
         @endif
            <form action="" role="form" class="form-horizontal" id="FormTambahDataNotaJual" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Nama Pembeli:</label>
                          <div class="col-md-2">
                          <select class="form-control select" data-live-search="true" name="IDPembeli" id="IDPembeli">
                               <?php
                               for ($i=0; $i < count($DataPembeli) ; $i++) { 
                                      echo '<option value="'. $DataPembeli[$i]['ID'].'">'.$DataPembeli[$i]['Nama'].'</option>';
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
                       <label class="col-md-2 control-label" style="margin-top:3px;">Kota:</label>
                          <div class="col-md-2">
                           <input type="text" class="form-control" readonly id="Kota" name="Kota" style="background:white; color:black;"></input>
                          </div> 
                     <label class="col-md-5 control-label" style="margin-top:3px;">Tanggal Bayar:</label>
                       <div class="col-md-2">
                               <div class="input-group">
                                   <input type="date" name="TanggalBayar" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                   <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                               </div>
                       </div>
                  </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Status Langganan:</label>
                       <div class="col-md-7" style="margin-top:10px" id="StatusLangganan"></div>
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-md-12">
                       <label class="col-md-2 control-label" style="margin-top:3px;">Kode Barang:</label>
                       <div class="col-md-7" style="margin-top:10px" id="KodeBarang" name="KodeBarang"></div>
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
                       <label class="col-md-2 control-label" style="margin-top:3px;">Jumlah Stok:</label>
                       <div class="col-md-7" style="margin-top:10px" id="JumlahStok" name="JumlahStok"></div>
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
                       <label class="col-md-2 control-label" style="margin-top:3px;">Harga Jual (Rp):</label>
                       <div class="col-md-2">
                           <!-- <input type="hidden" id="HargaJual" name="HargaJual" readonly class="form-control" value="0" placeholder="0" style="text-align:right; background:white; color:black;"/>                                     -->
                           <input type="text" name="HargaJual" onkeypress = "return isNumberKey(event)" id="HargaJual" required class="form-control" value="0" style="text-align:right; background:white; color:black;"/>
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
                              <table id="DataTableNotaJual" class="table table-bordered" cellspacing="0" width="100%" style="text-align:right">
                                 <thead>
                                     <tr>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Kuantiti</th>
                                         <th>Harga Jual (Rp)</th>
                                         <th>Sub Total (Rp)</th>
                                     </tr>
                                 </thead>
                                 <tfoot>
                                     <tr>
                                         <th>Kode Barang</th>
                                         <th>Nama Barang</th>
                                         <th>Kuantiti</th>
                                         <th>Harga Jual (Rp)</th>
                                         <th>Sub Total (Rp)</th>
                                     </tr>
                                 </tfoot>
                              </table>
                        </div>
                        <div class="form-group">
                               <label class="col-md-10 control-label">Total Sementara (Rp):</label>
                               <div class="col-md-2">
                                    <input type="hidden" id="TotalSementara" name="TotalSementara" readonly class="form-control" value="0" placeholder="0" style="text-align:right; background:white; color:black;"/>                                    
                                    <input type="text" readonly id="TotalS" name="" class="form-control" value="" readonly onkeypress = "return isNumberKey(event)" placeholder="0" style="text-align:right; background:white; color:black;"/>
                               </div>
                        </div>
                        <div class="form-group">
                               <label class="col-md-10 control-label">Diskon (Rp):</label>
                               <div class="col-md-2">
                                    <input type="hidden" id="Diskon" name="Diskon" readonly class="form-control" value="0" placeholder="0" style="text-align:right; background:white; color:black;"/>                                    
                                    <input type="text" readonly id="Disk" name="" class="form-control" value="" onkeypress = "return isNumberKey(event)" placeholder="0" style="text-align:right; background:white; color:black;"/>
                               </div>
                        </div>
                        <div class="form-group">
                               <label class="col-md-10 control-label">Total Akhir (Rp):</label>
                               <div class="col-md-2">
                                    <input type="hidden" id="TotalAkhir" name="TotalAkhir" readonly class="form-control" value="0" placeholder="0" style="text-align:right; background:white; color:black;"/>                                    
                                    <input type="text" readonly id="TotalA" name="" class="form-control" value="" readonly onkeypress = "return isNumberKey(event)" placeholder="0" style="text-align:right; background:white; color:black;"/>
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
                        <input type="hidden" name="arrHargaJual" id="arrHargaJual"/>
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
var ArrayHargaJual = new Array();
var ArraySubTotal = new Array();
var TotalSementara = 0;
var Diskon = 0;
var TotalAkhir = 0;

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

function GetHargaJual(IDBarang) {
  $.ajax({
    url: "ajax/GetHargaJual.php?IDBarang="+IDBarang,
    context: document.body, 
    success: function(responseText) {
      $('#HargaJual').empty();
      $('#HargaJual').html(responseText);
      $('#HargaJual').val(responseText);
    } 
  });
}

// function GetBank(IDPembeli) {
//   $.ajax({
//     url: "ajax/GetBank.php?IDPembeli="+IDPembeli,
//     context: document.body, 
//     success: function(responseText) {
//       $('#Bank').empty();
//       $('#Bank').html(responseText);
//       $('#Bank').val(responseText);
//     } 
//   });
// }

function GetKota(IDPembeli) {
  $.ajax({
    url: "ajax/GetKota.php?IDPembeli="+IDPembeli,
    context: document.body, 
    success: function(responseText) {
      $('#Kota').empty();
      $('#Kota').html(responseText);
      $('#Kota').val(responseText);
    } 
  });
}

function GetStatusLangganan(IDPembeli) {
  $.ajax({
    url: "ajax/GetStatusLangganan.php?IDPembeli="+IDPembeli,
    context: document.body, 
    success: function(responseText) {
      $('#StatusLangganan').empty();
      $('#StatusLangganan').html(responseText);
      $('#StatusLangganan').val(responseText);
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

function hitungTotalAkhir(){
  var total = 0;
  var diskon = 0;
  var totalAkhir = 0;
  for (var i=0; i<ArrayQty.length; i++)
  {
    if($('#StatusLangganan').val() == "Langganan") {
      Harga = convertToAngka(ArrayHargaJual[i]);
      total = total + (ArrayQty[i]*Harga);
      diskon = total * (5/100);
      totalAkhir = total - diskon;
    } else {
      Harga = convertToAngka(ArrayHargaJual[i]);
      total = total + (ArrayQty[i]*Harga);
      diskon = total * 0;
      totalAkhir = total - diskon;
    }
  }
  var ts = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var dis = diskon.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var totAkhir = totalAkhir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  $('#TotalS').val(ts);
  $('#Disk').val(dis); 
  $("#TotalA").val(totAkhir);
  $('#TotalSementara').val(total);
  $('#Diskon').val(diskon); 
  $("#TotalAkhir").val(totalAkhir);
}

$(document).ready(function() {
  var t = $('#DataTableNotaJual').DataTable();
  IDBarang = $('#IDBarang').val();
  GetKodeBarang(IDBarang);
  GetHargaJual(IDBarang);
  GetStokDatabase(IDBarang);
  IDPembeli = $('#IDPembeli').val();
  GetKota(IDPembeli);
  GetStatusLangganan(IDPembeli);

  $('#addRow').on('click', function () {
    
    KodeBarang = $('#KodeBarang').val();
    ArrayKodeBarang.push(KodeBarang); 
    IDBarang = $('#IDBarang').val();
    ArrayBarang.push(FunctionSplit(IDBarang, 0));
    Kuantiti = $('#Kuantiti').val();
    ArrayQty.push(Kuantiti);
    HargaJual = $('#HargaJual').val();
    ArrayHargaJual.push(HargaJual);
    SubTotal = Kuantiti * HargaJual;
    ArraySubTotal.push(SubTotal);

    t.row.add([
      KodeBarang,
      ShowDataTable(IDBarang),
      Kuantiti,
      HargaJual,
      SubTotal
      ]).draw(true);
    hitungTotalAkhir();
  });

  $('#DataTableNotaJual tbody').on('click', 'tr', function () {
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
    ArrayHargaJual.splice(Index, 1);
    ArrayQty.splice(Index, 1);
    ArraySubTotal.splice(Index, 1);
    hitungTotalAkhir();
  });

  $('#IDBarang').change(function(){
    var IDBarang = $(this).find("option:selected").val();
    IDBarang = FunctionSplit(IDBarang, 0);
    GetKodeBarang(IDBarang);
    GetHargaJual(IDBarang);
    GetStokDatabase(IDBarang);
  });

  $('#IDPembeli').change(function(){
    var IDPembeli = $(this).find("option:selected").val();
    IDPembeli = FunctionSplit(IDPembeli, 0);
    GetKota(IDPembeli);
    GetStatusLangganan(IDPembeli);
  });

  $('#Simpan').click(function () {
    if (ArrayKodeBarang.length<=0)
    {
        alertify.error("Transaksi nota jual harus memiliki detail");
    }
    else{
      if(ArrayQty > $('#JumlahStok').val()){
        alertify.error("Kuantiti melebihi jumlah stok");
      } else{
        alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Data Nota Jual ?",
        function() {
          $("#arrKodeBarang").val(JSON.stringify(ArrayKodeBarang));
          $("#arrQty").val(JSON.stringify(ArrayQty));
          $("#arrHargaJual").val(JSON.stringify(ArrayHargaJual));
          $("#arrSubTotal").val(JSON.stringify(ArraySubTotal));
          $("#FormTambahDataNotaJual").submit();
          alertify.success('Data Nota Jual Anda telah disimpan');
        }, 
        function(){
          alertify.error('Proses Menyimpan Data Nota Jual Anda dibatalkan');
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

function convertToRupiah(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}

function convertToAngka(rupiah)
{
  var rupiah;
  return parseInt(rupiah.replace(/[^0-9\.]+/g,""));
}
</script>
@endsection


