@extends('Master')
@section('Judul','Master Data | Shopping Cart')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<form role="form" action="ShoppingCart" class="form-horizontal FormCart" id="example-advanced-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <h3>Shopping Cart Information</h3>
    <fieldset>
        <legend><br>Shopping Cart Information</legend>
        @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        @if (session('status'))
           <div class="alert alert-success">
                {{ session('status') }}
           </div>
        @endif
             <div class="panel-body">
                 <table class="table table-bordered" id="DataTableShoppingCart">
                     <thead>
                        <tr>
                             <th style="text-align:center;">ID Product</th>
                             <th style="text-align:center;">Photo</th>
                             <th style="text-align:center;">Product Name</th>
                             <th style="text-align:center;">Description</th>
                             <th style="text-align:center;">Price</th>
                             <th style="text-align:center;">Weight</th>
                             <th style="text-align:center; width:10%;">Quantity</th>
                        </tr>
                     </thead>
                     <tbody>
                          @foreach($DataShopingCart as $Item)
                          <tr>
                              <td style="text-align:center; vertical-align:middle; font-size:15px;">
                                 <input type="hidden" name="IDFinal[]" value="{{$Item[0]['ID']}}">
                                 {{$Item[0]['ID']}}
                              </td>
                              <td style="text-align:center; vertical-align:middle;"><img width="50px" height="65px" src="foto/barang/{{$Item[0]['ID']}}.jpg"></td>
                              <td style="text-align:left; vertical-align:middle; font-size:15px;">{{$Item[0]['Nama']}}</td>
                              <td style="text-align:left; vertical-align:middle; font-size:15px;">{{$Item[0]['Keterangan']}}</td>
                              <td style="text-align:center; vertical-align:middle; font-size:15px;">
                                 @if($Item[0]['Promo'] == 1 || $Item[0]['IDStatusBarang'] == 3)
                                   <input type="hidden" name="Price[]" id="Price" value="{{$Item[0]['HargaJualPromo']}}">
                                   <input type="text" class="form-control" readonly style="background:white; color:grey; border:0px; text-align:center;" value="IDR {{number_format($Item[0]['HargaJualPromo'],0,',','.')}}">
                                 @else
                                   <input type="hidden" name="Price[]" id="Price" value="{{$Item[0]['HargaJual']}}">
                                   <input type="text" class="form-control" readonly style="background:white; color:grey; border:0px; text-align:center;" value="IDR {{number_format($Item[0]['HargaJual'],0,',','.')}}">
                                 @endif
                              </td>
                              <td style="text-align:center; vertical-align:middle; font-size:15px;">
                                   <input type="hidden" name="Weight[]" id="Weight" value="{{$Item[0]['Berat']}}">
                                   <input type="text" class="form-control" readonly style="background:white; color:grey; border:0px; text-align:center;" value="{{$Item[0]['Berat']}} gr">
                              </td>
                              <td style="text-align:center; vertical-align:middle; ">
                                 <select name="Quantity[]" id="Quantity" required class="form-control select Quantity" data-live-search="true"/>
                                    @for($i=1; $i <= $Item[0]['Stok']; $i++)
                                         <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                 </select>
                                 <!-- <input type="text" onkeypress="return isNumberKey(event)" required  class="form-control" name="Quantity[]" id="Quantity" value="1" placeholder="1"> -->
                              </td>
                          </tr>
                          @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <th style="text-align:center;">ID Product</th>
                           <th style="text-align:center;">Photo</th>
                           <th style="text-align:center;">Product Name</th>
                           <th style="text-align:center;">Description</th>
                           <th style="text-align:center;">Price</th>
                           <th style="text-align:center;">Weight</th>
                           <th style="text-align:center;">Quantity</th>
                        </tr>
                     </tfoot>
                 </table>
             </div>
             <div class="col-md-5">
              <i class="btn btn-danger fa fa-trash-o" id="DeleteRow" name="DeleteRow"></i>
              <!-- <button type="button" class="btn btn-danger" >Delete Product</button> -->
             </div>
    </fieldset>

    <h3>Recipient Information</h3>
    <fieldset>
        <legend><br>Recipient Information</legend>
             <!-- Awal Informasi Pra Estimasi -->
             <div class="panel-body">
                 <div class="form-group">
                    <div class="col-md-5">
                         <label class="col-md-4 control-label" style="margin-top:10px;">Name*</label>
                         <div class="col-md-8">
                            <input type="hidden" name="IDPembeli" id="IDPembeli" value="{{$ID}}">
                            <input type="text" class="form-control" value="" required id="NamaPenerima" name="NamaPenerima" required placeholder="Recipient Name"/>
                         </div>
                    </div>
                    <div class="col-md-7">
                       <label class="col-md-5 control-label" style="margin-top:10px;">Address*</label>
                         <div class="col-md-7">
                                     <input type="text" class="form-control" value="" required id="AlamatPenerima" name="AlamatPenerima" required placeholder="Recipient Address"/>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                       <label class="col-md-4 control-label" style="margin-top:10px;">Phone*</label>
                         <div class="col-md-5">
                                     <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="" required id="TeleponPenerima" name="TeleponPenerima" required placeholder="Recipient Phone"/>
                         </div>
                    </div>
                    <!-- <div class="col-md-7">
                       <label class="col-md-5 control-label" style="margin-top:10px;">Handphone*</label>
                         <div class="col-md-5">
                                     <input type="text" onkeypress="return isNumberKey(event)" required  class="form-control" name="HandphonePenerima" id="HandphonePenerima" value="" placeholder="Recipient Handphone">
                         </div>
                    </div> -->
                </div>
             </div>
    </fieldset>

    <h3>Shipper Information</h3>
    <fieldset>
        <legend><br>Shipper Information</legend>
        <div class="form-group">
          <div class="col-md-5">
               <label class="col-md-4 control-label">To Province*</label>
               <div class="col-md-7">
                  <input type="hidden" id="Provinsi" name="Provinsi" value="">
                   <select name="DivProvinsiTujuan" id="DivProvinsiTujuan" required class="form-control select" data-live-search="true"/>
                   </select>
               </div>
          </div>
          <div class="col-md-7">
               <label class="col-md-5 control-label">To City*</label>
               <div class="col-md-6">
                  <input type="hidden" id="Kota" name="Kota" value="">
                   <select name="DivKotaTujuan" id="DivKotaTujuan" required class="form-control select" data-live-search="true"/>
                   </select>
               </div>
          </div>
      </div>
      <div class="form-group">
        <div class="col-md-5">
             <label class="col-md-4 control-label" style="margin-top:10px;">Kecamatan</label>
             <div class="col-md-7">
                <input type="text" class="form-control" value="" id="Kecamatan" name="Kecamatan" placeholder="Kecamatan"/>
             </div>
        </div>
        <div class="col-md-7">
             <label class="col-md-5 control-label" style="margin-top:10px;">Kelurahan</label>
             <div class="col-md-6">
                <input type="text" class="form-control" value="" id="Kelurahan" name="Kelurahan" placeholder="Kelurahan"/>
             </div>
        </div>
    </div>
    <div class="form-group">
      <div class="col-md-5">
          <label class="col-md-4 control-label" style="margin-top:10px;">Postal Code</label>
          <div class="col-md-7">
             <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="" id="KodePos" name="KodePos" placeholder="Postal Code"/>
          </div>
      </div>
   </div>
   <div class="form-group">
      <div class="col-md-5">
         <label class="col-md-4 control-label">Note</label>
         <div class="col-md-7">
               <textarea style="border-radius:8px; text-align:justify; padding:10px; background:white; border: 1px solid grey" placeholder="Insert Yout Note" name="Keterangan" rows="3" cols="125"></textarea>
         </div>
      </div>
   </div>
      <div class="form-group">
        <div class="col-md-5">
             <label class="col-md-4 control-label" style="margin-top:10px;">Shipment Cost*</label>
             <div class="col-md-8">
                 <div name="DivHarga" id="DivHarga">
                 </div>
             </div>
        </div>
    </div>
          <div class="form-group">
              <div class="col-md-5">
                   <label class="col-md-4 control-label" style="margin-top:10px;">Dropshipper</label>
                   <div class="col-md-8">
                      <input type="hidden" name="IsDropship" id="IsDropship" value="0">
                               <input type="checkbox" style="margin-top:20px;" name="IsDropshipper" id="IsDropshipper">
                   </div>
              </div>
          </div>
          <div class="form-group" id="DataDropshipper" name="DataDropshipper">
             <div class="form-group">
                <div class="col-md-5">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="NamaDropshipper" placeholder="Dropshipper Name"/>
                    </div>
                </div>
             </div>
             <div class="form-group">
               <div class="col-md-5">
                    <label class="col-md-4 control-label" style="margin-top:10px;">Phone</label>
                    <div class="col-md-5">
                                <input type="text" class="form-control" value="" required id="TeleponDropshipper" name="TeleponDropshipper" required placeholder="Dropshipper Phone"/>
                    </div>
               </div>
               <!-- <div class="col-md-7">
                  <label class="col-md-5 control-label" style="margin-top:10px;">Handphone</label>
                    <div class="col-md-5">
                                <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="" required id="HandphoneDropshipper" name="HandphoneDropshipper" required placeholder="Dropshipper Handphone"/>
                    </div>
               </div> -->
               <!-- Awal Informasi Pra Estimasi -->
                <!-- <div class="form-group">
                   <div class="col-md-5">
                       <label class="col-md-4 control-label" style="margin-top:10px;">From Province</label>
                       <div class="col-md-7">
                           <select name="DivProvinsiAsal" id="DivProvinsiAsal" required class="form-control select" data-live-search="true"/>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-7">
                       <label class="col-md-4 control-label" style="margin-top:10px;">From City</label>
                       <div class="col-md-7">
                           <select name="DivKotaAsal" id="DivKotaAsal" required class="form-control select" data-live-search="true"/>
                           </select>
                       </div>
                  </div>
               </div> -->
               <!-- Awal Informasi Pra Estimasi -->
           </div>
          </div></div>
        </div>

    </fieldset>

    <h3>Bank Information</h3>
    <fieldset>
        <legend><br>Bank Information</legend>
          <!-- Awal Informasi Pra Estimasi -->
             <div class="form-group">
                <div class="col-md-5">
                     <label class="col-md-4 control-label" style="margin-top:10px;">Account Name*</label>
                     <div class="col-md-8">
                                 <input type="text" class="form-control" value="" required id="NamaRekening" name="NamaRekening" required placeholder="Account Name"/>
                     </div>
                </div>
                <div class="col-md-7">
                   <label class="col-md-5 control-label" style="margin-top:10px;">Account Number*</label>
                     <div class="col-md-5">
                                 <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="" required id="NomorRekening" name="NomorRekening" required placeholder="Account Number"/>
                     </div>
                </div>
            </div>
            <div class="form-group">
               <div class="col-md-5">
                   <label class="col-md-4 control-label" style="margin-top:10px;">Bank Transfer*</label>
                   <div class="col-md-8">
                      <select name="IDBank" class="form-control select" data-live-search="true"/>
                          @foreach ($DataBank as $Bank)
                                <option value="{{$Bank['ID']}}">{{$Bank['BankName']}} ({{$Bank['NomorRekening']}}) an ({{$Bank['NamaPemilikRekening']}})</option>
                          @endforeach
                      </select>
                   </div>
               </div>
           </div>
           <div class="form-group">
             <div class="col-md-5">
             </div>
                 <div class="col-md-7">
                     <label class="col-md-9 control-label">Total Product (IDR)</label>
                     <div class="col-md-3">
                         <input type="text" id="TotalBarang" name="TotalBarang" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                     </div>
                  </div>
           </div>
           <div class="form-group">
                 <div class="col-md-5">
                 </div>
                 <div class="col-md-7">
                     <label class="col-md-9 control-label">Total Weight (GR)</label>
                     <div class="col-md-3">
                         <input type="text" id="TotalBerat" name="TotalBerat" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                     </div>
                  </div>
           </div>
           <div class="form-group">
                 <div class="col-md-5">
                 </div>
                 <div class="col-md-7">
                     <label class="col-md-9 control-label">Total Weight (IDR)</label>
                     <div class="col-md-3" id="DivTotalHargaBerat" name="DivTotalHargaBerat">
                         <input type="text" id="TotalHargaBerat" name="TotalHargaBerat" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                     </div>
                  </div>
           </div>
           <div class="form-group">
                 <div class="col-md-5">
                   <a href="{{url('Dashboard')}}" id="ContinueShopping" class="btn btn-warning" name="ContinueShopping">Continue Shopping</a>
                 </div>
                 <div class="col-md-7">
                     <label class="col-md-9 control-label">Total Cost (IDR)</label>
                     <div class="col-md-3">
                         <input type="text" id="GrandTotal" name="GrandTotal" readonly class="form-control" value="" placeholder="0" style="background:white; color:black;"/>
                     </div>
                  </div>
           </div>
    </fieldset>
