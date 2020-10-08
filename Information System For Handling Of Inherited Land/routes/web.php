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

/*Login Web*/
Route::get('/Login', 'Auth\LoginController@LoginIndex');                                            // Done
Route::post('/Login', 'Auth\LoginController@LoginWeb');                                             // Done
Route::get('/Logout', 'Auth\LoginController@LogoutWeb');                                            // Done

/*Beranda*/
Route::get('/', 'MasterController@Beranda');                                                        // Done
Route::get('/TentangKami', 'MasterController@TentangKami');                                         // Done
Route::get('/Daftar', 'MasterController@Daftar');                                                   // Done
Route::post('/Daftar', 'MasterController@DaftarPemohon');                                           // Done

/*Profil*/
Route::get('/ProfilPemohon', 'PemohonController@ProfilPemohon');                                    // Done
Route::post('/ProfilPemohon', 'PemohonController@UpdatePemohon');                                   // Done
Route::get('/ProfilKepalaDesa', 'KepalaDesaController@ProfilKepalaDesa');                           // Done
Route::post('/ProfilKepalaDesa', 'KepalaDesaController@UpdateKepalaDesa');                          // Done
Route::get('/ProfilKaryawan', 'KaryawanController@ProfilKaryawan');                                 // Done
Route::post('/ProfilKaryawan', 'KaryawanController@UpdateKaryawan');                                // Done

/*Dashboard*/
Route::get('/Dashboard', 'MasterController@Dashboard');                                             // Done
Route::get('/AjaxDashboard','FormulirPermohonanController@AjaxDashboard');                          // Done
Route::get('/ViewFormulirPermohonan/{id}', 'MasterController@ViewFormulirPermohonan');              // Done

/*Master Data*/
Route::get('/Desa','DesaController@Index');                                                         // Done
Route::post('/Desa','DesaController@Store');                                                        // Done
Route::get('/AjaxDesa','DesaController@Ajax');                                                      // Done
Route::post('/EditDesa','DesaController@Update');                                                   // Done

Route::get('/Daerah','DaerahController@Index');                                                     // Done
Route::post('/Daerah','DaerahController@Store');                                                    // Done
Route::get('/AjaxDaerah','DaerahController@Ajax');                                                  // Done
Route::post('/EditDaerah','DaerahController@Update');                                               // Done

Route::get('/Karyawan','KaryawanController@Index');                                                 // Done
Route::post('/Karyawan','KaryawanController@Store');                                                // Done
Route::get('/AjaxKaryawan','KaryawanController@Ajax');                                              // Done
Route::post('/EditKaryawan','KaryawanController@Update');                                           // Done

Route::get('/KepalaDesa','KepalaDesaController@Index');                                             // Done
Route::post('/KepalaDesa','KepalaDesaController@Store');                                            // Done
Route::get('/AjaxKepalaDesa','KepalaDesaController@Ajax');                                          // Done
Route::post('/EditKepalaDesa','KepalaDesaController@Update');                                       // Done

Route::get('/Pemohon','PemohonController@Index');                                                   // Done
Route::post('/Pemohon','PemohonController@Store');                                                  // Done
Route::get('/AjaxPemohon','PemohonController@Ajax');                                                // Done
Route::post('/EditPemohon','PemohonController@Update');                                             // Done

/*Formulir Permohonan Pemohon*/
Route::get('/AjaxPengajuanFP','FormulirPermohonanController@AjaxFP');                               // Done
Route::get('/PengajuanFP', 'FormulirPermohonanController@CreatePengajuanFP');                       // Done
Route::post('/PengajuanFP', 'FormulirPermohonanController@StorePengajuanFP');                       // Done

Route::get('/PengubahanFP', 'FormulirPermohonanController@EditPengubahanFP');                       // Done
Route::post('/PengubahanFP', 'FormulirPermohonanController@UpdatePengubahanFP');                    // Done

Route::get('/PembayaranFP', 'FormulirPermohonanController@CreatePembayaranFP');                     // Done
Route::post('/PembayaranFP', 'FormulirPermohonanController@StorePembayaranFP');                     // Done

Route::get('/RevisiFP', 'FormulirPermohonanController@CreateRevisiFP');                             // Done
Route::post('/RevisiFP', 'FormulirPermohonanController@StoreRevisiFP');                             // Done

/*Formulir Permohonan Karyawan*/
Route::get('/ValidasiPengajuanFP', 'FormulirPermohonanController@CreateValidasiPengajuanFP');       // Done
Route::post('/ValidasiPengajuanFP', 'FormulirPermohonanController@StoreValidasiPengajuanFP');       // Done

Route::get('/ValidasiPembayaranFP', 'FormulirPermohonanController@CreateValidasiPembayaranFP');     // Done
Route::post('/ValidasiPembayaranFP', 'FormulirPermohonanController@StoreValidasiPembayaranFP');     // Done

Route::get('/ValidasiDisposisiFP', 'FormulirPermohonanController@CreateValidasiDisposisiFP');       // Done
Route::post('/ValidasiDisposisiFP', 'FormulirPermohonanController@StoreValidasiDisposisiFP');       // Done

