<li class="xn-title">Navigasi</li>
<li {{{ (Request::is('Beranda') ? 'class=active' : '')}}}><a href="{{ url('/Beranda')}}"><span class="fa fa-desktop"></span><span class="xn-text">Beranda</span></a></li>
<li class="xn-openable {{{ (Request::is('Karyawan') || Request::is('Pembeli') || Request::is('Pemasok') || Request::is('Barang') || Request::is('Kategori') || Request::is('Pengeluaran') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-dashboard"></span> <span class="xn-text">Master Data</span></a>
   <ul>
       <li {{{ (Request::is('Karyawan') ? 'class=active' : '')}}}><a href="{{ url('/Karyawan')}}"><span class="fa fa-users"></span>Karyawan</a></li>
       <li {{{ (Request::is('Pembeli') ? 'class=active' : '')}}}><a href="{{ url('/Pembeli')}}"><span class="fa fa-user"></span>Pembeli</a></li>
       <li {{{ (Request::is('Pemasok') ? 'class=active' : '')}}}><a href="{{ url('/Pemasok')}}"><span class="fa fa-user-md"></span>Pemasok</a></li>
       <li {{{ (Request::is('Barang') ? 'class=active' : '')}}}><a href="{{ url('/Barang')}}"><span class="fa fa-gear"></span>Barang</a></li>
       <li {{{ (Request::is('Kategori') ? 'class=active' : '')}}}><a href="{{ url('/Kategori')}}"><span class="fa fa-sitemap"></span>Kategori</a></li>
       <!-- <li {{{ (Request::is('Pengeluaran') ? 'class=active' : '')}}}><a href="{{ url('/Pengeluaran')}}"><span class="fa fa-money"></span>Pengeluaran</a></li> -->
   </ul>
</li>
<li class="xn-openable {{{ (Request::is('BuatNotaBeli') || Request::is('BuatNotaJual') || Request::is('BuatReturBeli') || Request::is('BuatReturJual') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-file-o"></span> <span class="xn-text">Nota dan Retur</span></a>
   <ul>
       <li {{{ (Request::is('BuatNotaBeli') ? 'class=active' : '')}}}><a href="{{ url('/BuatNotaBeli')}}"><span class="fa fa-file"></span>Nota Beli</a></li>
       <li {{{ (Request::is('BuatNotaJual') ? 'class=active' : '')}}}><a href="{{ url('/BuatNotaJual')}}"><span class="fa fa-file"></span>Nota Jual</a></li>
       <li {{{ (Request::is('BuatReturBeli') ? 'class=active' : '')}}}><a href="{{ url('/BuatReturBeli')}}"><span class="fa fa-file"></span>Retur Beli</a></li>
       <li {{{ (Request::is('BuatReturJual') ? 'class=active' : '')}}}><a href="{{ url('/BuatReturJual')}}"><span class="fa fa-file"></span>Retur Jual</a></li>  
   </ul>
</li>
<!-- @if($Nama == 'tjandra')
<li {{{ (Request::is('LaporanKeuangan') ? 'class=active' : '')}}}><a href="{{ url('/LaporanKeuangan')}}"><span class="fa fa-book"></span><span class="xn-text">Laporan Keuangan</span></a></li>
@endif -->
@if($Nama == 'tjandra')
<li {{{ (Request::is('BuatStokOpname') ? 'class=active' : '')}}}><a href="{{ url('/BuatStokOpname')}}"><span class="fa fa-calendar"></span><span class="xn-text">Stok Opname</span></a></li>
@endif
<li {{{ (Request::is('TentangKami') ? 'class=active' : '')}}}><a href="{{ url('/TentangKami')}}"><span class="fa fa-building-o"></span><span class="xn-text">Tentang Kami</span></a></li>
<li><a href="{{ url('/Auth/Logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
