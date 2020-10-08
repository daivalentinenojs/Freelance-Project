<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Web Routes*/


/*Login Web*/																																																					// Done T N
Route::get('/', 'Auth\AuthController@getLogin');																																			// Done T N
Route::get('auth/login', 'Auth\AuthController@getLogin');																															// Done T N
Route::post('auth/login', 'Auth\AuthController@LoginWeb');																														// Done T N

/*Logout Web*/																																																				// Done T N
Route::get('auth/logout', 'Auth\AuthController@LogoutWeb');																														// Done T N


/*Hak Akses Mahasiswa*/																																																// Done T N
Route::group(['middleware' => 'Mahasiswa'], function() {																															// Done T N

		/*Beranda Mahasiswa*/																																															// Done T N
		Route::get('/InformasiMahasiswa','APIController@BerandaMahasiswa');																								// Done T N
		Route::post('/InformasiMahasiswa','APIController@BerandaMahasiswaPost');																					// Done T N

});



/*Hak Akses Dosen*/																																																		// Done T N
Route::group(['middleware' => 'Dosen'], function() {																																	// Done T N

		/*Beranda*/																																																				// Done T N
		Route::get('/Beranda', 'APIController@Beranda');															  																	// Done T N

		/*Informasi MataKuliah Buka*/																																											// Done T N
		Route::get('/InformasiMataKuliahBuka', 'APIController@InformasiMataKuliahBuka');																	// Done T N

		/*Tambah Jenis Nilai*/																																														// Done T N
		Route::get('/TambahJenisNilai','APIController@CreateJenisNilaiWeb');																							// Done T N
		Route::post('/TambahJenisNilai', 'JenisNilaiController@StoreJenisNilaiWeb');																			// Done T N

		/*Ubah Jenis Nilai*/																																															// Done T N
		Route::get('/InformasiBobotNilai', 'APIController@IndexJenisNilaiWeb');																						// Done T N
		Route::get('/UbahBobotNilai/{id?}/edit','JenisNilaiController@EditJenisNilaiWeb');																// Done T N
		Route::post('/UbahBobotNilai/{id?}/edit','JenisNilaiController@UpdateJenisNilaiWeb');															// Done T N

		/*Hapus Jenis Nilai*/																																															// Done T N
		Route::get('/InformasiHapusJenisNilai', 'APIController@IndexHapusJenisNilaiWeb');																	// Done T N
		Route::get('/HapusJenisNilai/{id?}/edit','JenisNilaiController@HapusJenisNilaiWeb');															// Done T N
		Route::post('/HapusJenisNilai/{id?}/edit','JenisNilaiController@UpdateHapusJenisNilaiWeb');												// Done T N

		/*Input Nilai Mahasiswa*/																																													// Done T N
		Route::get('/InputNilaiMahasiswa', 'APIController@IndexNilaiMahasiswaWeb');																				// Done T N
		Route::post('/InputNilaiMahasiswa','NilaiMahasiswaController@CreateNilaiMahasiswaWeb');														// Done T N
		Route::post('/TambahNilaiMahasiswa', 'NilaiMahasiswaController@StoreNilaiMahasiswaWeb');													// Done T N
		Route::get('/ExportExcel/{KodeNilai?}/{KodeMkBuka?}/{KP?}', 'NilaiMahasiswaController@ExportExcel');							// Done T N
		Route::get('/InputNilaiMahasiswaAndroid', 'NilaiMahasiswaController@Upload');																			// Done T N

		/*Ubah Nilai Mahasiswa*/																																													// Done T N
		Route::get('/InformasiNilaiMahasiswa', 'APIController@IndexUbahNilaiMahasiswaWeb');																// Done T N
		Route::post('/InformasiNilaiMahasiswa','NilaiMahasiswaController@EditNilaiMahasiswaWeb');													// Done T N
		Route::post('/UbahNilaiMahasiswa','NilaiMahasiswaController@UpdateNilaiMahasiswaWeb');														// Done T N

		/*Kalkulasi Nilai Mahasiswa*/																																											// Done T N
		Route::get('/InformasiKalkulasiNilaiMahasiswa', 'APIController@IndexKalkulasiNilaiMahasiswa');										// Done T N
		Route::post('/InformasiKalkulasiNilaiMahasiswa','NilaiMahasiswaController@IndexHasilKalkulasiNilaiMahasiswa');		// Done T N
		Route::post('/KalkulasiNilaiMahasiswa','NilaiMahasiswaController@StoreNilaiAkhirMahasiswa');											// Done T N

		/*Verifikasi Nilai Mahasiswa*/																																										// Done T N
		Route::get('/InformasiVerifikasiNilaiMahasiswa', 'APIController@IndexVerifikasiNilaiMahasiswa');									// Done T N
		Route::post('/InformasiVerifikasiNilaiMahasiswa','NilaiMahasiswaController@IndexHasilVerifikasiNilaiMahasiswa');	// Done T N
		Route::post('/VerifikasiNilaiMahasiswa','NilaiMahasiswaController@StoreVerifikasiNilaiMahasiswa');								// Done T N

		/*Upload Nilai Mahasiswa*/																																												// Done T N
		Route::get('/InformasiUnggahNilaiMahasiswa', 'APIController@IndexUnggahNilaiMahasiswa');													// Done T N
		Route::post('/InformasiUnggahNilaiMahasiswa','NilaiMahasiswaController@IndexHasilUnggahNilaiMahasiswa');					// Done T N
		Route::post('/UnggahNilaiMahasiswa','NilaiMahasiswaController@StoreUnggahNilaiMahasiswa');												// Done T N
});



