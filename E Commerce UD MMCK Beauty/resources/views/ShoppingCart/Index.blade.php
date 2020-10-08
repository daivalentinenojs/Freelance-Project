@extends('Master')
@section('Judul','Shopping Cart | Checkout')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<form role="form" action="ShoppingCart" class="form-horizontal FormCart" id="wizard-validation" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">

      <div class="col-md-12 scCol" style="background:white;">
          <div class="panel panel-success" id="grid_block_5">

            <!-- Awal Informasi Pra Estimasi -->
            <div class="panel-body">
               @foreach ($errors->all() as $error)
               <p class="alert alert-danger">{{ $error }}</p>
               @endforeach
               @if (session('status'))
                   <div class="alert alert-success">
                       {{ session('status') }}
                   </div>
               @endif
                <div class="col-md-12 scCol" style="background:white;">
                    <div class="panel panel-success" id="grid_block_5">
                      <div class="panel-heading">
                         <h3 class="panel-title" style="text-align:center">Check Out Information</h3>
                      </div>

                      <!-- Awal Informasi Pra Estimasi -->
                      <div class="panel-body">
                         <div class="form-group">
                            <div class="col-md-12" style="font-family:Times">
                                 <p style="text-align:center; font-size:25px;">Thank you for shopping at {{$Content[0]['Nama']}}</p><br>
                                 <p style="text-align:center; font-size:18px;">The total amount that you must transfer is IDR {{number_format($DataNotaJual[0]['TotalAkhir'], 0, '.', ',')}}</p><br><br>
                                 <p style="text-align:center; font-size:18px;">Please transfer to our bank account which provided below :</p>
                                 <p style="text-align:center; font-size:18px;">
                                    @foreach($DataBank as $Bank)
                                    <b>{{$Bank['BankName']}}</b> ({{$Bank['NomorRekening']}}) an {{$Bank['NamaPemilikRekening']}} <br>
                                    @endforeach
                                 </p><br>
                                 <p style="text-align:center; font-size:15px;">Your package will be shipped on that day if you have paid and confirm the payment before 5 pm (Monday - Friday) or before 2 pm (Saturday)</p>
                                 <p style="text-align:center; font-size:15px;">We will update the Tracking Number within 1 x 24 hour after the package has been shipped.</p><br>
                                 <p style="text-align:center; font-size:15px;">
                                    <a href="{{url('Dashboard')}}" id="ContinueShopping" class="btn btn-warning" name="ContinueShopping">Continue Shopping</a>
                                 </p>
                            </div>
                        </div>
                      </div>
                   </div>
                </div>
                <!-- END DEFAULT DATATABLE -->
                <!-- Akhir Isi Konten -->
            </div>
         </div>
      </div>
</form>
@endsection

@section('Script')
<script type="text/javascript">
</script>
@endsection
