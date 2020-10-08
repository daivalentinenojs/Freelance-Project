@extends('master')
@section('judul','Pendaftaran Anggota')
@section('judul1','Pendaftaran')
@section('judul2','Anggota')
@section('title','Pendaftaran Anggota')
@section('nama','Pendaftaran Anggota')

@section('navigasi')

@endsection

@section('isi')

<form class="form-horizontal" enctype="multipart/form-data"  method="POST" action="{{url('auth/register')}}">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Pendaftaran Anggota</strong></h3>
        <ul class="panel-controls">
            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
        </ul>
    </div>
    <div class="panel-body">
        <p>Pada bagian ini Anda dapat mendaftarkan diri sebagai anggota dari website CV Kirmizhi Foam. Setelah menjadi anggota, Anda dapat melakukan transaksi pada website kami. Bagian yang ditandai dengan * wajib diisi.</p>

        @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="panel-body">                                                                        
        
        <div class="row">
            
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
            
                <div class="form-group">
                    <label class="col-md-3 control-label">Email*</label>
                    <div class="col-md-9">                                            
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                            <input type="email" size="25" class="form-control" required name="email" placeholder="Masukkan Email Anda ..."/>
                        </div>                                            
                        <span class="help-block">Contoh : bigbo_daipo@yahoo.com</span>
                    </div>
                </div>
                
                <div class="form-group">                                        
                    <label class="col-md-3 control-label">Password*</label>
                    <div class="col-md-9 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                            <input type="text" size="20" name="password" required class="form-control" placeholder="darkangel"/>
                        </div>            
                         <span class="help-block">Contoh : darkangel</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="panel-footer">

        <input type="submit" value="Daftar" class="btn btn-primary pull-right">

        <input type="reset" value="Hapus" style="margin-right:10px;" class="btn btn-default pull-right">
    </div>
</div>
</form>
@endsection
    