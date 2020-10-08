<!-- Checked -->

@extends('Master')

@section('Judul','Sistem Informasi Forecasting')
@section('Judul1','Sistem Informasi Forecasting')
@section('Judul2','Beranda')

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
   @include('Navigasi/Navigasi')
@endsection

@section('isi')
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
            <div class="panel-heading">
               <h3 class="panel-title">Beranda</h3>
            </div>

            <!-- Awal Informasi Dashboard -->
            <div class="panel-body">
                  <p style="margin-top:0px; font-size:15px; text-indent:20px; text-align:justify">PT Violatama Inti Sejati Surabaya adalah distributor resmi yang bergerak di bidang penjualan sepatu,
                    yang mempunyai komitmen untuk mengembangkan potensi usaha sepenuhnya.
                    PT Violatama Inti Sejati Surabaya menyalurkan berbagai tipe sepatu seperti Speed, Logo, dan juga World Star yang dikirim ke beberapa daerah di Indonesia seperti Jawa Timur, Bali dan Lombok.</p>

                  <p style="margin-top:0px; font-size:15px; text-indent:20px; text-align:justify">Berita dan foto seputar kegiatan PT Violatama Inti Sejati Surabaya akan ditampilkan pada halaman ini.</p>

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