/*Berkas Permohonan Pemohon*/
Route::get('/ValidasiGambarUkur', 'BerkasPermohonanController@CreateValidasiGambarUkur');           // Done
Route::post('/ValidasiGambarUkur', 'BerkasPermohonanController@StoreValidasiGambarUkur');           // Done

/*Berkas Permohonan Karyawan*/
Route::get('/JadwalUkur', 'BerkasPermohonanController@CreateJadwalUkur');                           // Done
Route::post('/JadwalUkur', 'BerkasPermohonanController@StoreJadwalUkur');                           // Done

Route::get('/GambarUkur', 'BerkasPermohonanController@CreateGambarUkur');                           // Done
Route::post('/GambarUkur', 'BerkasPermohonanController@StoreGambarUkur');                           // Done

Route::get('/SanggahanGambarUkur', 'BerkasPermohonanController@CreateSanggahanGambarUkur');         // Done
Route::post('/SanggahanGambarUkur', 'BerkasPermohonanController@StoreSanggahanGambarUkur');         // Done

Route::get('/UbahGambarUkur', 'BerkasPermohonanController@CreateUbahGambarUkur');                   // Done
Route::post('/UbahGambarUkur', 'BerkasPermohonanController@StoreUbahGambarUkur');                   // Done

/*Risalah Karyawan*/
Route::get('/Risalah', 'RisalahController@CreateRisalah');                                          // Done
Route::post('/Risalah', 'RisalahController@StoreRisalah');                                          // Done

Route::get('/UbahRisalah', 'RisalahController@CreateUbahRisalah');                                  // Done
Route::post('/UbahRisalah', 'RisalahController@StoreUbahRisalah');                                  // Done

/*Risalah Pemohon*/
Route::get('/ValidasiRisalah', 'RisalahController@CreateValidasiRisalah');                          // Done
Route::post('/ValidasiRisalah', 'RisalahController@StoreValidasiRisalah');                          // Done

/*Risalah Kepala Desa*/
Route::get('/VerifikasiRisalah', 'RisalahController@CreateVerifikasiRisalah');                      // Done
Route::post('/VerifikasiRisalah', 'RisalahController@StoreVerifikasiRisalah');                      // Done

/*Berkas Pengumuman Karyawan*/
Route::get('/PengajuanBPFY', 'BerkasPengumumanController@CreateBerkasPengumuman');                  // Done
Route::post('/PengajuanBPFY', 'BerkasPengumumanController@StoreBerkasPengumuman');                  // Done

Route::get('/UbahBPFY', 'BerkasPengumumanController@CreateUbahBerkasPengumuman');                   // Done
Route::post('/UbahBPFY', 'BerkasPengumumanController@StoreUbahBerkasPengumuman');                   // Done

Route::get('/ValidasiBPFY', 'BerkasPengumumanController@ValidasiBerkasPengumuman');                 // Done
Route::post('/ValidasiBPFY', 'BerkasPengumumanController@UpdateBerkasPengumuman');                  // Done

/*Surat Pengantar Karyawan*/
Route::get('/SuratPengantar', 'SuratPengantarController@CreateSuratPengantar');                     // Done
Route::post('/SuratPengantar', 'SuratPengantarController@StoreSuratPengantar');                     // Done

Route::get('/EditSuratPengantar', 'SuratPengantarController@EditSuratPengantar');                   // Done
Route::post('/EditSuratPengantar', 'SuratPengantarController@UpdateSuratPengantar');                // Done

Route::get('/VerifikasiSPKaryawan', 'SuratPengantarController@VerifikasiSPKaryawan');               // Done
Route::post('/VerifikasiSPKaryawan', 'SuratPengantarController@UpdateSPKaryawan');                  // Done

/*Surat Pengantar Kepala Desa*/
Route::get('/VerifikasiSPKepalaDesa', 'SuratPengantarController@VerifikasiSPKepalaDesa');           // Done
Route::post('/VerifikasiSPKepalaDesa', 'SuratPengantarController@UpdateSPKepalaDesa');              // Done

/*Berita Acara*/
Route::get('/BeritaAcara', 'BeritaAcaraController@CreateBeritaAcara');                              // Done
Route::post('/BeritaAcara', 'BeritaAcaraController@StoreBeritaAcara');                              // Done

Route::get('/VerifikasiBeritaAcara', 'BeritaAcaraController@VerifikasiBeritaAcara');                // Done
Route::post('/VerifikasiBeritaAcara', 'BeritaAcaraController@UpdateBeritaAcara');                   // Done

/*Print PDF*/
Route::get('/PrintRisalah', 'RisalahController@PrintRisalah');                                      // Done
Route::post('/PrintRisalah', 'RisalahController@PostPrintRisalah');                                 // Done

Route::get('/PrintBPFY', 'BerkasPengumumanController@PrintBPFY');                                   // Done
Route::post('/PrintBPFY', 'BerkasPengumumanController@PostPrintBPFY');                              // Done

Route::get('/PrintSuratPengantar', 'SuratPengantarController@PrintSuratPengantar');                 // Done
Route::post('/PrintSuratPengantar', 'SuratPengantarController@PostPrintSuratPengantar');            // Done

Route::get('/PrintBeritaAcara', 'BeritaAcaraController@PrintBeritaAcara');                          // Done
Route::post('/PrintBeritaAcara', 'BeritaAcaraController@PostPrintBeritaAcara');                     // Done
