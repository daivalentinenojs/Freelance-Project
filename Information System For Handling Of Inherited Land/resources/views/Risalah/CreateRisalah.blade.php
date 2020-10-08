@extends('Master')

@section('Judul','Master Data | Informasi Desa')

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
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
{{csrf_field()}}
    <div class="col-md-12 scCol" style="background:white;">
      @foreach ($errors->all() as $error)
      <p class="alert alert-danger">{{ $error }}</p>
      @endforeach
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
    </div>
    <div class="col-md-12 scCol" style="background:white;">
      <div class="panel panel-success" id="grid_block_5">
        <div class="panel-heading">
          <h3 class="panel-title">Pilih Formulir Permohonan</h3>
        </div>
        <div class="panel-body">
          <div class="col-md-12">
            <div class="form-group">
              <label for="focusedinput" class="col-sm-2 control-label">Nomor Berkas</label>
              <div class="col-sm-9">
                <select class="form-control select" name="IDFormulirPermohonan" required id="IDFormulirPermohonan" data-live-search="true">
                @foreach($DataRisalah as $FP)
                  <option value="{{$FP['ID']}}">{{$FP['NamaPemohon']}} | Nomor : {{$FP['NomorBukuHurufC']}} | Jenis : {{$FP['JenisTanahLetterC']}} | Luas : {{$FP['LuasDaerahLetterC']}} m2</option>
                @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiFP">

    </div>

    <br>
    <div class="col-md-12 scCol" style="background:white;" id="InformasiPersyaratan">

    </div>

    <div class="col-md-12 scCol" style="background:white;" id="InformasiRisalah">
        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Risalah</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <!-- <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Risalah</label>
                <div class="col-sm-3">
                  <input type="date" name="TanggalRisalah" value="" class="form-control" required id="TanggalRisalah">
                </div>
              </div> -->
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Sengketa</label>
                <div class="col-sm-7">
                  <input type="text" name="Sengketa" value="" class="form-control" id="Sengketa">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Status Sengketa</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="StatusSengketa" required id="StatusSengketa" data-live-search="true">
                    <option value="1">Sedang Dalam Sengketa</option>
                    <option value="2">Tidak Ada Sengketa</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Proses</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="Proses" required id="Proses" data-live-search="true">
                    <option value="1">Diproses</option>
                    <option value="2">Pemberian Hak</option>
                  </select>
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Penegasan Konversi</label>
                <div class="col-sm-5">
                  <input type="text" name="PenegasanKonversi" value="" class="form-control" required id="PenegasanKonversi">
                </div>
              </div> -->
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Catatan Keberatan</label>
                <div class="col-sm-7">
                  <input type="text" name="CatatanKeberatan" value="" class="form-control" id="CatatanKeberatan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Keterangan Sengketa</label>
                <div class="col-sm-7">
                  <input type="text" name="KeteranganSengketa" value="" class="form-control" id="KeteranganSengketa">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Beban Atas Tanah</label>
                <div class="col-sm-5">
                  <input type="text" name="BebanAtasTanah" value="" class="form-control" required id="BebanAtasTanah">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Status Alat Bukti</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="StatusAlatBukti" required id="StatusAlatBukti" data-live-search="true">
                    <option value="1">Lengkap</option>
                    <option value="2">Tidak Lengkap</option>
                    <option value="3">Tidak Ada</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Status Pembebanan</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="StatusPembebanan" required id="StatusPembebanan" data-live-search="true">
                    <option value="1">Sedang Digunakan</option>
                    <option value="2">Tidak Digunakan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Bangunan Kepentingan</label>
                <div class="col-sm-7">
                  <input type="text" name="BangunanKepentingan" value="" class="form-control" id="BangunanKepentingan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Status Tanah</label>
                <div class="col-sm-5">
                  <select class="form-control select" name="StatusTanah" required id="StatusTanah" data-live-search="true">
                    <option value="1">Tanah Dengan Hak Adat Perorangan</option>
                    <option value="2">Tanah Bagi Kepentingan Umum</option>
                    <option value="3">Lain - Lain</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Status Bagunan Atas Tanah</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="StatusBagunanAtasTanah" required id="StatusBagunanAtasTanah" data-live-search="true">
                    <option value="1">Rumah Hunian</option>
                    <option value="2">Toko</option>
                    <option value="3">Gudang</option>
                    <option value="4">Pagar</option>
                    <option value="5">Kantor</option>
                    <option value="6">Rumah Ibadah</option>
                    <option value="7">Bengkel</option>
                    <option value="8">Tidak Ada Bangunan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Keterangan Bangunan Atas Tanah</label>
                <div class="col-sm-7">
                  <input type="text" name="KeteranganBangunanAtasTanah" value="" class="form-control" id="KeteranganBangunanAtasTanah">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nama Kepala Desa</label>
                <div class="col-sm-5" id="DivIDKepalaDesa">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">File Sengketa</label>
                <div class="col-sm-3">
                  <input type="file" name="FotoSengketa" value="" class="form-control" id="FotoSengketa">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Sketsa Bidang</label>
                <div class="col-sm-3">
                  <input type="file" name="SketsaBidang" value="" class="form-control" required id="SketsaBidang">
                </div>
              </div>


              <!-- <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">ID Kenyataan</label>
                <div class="col-sm-5">
                  <input type="text" name="IDKenyataan" value="" class="form-control" required id="IDKenyataan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Bukti Pemilikan</label>
                <div class="col-sm-5">
                  <input type="text" name="NomorBuktiPemilikan" value="" class="form-control" required id="NomorBuktiPemilikan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">ID Kesimpulan Status Tanah</label>
                <div class="col-sm-5">
                  <input type="text" name="IDKesimpulanStatusTanah" value="" class="form-control" required id="IDKesimpulanStatusTanah">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Bukti Sanggahan</label>
                <div class="col-sm-3">
                  <input type="text" name="NomorBuktiSanggahan" value="" class="form-control" required id="NomorBuktiSanggahan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nomor Bukti Perpajakan</label>
                <div class="col-sm-3">
                  <input type="text" name="NomorBuktiPerpajakan" value="" class="form-control" required id="NomorBuktiPerpajakan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">ID Status Tanah</label>
                <div class="col-sm-3">
                  <input type="text" name="IDStatusTanah" value="" class="form-control" required id="IDStatusTanah">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">ID Formulir Permohonan</label>
                <div class="col-sm-5">
                  <input type="text" name="IDFormulirPermohonan" value="" class="form-control" required id="IDFormulirPermohonan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">ID Sanggahan</label>
                <div class="col-sm-5">
                  <input type="text" name="IDSanggahan" value="" class="form-control" required id="IDSanggahan">
                </div>
              </div> -->
            </div>
          </div>
        </div>

        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Bukti Perpajakan</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tanggal Bukti Perpajakan</label>
                <div class="col-sm-3">
                  <input type="date" name="TanggalBuktiPerpajakan" value="" class="form-control" required id="TanggalBuktiPerpajakan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Status Verponding</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="StatusVerponding" id="StatusVerponding" data-live-search="true">
                    <option value="1">NULL</option>
                    <option value="2">Verponding</option>
                    <option value="3">Verponding Indonesia</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">IPEDA / PBB / SPPT</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="StatusIPEDA" id="StatusIPEDA" data-live-search="true">
                    <option value="1">NULL</option>
                    <option value="2">IPEDA</option>
                    <option value="3">PBB</option>
                    <option value="4">SPPT</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Bukti Perpajakan Lain - Lain</label>
                <div class="col-sm-7">
                  <input type="text" name="LainLain" value="" class="form-control" id="LainLain">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Uraian Patok D</label>
                <div class="col-sm-7">
                  <input type="text" name="UraianPatokD" value="" class="form-control" id="UraianPatokD">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Uraian Verponding</label>
                <div class="col-sm-7">
                  <input type="text" name="UraianVerponding" value="" class="form-control" id="UraianVerponding">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Uraian IPEDA</label>
                <div class="col-sm-7">
                  <input type="text" name="UraianIPEDA" value="" class="form-control" id="UraianIPEDA">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Uraian Lain</label>
                <div class="col-sm-7">
                  <input type="text" name="UraianLain" value="" class="form-control" id="UraianLain">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Tahun Bukti Perpajakan</label>
                <div class="col-sm-3">
                  <input type="text" name="TahunBuktiPerpajakan" value="" class="form-control" required id="TahunBuktiPerpajakan">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Kenyataan</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Keterangan Tahun</label>
                <div class="col-sm-3">
                  <input type="text" name="KeteranganTahun" value="" class="form-control" required id="KeteranganTahun">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Keterangan Cara</label>
                <div class="col-sm-5">
                  <input type="text" name="KeteranganCara" value="" class="form-control" required id="KeteranganCara">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Keterangan Alih</label>
                <div class="col-sm-5">
                  <input type="text" name="KeteranganAlih" value="" class="form-control" required id="KeteranganAlih">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Jenis Kenyataan</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="JenisKenyataan" required id="JenisKenyataan" data-live-search="true">
                    <option value="1">Sawah</option>
                    <option value="2">Perumahan</option>
                    <option value="3">Ladang</option>
                    <option value="4">Industri</option>
                    <option value="5">Kebun</option>
                    <option value="6">Perkebunan</option>
                    <option value="7">Kolam Ikan</option>
                    <option value="8">Lapangan Umum</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Status Tanah</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nama Status Tanah</label>
                <div class="col-sm-5">
                  <select class="form-control select" name="NamaStatusTanah" required id="NamaStatusTanah" data-live-search="true">
                    <option value="1">Tanah Dengan Hak Perorangan</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Uraian Status Tanah</label>
                <div class="col-sm-7">
                  <select class="form-control select" name="UraianStatusTanah" required id="UraianStatusTanah" data-live-search="true">
                    <option value="1">Hak Milik Adat</option>
                    <option value="2">Hak Sanggahan</option>
                    <option value="3">Hak Anggaduh</option>
                    <option value="4">Hak Norowito</option>
                    <option value="5">Hak Gogol</option>
                    <option value="6">Hak Yasan</option>
                    <option value="7">Hak Pekulen</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Kesimpulan Status Tanah</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6" id="DivKesimpulanStatusTanah">
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Uraian</label>
                <div class="col-sm-7">
                  <input type="text" name="Uraian" value="" class="form-control" required id="Uraian">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Usulan</label>
                <div class="col-sm-2">
                  <select class="form-control select" name="Usulan" required id="Usulan" data-live-search="true">
                    <option value="1">Dapat</option>
                    <option value="2">Tidak Dapat</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-success" id="grid_block_5">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi Sanggahan</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Alasan Penyanggah</label>
                <div class="col-sm-7">
                  <select class="form-control select" name="AlasanPenyanggah" id="AlasanPenyanggah" data-live-search="true">
                    <option value="1">Terdapat Sengketa Mengenai Batas</option>
                    <option value="2">Terdapat Sanggahan Mengenai Batas</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Sengketa Dengan</label>
                <div class="col-sm-5">
                  <input type="text" name="SengketaDengan" value="" class="form-control" id="SengketaDengan">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Ada Sanggahan</label>
                <div class="col-sm-3">
                  <select class="form-control select" name="AdaSanggahan" id="AdaSanggahan" data-live-search="true">
                    <option value="1">Ada</option>
                    <option value="2">Tidak Ada</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Penyelesaian</label>
                <div class="col-sm-7">
                  <input type="text" name="Penyelesaian" value="" class="form-control" id="Penyelesaian">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Nama Penyanggah</label>
                <div class="col-sm-5">
                  <input type="text" name="NamaPenyanggah" value="" class="form-control" id="NamaPenyanggah">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">Alamat Penyanggah</label>
                <div class="col-sm-7">
                  <input type="text" name="AlamatPenyanggah" value="" class="form-control" id="AlamatPenyanggah">
                </div>
              </div>
              <div class="form-group">
                <label for="focusedinput" class="col-sm-4 control-label">File Sanggahan</label>
                <div class="col-sm-3">
                  <input type="file" name="FileSanggahan" value="" class="form-control" id="FileSanggahan">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="">
        	<div class="col-md-5">
        	</div>
        	<div class="col-md-4">
        		<input type="submit" value="Simpan Risalah Berkas Permohonan" class="btn btn-success"><br><br>
        	</div>
        </div>
    </div>
