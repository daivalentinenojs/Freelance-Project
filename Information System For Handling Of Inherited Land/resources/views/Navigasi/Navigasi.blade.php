<li class="xn-title">Navigasi</li>
<li {{{ (Request::is('Dashboard') ? 'class=active' : '')}}}><a href="{{ url('/Dashboard')}}"><span class="fa fa-desktop"></span><span class="xn-text">Beranda</span></a></li>

@if ($Role == 'Pemohon')

<li {{{ (Request::is('ProfilPemohon') ? 'class=active' : '')}}}><a href="{{ url('/ProfilPemohon')}}"><span class="fa fa-user"></span><span class="xn-text">Profil Pemohon</span></a></li>
<li class="xn-openable {{{ (Request::is('PengajuanFP') || Request::is('PembayaranFP') || Request::is('PengubahanFP') || Request::is('RevisiFP')? 'active' : '')}}}">
   <a href="#"><span class="fa fa-list-alt"></span> <span class="xn-text">Formulir Permohonan</span></a>
   <ul>
       <li {{{ (Request::is('PengajuanFP') ? 'class=active' : '')}}}><a href="{{ url('/PengajuanFP')}}"><span class="fa fa-list-alt"></span>Pengajuan</a></li>
       <li {{{ (Request::is('PengubahanFP') ? 'class=active' : '')}}}><a href="{{ url('/PengubahanFP')}}"><span class="fa fa-pencil"></span>Pengubahan</a></li>
       <li {{{ (Request::is('PembayaranFP') ? 'class=active' : '')}}}><a href="{{ url('/PembayaranFP')}}"><span class="fa fa-list"></span>Pembayaran</a></li>
       <li {{{ (Request::is('RevisiFP') ? 'class=active' : '')}}}><a href="{{ url('/RevisiFP')}}"><span class="fa fa-pencil"></span>Revisi</a></li>
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('ValidasiGambarUkur')? 'active' : '')}}}">
   <a href="#"><span class="glyphicon glyphicon-list-alt"></span> <span class="xn-text">Berkas Permohonan</span></a>
   <ul>
       <li {{{ (Request::is('ValidasiGambarUkur') ? 'class=active' : '')}}}><a href="{{ url('/ValidasiGambarUkur')}}"><span class="fa fa-star"></span>Validasi Gambar Ukur</a></li>
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('ValidasiRisalah')? 'active' : '')}}}">
   <a href="#"><span class="glyphicon glyphicon-briefcase"></span> <span class="xn-text">Risalah</span></a>
   <ul>
       <li {{{ (Request::is('ValidasiRisalah') ? 'class=active' : '')}}}><a href="{{ url('/ValidasiRisalah')}}"><span class="glyphicon glyphicon-briefcase"></span>Validasi Risalah</a></li>
   </ul>
</li>

@elseif ($Role == 'Kepala Desa')

<li {{{ (Request::is('ProfilKepalaDesa') ? 'class=active' : '')}}}><a href="{{ url('/ProfilKepalaDesa')}}"><span class="fa fa-user"></span><span class="xn-text">Profil Kepala Desa</span></a></li>
<li class="xn-openable {{{ (Request::is('VerifikasiRisalah') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-envelope"></span> <span class="xn-text">Risalah</span></a>
   <ul>
      <li {{{ (Request::is('VerifikasiRisalah') ? 'class=active' : '')}}}><a href="{{ url('/VerifikasiRisalah')}}"><span class="glyphicon glyphicon-pencil"></span>Validasi Risalah</a></li>
  </ul>
</li>
<li class="xn-openable {{{ (Request::is('VerifikasiSPKepalaDesa') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-envelope-o"></span> <span class="xn-text">Surat Pengantar</span></a>
   <ul>
       <li {{{ (Request::is('VerifikasiSPKepalaDesa') ? 'class=active' : '')}}}><a href="{{ url('/VerifikasiSPKepalaDesa')}}"><span class="fa fa-heart-o"></span>Validasi Surat Pengantar</a></li>
  </ul>
