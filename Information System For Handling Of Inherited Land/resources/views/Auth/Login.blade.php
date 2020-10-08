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
         <div class="col-md-4">
         </div>
         <div class="col-md-4">
             <br><br>
             <div style="text-align:center;">
                 <img width="150px" height="150px" src="{{asset('foto/Logo/Logo.png')}}"/>
             </div><br>
             <div style="text-align:center;">
                  <div class="login-title" style="font-size:20px; color:black;" ><strong>Sistem Informasi <br> Kepengurusan Pendaftaran Tanah</strong></div>
             </div>

            <div class="panel-body">
              @foreach ($errors->all() as $error)
                  <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif
              <div class="login-title">Selamat datang, Silahkan <i>log in</i> ...</div>
              <!-- Awal Form Login -->
              <form action="{{url('Login')}}" class="form-horizontal" method="POST">
              {!! csrf_field() !!}

              <div class="form-group">
                  <div class="col-md-12" id="ClassCheckErrorEmail">
                      <input type="text" name="Email" value="" class="form-control" placeholder="Email">
                      <!-- <input type="text" required name="email" data-toggle="tooltip" data-placement="top" title="Inputkan email Anda" class="form-control" value="{{ old('email') }}" placeholder="Nama Pengguna"/> -->
                  </div>
              </div>
              <div id="ClassCheckErrorPassword" class="form-group">
                  <div class="col-md-12">
                      <input type="password" name="Password" value="" class="form-control" placeholder="Kata Sandi" >
                      <!-- <input type="password" required name="passwords" class="form-control" placeholder="Kata Sandi" data-toggle="tooltip" data-placement="top" title="Inputkan password Anda"/> -->
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-12" style="text-align:center;">
                      <input type="submit" value="Masuk" data-toggle="tooltip" data-placement="bottom" title data-original-title="Klik untuk Akses Sistem" class="btn btn-primary">
                  </div>
              </div>
              </form>
            </div>
            <div class="login-footer">
                <div style="text-align:center;">
                    &copy; 2018 Universitas Surabaya
                </div>
            </div>

            <div class="login-footer">
                <div style="text-align:center;">
                    <strong style="font-size:14px;">Keterangan :</strong><br>
                    Pemohon perlu melakukan proses Login terlebih dahulu<br>
                    untuk mengakses Sistem Informasi Kepengurusan Pendaftaran Tanah
                </div><br>
            </div>

            <div class="login-footer">
                <div style="text-align:center;">
                    <strong style="font-size:14px;">Daftar :</strong><br>
                    Jika pemohon belum mempunyai username,<br>
                    silahkan mendaftarkan terlebih dahulu pada tautan <a href="{{ url('/Daftar')}}">ini</a>.
                </div><br>
            </div>
         </div>
       </div>
</div>
@endsection

@section('Script')
<script type="text/javascript">

</script>
@endsection