</form>
<div class="form-group" >
 <div class="form-group">
     <div class="col-md-12" style="background:white;">
        <button id="SubmitCart" class="btn btn-success SubmitCart pull-right" name="SubmitCart">Proceed To Checkout</button>
     </div>
 </div>
</div>
<!-- Awal Group Box Help dan Hint-->
<div class="col-md-12 scCol" style="background:white;"><br><br>
   <div class="panel panel-info" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Help dan Hint</h3>
      </div>

      <!-- Awal Status Info -->
      <div class="panel-body">
          <!-- Awal Isi Konten -->
          <form class="form-horizontal" id="FormHelpHint" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="panel-body">
                  <div class="col-md-8">
                     <div class="form-group">
                           <b>1. Every list only shows 10 items in 1 page.</b>
                     </div>
                     <div class="form-group">
                           <b>2. If you want to know the next page, you may click next button which is located on the bottom right of your table.</b>
                     </div>
                     <div class="form-group">
                           <b>3. [Search] Feature on the top right of your table used for looking Shopping Cart data fastly.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help dan Hint -->
@endsection

@section('Script')
<script type="text/javascript" src="{!! asset('js/jquery.steps.js') !!}"></script>
<script type="text/javascript">
$(function () {
   var form = $("#example-advanced-form").show();

   form.steps({
       headerTag: "h3",
       bodyTag: "fieldset",
       transitionEffect: "slideLeft",
       onStepChanging: function (event, currentIndex, newIndex)
       {
           // Allways allow previous action even if the current form is not valid!
           if (currentIndex > newIndex)
           {
               return true;
           }
           // Forbid next action on "Warning" step if the user is to young
           if (newIndex === 3 && Number($("#age-2").val()) < 18)
           {
               return false;
           }
           // Needed in some cases if the user went back (clean up)
           if (currentIndex < newIndex)
           {
               // To remove error styles
               form.find(".body:eq(" + newIndex + ") label.error").remove();
               form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
           }
           form.validate().settings.ignore = ":disabled,:hidden";
           return form.valid();
       },
       onStepChanged: function (event, currentIndex, priorIndex)
       {
           // Used to skip the "Warning" step if the user is old enough.
           if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
           {
               form.steps("next");
           }
           // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
           if (currentIndex === 2 && priorIndex === 3)
           {
               form.steps("previous");
           }
       },
       onFinishing: function (event, currentIndex)
       {
           form.validate().settings.ignore = ":disabled";
           return form.valid();
       },
       onFinished: function (event, currentIndex)
       {
           alert("Submitted!");
       }
   }).validate({
       errorPlacement: function errorPlacement(error, element) { element.before(error); },
       rules: {
           confirm: {
               equalTo: "#password-2"
           }
       }
   });
});

