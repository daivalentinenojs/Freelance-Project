<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Data Nota Pesan')

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
         <h3 class="panel-title">Data Nota Pesan</h3>
         <ul class="panel-controls">
             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
         </ul>
      </div>

      <!-- Awal Daftar Estimasi -->
      <div class="panel-body">
          <p style="text-indent:5%; text-align:justify; font-size:14px;">Data Nota Pesan berisi semua data Nota Pesanan Pelanggan yang terdaftar dan bekerja sama pada PT Violatama Inti Sejati Surabaya. Bila Anda ingin melihat detail, menambah, mengubah, atau menghapus data Nota Pesan dapat menekan icon tombol <i>View</i>, Tambah, Ubah, atau Hapus.</p><br>

          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <div class="alert alert-danger" id="warning">
            Jumlah Tidak Boleh Kosong Atau 0
          </div>

          <div class="alert alert-danger" id="warningbarang">
            Harap Pilih Barang, Ukuran dan Warna
          </div>

          <form action="DataNotaPesanDetail" role="form" class="form-horizontal" id="FormNotaPesan" method="POST">
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
                   <label class="col-md-5 control-label">Pelanggan</label>
                   <div class="col-md-3">
                     <select name="IDCustomer" id="NamaBarang" onchange="SelectBiaya(1,this)" class="form-control" style="background:white; color:black;">
                       <?php
                            for ($i=0; $i < count($DataPelanggan) ; $i++) {
                               //$DataBarang[$i]['Harga'];
                               echo '<option value="'.$DataPelanggan[$i]['ID'].'">'.$DataPelanggan[$i]['pelanggan'].'</option>';
                            }
                       ?>
                    </select>
                   </div>
              </div>

              <!--div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-5 control-label">Kode Barang</label>
                     <div class="col-md-3">
                         <input type="text" name="KodeBarang[]" style="background:white; color:black;" id="KodeBarang1" placeholder="Kode Barang" readonly class="form-control">
                     </div>
                   </div>
              </div-->

              <div class="form-group">
                <label class="col-md-5 control-label">Pilih Tipe Barang</label>
                  <div class="col-md-3">
                       <select name="IDTipe[]" id="NamaBarang1" onchange="Ukuran(this)" class="form-control" style="background:white; color:black;">
                         <option value="">Pilih Barang</option>
                         <?php
                              for ($i=0; $i < count($DataBarang) ; $i++) {
                                 //$DataBarang[$i]['Harga'];
                                 echo '<option value="'.$DataBarang[$i]['ID'].'">'.$DataBarang[$i]['Merek'].' '.$DataBarang[$i]['Tipe'].'</option>';
                              }
                         ?>
                      </select>
                  </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label">Pilih Ukuran</label>
                  <div class="col-md-3">
                       <select name="IDUkuran[]" id="NamaUkuran1" onchange="Warna(this)" class="form-control Ukuran" style="background:white; color:black;">
                         <option value="">Pilih Ukuran</option>
                         <!--?php
                              for ($i=0; $i < count($DataBarang) ; $i++) {
                                 //$DataBarang[$i]['Harga'];
                                 echo '<option value="'.$DataBarang[$i]['ID'].'">'.$DataBarang[$i]['Merek'].' '.$DataBarang[$i]['Tipe'].' '.$DataBarang[$i]['Warna'].' '.$DataBarang[$i]['JenisUkuran'].'</option>';
                              }
                         ?-->
                      </select>
                  </div>
              </div>

              <div class="form-group">
                <label class="col-md-5 control-label">Pilih Warna</label>
                  <div class="col-md-3">
                       <select name="IDDetailSepatu[]" id="NamaWarna1" onchange="SelectBiaya(this)" class="form-control Warna" style="background:white; color:black;">
                         <option value="">Pilih Warna</option>
                         <!--?php
                              for ($i=0; $i < count($DataBarang) ; $i++) {
                                 //$DataBarang[$i]['Harga'];
                                 echo '<option value="'.$DataBarang[$i]['ID'].'">'.$DataBarang[$i]['Merek'].' '.$DataBarang[$i]['Tipe'].' '.$DataBarang[$i]['Warna'].' '.$DataBarang[$i]['JenisUkuran'].'</option>';
                              }
                         ?-->
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                     <label class="col-md-5 control-label">Jumlah Barang</label>
                       <div class="col-md-3">
                         <input type="number" name="Jumlah" id="Jumlah" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Masukkan Jumlah" style="background:white; color:black;"/>
                        </div>
                     </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                     <label class="col-md-5 control-label">Harga Barang</label>
                       <div class="col-md-3">
                         <input type="hidden" name="Harga[]" id='Harga_S' value="">
                           <input type="text" style="background:white; color:black;" id="Hasil1" size ="50" value="0" required class="form-control hrg" name="Harga[]" readonly/>
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
                                   <table id="DataTableNotaPesan" class="table table-bordered" cellspacing="0" width="100%">
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
var Totalkoma = 0;

