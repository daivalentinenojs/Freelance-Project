@extends('Master')

@section('Judul','Beranda')

@section('Foto',url('foto/Logo/logo.png'))

@section('ID')
Badan Pertanahan Nasional
@endsection

@section('Nama')
Jl. Jaksa Agung R Suprapto No.7, Sidokumpul, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61212
@endsection

@section('Navigasi')
   @include('Navigasi/Nav')
@endsection

@section('Isi')
<div class="col-md-12 scCol" style="background:white;">
       <div class="panel panel-success" id="grid_block_5">
            <div class="panel-heading">
               <h3 class="panel-title">Tentang Kami</h3>
            </div>

            <div class="panel-body">
                  <p style="margin-top:0px; font-size:15px; text-indent:20px; text-align:justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                  into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                  publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                  <p style="margin-top:0px; font-size:15px; text-indent:20px; text-align:justify">It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                  its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
                  Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various
                  versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>

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
@endsection

@section('Script')
<script type="text/javascript">

</script>
@endsection