var Total = 0;
var TotalBerat = 0;
var TotalHargaBerat = 0;
var ArrQty = new Array();
var ArrPrice = new Array();
var ArrWeight = new Array();

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

function HitungTotal() {
   Total = 0;
   $('#TotalBarang').val(Total);
   ArrQty = document.getElementsByName("Quantity[]");
   ArrPrice = document.getElementsByName("Price[]");
   for (var i = 0; i < ArrQty.length; i++) {
      Total = Total + parseInt(ArrQty[i].value) * parseInt(ArrPrice[i].value);
   }
   $('#TotalBarang').val(Total);
}

function HitungTotalBerat() {
   TotalBerat = 0;
   $('#TotalBerat').val(TotalBerat);
   ArrQty = document.getElementsByName("Quantity[]");
   ArrWeight = document.getElementsByName("Weight[]");
   for (var i = 0; i < ArrQty.length; i++) {
      TotalBerat = TotalBerat + parseInt(ArrQty[i].value) * parseInt(ArrWeight[i].value);
   }
   $('#TotalBerat').val(TotalBerat);
   IDKotaTujuan = $('#DivKotaTujuan').val();
   DivHarga(IDKotaTujuan);
}

$('#SubmitCart').on('click', function () {
   NamaPenerima = $('#NamaPenerima').val();
   AlamatPenerima = $('#AlamatPenerima').val();
   TeleponPenerima = $('#TeleponPenerima').val();
   // HandphonePenerima = $('#HandphonePenerima').val();

   NamaRekening = $('#NamaRekening').val();
   NomorRekening = $('#NomorRekening').val();
   BankTransfer = $('#BankTransfer').val();
   BiayaKirim = $('#TotalHargaBerat').val();
   Kota = $('#Kota').val();
   Provinsi = $('#Provinsi').val();
   NamaDropshipper = $('#NamaDropshipper').val();
   TeleponDropshipper = $('#TeleponDropshipper').val();
   // HandphoneDropshipper = $('#HandphoneDropshipper').val();
   if(BiayaKirim != 0) {
      if(NamaPenerima != "" && AlamatPenerima != "" && TeleponPenerima != "" && Kota != "" && Provinsi != "" &&
      NamaRekening != "" && NomorRekening != "" && BankTransfer != "" && BiayaKirim != "") {
         if (IsDropshipper == 1) {
            if(NamaDropshipper != "" && TeleponDropshipper != "") {
               alertify.confirm("Are you sure with your purchase order ?",
               function(){
                   alertify.success('Your purchase order has been saved');
                   $('.FormCart').submit();
               },
               function(){
                   alertify.error('Your purchase order has been cancelled');
               });
            } else {
               alertify.alert("Please fill the required field !");
            }
         } else {
            alertify.confirm("Are you sure with your purchase order ?",
            function(){
                alertify.success('Your purchase order has been saved');
                $('.FormCart').submit();
            },
            function(){
                alertify.error('Your purchase order has been cancelled');
            });
         }
      } else {
         alertify.alert("Please fill the required field !");
      }
   } else {
      alertify.alert("No shipment cost listed, Please contact our admin !");
   }
});