function Ukuran(param){
  //var id = param.value;
  var index = param.id;
  var id = param.value;
  var i=index.split("NamaBarang");
  $.get(
  'Ukuran/'+id,function(data){
    $('#KodeBarang'+i[1]).val('');
    $('#NamaUkuran'+i[1]).html('');
    $('#NamaUkuran'+i[1]).html(data);
      $('#NamaWarna'+i[1]).html('<option value="">Pilih Warna</option>');
  })
  //alert(id);
}
function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}

function Warna(param){
  var index = param.id;
  var id = param.value;
  var i=index.split("NamaUkuran");
  $.get(
  'Warna/'+id,function(data){
    $('#NamaWarna'+i[1]).html('');
    $('#NamaWarna'+i[1]).html(data);
    index++;
  })
}
var idBarang=null;
function SelectBiaya(param){
  var index = param.id;
  var id = param.value;
  var i=index.split("NamaWarna");
  $('#KodeBarang'+i[1]).val(param.value);

  $.get(
  'DataNotaPesanDetail/'+param.value,function(data){
    var dataDetail=JSON.parse(data);
    console.log(dataDetail);
    var harga=dataDetail.HargaJual;
    //document.getElementById('Hasil'+i[1]).value=
     $('#harga'+i[1]).val(harga);
     harga=parseFloat(harga.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
     $('#Hasil'+i[1]).val(harga);
     idBarang=dataDetail.ID+"-"+ dataDetail.Merek +"-"+ dataDetail.Tipe +"-"+ dataDetail.JenisUkuran +"-"+ dataDetail.Warna;
     console.log(idBarang);
  })
  //idBarang=$('#KodeBarang'+i[1]).val();
  //alert($('#KodeBarang'+i[1]).val());
  //console.log(data);
  //alert(id);
}

$("#warning").hide();
$("#warningbarang").hide();

function hitungTotal()
{
  var total=0;
  for (var i=0;i<ArrayJumlah.length;i++)
  {
    var hrg=replaceAll(ArrayHarga[i],",","");
    console.log(ArrayHarga[i]);
    console.log(hrg);
    total=total+(ArrayJumlah[i]*hrg);
  }
  var ts=total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  $("#TotalBiaya").val(ts);
  $("#BiayaTotal").val(total);
  TotalBiaya = total;
}

function ganti(kode)
{
  for (var i=0;i<ArrayKode.length;i++)
  {
      if (ArrayKode[i]==kode)
      {
        ArrayJumlah[i]=$("#jumlah"+kode).val();
      }
  }
  hitungTotal();
}

$(document).ready(function() {
  var t = $('#DataTableNotaPesan').DataTable();
  //var i = 1;
  $('#addRow').on( 'click', function () {
    var jumlah=$("#Jumlah").val();
    var color=$("#NamaWarna1").val();
    if (jumlah!="" && color != "")
    {
      var ix=-1;
      KodeBarang = idBarang.split('-');
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
          i++;
      }

      if(ix==-1){
        ArrayKode.push(KodeBarang[0]);
        Jumlah = $('#Jumlah').val();
        ArrayJumlah.push(Jumlah);
        Harga = $('#Hasil1').val();
        ArrayHarga.push(Harga);

           t.row.add([KodeBarang[0],
               KodeBarang[1]+"-"+KodeBarang[2]+"-"+KodeBarang[3]+ "-"+KodeBarang[4],
               "<input type='number' onchange='ganti("+KodeBarang[0]+")' id='jumlah"+KodeBarang[0]+"' value='"+Jumlah+"' />",
               Harga
           ] ).draw(true);
         }
         hitungTotal();
    }
    if(jumlah==""){
      alertify.error("Jumlah harus diisi!");
    }
    if(color=="") {
      alertify.error("Pilih Barang, Ukuran dan Warna!");
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

  $('#DataTableNotaPesan tbody').on( 'click', 'tr', function () {
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
          // KurangUang = parseInt(ArrayHarga[Index]*ArrayJumlah[Index]);
           //TotalBiaya -= KurangUang;
           //$('#TotalBiaya').val(TotalBiaya);
           //$('BiayaTotal').val(TotalBiaya);
           ArrayKode.splice(Index, 1);
           ArrayJumlah.splice(Index, 1);
           ArrayHarga.splice(Index, 1);
           hitungTotal();
    });
});

$('#Simpan').click( function () {
  if (ArrayKode.length<=0)
  {
          alertify.error("Transaksi harus memiliki detail");
  }
  else{
    alertify.confirm("Apakah Anda Yakin Ingin Menyimpan Nota Pesan ?",
    function(){
      $("#arrKode").val(JSON.stringify(ArrayKode));
      $("#arrJumlah").val(JSON.stringify(ArrayJumlah));
      $("#arrHarga").val(JSON.stringify(ArrayHarga));
        $('#FormNotaPesan').submit();
        alertify.success('Nota Pesan Anda Telah Disimpan');
    },
    function(){
        alertify.error('Proses Menyimpan Nota Pesan Anda Dibatalkan');
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


function alertsimpan(){
  var add = true;
  var addwarna = true;
  //for(var i = 1; i < T; i++){
    if($('#Jumlah').val() < 1){
      add = false;
      break;
    }
    if($('#NamaWarna1').val() == null){
      addwarna = false;
      break;
    }
  //}
  if(!add){
    event.preventDefault();
    $("#warning").slideDown(function() {
    setTimeout(function() {
        $("#warning").slideUp();
    }, 2000);
});
  }
  if(!addwarna){
    event.preventDefault();
    $("#warningbarang").slideDown(function() {
    setTimeout(function() {
        $("#warningbarang").slideUp();
    }, 2000);
});
  }
}
</script>

<!--script type="text/javascript">
var T=2;
var Index=1;
var TotalBiaya = 0;
hitung();
function hitung()
{
  $('.hrg, .sbj').bind('change',function()
  {
    var sum = 0;
    var index=1;
    $('.hrg').each(function(){

        var price = $('#Hasil'+index).val();
        var realprice = price.replace(/,/g, "");
        sum += parseFloat($('#SubJumlah'+index).val())*realprice;
        index++;
    });
    sums = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#TotalBiaya').val(sums);
    $('#BiayaTotal').val(sum);
  });
}

function Koma(param){
  var sum = param.value;
  var id = param.id;
  var nomor = id.split('Hasil');

  if(sum!= 0){
    sums = parseFloat(sum.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#Hasil'+nomor[1]).val(sums);
    $('#harga'+nomor[1]).val(sums.replace(/,/g, ""));
    //alert($('#harga'+nomor[1]).val());
  }
}

function SelectBiaya(param){
  var index = param.id;
  var id = param.value;
  var i=index.split("NamaWarna");
  $('#KodeBarang'+i[1]).val(param.value);

  $.get(
  'DataNotaPesanDetail/'+param.value,function(data){
    //document.getElementById('Hasil'+i[1]).value=
    $('#harga'+i[1]).val(data);
    data=parseFloat(data.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    $('#Hasil'+i[1]).val(data);
  })
  //alert(id);
}

function hapuskah(param){
  var index = param.id;
  var i=index.split("delete")
  $('#Baru'+i[1]).hide();
  $('#SubJumlah'+i[1]).val('0');
  $('#Hasil'+i[1]).val('0');
  $('#Harga'+i[1]).val('0');

  /*Index = Index - 1;
  $('#JumlahPanel').val(Index);
    console.log(Index);*/
  var sum = 0;
  index=1;
  $('.hrg').each(function(){

      var price = $('#Hasil'+index).val();
      var realprice = price.replace(/,/g, "");
      sum += parseFloat($('#SubJumlah'+index).val())*realprice;
      index++;
  });
  sums = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  $('#TotalBiaya').val(sums);
  $('#BiayaTotal').val(sum);
}

$('#TambahPanel').click(function(event)
{
  //var Index=$('#JumlahPanel').val()

  var add = true;
  for(var i = 1; i < T; i++){
    if($('#SubJumlah'+i).val() < 1){
      add = false;
      break;
    }
  }
  event.preventDefault();
  if(add){


    $('#TambahPanelDiSini').append("<tr id='Baru"+T+"'>");
    $('#Baru'+T).prepend("<td style='text-align: center' width:2%'>"+T+"<input type='hidden' value='0' id='nilai"+T+"'></td>");

    var Tr=$('#Copi').clone().appendTo('#Baru'+T);
    //Tr.find("select").attr("onchange","SelectBiaya(this)");
    Tr.find("input[type='text']").val("");
    Tr.find("input[type='text']").attr("name","KodeBarang[]");
    Tr.find("input[type='text']").attr("id","KodeBarang"+T);

    var Tf=$('#Copi2').clone().appendTo('#Baru'+T);
    Tf.find("select").attr("onchange","Ukuran(this)");
    Tf.find("select").attr("name","IDTipe[]");
    Tf.find("select").attr("id","NamaBarang"+T);

    var Tf=$('#Copi5').clone().appendTo('#Baru'+T);
    Tf.find("select").attr("onchange","Warna(this)");
    Tf.find("select").attr("name","IDUkuran[]");
    Tf.find("select").attr("id","NamaUkuran"+T);

    var Tf=$('#Copi6').clone().appendTo('#Baru'+T);
    Tf.find("select").attr("onchange","SelectBiaya(this)");
    Tf.find("select").attr("name","IDDetailSepatu[]");
    Tf.find("select").attr("id","NamaWarna"+T);

    var Ts= $('#Copi3').clone().appendTo('#Baru'+T);
    Ts.find("input[type='text']").val("0");
    Ts.find("input[type='text']").attr("id","SubJumlah"+T  );
    Ts.find("input[type='text']").attr("name","Jumlah[]");

    //var Ta = '<input type="hidden" name="Harga[]" id="harga'+T+'" value="">'

    var Te=$('#Copi4').clone().appendTo('#Baru'+T);
    Te.find("input[type='text']").val("0");
    Te.find("input[type='text']").attr("id","Hasil"+T)
    Te.find("input[type='text']").attr("onkeyup","Koma(this)");
    Te.find("input[type='hidden']").val("0");
    Te.find("input[type='hidden']").attr("id","harga"+T)
    Te.find("input[type='hidden']").attr("name","Harga[]")


    var Tx = $('#hapus').clone().appendTo('#Baru'+T);
    Tx.find("button[type='button']").removeAttr('disabled');
    Tx.find("button[type='button']").attr('onclick', "hapuskah(this)");
    Tx.find("button[type='button']").attr("id","delete"+T)

      $('#Baru'+T).append("</tr>");
    //BiayaAwal(Index);

    T = T + 1;
    //console.log(T);
    //Index = T
    Index = Index + 1;
    $('#JumlahPanel').val(Index);
    console.log(Index)
    hitung();
  }
  else{
    $("#warning").slideDown(function() {
    setTimeout(function() {
        $("#warning").slideUp();
    }, 2000);
});
  }
});

function Ukuran(param){
  //var id = param.value;
  var index = param.id;
  var id = param.value;
  var i=index.split("NamaBarang");
  $.get(
  'Ukuran/'+id,function(data){
    $('#KodeBarang'+i[1]).val('');
    $('#NamaUkuran'+i[1]).html('');
    $('#NamaUkuran'+i[1]).html(data);
      $('#NamaWarna'+i[1]).html('<option value="">Pilih Warna</option>');
  })
  //alert(id);
}

function Warna(param){
  var index = param.id;
  var id = param.value;
  var i=index.split("NamaUkuran");
  $.get(
  'Warna/'+id,function(data){
    $('#NamaWarna'+i[1]).html('');
    $('#NamaWarna'+i[1]).html(data);
    index++;

  })
  //alert(id);
}

$("#warning").hide();
$("#warningbarang").hide();


function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      alert("Harus input angka!");
      return false;
  }
  return true;
}

function alertsimpan(){
  var add = true;
  var addwarna = true;
  for(var i = 1; i < T; i++){
    if($('#SubJumlah'+i).val() < 1){
      add = false;
      break;
    }
    if($('#NamaWarna'+i).val() == null){
      addwarna = false;
      break;
    }
  }
  if(!add){
    event.preventDefault();
    $("#warning").slideDown(function() {
    setTimeout(function() {
        $("#warning").slideUp();
    }, 2000);
});
  }
  if(!addwarna){
    event.preventDefault();
    $("#warningbarang").slideDown(function() {
    setTimeout(function() {
        $("#warningbarang").slideUp();
    }, 2000);
});
  }
}
</script-->
@endsection
