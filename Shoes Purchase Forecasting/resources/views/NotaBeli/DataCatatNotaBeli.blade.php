@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Nota Beli')

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
         <h3 class="panel-title">Data Nota Beli</h3>
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

          <form action="DataNotaBeliDetail" role="form" class="form-horizontal" id="FormNotaBeli" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
             <div class="form-group">
                  <label class="col-md-5 control-label">Tanggal Buat</label>
                  <div class="col-md-3">
                         <div class="input-group">
                              <input type="date" name="TanggalBuat" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                         </div>
                  </div>
             </div>

              <div class="form-group">
                   <label class="col-md-5 control-label">Supplier</label>
                   <div class="col-md-3">
                     <select name="IDSupplier" id="IDSupplier" class="form-control select" data-live-search="true">
                        @foreach ($DataSupplier as $Supplier)
                           <option value="{{$Supplier['ID']}}">{{$Supplier['Supplier']}}</option>
                        @endforeach
                    </select>
                   </div>
              </div>
              <div class="form-group">
                   <label class="col-md-5 control-label">Barang</label>
                   <div class="col-md-3">
                     <select name="IDBarang" id="IDBarang" class="form-control select" data-live-search="true">
                        @foreach ($DataBarang as $Barang)
                           <option value="{{$Barang['ID']}}-{{$Barang['Merek']}}-{{$Barang['Tipe']}}-{{$Barang['Warna']}}-{{$Barang['JenisUkuran']}}">{{$Barang['Merek']}} {{$Barang['Tipe']}} {{$Barang['Warna']}} {{$Barang['JenisUkuran']}}</option>
                        @endforeach
                    </select>
                   </div>
              </div>
              <div class="form-group">
                   <div class="col-md-12">
                      <label class="col-md-5 control-label" style="margin-top:10px;">Jumlah</label>
                      <div class="col-md-3">
                        <input type="number" name="Jumlah" id="Jumlah" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Masukkan Jumlah" style="background:white; color:black;"/>
                       </div>
                   </div>
              </div>
              <div class="form-group">
                   <div class="col-md-12">
                      <label class="col-md-5 control-label" style="margin-top:10px;">Harga</label>
                      <div class="col-md-3">
                        <input type="hidden" name="HargaJualSepatu" id='Harga_S' value="">
                        <input type="text" name="Harga" id="Harga" onkeyup='KomaJual(this)' onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Masukkan Harga" style="background:white; color:black;"/>
                      </div>
                   </div>
              </div>

              <div class="form-group">
                 <div class="col-md-12">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-4">
                       <button type="button" id="addRow" class="btn btn-info" name="addRow">Tambah Barang</button>
                       <button type="button" id="deleteRow" class="btn btn-danger" name="deleteRow">Hapus Barang</button>
                    </div>
                 </div>
              </div>

             <div class="panel-body">
                <div class="row">
                     <div class="col-md-12">
                         <div class="form-group">
                                <table id="DataTableNotaBeli" class="table table-bordered" cellspacing="0" width="100%">
                                       <thead>
                                           <tr>
                                             <th>Kode Barang</th>
                                              <th>Barang</th>
                                              <th>Jumlah</th>
                                              <th>Harga</th>
                                           </tr>
                                       </thead>
                                       <tbody>

                                       </tbody>
                                       <tfoot>
                                           <tr>
                                             <th>Kode Barang</th>
                                              <th>Barang</th>
                                              <th>Jumlah</th>
                                              <th>Harga</th>
                                           </tr>
                                       </tfoot>
                                    </table>
                                 <br>
                                 <div class="form-group">
                                       <label class="col-md-10 control-label">Total Biaya Barang</label>
                                       <div class="col-md-2">
                                            <input type="text" id="TotalBiaya" name="TotalBiaya" value="0" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                                            <input type="hidden" id="BiayaTotal" name="BiayaTotal" value="0" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                                       </div>
                                 </div>

                                 <input type="hidden" name="arrKode" id="arrKode"/>
                                 <input type="hidden" name="arrJumlah" id="arrJumlah"/>
                                 <input type="hidden" name="arrHarga" id="arrHarga"/>
                                 <div class="form-group pull-right">
                                        <input type="button" name="Simpan" value="Simpan" id="Simpan" class="btn btn-warning">
                                 </div>
                             </div>
                     </div>
             </div>
             </div>
   </form>
</div>
   </div>
</div>
<!-- Akhir Group Box Daftar Estimasi -->


<script type="text/javascript">
var ArrayKode = new Array();
var ArrayBarang = new Array();
var ArrayJumlah = new Array();
var ArrayHarga = new Array();
var TotalBiaya = 0;