</li>

@else ($Role == 'Penerima Setoran PNBP' || $Role == 'Kepala Sub Bagian TU' || $Role == 'Kepala Seksi Hak Tanah dan Pendaftaran Tanah' || $Role == 'Kepala Seksi Pengukuran dan Pemetaan' ||
      $Role == 'Petugas Pengumpul Data Yuridis' || $Role == 'Kepala Seksi Hub Hukum Pertanahan' || $Role == 'Sekretaris Bukan Anggota' || $Role == 'Anggota' || $Role == 'Ketua' ||
      $Role == 'Koordinator' || $Role == 'Kepala Seksi Infrastruktur Pertanahan' || $Role == 'Kepala Sub Bagian Seksi Peralihan Hak' || $Role == 'Staff Hubungan Hukum Pertanahan')

<li {{{ (Request::is('ProfilKaryawan') ? 'class=active' : '')}}}><a href="{{ url('/ProfilKaryawan')}}"><span class="fa fa-user"></span><span class="xn-text">Profil Karyawan</span></a></li>

@if ($Role == 'Kepala Sub Bagian TU')

<li class="xn-openable {{{ (Request::is('ValidasiPengajuanFP') || Request::is('ValidasiPembayaranFP') || Request::is('ValidasiDisposisiFP')? 'active' : '')}}}">
   <a href="#"><span class="fa fa-list-alt"></span> <span class="xn-text">Formulir Permohonan</span></a>
   <ul>
       <li {{{ (Request::is('ValidasiPengajuanFP') ? 'class=active' : '')}}}><a href="{{ url('/ValidasiPengajuanFP')}}"><span class="fa fa-list-alt"></span>Validasi Pengajuan</a></li>
       <li {{{ (Request::is('ValidasiPembayaranFP') ? 'class=active' : '')}}}><a href="{{ url('/ValidasiPembayaranFP')}}"><span class="fa fa-pencil"></span>Validasi Pembayaran</a></li>
       <!-- <li {{{ (Request::is('ValidasiDisposisiFP') ? 'class=active' : '')}}}><a href="{{ url('/ValidasiDisposisiFP')}}"><span class="glyphicon glyphicon-list-alt"></span>Validasi Disposisi</a></li> -->
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('VerifikasiSPKaryawan') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-envelope-o"></span> <span class="xn-text">Surat Pengantar</span></a>
   <ul>
      <li {{{ (Request::is('VerifikasiSPKaryawan') ? 'class=active' : '')}}}><a href="{{ url('/VerifikasiSPKaryawan')}}"><span class="fa fa-heart-o"></span>Validasi Surat Pengantar</a></li>
  </ul>
</li>

@elseif ($Role == 'Kepala Seksi Infrastruktur Pertanahan')

<li class="xn-openable {{{ (Request::is('JadwalUkur') ? 'active' : '')}}}">
   <a href="#"><span class="glyphicon glyphicon-list-alt"></span> <span class="xn-text">Berkas Permohonan</span></a>
   <ul>
       <li {{{ (Request::is('JadwalUkur') ? 'class=active' : '')}}}><a href="{{ url('/JadwalUkur')}}"><span class="fa fa-calendar-o"></span>Jadwal Ukur</a></li>
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('UbahGambarUkur')? 'active' : '')}}}">
   <a href="#"><span class="glyphicon glyphicon-list-alt"></span> <span class="xn-text">Berkas Permohonan</span></a>
   <ul>
       <li {{{ (Request::is('UbahGambarUkur') ? 'class=active' : '')}}}><a href="{{ url('/UbahGambarUkur')}}"><span class="glyphicon glyphicon-camera"></span>Ubah Gambar Ukur</a></li>
   </ul>
</li>

@elseif ($Role == 'Kepala Seksi Pengukuran dan Pemetaan')