</form>
@endsection

@section('Script')
<script type="text/javascript">
var IDFormulirPermohonan;

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46)
        return true;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

$(document).ready(function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivIDKepalaDesa(IDFormulirPermohonan);
    DivKesimpulanStatusTanah(IDFormulirPermohonan);
});

$(document).on('change', '#IDFormulirPermohonan', function()
{
    IDFormulirPermohonan = $('#IDFormulirPermohonan').val();
    DivInformasiFP(IDFormulirPermohonan);
    DivInformasiFPPersyaratan(IDFormulirPermohonan);
    DivIDKepalaDesa(IDFormulirPermohonan);
    DivKesimpulanStatusTanah(IDFormulirPermohonan);
});

function DivInformasiFP(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/JadwalUkurBP.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiFP').empty();
        $("#InformasiFP").html(responseText);
    }
    });
}

function DivInformasiFPPersyaratan(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/JadwalUkurBPPersyaratan.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#InformasiPersyaratan').empty();
        $("#InformasiPersyaratan").html(responseText);
    }
    });
}

function DivIDKepalaDesa(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/RisalahIDKepalaDesa.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivIDKepalaDesa').empty();
        $("#DivIDKepalaDesa").html(responseText);
    }
    });
}

function DivKesimpulanStatusTanah(IDFormulirPermohonan)
{
    $.ajax({
    url: "ajax/RisalahDivKesimpulanStatusTanah.php?IDFP="+IDFormulirPermohonan,
    context: document.body,
    success: function(responseText) {
        $('#DivKesimpulanStatusTanah').empty();
        $("#DivKesimpulanStatusTanah").html(responseText);
    }
    });
}
</script>
@endsection