// Hak Akses																																																					// Done
// Middleware																																																					// Done
// Auth Sesuai Jabatan																																																// Done
// Div Error Ubah Message Box Alert																																										// Done
// Pagination																																																					// Done
// Tambah Informasi Yang TelahDiKalkulasi, SiapUpload, Dan TelahDiUpload																							// Done
// Error Logout Otomatis, Session Lifetime (dalam menit)																															// Done
// Icon Ubah Dan Hapus																																																// Done
// Merapikan Tabel NRP Nama saja tidak perlu satu layar																																// Done
// LDAP 																																																							// X
// Check Create Ubah Hapus untuk pengecheckan SiapUpload dan TelahUpload Tambah Keterangan														// Done
// Tampil Nilai dan Mata Kuliah Diajar Semester lalu																																	// Done
// Textbox Search 																																																		// Done
// Perbaiki tampilan tidak diizinkan																																									// Done
// Check Tambah Jenis Nilai Untuk Semua KP, tidak mau masuk, bobotnya lebih dari 100%, padahal harusnya bisa					// Done
// Check Jika KP A atau KP Awal adalah bukan KP Koordinator																														// Done
// Tambahkan Jenis Nilai NTS NAS di RekapNilai untuk Bantu Upload																											// Done
// Ubah Penulisan Input Kode Nilai mengenai satu dan dua digit KP																											// Done
// Input Excel atau CSV																																																// Done
// Input Semua Nilai Langsung																																													// Done
// Tambah Siapa yang input, yang input yang validasi																																	// Done
// Tooltip (T)																																																				// Done
// Notification Dan Ubah Warna Div (N)  																																							// Done
// Buat Keterangan Input Nilai Mahasiswa Untuk Nilai Telah diinputkan																									// Done
// Buat Keterangan Tambah Jenis Nilai Jika Bobot Telah 100 % Untuk MkBuka dan KP Tersebut															// Done
// Check Dicentang Dahulu, Tapi G Bisa Input Karena Koordinator Sudah Input																						// Done
// Perbaiki Export																																																		// Done
// Kalau Rotate Di Handphone Jangan Logout 																																						// Done
// Ubah Kode Nilai NTS NAS Waktu UnggahNilaiMahasiswa																																	// Done
// Check Unggah Mengikuti Tanggal Periode Di BAAK																																			// Done
// Check Waktu Unggah Status Belum Ada (Insert Langsung) dan Daftar (Update Langsung)																	// Done
// Check Waktu Unggah Status Valid Dosen (Insert Baru) dan Valid Admik (Tidak Bisa)  																	// Done
// Perbaiki Input Nilai, Mahasiswa Tilang / Tidak Hadir Tidak Bisa Input																							// Done
// Data Table Detail Nilai di Informasi Mahasiswa																																			// Y
// Input Ubah Nilai Sendiri Sendiri UTS UAS Sesuai Tanggal																														// Done
// Kalkulasi, Verifikasi, Unggah UTS UAS Sendiri Sendiri Sesuai Tanggal																								// Done
// Ubah Kode UTS UAS 001 002 Saat Unggah MyUbaya																																			// Done
// Migration Dan Seeder Tabel Baru, Termasuk Check Seeder Lama Tahun																									// Done
// Buat di BAAK Berita Acara 2016	dan BeritaAcaraMhs 2016																															// Done
// Perbaiki Kalkulasi Nilai Error Konsultasi P Richard																																// Done
// Sorting Nilai Saat Input Nilai																																											// Done
// Excel dengan Pengecheckan Nilai, Mahasiswa Hadir Atau Tidak Atau Tilang Presensi, Nilai 0													// Done
// Tambahkan Excel jika Salah Satu Kolom NRP Dihapus maka harusnya diinput Nilai 0 (Tidak Tampil di Data Table)				// Done
// Check Detail Nilai Yang Tidak Hadir UTS UAS Di Informasi Mahasiswa 																								// Done
// Check Input Nilai Mahasiswa Lebih dari 100, Tidak Submit, Tidak Boleh Null																					// Done
// Check Ubah Nilai Mahasiswa Lebih dari 100, Tidak Submit, Tidak Boleh Null																					// Done
// Jika NTS saja diunggah, NAS waktu Login Mahasiswa Muncul 0 Atau E Atau - 																					// Done
// Check Unggah NAS Batas, Tambah Keterangan Batas Input NTS Telah Lewat																							// Done
// Check Buat, Ubah, Hapus Jenis Nilai Tergantung Batas NAS, Semua 																										// Done
// Lewat Batas Input NTS, Jenis Nilai Create, Edit, Delete Hanya NAS 																									// Done
// Tambah Pengecheckan Valid Admik Sebelum Klik Tombol Unggah 																												// Done
// Check Jika Batas Input NTS Lebih Panjang Daripada Batas Input NAS 																									// Done
// Tombol Tesseract Hanya Muncul Saat di Android																																			// Y
// Perbaiki Tampilan Layar Kecil 																																											// Y
// Perbaiki Kalkulasi, Verifikasi, Unggah di Detail Nilai Untuk Tidak Hadir 																					// Done
// Perbaiki Tanpa UTS UAS di Informasi Mahasiswa 																																			// Done
// Check Jika Tidak Ada UTS UAS Kalkulasi Verifikasi Unggah																														// Done

/*Android Routes*/


/*Login logout Android*/
//Route::get('auth/LoginAndroid/{email?}/{password?}/{domain?}', 'Auth\AuthController@LoginAndroid');

/*Informasi Mata Kuliah*/
//Route::get('API/InformasiMataKuliahBuka', 'AndroidController@TampilMataKuliahBukaAndroid');

/*Tambah Jenis Nilai*/
//Route::get('API/TambahJenisNilai/{NPK?}', 'AndroidController@TampilDistinctMataKuliahDiajarTanpaLihatKPAndroid');
//::get('API/TambahJenisNilaiTampilIndexKoordinator/{Kode?}', 'AndroidController@JenisNilaiCreateTampilIndexNilaiPribadiAndroid');