$(document).ready(function() {
   var t = $('#DataTableShoppingCart').DataTable();
   HitungTotal();
   HitungTotalBerat();

   $('#DataTableShoppingCart tbody').on( 'click', 'tr', function () {
     if ( $(this).hasClass('selected') ) {
         $(this).removeClass('selected');
     } else {
        t.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        Index = t.row( this ).index();
     }
   } );

   $('#DeleteRow').click( function () {
     t.row('.selected').remove().draw( false );
     HitungTotal();
     HitungTotalBerat();
     //   DataShopingCart.splice(Index, 1);
     //   alert(DataShopingCart+'\n');
   });

   // $('input[name="Quantity[]"]').change(function() {
   //    alert("a");
   //    HitungTotal();
   //    HitungTotalBerat();
   // });

   $('.Quantity').change(function() {
      HitungTotal();
      HitungTotalBerat();
   });

   IsDropshipper = 0;
   $('#DataDropshipper').hide();
   $('#IsDropshipper').click(function() {
      if (this.checked) {
         IsDropshipper = 1;
         $('#IsDropship').val(IsDropshipper);
         $('#DataDropshipper').show();
      } else {
         IsDropshipper = 0;
         $('#IsDropship').val(IsDropshipper);
         $('#DataDropshipper').hide();
      }
   });

   DivProvinsiAsal();
   DivProvinsiTujuan();

   $('#DivProvinsiAsal').change( function () {
      IDProvinsiAsal = $('#DivProvinsiAsal').val();
      DivKotaAsal(IDProvinsiAsal);
   });

   $('#DivProvinsiTujuan').change( function () {
      IDProvinsiTujuan = $('#DivProvinsiTujuan').val();
      DivKotaTujuan(IDProvinsiTujuan);
      PrintProvinsiTujuan(IDProvinsiTujuan);
   });

   // $('#DivKotaAsal').change( function () {
   //    IDKotaAsal = $('#DivKotaAsal').val();
   //    alert (IDKotaAsal);
   // });

   $('#DivKotaTujuan').change( function () {
      IDKotaTujuan = $('#DivKotaTujuan').val();
      DivHarga(IDKotaTujuan);
      PrintKotaTujuan(IDKotaTujuan);
   });

});

