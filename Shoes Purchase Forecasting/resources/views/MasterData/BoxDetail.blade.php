<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Box Detail')

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
         <h3 class="panel-title">Data Box Detail</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Data Box Detail berisi semua data jumlah ukuran sepatu dalam satu box tertentu. Bila Anda ingin melihat detail, menambah, mengubah, atau menghapus data Box Detail dapat menekan icon tombol <i>View</i>, Tambah, Ubah, atau Hapus.</p><br>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <form action="DataBoxDetail" role="form" class="form-horizontal" id="wizard-validation" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                   <div class="form-group">
                        <label class="col-md-3 control-label">Sepatu</label>
                        <div class="col-md-5">
                          <select name="Merek" id="Merek" onchange="Sepatu(this)" class="form-control">
                            <option value="">Silahkan Pilih Box</option>
                            <?php
                                 for ($i=0; $i < count($DataBox) ; $i++) {
                                    //$DataBarang[$i]['Harga'];
                                    echo '<option value="'.$DataBox[$i]['ID'].'">'.$DataBox[$i]['Merek'].' '.$DataBox[$i]['Tipe'].' '.$DataBox[$i]['Warna'].' '.$DataBox[$i]['Ukuran'].'</option>';
                                 }
                            ?>
                         </select>
                        </div>
                   </div>

                   <div class="panel-body"><br><br>
                      <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-10">
                               <div class="form-group">
                                   <form class="form-horizontal">
                                       <table class="table table-bordered">
                                       <thead ><tr>
                                          <!--th style="text-align:center" width="5%">Nomor</th-->
                                           <th style="text-align:center">Ukuran Sepatu</th>
                                           <th style="text-align:center" width="40%">Jumlah</th>
                                           <th style="text-align:center">Hapus</th>
                                       </tr></thead>
                                       <tbody id="TambahPanelDiSini">
                                       <tr>
                                          <!--td style="text-align:center" width="2%" class="Nomor" id="No1">1
                                          </td-->
                                           <td style="text-align:center" id="Copi3">
                                               <div class="form-group">
                                                   <div class="col-md-12" >
                                                        <select name="SizeSepatu[]" id="NamaBarang1" class="form-control tipewarna" onchange="SelectBiaya(1,this)" class="form-control">
                                                          <!--?php

                                                               for ($i=0; $i < count($DataUkuran) ; $i++) {
                                                                  //$DataBarang[$i]['Harga'];
                                                                  echo '<option value="'.$DataUkuran[$i]['ID'].'">'.$DataUkuran[$i]['Merek'].' '.$DataUkuran[$i]['Tipe'].' '.$DataUkuran[$i]['Warna'].' '.$DataUkuran[$i]['Ukuran'].'</option>';
                                                               }
                                                          ?-->
                                                       </select>
                                                   </div>
                                               </div>
                                           </td>
                                           <td style="text-align:center" id="Copi4">
                                               <div class="col-md-12">
                                                   <div class="input-group">
                                                       <input type="text" id="Hasil1" size ="50" required class="form-control hrg" name="Jumlah[]" placeholder="0"/>
                                                   </div>
                                               </div>
                                           </td>

                                           <td style="text-align:center" id="hapus">
                                             <button type="button" id="delete1" disabled>Hapus</button>
                                           </td>
                                       </tr>
                                       </tbody>
                                       </table>
                                       <br>

                                       <a href=""><button id="TambahPanel" class="btn btn-info pull-right" type="submit"><i class="fa fa-plus"></i><i class="fa fa-paste"></i>   Tambah Barang</button></a>

                                       <br><br><br>
                                       <div class="form-group" style="text-align:center;">
                                              <input type="submit" name="BtnCreatNotaBeli" value="Simpan Detail Box" class="btn btn-warning" id="button1">
                                       </div>
                                       <input type="hidden" id="JumlahPanel" value=1 name="JumlahPanel">
                                       <!-- <input type="reset" value="Hapus" class="btn btn-danger pull-right">
                                       <input type="submit" value="Simpan Final" style="margin-right:10px" class="btn btn-success pull-right">
                                       <input type="submit" value="Simpan Sementara" style="margin-right:10px" class="btn btn-default pull-right"> -->
                                  </form>
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
var T=2;
var Index=1;

function hapuskah(param){
  var index = param.id;
  var i=index.split("delete")
  $('#Baru'+i[1]).remove();

  Index = Index - 1;
  $('#JumlahPanel').val(Index);
    console.log(Index);
}

$('#TambahPanel').click(function(event)
{
    event.preventDefault();
    $('#TambahPanelDiSini').append("<tr id='Baru"+T+"'>");
    //$('#Baru'+T).prepend("<td style='text-align: center' width:2%' class='Nomor' id='No"+T+"'>"+T+"</td>");


    var Ts= $('#Copi3').clone().appendTo('#Baru'+T);
    Ts.find("select").attr("id","NamaBarang"+T  );
    //Ts.find("select").attr("class","tipewarna" );
    Ts.find("select").attr("class","form-control tipewarna");
    Ts.find("select").attr("name","SizeSepatu[]");
    Ts.find("select").attr("placeholder","Ukuran Sepatu");

    var Te=$('#Copi4').clone().appendTo('#Baru'+T);
    Te.find("input[type='text']").attr("id","Hasil"+T);
    Te.find("input[type='text']").attr("name","Jumlah[]");
    Te.find("input[type='text']").attr("placeholder","0");
    $('#Baru'+T).append("</tr>");

    var Tx = $('#hapus').clone().appendTo('#Baru'+T);
    Tx.find("button[type='button']").removeAttr('disabled');
    Tx.find("button[type='button']").attr('onclick', "hapuskah(this)");
    Tx.find("button[type='button']").attr("id","delete"+T)

    T = T + 1;
    Index = Index + 1;
    $('#JumlahPanel').val(Index);

    console.log(Index)
    var id = $('#Merek').val();

    $.get(
    'BoxDetail/'+id,function(data){
      $('#NamaBarang'+Index).html('');
      $('#NamaBarang'+Index).html(data);

    })

    /*var index = 1;
    $('.Nomor').each(function(){
    $('#No'+index).html('');
    $('#No'+index).html(index);
    index++;
  })*/

});

function Sepatu(param){
  var id = param.value;

  $.get(
  'BoxDetail/'+id,function(data){
    var index = 1;
    $('.tipewarna').each(function(){
    $('#NamaBarang'+index).html('');
    $('#NamaBarang'+index).html(data);
    index++;
  })
  })
}

</script>
@endsection