<li class="xn-openable {{{ (Request::is('GambarUkur') || Request::is('SanggahanGambarUkur') || Request::is('UbahGambarUkur')? 'active' : '')}}}">
   <a href="#"><span class="glyphicon glyphicon-list-alt"></span> <span class="xn-text">Berkas Permohonan</span></a>
   <ul>
       <li {{{ (Request::is('GambarUkur') ? 'class=active' : '')}}}><a href="{{ url('/GambarUkur')}}"><span class="glyphicon glyphicon-picture"></span>Gambar Ukur</a></li>
       <li {{{ (Request::is('SanggahanGambarUkur') ? 'class=active' : '')}}}><a href="{{ url('/SanggahanGambarUkur')}}"><span class="fa fa-heart"></span>Sanggahan Gambar Ukur</a></li>
       <li {{{ (Request::is('UbahGambarUkur') ? 'class=active' : '')}}}><a href="{{ url('/UbahGambarUkur')}}"><span class="glyphicon glyphicon-camera"></span>Ubah Gambar Ukur</a></li>
   </ul>
</li>

@elseif ($Role == 'Staff Hubungan Hukum Pertanahan')

<li class="xn-openable {{{ (Request::is('BeritaAcara') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-comments"></span> <span class="xn-text">Berita Acara</span></a>
   <ul>
       <li {{{ (Request::is('BeritaAcara') ? 'class=active' : '')}}}><a href="{{ url('/BeritaAcara')}}"><span class="fa fa-comments"></span>Berita Acara</a></li>
   </ul>
</li>

@elseif ($Role == 'Kepala Seksi Hub Hukum Pertanahan' || $Role == 'Sekretaris Bukan Anggota')

<li class="xn-openable {{{ (Request::is('Risalah') || Request::is('UbahRisalah')? 'active' : '')}}}">
   <a href="#"><span class="glyphicon glyphicon-briefcase"></span> <span class="xn-text">Risalah</span></a>
   <ul>
       <li {{{ (Request::is('Risalah') ? 'class=active' : '')}}}><a href="{{ url('/Risalah')}}"><span class="glyphicon glyphicon-briefcase"></span>Risalah</a></li>
       <li {{{ (Request::is('UbahRisalah') ? 'class=active' : '')}}}><a href="{{ url('/UbahRisalah')}}"><span class="glyphicon glyphicon-pencil"></span>Ubah Risalah</a></li>
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('PengajuanBPFY') || Request::is('UbahBPFY') || Request::is('ValidasiBPFY')? 'active' : '')}}}">
   <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Berkas Pengumuman</span></a>
   <ul>
       <li {{{ (Request::is('PengajuanBPFY') ? 'class=active' : '')}}}><a href="{{ url('/PengajuanBPFY')}}"><span class="fa fa-archive"></span>Pengajuan Berkas</a></li>
       <li {{{ (Request::is('UbahBPFY') ? 'class=active' : '')}}}><a href="{{ url('/UbahBPFY')}}"><span class="fa fa-pencil"></span>Ubah Berkas</a></li>
       <li {{{ (Request::is('ValidasiBPFY') ? 'class=active' : '')}}}><a href="{{ url('/ValidasiBPFY')}}"><span class="fa fa-heart-o"></span>Validasi Berkas</a></li>
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('SuratPengantar') || Request::is('EditSuratPengantar') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-envelope-o"></span> <span class="xn-text">Surat Pengantar</span></a>
   <ul>
      <li {{{ (Request::is('SuratPengantar') ? 'class=active' : '')}}}><a href="{{ url('/SuratPengantar')}}"><span class="fa fa-envelope-o"></span>Pengajuan Surat Pengantar</a></li>
      <li {{{ (Request::is('EditSuratPengantar') ? 'class=active' : '')}}}><a href="{{ url('/EditSuratPengantar')}}"><span class="fa fa-pencil"></span>Ubah Surat Pengantar</a></li>\
  </ul>
