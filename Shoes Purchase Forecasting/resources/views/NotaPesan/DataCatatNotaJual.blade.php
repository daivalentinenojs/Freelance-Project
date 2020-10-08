
<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Nota Jual')

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
         <h3 class="panel-title">Data Nota Jual</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Data Nota Jual berisi semua data Nota Jual yang terdaftar dan bekerja sama pada PT Violatama Inti Sejati Surabaya. Bila Anda ingin melihat detail, menambah, mengubah, atau menghapus data Nota Jual dapat menekan icon tombol <i>View</i>, Tambah, Ubah, atau Hapus.</p><br>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <form action="DataNotaJualDetail" role="form" class="form-horizontal" id="FormNotaJual" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="form-group">
                   <label class="col-md-3 control-label">Nomor Nota Pesanan</label>
                   <div class="col-md-3">
                     <select name="DataPesanan" id="NamaBarang" onchange="SelectNomorPesanan(this)" class="form-control">
                       <option value="">Silahkan Pilih Nomor Nota</option>
                       <?php
                            for ($i=0; $i < count($DataPesanan) ; $i++) {
                               //$DataBarang[$i]['Harga'];
                               echo '<option value="'.$DataPesanan[$i]['Nomor'].'">'.$DataPesanan[$i]['Nomor'].' / '.$DataPesanan[$i]['Tanggal'].' / '.$DataPesanan[$i]['Customer'].'</option>';
                            }
                       ?>
                    </select>
                   </div>
              </div>

                   <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Dikirim</label>
                        <div class="col-md-3">
                                <div class="input-group">
                                    <input type="date" name="TanggalJual" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
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
                                           <th style="text-align:center" width="10%">Jumlah Pesanan</th>
                                           <th style="text-align:center" width="10%">Stok Saat Ini</th>
                                           <th style="text-align:center" width="10%">Harga</th>
                                           <th style="text-align:center" width="10%">Konversi</th>
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
                                       <!--div class="form-group">
                                             <label class="col-md-10 control-label">Total Biaya Barang</label>
                                             <div class="col-md-2">
                                                  <input type="text" id="TotalBiaya" name="TotalBiaya" value="0" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                                                  <input type="hidden" id="BiayaTotal" name="BiayaTotal" value="0" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                                             </div>
                                       </div-->

                                       <input type="hidden" id="JumlahPanel" value=1 name="JumlahPanel">

                               </div>
                           </div>
                      </div>
                   </div>
                   <div class="form-group" style="text-align:center;">
                          <input type="button" id="BtnCreatNotaBeli" name="BtnCreatNotaBeli" value="Konfirmasi Barang Datang" class="btn btn-warning">
                   </div>

                   <input type="hidden" name="arrKode" id="arrKode"/>
                   <input type="hidden" name="arrJumlah" id="arrJumlah"/>
                   <input type="hidden" name="arrHarga" id="arrHarga"/>
                   <input type="hidden" name="arrTotal" id="arrTotal"/>
         </form>
      </div>
   </div>
</div>
<!-- Akhir Group Box Daftar Estimasi -->


<script type="text/javascript">
var T=2;
var Index=1;
var TotalBiaya = 0;
hitung();

var dataJSON=null;
function SelectNomorPesanan(param){
  var id = param.value
  $.get(
    'NotaPesanan/'+id,function(data){
      dataJSON=JSON.parse(data);
      var contentHTML="";
      for (var i=0;i<dataJSON.length;i++)
      {
        //echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['ID']."' name='IDSepatu[]'>".$DataDetailSepatu[$i]['Merek']." ".$DataDetailSepatu[$i]['Tipe']." ".$DataDetailSepatu[$i]['Warna']." ".$DataDetailSepatu[$i]['Ukuran']."</td>";
        //echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['Stoksaatini']."' name='Stoksaatini[]'>".$DataDetailSepatu[$i]['Stoksaatini']."</td>";
        var detail=dataJSON[i];
        contentHTML=contentHTML+"<tr>";
        contentHTML=contentHTML+"<td>"+(i+1)+"</td>";
        contentHTML=contentHTML+"<td><input type='hidden' value='"+detail.ID+"' name='IDSepatu[]'>"+detail.Merek+" "+detail.Tipe+" "+detail.Warna+" "+detail.Ukuran+"</td>";
        contentHTML=contentHTML+"<td><input type='hidden' value='"+detail.Jumlah+"' name='Jumlah[]'>"+detail.Jumlah+"</td>";
        contentHTML=contentHTML+"<td><input type='hidden' value='"+detail.Stoksaatini+"' name='Stoksaatini[]'>"+detail.Stoksaatini+"</td>";
        //echo "<td>"."<input type='hidden' value='".$DataDetailSepatu[$i]['Harga']."' name='Harga[]'> Rp ".formatMoney($DataDetailSepatu[$i]['Harga'])."</td>";
        contentHTML=contentHTML+"<td style='text-align:right'><input type='hidden' value='"+detail.Harga+"' name='Harga[]'>"+KomaJual2(detail.Harga)+"</td>";
        if (detail.Stoksaatini*1<detail.Jumlah*1)
        {
          contentHTML=contentHTML+"<td><a href = '/Forecasting/public/DataKonversiDetail' target='_blank'>Klik disini</a></td>";
        }
        else {
          contentHTML=contentHTML+"<td></td>";
        }
        contentHTML=contentHTML+"</tr>";
      }
      $("#TambahPanelDiSini").html(contentHTML);
      //console.log(dataJSON);
      //alert(data)
      //$('#TambahPanelDiSini').html(data)
    }
  )
}

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

  $(document).ready(function()
{
  $("#BtnCreatNotaBeli").click(function()
  {
      var adaKurang=false;
      for (var i=0;i<dataJSON.length;i++)
      {
        var detail=dataJSON[i];
        if (detail.Jumlah>detail.Stoksaatini)
        {
          adaKurang=true;
        }
      }
      if (!adaKurang)
      {
        alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Nota Jual ?",
         function()
         {
           $('#FormNotaJual').submit();
           alertify.success('Nota Jual Anda Telah Disimpan');
         },
         function(){
          alertify.error('Proses Menyimpan Nota Jual Anda Dibatalkan');
         });
      }
      else {
        //alert("Jumlah stok ada yang kurang");
        alertify.confirm("Terdapat jumlah pesanan yang melebih stok. Tetap lanjutkan ?",
         function()
         {
           $('#FormNotaJual').submit();
         },
         function(){
          alertify.error('Proses Menyimpan Nota Jual Anda Dibatalkan');
         });
      }
  });
});
</script>
@endsection
