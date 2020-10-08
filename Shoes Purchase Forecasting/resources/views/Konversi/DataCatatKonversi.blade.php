@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Konversi')

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
<!-- Awal Group Box Daftar Estimasi -->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Data Konversi</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Data Nota Beli berisi semua data Nota Beli yang terdaftar dan bekerja sama pada PT Violatama Inti Sejati Surabaya. Bila Anda ingin melihat detail, menambah, mengubah, atau menghapus data Nota Beli dapat menekan icon tombol <i>View</i>, Tambah, Ubah, atau Hapus.</p><br>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <form action="DataKonversiDetail" role="form" class="form-horizontal" id="FormKonversi" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
             <div class="form-group">
                  <label class="col-md-5 control-label">Tanggal Buka Box</label>
                  <div class="col-md-3">
                         <div class="input-group">
                              <input type="date" name="TanggalBuat" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                         </div>
                  </div>
             </div>

              <div class="form-group">
                   <label class="col-md-5 control-label">Box Sepatu</label>
                   <div class="col-md-3">
                     <select name="BoxSepatu" id="IDBox1" onchange="StokSaatIni(this)" class="form-control select" data-live-search="true">
                       <option value="">Silahkan Pilih Box Sepatu</option>
                        <?php

                             for ($i=0; $i < count($DataBarang) ; $i++) {
                                //$DataBarang[$i]['Harga'];
                                echo '<option value="'.$DataBarang[$i]['ID'].'">'.$DataBarang[$i]['Merek']." ".$DataBarang[$i]['Tipe']." ".$DataBarang[$i]['JenisUkuran']." ".$DataBarang[$i]['Warna'].'</option>';
                             }
                        ?>
                    </select>
                   </div>
              </div>

              <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-5 control-label">Kode Barang</label>
                     <div class="col-md-3">
                         <input type="text" name="KodeBarang" style="background:white; color:black;" id="KodeBarang" placeholder="Kode Barang" readonly class="form-control">
                     </div>
                   </div>
              </div>

              <div class="form-group">
                   <div class="col-md-12">
                      <label class="col-md-5 control-label" style="margin-top:10px;">Stok Saat ini</label>
                      <div class="col-md-3">
                        <input type="text" name="Stok" id="Stok" required class="form-control" value="0" placeholder="Stok saat ini" readonly style="background:white; color:black;"/>
                      </div>
                   </div>
              </div>

              <div class="form-group">
                   <div class="col-md-12">
                      <label class="col-md-5 control-label" style="margin-top:10px;">Jumlah Buka Box</label>
                      <div class="col-md-3">
                        <input type="number" name="JumlahBuka" id="Jumlah" onkeypress="return isNumberKey(event)" onkeyup="checkBuka(event)" required class="form-control" value="" placeholder="Masukkan Jumlah" style="background:white; color:black;"/>
                       </div>
                   </div>
              </div>

             <div class="form-group" style="text-align:center;">
                <input type="button" name="Simpan" value="Simpan" id="Simpan" class="btn btn-warning">
             </div>

   </form>
</div>
   </div>
</div>
<!-- Akhir Group Box Daftar Estimasi -->


<script type="text/javascript">
function StokSaatIni(param){
  var id = param.value;
  $('#KodeBarang').val(id);

  $.get(
  'DataKonversiDetail/'+id,function(data){
    $('#Stok').val(data);
  })
}

function isNumberKey(evt) {
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode == 46)
        return true;
   if ((charCode > 31 && (charCode < 48 || charCode > 57))){
     alert("Harus input angka!");
     return false;
   }
   return true;
}


function checkBuka(evt){
  var input = $('#Jumlah').val()*1;
  var stok = $('#Stok').val()*1;
  console.log(input+' '+stok);
  if(stok == 0){
    alert('Mohon pilih box sepatu terlebih dahulu ! !');
    $('#Jumlah').val("");
  }
  if(input > stok){
    alert('Jumlah buka box tidak boleh melebihi jumlah stok ! !');
    $('#Jumlah').val("");
  }
}

$('#Simpan').click( function () {
  var box = $('#KodeBarang').val();
  var inputs = $('#Jumlah').val();
  if(box=="")
  {
      alertify.error("Mohon pilih box sepatu terlebih dahulu ! !");
  }
  if(inputs=="")
  {
      alertify.error("Input stok terlebih dahulu ! !");
  }

  else if(box != "" && inputs != ""){
     alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Data Konversi ?",
     function(){
         $('#FormKonversi').submit();
         alertify.success('Data Konversi Anda Telah Disimpan');
     },
     function(){
         alertify.error('Proses Menyimpan Data Konversi Anda Dibatalkan');
     });
   }
});

</script>
@endsection