</li>
<li class="xn-openable {{{ (Request::is('VerifikasiBeritaAcara')? 'active' : '')}}}">
   <a href="#"><span class="fa fa-comments"></span> <span class="xn-text">Berita Acara</span></a>
   <ul>
       <li {{{ (Request::is('VerifikasiBeritaAcara') ? 'class=active' : '')}}}><a href="{{ url('/VerifikasiBeritaAcara')}}"><span class="fa fa-heart-o"></span>Validasi Berita Acara</a></li>
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('PrintRisalah') || Request::is('PrintBPFY') || Request::is('PrintSuratPengantar') || Request::is('PrintBeritaAcara') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-print"></span> <span class="xn-text">Print PDF</span></a>
   <ul>
       <li {{{ (Request::is('PrintRisalah') ? 'class=active' : '')}}}><a href="{{ url('/PrintRisalah')}}"><span class="fa fa-file-powerpoint-o"></span>Risalah</a></li>
       <li {{{ (Request::is('PrintBPFY') ? 'class=active' : '')}}}><a href="{{ url('/PrintBPFY')}}"><span class="fa fa-file-word-o"></span>Berkas Pengumuman</a></li>
       <li {{{ (Request::is('PrintSuratPengantar') ? 'class=active' : '')}}}><a href="{{ url('/PrintSuratPengantar')}}"><span class="fa fa-file-zip-o"></span>Surat Pengantar</a></li>
       <li {{{ (Request::is('PrintBeritaAcara') ? 'class=active' : '')}}}><a href="{{ url('/PrintBeritaAcara')}}"><span class="fa fa-file-pdf-o"></span>Berita Acara</a></li>
   </ul>
</li>

@elseif ($Role == 'Koordinator' || $Role == 'Kepala Seksi Hak Tanah dan Pendaftaran Tanah' || $Role == 'Kepala Sub Bagian Seksi Peralihan Hak')

<li class="xn-openable {{{ (Request::is('ValidasiBPFY') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Berkas Pengumuman</span></a>
   <ul>
       <li {{{ (Request::is('ValidasiBPFY') ? 'class=active' : '')}}}><a href="{{ url('/ValidasiBPFY')}}"><span class="fa fa-heart-o"></span>Validasi Berkas</a></li>
   </ul>
</li>

@endif

<li class="xn-openable {{{ (Request::is('KepalaDesa') || Request::is('Desa') || Request::is('Pemohon') || Request::is('Karyawan') || Request::is('Daerah')? 'active' : '')}}}">
   <a href="#"><span class="fa fa-dashboard"></span> <span class="xn-text">Master Data</span></a>
   <ul>
       <li {{{ (Request::is('KepalaDesa') ? 'class=active' : '')}}}><a href="{{ url('/KepalaDesa')}}"><span class="fa fa-user-md"></span>Kepala Desa</a></li>
       <li {{{ (Request::is('Desa') ? 'class=active' : '')}}}><a href="{{ url('/Desa')}}"><span class="fa fa-hospital-o"></span>Desa</a></li>
       <li {{{ (Request::is('Pemohon') ? 'class=active' : '')}}}><a href="{{ url('/Pemohon')}}"><span class="fa fa-user"></span>Pemohon</a></li>
       <li {{{ (Request::is('Karyawan') ? 'class=active' : '')}}}><a href="{{ url('/Karyawan')}}"><span class="fa fa-users"></span>Karyawan</a></li>
       <li {{{ (Request::is('Daerah') ? 'class=active' : '')}}}><a href="{{ url('/Daerah')}}"><span class="fa fa-building-o"></span>Daerah</a></li>
   </ul>
</li>
@endif

<li><a href="{{ url('Logout')}}" class="mb-control" data-box="#mb-signout"><span class="fa fa-eject"></span><span class="xn-text">Keluar</span></a></li>
