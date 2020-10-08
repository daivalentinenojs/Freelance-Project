<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::group(['middleware' => 'Mahasiswa'], function() {
// 	Route::get('InformasiMahasiswa', 'APIController@BerandaMahasiswa');
// 	Route::post('InformasiMahasiswa', 'APIController@BerandaMahasiswaPost');
// })

/*Login Web*/
Route::get('/', function () {    return view('Auth/Login');    });
Route::get('/Auth/Login', function () {    return view('Auth/Login');    });
Route::post('/Auth/Login', 'Auth\LoginController@LoginWeb');
Route::get('/Auth/Logout', 'Auth\LoginController@LogoutWeb');

/*Beranda*/
Route::get('/Beranda','BerandaController@Index');

/*Nota Beli*/
Route::get('/BuatNotaBeli','NotaBeliController@Index');
Route::get('/DataNotaBeliDetail', 'NotaBeliController@Create');
Route::get('/CetakNotaBeli/{id}', 'NotaBeliController@Cetak');
Route::post('/DataNotaBeliDetail', 'NotaBeliController@Store');
Route::post('/UbahDataNotaBeli', 'NotaBeliController@Update');

/*Nota Jual*/
Route::get('/BuatNotaJual','NotaJualController@Index');
Route::get('/DataNotaJualDetail', 'NotaJualController@Create');
Route::get('/CetakNotaJual/{id}', 'NotaJualController@Cetak');
Route::post('/DataNotaJualDetail', 'NotaJualController@Store');
Route::post('/UbahDataNotaJual', 'NotaJualController@Update');

/*Retur Beli*/
Route::get('/BuatReturBeli','ReturBeliController@Index');
Route::get('/DataReturBeliDetail', 'ReturBeliController@Create');
Route::get('/CetakReturBeli/{id}', 'ReturBeliController@Cetak');
Route::post('/DataReturBeliDetail', 'ReturBeliController@Store');
Route::post('/UbahDataReturBeli', 'ReturBeliController@Update');

/*Retur Jual*/
Route::get('/BuatReturJual','ReturJualController@Index');
Route::get('/DataReturJualDetail','ReturJualController@Create');
Route::get('/CetakReturJual/{id}', 'ReturJualController@Cetak');
Route::post('/DataReturJualDetail', 'ReturJualController@Store');
Route::post('/UbahDataReturJual', 'ReturJualController@Update');

/*Stok Opname*/
Route::get('/BuatStokOpname','StokOpnameController@Index');
Route::get('/DataStokOpnameDetail', 'StokOpnameController@Create');
Route::get('/CetakStokOpname/{id}', 'StokOpnameController@Cetak');
Route::post('/DataStokOpnameDetail', 'StokOpnameController@Store');
Route::post('/UbahDataStokOpname', 'StokOpnameController@Update');

/*Laporan Keuangan*/
// Route::get('/LaporanKeuangan','LaporanKeuanganController@Index');
// Route::get('/CetakLaporanKeuangan','LaporanKeuanganController@PrintLaporan');

/*Master Data*/
/*Karyawan*/
Route::get('/Karyawan','KaryawanController@Index');
Route::post('/Karyawan','KaryawanController@Store');
Route::post('/UbahDataKaryawan','KaryawanController@Update');

/*Pembeli*/
Route::get('/Pembeli','PembeliController@Index');
Route::post('/Pembeli','PembeliController@Store');
Route::post('/UbahDataPembeli','PembeliController@Update');

/*Pemasok*/
Route::get('/Pemasok','PemasokController@Index');
Route::post('/Pemasok','PemasokController@Store');
Route::post('/UbahDataPemasok','PemasokController@Update');

/*Barang*/
Route::get('/Barang','BarangController@Index');
Route::post('/Barang','BarangController@Store');
Route::post('/UbahDataBarang','BarangController@Update');

/*Kategori*/
Route::get('/Kategori','KategoriController@Index');
Route::post('/Kategori','KategoriController@Store');
Route::post('/UbahDataKategori','KategoriController@Update');

/*Pengeluaran*/
Route::get('/Pengeluaran','PengeluaranController@Index');
Route::post('/Pengeluaran','PengeluaranController@Store');
Route::post('/UbahDataPengeluaran','PengeluaranController@Update');
/*Master Data*/

/*Tentang Kami*/
Route::get('/TentangKami','TentangKamiController@Index');
