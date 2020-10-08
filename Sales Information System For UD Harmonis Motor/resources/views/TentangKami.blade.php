<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')
@section('Judul2','Tentang Kami')

@section('Title','Sistem Informasi Harmonis Motor')
@section('Nama','Sistem Informasi Harmonis Motor')

@section('FotoLogin',url('foto/karyawan/'.$ID.'.jpg'))

@section('ID')
  
@endsection

@section('NamaLogin')
   {{$Nama}}
@endsection

@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('isi')
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
            <div class="panel-heading">
               <h3 class="panel-title">Tentang Kami</h3>
            </div>

            <!-- Awal Informasi Dashboard -->
            <div class="panel-body">
                  <p style="margin-top:0px; font-size:15px; text-indent:20px; text-align:justify">Harmonis Motor berdiri pada tahun 1980 di kota Surabaya. Sejak tahun 1980 - 2017 sudah menempati lokasi sekarang di Jalan Peneleh 106A, Surabaya. Sejak berdiri, Harmonis Motor berkomitmen hanya menjual suku cadang Toyota yang sudah teruji kualitasnya. Ketangguhan suku cadang yang dijual ini membuat Harmonis Motor mampu berdiri sampai hari ini.</p>

                  @foreach ($errors->all() as $error)
                  <p class="alert alert-danger">{{ $error }}</p>
                  @endforeach
                  @if (session('status'))
                     <div class="alert alert-success">
                        {{ session('status') }}
                     </div>
                  @endif
            </div>
         </div>
</div>
<!-- Akhir Informasi Dashboard -->

<script type="text/javascript">

</script>
@endsection
