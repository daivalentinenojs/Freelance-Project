<li class="xn-title">Navigasi</li>
<li {{{ (Request::is('Beranda') ? 'class=active' : '')}}}><a href="{{ url('/Beranda')}}"><span class="fa fa-desktop"></span><span class="xn-text">Beranda</span></a></li>
@if($IDJabatan == 3)
<li class="xn-openable {{{ (Request::is('ProsesForecasting') || Request::is('CetakLaporanForecasting') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-magic"></span> <span class="xn-text">Forecasting</span></a>
   <ul>
       <li {{{ (Request::is('ProsesForecasting') ? 'class=active' : '')}}}><a href="{{ url('/ProsesForecasting')}}"><span class="fa fa-bar-chart-o"></span>Proses Forecasting</a></li>
       <!--li {{{ (Request::is('CetakLaporanForecasting') ? 'class=active' : '')}}}><a href="{{ url('/CetakLaporanForecasting')}}"><span class="fa fa-print"></span>Cetak Laporan Forecasting</a></li-->
   </ul>
</li>
@endif
<li class="xn-openable {{{ (Request::is('DataJabatan') || Request::is('DataSizeSepatu') || Request::is('DataKaryawan') ||  Request::is('DataNotaBeli')
|| Request::is('DataCustomer') ||  Request::is('DataTipeSepatu') || Request::is('DataBoxDetail') || Request::is('DataWarna')
|| Request::is('DataSepatu') ||  Request::is('DataSupplier') || Request::is('DataDetailSepatu') ? 'active' : '')}}}">
   <a href="#"><span class="fa fa-dashboard"></span> <span class="xn-text">Master Data</span></a>
   <ul>
       <li {{{ (Request::is('DataJabatan') ? 'class=active' : '')}}}><a href="{{ url('/DataJabatan')}}"><span class="fa fa-suitcase"></span>Data Jabatan</a></li>
       <li {{{ (Request::is('DataKaryawan') ? 'class=active' : '')}}}><a href="{{ url('/DataKaryawan')}}"><span class="fa fa-users"></span>Data Karyawan</a></li>
       <li {{{ (Request::is('DataSupplier') ? 'class=active' : '')}}}><a href="{{ url('/DataSupplier')}}"><span class="fa fa-user"></span>Data Supplier</a></li>
       <li {{{ (Request::is('DataCustomer') ? 'class=active' : '')}}}><a href="{{ url('/DataCustomer')}}"><span class="fa fa-user-md"></span>Data Customer</a></li>
       <li {{{ (Request::is('DataSepatu') ? 'class=active' : '')}}}><a href="{{ url('/DataSepatu')}}"><span class="fa fa-gift"></span>Data Merek Sepatu</a></li>
       <li {{{ (Request::is('DataTipeSepatu') ? 'class=active' : '')}}}><a href="{{ url('/DataTipeSepatu')}}"><span class="fa fa-sitemap"></span>Data Tipe Sepatu</a></li>
       <li {{{ (Request::is('DataSizeSepatu') ? 'class=active' : '')}}}><a href="{{ url('/DataSizeSepatu')}}"><span class="fa fa-sort-numeric-asc"></span>Data Ukuran Sepatu</a></li>
       <li {{{ (Request::is('DataBoxDetail') ? 'class=active' : '')}}}><a href="{{ url('/DataBoxDetail')}}"><span class="fa fa-sort-numeric-asc"></span>Data Box Detail</a></li>
       <li {{{ (Request::is('DataWarna') ? 'class=active' : '')}}}><a href="{{ url('/DataWarna')}}"><span class="fa fa-cog"></span>Data Warna</a></li>
       <li {{{ (Request::is('DataDetailSepatu') ? 'class=active' : '')}}}><a href="{{ url('/DataDetailSepatu')}}"><span class="fa fa-book"></span>Data Detail Sepatu</a></li>

   </ul>
</li>
<li class="xn-openable {{{ (Request::is('DataKonversiDetail') || Request::is('DataNotaTerimaDetail') || Request::is('DataNotaBeliDetail') || Request::is('DataNotaJualDetail') || Request::is('DataNotaPesanDetail') || Request::is('DataKonversi') || Request::is('DataNotaBeli') || Request::is('DataNotaTerima') || Request::is('DataNotaPesan') || Request::is('DataNotaJual') ? 'active' : '')}}}">
     <a href="#"><span class="fa fa-magic"></span> <span class="xn-text">Transaksi</span></a>
   <ul>
     <li {{{ (Request::is('DataNotaPesan')? 'class=active' : '')}}}><a href="{{ url('/DataNotaPesan')}}"><span class="fa fa-list-alt"></span>Data Nota Pesan</a></li>
     <li {{{ (Request::is('DataNotaJual')? 'class=active' : '')}}}><a href="{{ url('/DataNotaJual')}}"><span class="fa fa-list-alt"></span>Data Nota Jual</a></li>
     <li {{{ (Request::is('DataNotaBeli')? 'class=active' : '')}}}><a href="{{ url('/DataNotaBeli')}}"><span class="fa fa-list-alt"></span>Data Nota Beli</a></li>
     <li {{{ (Request::is('DataNotaTerima')? 'class=active' : '')}}}><a href="{{ url('/DataNotaTerima')}}"><span class="fa fa-list-alt"></span>Data Nota Terima</a></li>
     <li {{{ (Request::is('DataKonversi')? 'class=active' : '')}}}><a href="{{ url('/DataKonversi')}}"><span class="fa fa-list-alt"></span>Konversi Box Sepatu</a></li>
   </ul>
</li>
<li><a href="{{ url('/auth/logout')}}" class="mb-control" data-box="#mb-signout"><span class="glyphicon glyphicon-log-out"></span> <span class="xn-text">Keluar</span></a></li>
