
<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Nota Terima')

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
         <h3 class="panel-title">Data Nota Terima</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Data Nota Terima berisi semua data Nota Terima yang terdaftar dan bekerja sama pada PT Violatama Inti Sejati Surabaya. Bila Anda ingin melihat detail, menambah, mengubah, atau menghapus data Nota Terima dapat menekan icon tombol <i>View</i>, Tambah, Ubah, atau Hapus.</p><br>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <form action="DataNotaTerimaDetail" role="form" class="form-horizontal" id="wizard-validation" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="form-group">
                   <label class="col-md-3 control-label">Nomor Nota Pembelian</label>
                   <div class="col-md-3">
                     <select name="DataPembelian" id="NamaBarang" onchange="SelectNomorPembelian(this)" class="form-control">
                       <option value="">Silahkan Pilih Nomor Nota</option>
                       <?php
                            for ($i=0; $i < count($DataPembelian) ; $i++) {
                               //$DataBarang[$i]['Harga'];
                               echo '<option value="'.$DataPembelian[$i]['Nomor'].'">'.$DataPembelian[$i]['Nomor'].' / '.$DataPembelian[$i]['Tanggal'].' / '.$DataPembelian[$i]['Supplier'].'</option>';
                            }
                       ?>
                    </select>
                   </div>
              </div>

                   <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Diterima</label>
                        <div class="col-md-3">
                                <div class="input-group">
                                    <input type="date" name="TanggalTerima" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                        </div>
                   </div>

                   <div class="panel-body"><br><br>
                      <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-10">
                               <div class="form-group">

                                       <table class="table table-bordered">
                                       <thead ><tr>
                                           <th style="text-align:center" width="5%">Nomor</th>
                                           <th style="text-align:center" width="40%">Nama Barang</th>
                                           <th style="text-align:center" width="10%">Jumlah</th>
                                       </tr></thead>
                                       <tbody id="TambahPanelDiSini">


                                       </tbody>
                                       </table>
                                         <!--?php


                                       <br>

                                       <a href=""><button id="TambahPanel" class="btn btn-info pull-right" type="submit"><i class="fa fa-plus"></i><i class="fa fa-paste"></i>   Tambah Barang</button></a>

                                       <br><br><br>
                                       <div class="form-group" style="text-align:center;">
                                              <input type="submit" name="BtnCreatNotaBeli" value="Simpan Nota" class="btn btn-warning">
                                       </div-->

                                       <input type="hidden" id="JumlahPanel" value=1 name="JumlahPanel">

                               </div>
                           </div>
                      </div>
                   </div>
                   <div class="form-group" style="text-align:center;">
                          <input type="submit" name="BtnCreatNotaBeli" value="Konfirmasi Barang Datang" class="btn btn-warning">
                   </div>
         </form>
      </div>
   </div>
</div>
<!-- Akhir Group Box Daftar Estimasi -->


<script type="text/javascript">
var T=2;
var Index=1;
var TotalBiaya = 0;
//hitung();

function SelectNomorPembelian(param){
  var id = param.value
  $.get(
    'NotaPembelian/'+id,function(data){
      //alert(data)
      $('#TambahPanelDiSini').html(data)
    }
  )
}
/*
function hitung()
{
  $('.hrg, .sbj').bind('change',function()
  {
    var sum = 0;
    var index=1;
    $('.hrg').each(function(){
        sum += parseFloat($('#SubJumlah'+index).val())*parseFloat($('#Hasil'+index).val());
        index++;
    });
    sums = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#TotalBiaya').val(sums);
    $('#BiayaTotal').val(sum);
  });
}

$('#TambahPanel').click(function(event)
{
  var Index=$('#JumlahPanel').val()

    event.preventDefault();
    $('#TambahPanelDiSini').append("<tr id='Baru"+T+"'>");
    $('#Baru'+T).prepend("<td style='text-align: center' width:2%'>"+T+"<input type='hidden' value='0' id='nilai"+T+"'></td>");

    var Tr=$('#Copi').clone().appendTo('#Baru'+T);
    Tr.find("select").attr("onchange","SelectBiaya("+T+",this)");
    Tr.find("select").attr("name","KodeBarang[]");
    Tr.find("select").attr("id","KodeBarang"+Index);

    var Tf=$('#Copi2').clone().appendTo('#Baru'+T);
    Tf.find("select").attr("onchange","SelectBiaya("+T+",this)");
    Tf.find("select").attr("name","IDDetailSepatu[]");
    Tf.find("select").attr("id","NamaBarang"+Index);

    var Ts= $('#Copi3').clone().appendTo('#Baru'+T);
   //  Ts.find("input[type='text']").val("1");
   //  Ts.find("input[type='number']").attr("onchange","Ubah("+T+")");
   //  Ts.find("input[type='number']").attr("id","Biaya"+T);
    Ts.find("input[type='text']").val("0");
    Ts.find("input[type='text']").attr("id","SubJumlah"+T  );
    Ts.find("input[type='text']").attr("name","Jumlah[]");

    var Te=$('#Copi4').clone().appendTo('#Baru'+T);
    Te.find("input[type='text']").val("0");
    Te.find("input[type='text']").attr("id","Hasil"+T)
    Te.find("input[type='text']").attr("name","Harga[]")
    $('#Baru'+T).append("</tr>");

    //BiayaAwal(Index);
    T = T + 1;
    Index = parseInt(Index) + 1;
    $('#JumlahPanel').val(Index);
    console.log(Index)
    hitung();
});
*/


</script>
@endsection
