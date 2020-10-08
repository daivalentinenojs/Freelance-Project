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

// Route::get('/', function () {
//     return view('Beranda');
// });


/*Login Web*/
Route::get('/', 'Auth\LoginController@LoginIndex');
Route::post('Login', 'Auth\LoginController@LoginWeb');
Route::get('Auth/Logout', 'Auth\LoginController@LogoutWeb');

/*Beranda*/
Route::get('Beranda', 'Controller@Beranda');

/*Forecasting*/
Route::get('/Tipe/{id}','ForecastingController@Tipe');
Route::get('/Merek/{id}','ForecastingController@Merek');
Route::get('/ProsesForecasting','ForecastingController@Index');
Route::get('/CetakLaporanForecasting','ForecastingController@Create');

/*Master Data*/
Route::get('/DataJabatan','JabatanController@Index');
Route::post('/DataJabatan','JabatanController@Store');
Route::post('/UbahDataJabatan','JabatanController@Update');

Route::get('/DataJenisBarang','JenisBarangController@Index');
Route::post('/DataJenisBarang','JenisBarangController@Store');
Route::post('/UbahDataJenisBarang','JenisBarangController@Update');

Route::get('/DataDetailSatuan','DetailSatuanController@Index');
Route::post('/DataDetailSatuan','DetailSatuanController@Store');
Route::post('/UbahDataDetailSatuan','DetailSatuanController@Update');

Route::get('/DataKaryawan','KaryawanController@Index');
Route::post('/DataKaryawan','KaryawanController@Store');
Route::post('/UbahDataKaryawan','KaryawanController@Update');

Route::get('/DataSupplier','SupplierController@Index');
Route::post('/DataSupplier','SupplierController@Store');
Route::post('/UbahDataSupplier','SupplierController@Update');

Route::get('/DataCustomer','CustomerController@Index');
Route::post('/DataCustomer','CustomerController@Store');
Route::post('/UbahDataCustomer','CustomerController@Update');

Route::get('/DataBoxDetail','BoxDetailController@Index');
Route::get('/BoxDetail','CatatBoxDetailController@Index');
Route::get('/BoxDetail/{id}','CatatBoxDetailController@GetSepatu');
Route::post('/DataBoxDetail','CatatBoxDetailController@Store');
Route::post('/UbahDataBoxDetail','CatatBoxDetailController@Update');

Route::get('/DataSizeSepatu','SizeSepatuController@Index');
Route::post('/DataSizeSepatu','SizeSepatuController@Store');
Route::post('/UbahDataSizeSepatu','SizeSepatuController@Update');

Route::get('/DataTipeSepatu','TipeSepatuController@Index');
Route::post('/DataTipeSepatu','TipeSepatuController@Store');
Route::post('/UbahDataTipeSepatu','TipeSepatuController@Update');

Route::get('/DataWarna','WarnaController@Index');
Route::post('/DataWarna','WarnaController@Store');
Route::post('/UbahDataWarna','WarnaController@Update');

Route::get('/DataSepatu','SepatuController@Index');
Route::post('/DataSepatu','SepatuController@Store');
Route::post('/UbahDataSepatu','SepatuController@Update');

Route::get('/DataDetailSepatu','DetailSepatuController@Index');
Route::post('/DataDetailSepatu','DetailSepatuController@Store');
Route::post('/UbahDataDetailSepatu','DetailSepatuController@Update');

//Nota Pembelian
Route::get('/CetakLaporanNotaBeli','CatatNotaBeliController@PrintLaporan');
Route::get('/CetakNotaBeli/{id}','CatatNotaBeliController@PrintNotaBeli');
Route::get('/DataNotaBeli','NotaBeliController@Index');
Route::get('/DataNotaBeliDetail','CatatNotaBeliController@Index');
Route::post('/DataNotaBeliDetail','CatatNotaBeliController@Store');
Route::post('/UbahDataNotaBeli','CatatNotaBeliController@Update');

//Nota Penerimaan
Route::get('/CetakLaporanNotaTerima','CatatNotaTerimaController@PrintLaporan');
Route::get('/CetakNotaTerima/{id}','CatatNotaTerimaController@PrintNotaTerima');
Route::get('/DataNotaTerima','NotaTerimaController@Index');
Route::get('/DataNotaTerimaDetail','CatatNotaTerimaController@Index');
Route::post('/DataNotaTerimaDetail','CatatNotaTerimaController@Store');
Route::post('/UbahDataNotaTerima','CatatNotaTerimaController@Update');
Route::get('/NotaPembelian/{ID}', 'CatatNotaTerimaController@LihatNota');

//Nota Pemesanan
Route::get('/CetakLaporanNotaPesan','CatatNotaPesanController@PrintLaporan');
Route::get('/CetakNotaPesan/{id}','CatatNotaPesanController@PrintNotaPesan');
Route::get('/DataNotaPesan','NotaPesanController@Index');
Route::get('/DataNotaPesanDetail','CatatNotaPesanController@Index');
Route::get('/DataNotaPesanDetail/{id}','CatatNotaPesanController@GetHarga');
Route::post('/DataNotaPesanDetail','CatatNotaPesanController@Store');
Route::post('/UbahDataNotaPesan','CatatNotaPesanController@Update');
Route::get('/Ukuran/{id}','CatatNotaPesanController@Ukuran');
Route::get('/Warna/{id}','CatatNotaPesanController@Warna');

//Nota Penjualan
Route::get('/CetakLaporanNotaJual','CatatNotaJualController@PrintLaporan');
Route::get('/CetakNotaJual/{id}','CatatNotaJualController@PrintNotaJual');
Route::get('/DataNotaJual','NotaJualController@Index');
Route::get('/DataNotaJualDetail','CatatNotaJualController@Index');
Route::post('/DataNotaJualDetail','CatatNotaJualController@Store');
Route::post('/UbahDataNotaJual','CatatNotaJualController@Update');
Route::get('/NotaPesanan/{ID}', 'CatatNotaJualController@LihatNota');

//Konversi
Route::get('/DataKonversi','KonversiController@Index');
Route::get('/DataKonversiDetail','CatatKonversiController@Index');
Route::post('/DataKonversiDetail','CatatKonversiController@Store');
Route::get('/DataKonversiDetail/{id}','CatatKonversiController@GetStok');
?>
