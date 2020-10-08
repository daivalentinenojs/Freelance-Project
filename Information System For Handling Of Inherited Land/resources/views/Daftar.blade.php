@extends('Master')

@section('Judul','Daftar Pemohon')

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
         <h3 class="panel-title">Daftar Sebagai Pemohon</h3>
      </div>

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
          <p>Halaman ini merupakan halaman untuk mendaftarkan diri sebagai pemohon.</p><br>

          <form class="form-horizontal" id="FormTambahPemohon" name="FormTambahPemohon" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="_token" value="{!! csrf_token() !!}">
             <div class="modal-body">
                    <div class="panel-body">
                          <div class="col-md-6">
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Nama Pengguna</label>
                                  <div class="col-md-4">
                                       <input type="text" name="Username" required class="form-control" value="" placeholder="Nama Pengguna" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Email</label>
                                  <div class="col-md-5">
                                       <input type="email" name="Email" required class="form-control" value="" placeholder="Email" style="background:white; color:black;"/>
                                  </div>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-5 control-label">Kata Sandi</label>
                                  <div class="col-md-4">
                                       <input type="password" name="Password" required class="form-control" value="" placeholder="Kata Sandi" style="background:white; color:black;"/>
                                  </div>
                            </div>
                              <div class="form-group">
                                   <label class="col-md-5 control-label">Foto Pemohon</label>
                                   <div class="col-md-5">
                                         <input type="file" required id="FotoPemohon" name="FotoPemohon"/>
                                   </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Desa</label>
                                    <div class="col-md-4">
                                         <select name="IDDesa" required class="form-control select" data-live-search="true"/>
                                            @foreach ($DataDesa as $Desa)
                                                  <option value="{{$Desa['ID']}}">{{$Desa['NamaDesa']}}</option>
                                            @endforeach
                                         </select>
                                    </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                  <label class="col-md-5 control-label">NIK</label>
                                  <div class="col-md-4">
                                       <input type="text" name="NIK" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="NIK Pemohon" style="background:white; color:black;"/>
                                  </div>
                            </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Nama Pemohon</label>
                                    <div class="col-md-5">
                                         <input type="text" name="Nama" required class="form-control" value="" placeholder="Nama Pemohon" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Telepon</label>
                                    <div class="col-md-4">
                                         <input type="text" name="Telepon" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Telepon" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Alamat</label>
                                    <div class="col-md-5">
                                         <input type="text" name="Alamat" required class="form-control" value="" placeholder="Alamat" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Pekerjaan</label>
                                    <div class="col-md-5">
                                         <input type="text" name="Pekerjaan" required class="form-control" value="" placeholder="Pekerjaan" style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-5 control-label">Umur</label>
                                    <div class="col-md-4">
                                         <input type="text" name="Umur" onkeypress="return isNumberKey(event)" required class="form-control" value="" placeholder="Umur" style="background:white; color:black;"/>
                                    </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group" style="text-align:center;">
                                   <input type="submit" id="BtnCreatePemohon" name="BtnCreatePemohon" value="Simpan" class="btn btn-success">
                            </div>
                          </div>
                     </div>
               </div>
             </form>
      </div>
   </div>
</div>

<!-- Awal Group Box Help and Hint-->
<div class="col-md-12 scCol" style="background:white;">
   <div class="panel panel-info" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Bantuan Informasi</h3>
      </div>

      <!-- Awal Status Info -->
      <div class="panel-body">
          <!-- Awal Isi Konten -->
          <form class="form-horizontal" id="FormHelpHint" method="POST">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="panel-body">
                  <div class="col-md-8">
                     <div class="form-group">
                           <b>1. Halaman ini digunakan untuk mendaftarkan diri sebagai Pemohon.</b>
                     </div>
                  </div>
               </div>
           </form>
      </div>
      <!-- Akhir Isi Konten -->
   </div>
</div>
<!-- Akhir Group Box Help and Hint -->
@endsection

@section('Script')
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}
</script>
@endsection