$(document).on('change', '#BiayaKirim', function() {
   TotalHargaBerat = $("#BiayaKirim").val();
   $("#TotalHargaBerat").val(TotalHargaBerat);

   GrandTotal = parseInt(TotalHargaBerat) + parseInt(Total);
   if (parseInt(GrandTotal) >= 0) {
      $("#GrandTotal").val(GrandTotal);
   } else {
      $("#GrandTotal").val(0);
   }
});

function DivProvinsiAsal()
{
    $.ajax({
    url: "FromProvince",
    context: document.body,
    success: function(responseText) {
        $('#DivProvinsiAsal').empty();
        $("#DivProvinsiAsal").html(responseText);

        IDProvinsiAsal = $('#DivProvinsiAsal').val();
        DivKotaAsal(IDProvinsiAsal);
    }
    });
}

function DivProvinsiTujuan()
{
    $.ajax({
    url: "ToProvince",
    context: document.body,
    success: function(responseText) {
        $('#DivProvinsiTujuan').empty();
        $("#DivProvinsiTujuan").html(responseText);

        IDProvinsiTujuan = $('#DivProvinsiTujuan').val();
        DivKotaTujuan(IDProvinsiTujuan);

        PrintProvinsiTujuan(IDProvinsiTujuan);
    }
    });
}

