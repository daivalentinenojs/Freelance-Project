@extends('Master')

@section('Judul','Master Data | Informasi KepalaDesa')

@if($Role == 'Kepala Desa')
  @section('Foto',url('foto/KepalaDesa/'.$ID.'.jpg'))
@elseif($Role == 'Karyawan')
  @section('Foto',url('foto/Karyawan/'.$ID.'.jpg'))
@else
  @section('Foto',url('foto/Pemohon/'.$ID.'.jpg'))
@endif

@section('ID')
  {{$Nama}}
@endsection

@section('Nama')
  {{$Role}}
@endsection

@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')

<div class="col-md-12 scCol" style="background:white;">
    <div class="panel panel-success" id="grid_block_5">
      <div class="panel-heading">
         <h3 class="panel-title">Informasi Kepala Desa</h3>
      </div>

      <!-- Awal Informasi Pra Estimasi -->
      <div class="panel-body">
          <p>Halaman ini digunakan untuk mengubah profil Kepala Desa.</p><br>
          @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
          @endforeach
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
          <div class="modal-dialog">
                  <form class="form-horizontal" id="FormTambahKepalaDesa" name="FormTambahKepalaDesa" method="POST" enctype="multipart/form-data" action="ProfilKepalaDesa">
                     <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                     <div class="modal-body">
                            <div class="panel-body">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                          <div class="col-md-12" style="text-align:center">
                                               <img src="{{url('foto/KepalaDesa/'.$DataKepalaDesa[0]['ID'].'.jpg')}}" alt="" style="border-radius:10px;"><br><br>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="col-md-5 control-label">Nama Pengguna</label>
                                          <div class="col-md-4">
                                               <input type="hidden" name="IDUser" value="{{$DataKepalaDesa[0]['IDUser']}}">
                                               <input type="hidden" name="IDKepalaDesa" value="{{$DataKepalaDesa[0]['ID']}}">
                                               <input type="text" name="Username" readonly required class="form-control" value="{{$DataKepalaDesa[0]['Username']}}" placeholder="Nama Pengguna" style="background:white; color:black;"/>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="col-md-5 control-label">Email</label>
                                          <div class="col-md-5">
                                               <input type="email" name="Email" readonly required class="form-control" value="{{$DataKepalaDesa[0]['Email']}}" placeholder="Email" style="background:white; color:black;"/>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label class="col-md-5 control-label">Kata Sandi</label>
                                          <div class="col-md-4">
                                               <input type="password" name="Password" required class="form-control" value="{{$DataKepalaDesa[0]['Password']}}" placeholder="Kata Sandi" style="background:white; color:black;"/>
                                          </div>
                                    </div>
                                    <br><br>
                                      <div class="form-group">
                                            <label class="col-md-5 control-label">Nama Kepala Desa</label>
                                            <div class="col-md-5">
                                                 <input type="text" name="Nama" required class="form-control" value="{{$DataKepalaDesa[0]['Nama']}}" placeholder="Nama KepalaDesa" style="background:white; color:black;"/>
                                            </div>
                                      </div>
                                      <div class="form-group">
                                              <label class="col-md-5 control-label">Desa</label>
                                              <div class="col-md-4">
                                                     <select name="IDDesa" required class="form-control select" data-live-search="true">
                                                     <?php foreach ($DataDesa as $Desa): ?>
                                                            <?php if ($Desa['ID'] == $DataKepalaDesa[0]['IDDesa']) {
                                                                   echo '<option value="'.$Desa['ID'].'" selected>'.$Desa['NamaDesa'].'</option>';
                                                            } else {
                                                                   echo '<option value="'.$Desa['ID'].'">'.$Desa['NamaDesa'].'</option>';
                                                            }?>
                                                     <?php endforeach; ?>
                                                     </select>
                                              </div>
                                       </div>
                                      <div class="form-group">
                                           <label class="col-md-5 control-label">Foto KepalaDesa</label>
                                           <div class="col-md-5">
                                                 <input type="file" id="FotoKepalaDesa" name="FotoKepalaDesa"/>
                                           </div>
                                      </div>
                                      <div class="form-group" style="text-align:center;">
                                             <input type="submit" id="BtnCreateKepalaDesa" name="BtnCreateKepalaDesa" value="Simpan" class="btn btn-success">
                                      </div>
                                  </div>
                             </div>
                       </div>
                     </form>
          </div>

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
                           <b>1. Halaman ini digunakan untuk mengubah profil Kepala Desa.</b>
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
