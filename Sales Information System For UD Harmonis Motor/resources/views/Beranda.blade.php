<!-- Checked -->

@extends('Master')

@section('Judul1','Beranda')

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
               <h3 class="panel-title">Beranda</h3>
            </div>

            <!-- Awal Informasi Dashboard -->
            <div class="panel-body">
                  <p style="margin-top:0px; font-size:15px; text-indent:20px; text-align:justify">Cari suku cadang Toyota yang murah dan berkualitas? Harmonis Motor solusinya!
                  Kami menyediakan berbagai suku cadang untuk mobil Toyota dengan kualitas dan harga istimewa! Ga percaya? Datang dan buktikan sendiri!</p>

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