function PrintProvinsiTujuan(IDProvinsi)
{
    $.ajax({
    url: "GetToProvince"+'/'+IDProvinsi,
    context: document.body,
    success: function(responseText) {
        $("#Provinsi").val(responseText);
    }
    });
}

function PrintKotaTujuan(IDKota)
{
    $.ajax({
    url: "GetToCity"+'/'+IDKota,
    context: document.body,
    success: function(responseText) {
        $("#Kota").val(responseText);
    }
    });
}

function DivKotaAsal(IDProvinsi)
{
    $.ajax({
    url: "FromCity"+'/'+IDProvinsi,
    context: document.body,
    success: function(responseText) {
        $('#DivKotaAsal').empty();
        $("#DivKotaAsal").html(responseText);
    }
    });
}

function DivKotaTujuan(IDProvinsi)
{
    $.ajax({
    url: "ToCity"+'/'+IDProvinsi,
    context: document.body,
    success: function(responseText) {
        $('#DivKotaTujuan').empty();
        $("#DivKotaTujuan").html(responseText);

        IDKotaTujuan = $('#DivKotaTujuan').val();
        DivHarga(IDKotaTujuan);
        PrintKotaTujuan(IDKotaTujuan);
    }
    });
}

function DivHarga(IDKota)
{
    $.ajax({
    url: "Cost"+'/'+IDKota+'/'+TotalBerat,
    context: document.body,
    success: function(responseText) {
        $('#DivHarga').empty();
        $("#DivHarga").html(responseText);

        TotalHargaBerat = $("#BiayaKirim").val();
        $("#TotalHargaBerat").val(TotalHargaBerat);

        GrandTotal = parseInt(TotalHargaBerat) + parseInt(Total);
        if (parseInt(GrandTotal) >= 0) {
           $("#GrandTotal").val(GrandTotal);
        } else {
           $("#GrandTotal").val(0);
        }
    }
    });
}
</script>
@endsection