function hitungTotal()
{
  var total=0;
  for (var i=0;i<ArrayJumlah.length;i++)
  {
    total=total+(ArrayJumlah[i]*ArrayHarga[i]);
  }
  var ts=total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  $("#TotalBiaya").val(ts);
  $("#BiayaTotal").val(total);
  TotalBiaya = total
}
function replaceAll(originalString, find, replace) {
  return originalString.replace(new RegExp(find, 'g'), replace);
};
function ganti(kode)
{
  var str=$("#harga"+kode).val();
  var strBersih=replaceAll(str,",","");
  $("#harga_S"+kode).val(strBersih);
  for (var i=0;i<ArrayKode.length;i++)
  {
      if (ArrayKode[i]==kode)
      {
        ArrayJumlah[i]=$("#jumlah"+kode).val();
        ArrayHarga[i]=$("#harga_S"+kode).val();

      }
  }
  hitungTotal();
}
$(document).ready(function() {
  var t = $('#DataTableNotaBeli').DataTable();

  $('#addRow').on( 'click', function () {
      var jumlah=$("#Jumlah").val();
      var hargaS=$("#Harga_S").val();
      if (jumlah!="" && hargaS!="")
      {
        IDBarang = $('#IDBarang').val();
        var ix=-1;
        KodeBarang = IDBarang.split("-");
        for (var i=0;i<ArrayKode.length;i++)
        {
            if (ArrayKode[i]==KodeBarang[0])
            {
              ix=i;
              $("#jumlah"+KodeBarang[0]).val($("#Jumlah").val());
              $("#harga"+KodeBarang[0]).val($("#Harga_S").val());
              ArrayJumlah[i]=$("#Jumlah").val();
              ArrayHarga[i]=$("#Harga_S").val();
            }
        }

        if (ix==-1)
        {
          //console.log(KodeBarang);
          ArrayKode.push(KodeBarang[0]);
          Jumlah = $('#Jumlah').val();

          ArrayJumlah.push(Jumlah);
          Harga = $('#Harga_S').val();
          ArrayHarga.push(Harga);

             t.row.add([KodeBarang[0],
                 KodeBarang[1]+"-"+KodeBarang[2]+"-"+KodeBarang[3]+ "-"+KodeBarang[4],
                 "<input type='number' onchange='ganti("+KodeBarang[0]+")' id='jumlah"+KodeBarang[0]+"' value='"+Jumlah+"' />",
                 "<input type='text' onchange='ganti("+KodeBarang[0]+")' onkeyup='KomaJual(this)' id='harga"+KodeBarang[0]+"' value='"+KomaJual2(Harga)+"' />"+
                 "<input type='hidden' onchange='ganti("+KodeBarang[0]+")' id='harga_S"+KodeBarang[0]+"' value='"+Harga+"' />"
             ] ).draw(true);
        }
        hitungTotal();
        console.log(TotalBiaya);
      }
      else {
        alertify.error("Jumlah dan harga harus diisi!");
      }

  });

  function ShowDataTable(IDIndex) {
     var Hasil = '';
     var res = IDIndex.split("-");
     for (var i = 1; i < res.length; i++) {
        Hasil += res[i]+' ';
     }
     return Hasil;
  }

  function FunctionSplit(Data, Angka) {
     var res = Data.split("-");
     return res[Angka];
  }

  $('#DataTableNotaBeli tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        } else {
           t.$('tr.selected').removeClass('selected');
           $(this).addClass('selected');
           Index = t.row( this ).index();
        }
    } );

    $('#deleteRow').click( function () {
        t.row('.selected').remove().draw( false );
           KurangUang = parseInt(ArrayHarga[Index]*ArrayJumlah[Index]);
           TotalBiaya -= KurangUang;
           $('#TotalBiaya').val(TotalBiaya);
           $('BiayaTotal').val(TotalBiaya);
           ArrayKode.splice(Index, 1);
           ArrayJumlah.splice(Index, 1);
           ArrayHarga.splice(Index, 1);
           console.log(TotalBiaya);
           console.log(KurangUang);
    });
});

$('#Simpan').click( function () {
  if (ArrayKode.length<=0)
  {
          alertify.error("Transaksi harus memiliki detail");
  }
  else {
    alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Nota Beli ?",
    function(){
         $("#arrKode").val(JSON.stringify(ArrayKode));
         $("#arrJumlah").val(JSON.stringify(ArrayJumlah));
         $("#arrHarga").val(JSON.stringify(ArrayHarga));
         $('#FormNotaBeli').submit();
         alertify.success('Nota Beli Anda Telah Disimpan');

    },
    function(){
        alertify.error('Proses Menyimpan Nota Beli Anda Dibatalkan');
    });
  }

});

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

</script>
@endsection
