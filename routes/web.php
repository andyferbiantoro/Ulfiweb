<?php

use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });

Route::get('/', 'AuthController@login')->name('login')->middleware('guest');
Route::get('/home', 'AuthController@login')->name('login')->middleware('guest');
Route::get('/register', 'AuthController@register')->name('register')->middleware('guest');
Route::post('/register-proses', 'AuthController@register_proses')->name('register_proses')->middleware('guest');
Route::post('/login-proses', 'AuthController@login_proses')->name('login-proses')->middleware('guest');



//AUDITOR
Route::get('/dashboard-auditor', 'AuditorController@index')->name('dashboard-auditor')->middleware('auditor', 'auth');
Route::get('/auditor-profil', 'AuditorController@auditor_profil')->name('auditor-profil')->middleware('auditor', 'auth');
Route::get('/auditor-pengumuman', 'AuditorController@pengumuman')->name('auditor-pengumuman')->middleware('auditor', 'auth');
Route::get('/auditor-lihat_pengumuman/{id}', 'auditorController@lihat_pengumuman')->name('auditor-lihat_pengumuman')->middleware('auditor', 'auth');
Route::get('/auditor-hasil_penilaian_lkps', 'AuditorController@hasil_penilaian_lkps')->name('auditor-hasil_penilaian_lkps')->middleware('auditor', 'auth');
Route::post('/auditor-tambah_hasil_penilaian_lkps', 'AuditorController@tambah_hasil_penilaian_lkps')->name('auditor-tambah_hasil_penilaian_lkps')->middleware('auditor', 'auth');
Route::get('/auditor-file_download/{id}', 'AuditorController@file_download')->name('auditor-file_download')->middleware('auditor', 'auth');
Route::post('/auditor-hapus_penilaian/{id}', 'AuditorController@hapus_penilaian')->name('auditor-hapus_penilaian')->middleware(['auditor', 'auth']);
Route::get('/auditor-edit_penilaian_lkps/{id}', 'AuditorController@edit_penilaian_lkps')->name('auditor-edit_penilaian_lkps')->middleware('auditor', 'auth');
Route::post('/auditor-proses_edit_penilaian_lkps/{id}', 'auditorController@proses_edit_penilaian_lkps')->name('auditor-proses_edit_penilaian_lkps')->middleware('auditor', 'auth');
Route::put('/auditor-proses_edit_file_penilaian/{id}', 'auditorController@proses_edit_file_penilaian')->name('auditor-proses_edit_file_penilaian')->middleware('auditor', 'auth');
Route::post('/auditor-proses_edit_profil/{id}', 'AuditorController@proses_edit_profil')->name('auditor-proses_edit_profil')->middleware('auditor', 'auth');



//KAPPM
Route::get('/dashboard-kappm', 'KappmController@index')->name('dashboard-kappm')->middleware('kappm', 'auth');
Route::get('/kappm-profil', 'KappmController@kappm_profil')->name('kappm-profil')->middleware('kappm', 'auth');
Route::get('/kappm-edit_akun/{id}', 'KappmController@edit_akun')->name('kappm-edit_akun')->middleware('kappm', 'auth');
Route::post('/kappm-proses_edit_akun/{id}', 'kappmController@proses_edit_akun')->name('kappm-proses_edit_akun')->middleware('kappm', 'auth');
Route::get('/kappm-pengumuman', 'KappmController@pengumuman')->name('kappm-pengumuman')->middleware('kappm', 'auth');
Route::post('/kappm-tambah_pengumuman', 'KappmController@tambah_pengumuman')->name('kappm-tambah_pengumuman')->middleware('kappm', 'auth');
Route::get('/kappm-lihat_pengumuman/{id}', 'KappmController@lihat_pengumuman')->name('kappm-lihat_pengumuman')->middleware('kappm', 'auth');
Route::get('/kappm-get_edit_pengumuman/{id}', 'KappmController@get_edit_pengumuman')->name('kappm-get_edit_pengumuman')->middleware('kappm', 'auth');
Route::post('/kappm-edit_pengumuman/{id}', 'KappmController@edit_pengumuman')->name('kappm-edit_pengumuman')->middleware('kappm', 'auth');
Route::post('/kappm-hapus_pengumuman/{id}', 'KappmController@hapus_pengumuman')->name('kappm-hapus_pengumuman')->middleware(['kappm', 'auth']);
Route::put('/kappm-edit_gambar/{id}', 'KappmController@edit_gambar')->name('kappm-edit_gambar/{id}')->middleware(['kappm', 'auth']);
Route::get('/kappm-hasil_penilaian_lkps', 'KappmController@hasil_penilaian_lkps')->name('kappm-hasil_penilaian_lkps')->middleware('kappm', 'auth');
Route::get('/kappm-file_penilian_download/{id}', 'KappmController@file_penilaian_download')->name('kappm-file_penilaian_download')->middleware('kappm', 'auth');
Route::post('/kappm-hapus_user/{id}', 'kappmController@hapus_user')->name('kappm-hapus_user')->middleware(['kappm', 'auth']);
Route::post('/kappm-tambah_akun', 'kappmController@tambah_akun')->name('kappm-tambah_akun')->middleware(['kappm', 'auth']);
Route::get('/kappm-perjanjian_kinerja', 'KappmController@perjanjian_kinerja')->name('kappm-perjanjian_kinerja')->middleware('kappm', 'auth');
Route::get('/kappm-file_perjanjian_download/{id}', 'KappmController@file_perjanjian_download')->name('kappm-file_perjanjian_download')->middleware('kappm', 'auth');

Route::get('/kappm-batas_waktu_lkps', 'KappmController@batas_waktu')->name('kappm-batas_waktu_lkps');
Route::post('/kappm-batas_waktu_lkps_add', 'KappmController@batas_waktu_add')->name('kappm-batas_waktu_lkps_add');
Route::post('/kappm-batas_waktu_lkps_update/{id}', 'KappmController@batas_waktu_update')->name('kappm-batas_waktu_lkps_update');
Route::post('/kappm-batas_waktu_lkps_delete/{id}', 'KappmController@batas_waktu_delete')->name('kappm-batas_waktu_lkps_delete');
Route::post('/kappm-batas_waktu_lkps_buka_akses/{id_prodi}', 'KappmController@batas_waktu_buka_akses')->name('kappm-batas_waktu_lkps_buka_akses');


Route::get('/kappm-penunjukan_auditor', 'KappmController@penunjukan_auditor')->name('kappm-penunjukan_auditor');
Route::post('/kappm-proses_penunjukan_auditor', 'KappmController@proses_penunjukan_auditor')->name('kappm-proses_penunjukan_auditor');



//PRODI
Route::get('/dashboard-prodi', 'ProdiController@index')->name('dashboard-prodi')->middleware('prodi', 'auth');
Route::get('/prodi-profil', 'ProdiController@prodi_profil')->name('prodi-profil')->middleware('prodi', 'auth');
Route::get('/prodi-pengumuman', 'ProdiController@pengumuman')->name('prodi-pengumuman')->middleware('prodi', 'auth');
Route::post('/prodi-tambah_pengumuman', 'ProdiController@tambah_pengumuman')->name('prodi-tambah_pengumuman')->middleware('prodi', 'auth');
Route::get('/prodi-lihat_pengumuman/{id}', 'ProdiController@lihat_pengumuman')->name('prodi-lihat_pengumuman')->middleware('prodi', 'auth');
Route::get('/prodi-get_edit_pengumuman/{id}', 'ProdiController@get_edit_pengumuman')->name('prodi-get_edit_pengumuman')->middleware('prodi', 'auth');
Route::post('/prodi-proses_edit_pengumuman/{id}', 'ProdiController@proses_edit_pengumuman')->name('prodi-proses_edit_pengumuman')->middleware('prodi', 'auth');
Route::put('/prodi-edit_gambar/{id}', 'ProdiController@edit_gambar')->name('prodi-edit_gambar/{id}')->middleware(['prodi', 'auth']);
Route::post('/prodi-hapus_pengumuman/{id}', 'ProdiController@hapus_pengumuman')->name('prodi-hapus_pengumuman')->middleware(['prodi', 'auth']);
Route::get('/prodi-hasil_penilaian_lkps', 'ProdiController@hasil_penilaian_lkps')->name('prodi-hasil_penilaian_lkps')->middleware('prodi', 'auth');
Route::get('/prodi-file_penilaian_download/{id}', 'ProdiController@file_penilaian_download')->name('prodi-file_penilaian_download')->middleware('prodi', 'auth');
Route::post('/prodi-proses_edit_profil/{id}', 'ProdiController@proses_edit_profil')->name('prodi-proses_edit_profil')->middleware('prodi', 'auth');
Route::get('/prodi-perjanjian_kinerja', 'ProdiController@perjanjian_kinerja')->name('prodi-perjanjian_kinerja')->middleware('prodi', 'auth');
Route::get('/prodi-file_perjanjian_download/{id}', 'ProdiController@file_perjanjian_download')->name('prodi-file_perjanjian_download')->middleware('prodi', 'auth');
Route::put('/prodi-edit_file_perjanjian/{id}', 'ProdiController@edit_file_perjanjian')->name('prodi-edit_file_perjanjian/{id}')->middleware(['prodi', 'auth']);
Route::post('/prodi-tambah_perjanjian', 'ProdiController@tambah_perjanjian')->name('prodi-tambah_perjanjian')->middleware('prodi', 'auth');
Route::post('/prodi-hapus_perjanjian/{id}', 'ProdiController@hapus_perjanjian')->name('prodi-hapus_perjanjian')->middleware(['prodi', 'auth']);
Route::get('/prodi-edit_perjanjian_kinerja/{id}', 'ProdiController@edit_perjanjian_kinerja')->name('prodi-edit_perjanjian_kinerja')->middleware('prodi', 'auth');
Route::post('/prodi-proses_edit_perjanjian_kinerja/{id}', 'ProdiController@proses_edit_perjanjian_kinerja')->name('prodi-proses_edit_perjanjian_kinerja')->middleware('prodi', 'auth');






//Auth
Route::get('logout-auditor', 'AuthController@logout')->name('logout-auditor')->middleware(['auditor', 'auth']);
Route::get('logout-kappm', 'AuthController@logout')->name('logout-kappm')->middleware(['kappm', 'auth']);
Route::get('logout-prodi', 'AuthController@logout')->name('logout-prodi')->middleware(['prodi', 'auth']);


Route::get('send-notif/{name}', function ($name) {
    event(new SendGlobalNotification($name));
    return "Event has been sent!";
});

//LKPS KAPPM
Route::get('/data_lkps', 'LkpsController@data_lkps')->name('data_lkps');
Route::get('/daftar_program_studi_upps', 'LkpsController@daftar_program_studi_upps')->name('daftar_program_studi_upps');

Route::get('/kerja_sama_tridharma_pendidikan', 'LkpsController@kerja_sama_tridharma_pendidikan')->name('kerja_sama_tridharma_pendidikan');
Route::get('/kerja_sama_tridharma_penelitian', 'LkpsController@kerja_sama_tridharma_penelitian')->name('kerja_sama_tridharma_penelitian');
Route::get('/kerja_sama_tridharma_pengabdian_kepada_masyarakat', 'LkpsController@kerja_sama_tridharma_pengabdian_kepada_masyarakat')->name('kerja_sama_tridharma_pengabdian_kepada_masyarakat');

Route::get('/mahasiswa_seleksi_mahasiswa_baru', 'LkpsController@mahasiswa_seleksi_mahasiswa_baru')->name('mahasiswa_seleksi_mahasiswa_baru');
Route::get('/lihat_mahasiswa_seleksi_mahasiswa_baru', 'LkpsController@lihat_mahasiswa_seleksi_mahasiswa_baru')->name('lihat_mahasiswa_seleksi_mahasiswa_baru');
Route::get('/mahasiswa_mahasiswa_asing', 'LkpsController@mahasiswa_mahasiswa_asing')->name('mahasiswa_mahasiswa_asing');
Route::get('/lihat_mahasiswa_mahasiswa_asing', 'LkpsController@lihat_mahasiswa_mahasiswa_asing')->name('lihat_mahasiswa_mahasiswa_asing');

Route::get('/profil_dosen_dosen_tetap_perguruan_tinggi', 'LkpsProfilDosenController@profil_dosen_dosen_tetap_perguruan_tinggi')->name('profil_dosen_dosen_tetap_perguruan_tinggi');
Route::get('/profil_dosen_dosen_pembimbing_utama_tugas_akhir', 'LkpsProfilDosenController@profil_dosen_dosen_pembimbing_utama_tugas_akhir')->name('profil_dosen_dosen_pembimbing_utama_tugas_akhir');
Route::get('/lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir', 'LkpsProfilDosenController@lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir')->name('lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir');
Route::get('/profil_dosen_ewmp_dosen_tetap_perguruan_tinggi', 'LkpsProfilDosenController@profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')->name('profil_dosen_ewmp_dosen_tetap_perguruan_tinggi');
Route::get('/lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi', 'LkpsProfilDosenController@lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')->name('lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi');
Route::get('/profil_dosen_dosen_tidak_tetap', 'LkpsProfilDosenController@profil_dosen_dosen_tidak_tetap')->name('profil_dosen_dosen_tidak_tetap');
Route::get('/profil_dosen_dosen_industri_praktisi', 'LkpsProfilDosenController@profil_dosen_dosen_industri_praktisi')->name('profil_dosen_dosen_industri_praktisi');

Route::get('/kinerja_dosen_pengakuan_rekognisi_dtps', 'LkpsKinerjaDosenController@kinerja_dosen_pengakuan_rekognisi_dtps')->name('kinerja_dosen_pengakuan_rekognisi_dtps');
Route::get('/kinerja_dosen_penelitian_dtps', 'LkpsKinerjaDosenController@kinerja_dosen_penelitian_dtps')->name('kinerja_dosen_penelitian_dtps');
Route::get('/lihat_kinerja_dosen_penelitian_dtps', 'LkpsKinerjaDosenController@lihat_kinerja_dosen_penelitian_dtps')->name('lihat_kinerja_dosen_penelitian_dtps');
Route::get('/kinerja_dosen_pengabdian_kepada_masyarakat_dtps', 'LkpsKinerjaDosenController@kinerja_dosen_pengabdian_kepada_masyarakat_dtps')->name('kinerja_dosen_pengabdian_kepada_masyarakat_dtps');
Route::get('/lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps', 'LkpsKinerjaDosenController@lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps')->name('lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps');
Route::get('/kinerja_dosen_publikasi_ilmiah_dtps', 'LkpsKinerjaDosenController@kinerja_dosen_publikasi_ilmiah_dtps')->name('kinerja_dosen_publikasi_ilmiah_dtps');
Route::get('/kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps', 'LkpsKinerjaDosenController@kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')->name('kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps');
Route::get('/lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps', 'LkpsKinerjaDosenController@lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')->name('lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps');
Route::get('/kinerja_dosen_karya_ilmiah_dtps_yang_disitasi', 'LkpsKinerjaDosenController@kinerja_dosen_karya_ilmiah_dtps_yang_disitasi')->name('kinerja_dosen_karya_ilmiah_dtps_yang_disitasi');
Route::get('/kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat', 'LkpsKinerjaDosenController@kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat')->name('kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat');
Route::get('/kinerja_dosen_hki_paten', 'LkpsKinerjaDosenController@kinerja_dosen_hki_paten')->name('kinerja_dosen_hki_paten');
Route::get('/kinerja_dosen_hki_hak_cipta', 'LkpsKinerjaDosenController@kinerja_dosen_hki_hak_cipta')->name('kinerja_dosen_hki_hak_cipta');
Route::get('/kinerja_dosen_teknologi_tepat_guna', 'LkpsKinerjaDosenController@kinerja_dosen_teknologi_tepat_guna')->name('kinerja_dosen_teknologi_tepat_guna');
Route::get('/kinerja_dosen_buku_berisbn', 'LkpsKinerjaDosenController@kinerja_dosen_buku_berisbn')->name('kinerja_dosen_buku_berisbn');

// --
Route::get('/penggunaan_dana', 'LkpsPenggunaanDanaController@penggunaan_dana')->name('penggunaan_dana');
Route::get('/lihat_penggunaan_dana', 'LkpsPenggunaanDanaController@lihat_penggunaan_dana')->name('lihat_penggunaan_dana');

Route::get('/pendidikan_kurikulum', 'LkpsPendidikanController@pendidikan_kurikulum')->name('pendidikan_kurikulum');
Route::get('/lihat_pendidikan_kurikulum', 'LkpsPendidikanController@lihat_pendidikan_kurikulum')->name('lihat_pendidikan_kurikulum');
Route::get('/pendidikan_integrasi_kegiatan_penelitian', 'LkpsPendidikanController@pendidikan_integrasi_kegiatan_penelitian')->name('pendidikan_integrasi_kegiatan_penelitian');
Route::get('/pendidikan_kepuasan_mahasiswa', 'LkpsPendidikanController@pendidikan_kepuasan_mahasiswa')->name('pendidikan_kepuasan_mahasiswa');
Route::get('/lihat_pendidikan_kepuasan_mahasiswa', 'LkpsPendidikanController@lihat_pendidikan_kepuasan_mahasiswa')->name('lihat_pendidikan_kepuasan_mahasiswa');

Route::get('/penelitian_dtps_yang_melibatkan_mahasiswa', 'LkpsPenelitianController@penelitian_dtps_yang_melibatkan_mahasiswa')->name('penelitian_dtps_yang_melibatkan_mahasiswa');

Route::get('/pkm_dtps_yang_melibatkan_mahasiswa', 'LkpsPengabdianKepadaMasyarakatController@pkm_dtps_yang_melibatkan_mahasiswa')->name('pkm_dtps_yang_melibatkan_mahasiswa');

Route::get('/ipk_lulusan', 'LkpsLuaranDanCapaianTridharmaController@ipk_lulusan')->name('ipk_lulusan');
Route::get('/lihat_ipk_lulusan', 'LkpsLuaranDanCapaianTridharmaController@lihat_ipk_lulusan')->name('lihat_ipk_lulusan');
Route::get('/prestasi_akademik_mahasiswa', 'LkpsLuaranDanCapaianTridharmaController@prestasi_akademik_mahasiswa')->name('prestasi_akademik_mahasiswa');
Route::get('/prestasi_non_akademik_mahasiswa', 'LkpsLuaranDanCapaianTridharmaController@prestasi_non_akademik_mahasiswa')->name('prestasi_non_akademik_mahasiswa');
Route::get('/masa_studi_lulusan_program_d3', 'LkpsLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_d3')->name('masa_studi_lulusan_program_d3');
Route::get('/lihat_masa_studi_lulusan_program_d3', 'LkpsLuaranDanCapaianTridharmaController@lihat_masa_studi_lulusan_program_d3')->name('lihat_masa_studi_lulusan_program_d3');
Route::get('/masa_studi_lulusan_program_sarajana_terapan', 'LkpsLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_sarajana_terapan')->name('masa_studi_lulusan_program_sarajana_terapan');
Route::get('/lihat_masa_studi_lulusan_program_sarjana_terapan', 'LkpsLuaranDanCapaianTridharmaController@lihat_masa_studi_lulusan_program_sarajana_terapan')->name('lihat_masa_studi_lulusan_program_sarjana_terapan');
Route::get('/waktu_tunggu_lulusan_program_d3', 'LkpsLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_d3')->name('waktu_tunggu_lulusan_program_d3');
Route::get('/lihat_waktu_tunggu_lulusan_program_d3', 'LkpsLuaranDanCapaianTridharmaController@lihat_waktu_tunggu_lulusan_program_d3')->name('lihat_waktu_tunggu_lulusan_program_d3');
Route::get('/waktu_tunggu_lulusan_program_sarajana_terapan', 'LkpsLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_sarajana_terapan')->name('waktu_tunggu_lulusan_program_sarajana_terapan');
Route::get('/lihat_waktu_tunggu_lulusan_program_sarajana_terapan', 'LkpsLuaranDanCapaianTridharmaController@lihat_waktu_tunggu_lulusan_program_sarajana_terapan')->name('lihat_waktu_tunggu_lulusan_program_sarajana_terapan');
Route::get('/kesesuaian_bidang_kerja_lulusan', 'LkpsLuaranDanCapaianTridharmaController@kesesuaian_bidang_kerja_lulusan')->name('kesesuaian_bidang_kerja_lulusan');
Route::get('/lihat_kesesuaian_bidang_kerja_lulusan', 'LkpsLuaranDanCapaianTridharmaController@lihat_kesesuaian_bidang_kerja_lulusan')->name('lihat_kesesuaian_bidang_kerja_lulusan');
Route::get('/tempat_kerja_lulusan', 'LkpsLuaranDanCapaianTridharmaController@tempat_kerja_lulusan')->name('tempat_kerja_lulusan');
Route::get('/lihat_tempat_kerja_lulusan', 'LkpsLuaranDanCapaianTridharmaController@lihat_tempat_kerja_lulusan')->name('lihat_tempat_kerja_lulusan');
Route::get('/referensi_kepuasan_pengguna_lulusan', 'LkpsLuaranDanCapaianTridharmaController@referensi_kepuasan_pengguna_lulusan')->name('referensi_kepuasan_pengguna_lulusan');
Route::get('/kepuasan_pengguna_lulusan', 'LkpsLuaranDanCapaianTridharmaController@kepuasan_pengguna_lulusan')->name('kepuasan_pengguna_lulusan');
Route::get('/lihat_kepuasan_pengguna_lulusan', 'LkpsLuaranDanCapaianTridharmaController@lihat_kepuasan_pengguna_lulusan')->name('lihat_kepuasan_pengguna_lulusan');

Route::get('/pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa', 'LkpsLuaranDanCapaianTridharmaController@pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')->name('pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa');
Route::get('/lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa', 'LkpsLuaranDanCapaianTridharmaController@lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')->name('lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa');
Route::get('/produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat', 'LkpsLuaranDanCapaianTridharmaController@produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat')->name('produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat');
Route::get('/mahasiswa_hki_paten', 'LkpsLuaranDanCapaianTridharmaController@mahasiswa_hki_paten')->name('mahasiswa_hki_paten');
Route::get('/mahasiswa_hki_hak_cipta', 'LkpsLuaranDanCapaianTridharmaController@mahasiswa_hki_hak_cipta')->name('mahasiswa_hki_hak_cipta');
Route::get('/mahasiswa_teknologi_tepat_guna', 'LkpsLuaranDanCapaianTridharmaController@mahasiswa_teknologi_tepat_guna')->name('mahasiswa_teknologi_tepat_guna');
Route::get('/mahasiswa_buku_berisbn', 'LkpsLuaranDanCapaianTridharmaController@mahasiswa_buku_berisbn')->name('mahasiswa_buku_berisbn');

//add komentar
Route::post('/kappm_komentar_add', 'KomentarController@komentar_add')->name('kappm_komentar_add');
Route::post('/kappm_balasan_add', 'KomentarController@balasan_add')->name('kappm_balasan_add');






//LKPS PRODI
Route::get('/prodi_data_lkps', 'LkpsProdiController@data_lkps')->name('prodi_data_lkps');
Route::get('/prodi-file_download_lkps/{id}', 'LkpsProdiController@file_download_lkps')->name('prodi-file_download_lkps');
Route::post('/prodi_data_lkps_add', 'LkpsProdiController@data_lkps_add')->name('prodi_data_lkps_add');
Route::post('/prodi_data_lkps_update/{id}', 'LkpsProdiController@data_lkps_update')->name('prodi_data_lkps_update');
Route::post('/prodi_data_lkps_delete/{id}', 'LkpsProdiController@data_lkps_delete')->name('prodi_data_lkps_delete');


Route::get('/prodi_daftar_program_studi_upps', 'LkpsProdiController@daftar_program_studi_upps')->name('prodi_daftar_program_studi_upps');
Route::get('/prodi-file_download_upps/{id}', 'LkpsProdiController@file_download_upps')->name('prodi-file_download_upps');
Route::post('/prodi_daftar_program_studi_upps_add', 'LkpsProdiController@daftar_program_studi_upps_add')->name('prodi_daftar_program_studi_upps_add');
Route::post('/prodi_daftar_program_studi_upps_update/{id}', 'LkpsProdiController@daftar_program_studi_upps_update')->name('prodi_daftar_program_studi_upps_update');
Route::post('/prodi_daftar_program_studi_upps_delete/{id}', 'LkpsProdiController@daftar_program_studi_upps_delete')->name('prodi_daftar_program_studi_upps_delete');


Route::get('/prodi_kerja_sama_tridharma_pendidikan', 'LkpsProdiController@kerja_sama_tridharma_pendidikan')->name('prodi_kerja_sama_tridharma_pendidikan');
Route::get('/prodi-file_download_pendidikan/{id}', 'LkpsProdiController@file_download_pendidikan')->name('prodi-file_download_pendidikan');
Route::post('/prodi_kerja_sama_tridharma_pendidikan_add', 'LkpsProdiController@kerja_sama_tridharma_pendidikan_add')->name('prodi_kerja_sama_tridharma_pendidikan_add');
Route::post('/prodi_kerja_sama_tridharma_pendidikan_update/{id}', 'LkpsProdiController@kerja_sama_tridharma_pendidikan_update')->name('prodi_kerja_sama_tridharma_pendidikan_update');
Route::post('/prodi_kerja_sama_tridharma_pendidikan_delete/{id}', 'LkpsProdiController@kerja_sama_tridharma_pendidikan_delete')->name('prodi_kerja_sama_tridharma_pendidikan_delete');

Route::get('/prodi_kerja_sama_tridharma_penelitian', 'LkpsProdiController@kerja_sama_tridharma_penelitian')->name('prodi_kerja_sama_tridharma_penelitian');
Route::get('/prodi-file_download_penelitian/{id}', 'LkpsProdiController@file_download_penelitian')->name('prodi-file_download_penelitian');
Route::post('/prodi_kerja_sama_tridharma_penelitian_add', 'LkpsProdiController@kerja_sama_tridharma_penelitian_add')->name('prodi_kerja_sama_tridharma_penelitian_add');
Route::post('/prodi_kerja_sama_tridharma_penelitian_update/{id}', 'LkpsProdiController@kerja_sama_tridharma_penelitian_update')->name('prodi_kerja_sama_tridharma_penelitian_update');
Route::post('/prodi_kerja_sama_tridharma_penelitian_delete/{id}', 'LkpsProdiController@kerja_sama_tridharma_penelitian_delete')->name('prodi_kerja_sama_tridharma_penelitian_delete');

Route::get('/prodi_kerja_sama_tridharma_pengabdian_kepada_masyarakat', 'LkpsProdiController@kerja_sama_tridharma_pengabdian_kepada_masyarakat')->name('prodi_kerja_sama_tridharma_pengabdian_kepada_masyarakat');
Route::get('/prodi-file_download_pkm/{id}', 'LkpsProdiController@file_download_pkm')->name('prodi-file_download_pkm');
Route::post('/prodi_kerja_sama_tridharma_pkm_add', 'LkpsProdiController@kerja_sama_tridharma_pkm_add')->name('prodi_kerja_sama_tridharma_pkm_add');
Route::post('/prodi_kerja_sama_tridharma_pkm_update/{id}', 'LkpsProdiController@kerja_sama_tridharma_pkm_update')->name('prodi_kerja_sama_tridharma_pkm_update');
Route::post('/prodi_kerja_sama_tridharma_pkm_delete/{id}', 'LkpsProdiController@kerja_sama_tridharma_pkm_delete')->name('prodi_kerja_sama_tridharma_pkm_delete');

Route::get('/prodi_mahasiswa_seleksi_mahasiswa_baru', 'LkpsProdiController@mahasiswa_seleksi_mahasiswa_baru')->name('prodi_mahasiswa_seleksi_mahasiswa_baru');
Route::get('/prodi-file_download_mhs_baru/{id}', 'LkpsProdiController@file_download_mhs_baru')->name('prodi-file_download_mhs_baru');
Route::post('/prodi_mahasiswa_seleksi_mahasiswa_baru_add', 'LkpsProdiController@mahasiswa_seleksi_mahasiswa_baru_add')->name('prodi_mahasiswa_seleksi_mahasiswa_baru_add');
Route::get('/prodi_lihat_mahasiswa_seleksi_mahasiswa_baru', 'LkpsProdiController@lihat_mahasiswa_seleksi_mahasiswa_baru')->name('prodi_lihat_mahasiswa_seleksi_mahasiswa_baru');
Route::post('/prodi_mahasiswa_seleksi_mahasiswa_baru_update/{id}', 'LkpsProdiController@mahasiswa_seleksi_mahasiswa_baru_update')->name('prodi_mahasiswa_seleksi_mahasiswa_baru_update');
Route::post('/prodi_mahasiswa_seleksi_mahasiswa_baru_delete/{id}', 'LkpsProdiController@mahasiswa_seleksi_mahasiswa_baru_delete')->name('prodi_mahasiswa_seleksi_mahasiswa_baru_delete');

Route::get('/prodi_mahasiswa_mahasiswa_asing', 'LkpsProdiController@mahasiswa_mahasiswa_asing')->name('prodi_mahasiswa_mahasiswa_asing');
Route::get('/prodi-file_download_mhs_asing/{id}', 'LkpsProdiController@file_download_mhs_asing')->name('prodi-file_download_mhs_asing');
Route::post('/prodi_mahasiswa_mahasiswa_asing_add', 'LkpsProdiController@mahasiswa_mahasiswa_asing_add')->name('prodi_mahasiswa_mahasiswa_asing_add');
Route::get('/prodi_lihat_mahasiswa_mahasiswa_asing', 'LkpsProdiController@lihat_mahasiswa_mahasiswa_asing')->name('prodi_lihat_mahasiswa_mahasiswa_asing');
Route::post('/prodi_mahasiswa_mahasiswa_asing_update/{id}', 'LkpsProdiController@mahasiswa_mahasiswa_asing_update')->name('prodi_mahasiswa_mahasiswa_asing_update');
Route::post('/prodi_mahasiswa_mahasiswa_asing_delete/{id}', 'LkpsProdiController@mahasiswa_mahasiswa_asing_delete')->name('prodi_mahasiswa_mahasiswa_asing_delete');


Route::get('/prodi_profil_dosen_dosen_tetap_perguruan_tinggi', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tetap_perguruan_tinggi')->name('prodi_profil_dosen_dosen_tetap_perguruan_tinggi');
Route::post('/prodi_profil_dosen_dosen_tetap_perguruan_tinggi_add', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tetap_perguruan_tinggi_add')->name('prodi_profil_dosen_dosen_tetap_perguruan_tinggi_add');
Route::get('/prodi-file_download_ser_pendidik/{id}', 'LkpsProdiProfilDosenController@file_download_ser_pendidik')->name('prodi-file_download_ser_pendidik');
Route::get('/prodi-file_download_ser_kompetensi/{id}', 'LkpsProdiProfilDosenController@file_download_ser_kompetensi')->name('prodi-file_download_ser_kompetensi');
Route::get('/prodi-file_download_bukti_dokumen/{id}', 'LkpsProdiProfilDosenController@file_download_bukti_dokumen')->name('prodi-file_download_bukti_dokumen');
Route::post('/prodi_profil_dosen_dosen_tetap_perguruan_tinggi_update/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tetap_perguruan_tinggi_update')->name('prodi_profil_dosen_dosen_tetap_perguruan_tinggi_update');
Route::post('/prodi_profil_dosen_dosen_tetap_perguruan_tinggi_delete/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tetap_perguruan_tinggi_delete')->name('prodi_profil_dosen_dosen_tetap_perguruan_tinggi_delete');


Route::get('/prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir', 'LkpsProdiProfilDosenController@profil_dosen_dosen_pembimbing_utama_tugas_akhir')->name('prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir');
Route::get('/prodi_lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir', 'LkpsProdiProfilDosenController@lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir')->name('prodi_lihat_profil_dosen_dosen_pembimbing_utama_tugas_akhir');
Route::post('/prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_add', 'LkpsProdiProfilDosenController@profil_dosen_dosen_pembimbing_utama_tugas_akhir_add')->name('prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_add');
Route::get('/prodi-file_download_bukti_dokumen_dospem/{id}', 'LkpsProdiProfilDosenController@file_download_bukti_dokumen_dospem')->name('prodi-file_download_bukti_dokumen_dospem');
Route::post('/prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_update/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_pembimbing_utama_tugas_akhir_update')->name('prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_update');
Route::post('/prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_delete/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_pembimbing_utama_tugas_akhir_delete')->name('prodi_profil_dosen_dosen_pembimbing_utama_tugas_akhir_delete');


Route::get('/prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi', 'LkpsProdiProfilDosenController@profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')->name('prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi');
Route::get('/prodi_lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi', 'LkpsProdiProfilDosenController@lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi')->name('prodi_lihat_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi');
Route::post('/prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_add', 'LkpsProdiProfilDosenController@profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_add')->name('prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_add');
Route::get('/prodi-file_download_bukti_dokumen_ewmp/{id}', 'LkpsProdiProfilDosenController@file_download_bukti_dokumen_ewmp')->name('prodi-file_download_bukti_dokumen_ewmp');
Route::post('/prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_update/{id}', 'LkpsProdiProfilDosenController@profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_update')->name('prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_update');
Route::post('/prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_delete/{id}', 'LkpsProdiProfilDosenController@profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_delete')->name('prodi_profil_dosen_ewmp_dosen_tetap_perguruan_tinggi_delete');


Route::get('/prodi_profil_dosen_dosen_tidak_tetap', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tidak_tetap')->name('prodi_profil_dosen_dosen_tidak_tetap');
Route::post('/prodi_profil_dosen_dosen_tidak_tetap_add', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tidak_tetap_add')->name('prodi_profil_dosen_dosen_tidak_tetap_add');
Route::get('/prodi-file_download_ser_pendidik_tidak_tetap/{id}', 'LkpsProdiProfilDosenController@file_download_ser_pendidik_tidak_tetap')->name('prodi-file_download_ser_pendidik_tidak_tetap');
Route::get('/prodi-file_download_ser_kompetensi_tidak_tetap/{id}', 'LkpsProdiProfilDosenController@file_download_ser_kompetensi_tidak_tetap')->name('prodi-file_download_ser_kompetensi_tidak_tetap');
Route::get('/prodi-file_download_bukti_dokumen_tidak_tetap/{id}', 'LkpsProdiProfilDosenController@file_download_bukti_dokumen_tidak_tetap')->name('prodi-file_download_bukti_dokumen_tidak_tetap');
Route::post('/prodi_profil_dosen_dosen_tidak_tetap_update/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tidak_tetap_update')->name('prodi_profil_dosen_dosen_tidak_tetap_update');
Route::post('/prodi_profil_dosen_dosen_tidak_tetap_delete/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_tidak_tetap_delete')->name('prodi_profil_dosen_dosen_tidak_tetap_delete');


Route::get('/prodi_profil_dosen_dosen_industri_praktisi', 'LkpsProdiProfilDosenController@profil_dosen_dosen_industri_praktisi')->name('prodi_profil_dosen_dosen_industri_praktisi');
Route::post('/prodi_profil_dosen_dosen_industri_praktisi_add', 'LkpsProdiProfilDosenController@profil_dosen_dosen_industri_praktisi_add')->name('prodi_profil_dosen_dosen_industri_praktisi_add');
Route::get('/prodi-file_download_ser_kompetensi_industri/{id}', 'LkpsProdiProfilDosenController@file_download_ser_kompetensi_industri')->name('prodi-file_download_ser_kompetensi_industri');
Route::get('/prodi-file_download_bukti_dokumen_industri/{id}', 'LkpsProdiProfilDosenController@file_download_bukti_dokumen_industri')->name('prodi-file_download_bukti_dokumen_industri');
Route::post('/prodi_profil_dosen_dosen_industri_praktisi_update/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_industri_praktisi_update')->name('prodi_profil_dosen_dosen_industri_praktisi_update');
Route::post('/prodi_profil_dosen_dosen_industri_praktisi_delete/{id}', 'LkpsProdiProfilDosenController@profil_dosen_dosen_industri_praktisi_delete')->name('prodi_profil_dosen_dosen_industri_praktisi_delete');


Route::get('/prodi_kinerja_dosen_pengakuan_rekognisi_dtps', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengakuan_rekognisi_dtps')->name('prodi_kinerja_dosen_pengakuan_rekognisi_dtps');
Route::post('/prodi_kinerja_dosen_pengakuan_rekognisi_dtps_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengakuan_rekognisi_dtps_add')->name('prodi_kinerja_dosen_pengakuan_rekognisi_dtps_add');
Route::get('/prodi-file_download_bukti_pendukung/{id}', 'LkpsProdiProfilDosenController@file_download_bukti_pendukung')->name('prodi-file_download_bukti_pendukung');
Route::post('/prodi_kinerja_dosen_pengakuan_rekognisi_dtps_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengakuan_rekognisi_dtps_update')->name('prodi_kinerja_dosen_pengakuan_rekognisi_dtps_update');
Route::post('/prodi_kinerja_dosen_pengakuan_rekognisi_dtps_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengakuan_rekognisi_dtps_delete')->name('prodi_kinerja_dosen_pengakuan_rekognisi_dtps_delete');


Route::get('/prodi_kinerja_dosen_penelitian_dtps', 'LkpsProdiKinerjaDosenController@kinerja_dosen_penelitian_dtps')->name('prodi_kinerja_dosen_penelitian_dtps');
Route::post('/prodi_kinerja_dosen_penelitian_dtps_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_penelitian_dtps_add')->name('prodi_kinerja_dosen_penelitian_dtps_add');
Route::get('/prodi_lihat_kinerja_dosen_penelitian_dtps', 'LkpsProdiKinerjaDosenController@lihat_kinerja_dosen_penelitian_dtps')->name('prodi_lihat_kinerja_dosen_penelitian_dtps');
Route::get('/prodi-file_download_file_bukti_dokumen/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_bukti_dokumen')->name('prodi-file_download_file_bukti_dokumen');
Route::post('/prodi_kinerja_dosen_penelitian_dtps_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_penelitian_dtps_update')->name('prodi_kinerja_dosen_penelitian_dtps_update');
Route::post('/prodi_kinerja_dosen_penelitian_dtps_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_penelitian_dtps_delete')->name('prodi_kinerja_dosen_penelitian_dtps_delete');



Route::get('/prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengabdian_kepada_masyarakat_dtps')->name('prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps');
Route::get('/prodi_lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps', 'LkpsProdiKinerjaDosenController@lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps')->name('prodi_lihat_kinerja_dosen_pengabdian_kepada_masyarakat_dtps');
Route::post('/prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengabdian_kepada_masyarakat_dtps_add')->name('prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps_add');
Route::get('/prodi-file_download_file_bukti_dokumen_pkm/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_bukti_dokumen_pkm')->name('prodi-file_download_file_bukti_dokumen_pkm');
Route::post('/prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengabdian_kepada_masyarakat_dtps_update')->name('prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps_update');
Route::post('/prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pengabdian_kepada_masyarakat_dtps_delete')->name('prodi_kinerja_dosen_pengabdian_kepada_masyarakat_dtps_delete');


Route::get('/prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')->name('prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps');
Route::get('/prodi_lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps', 'LkpsProdiKinerjaDosenController@lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps')->name('prodi_lihat_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps');
Route::get('/prodi-file_download_file_bukti_dokumen_ilmiah_pkm/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_bukti_dokumen_ilmiah_pkm')->name('prodi-file_download_file_bukti_dokumen_ilmiah_pkm');
Route::post('/prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_add')->name('prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_add');
Route::post('/prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_update')->name('prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_update');
Route::post('/prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_delete')->name('prodi_kinerja_dosen_pagelaran_pameran_prestasi_publikasi_ilmiah_dtps_delete');


Route::get('/prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi', 'LkpsProdiKinerjaDosenController@kinerja_dosen_karya_ilmiah_dtps_yang_disitasi')->name('prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi');
Route::get('/prodi-file_download_file_bukti_sitasi/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_bukti_sitasi')->name('prodi-file_download_file_bukti_sitasi');
Route::post('/prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_add')->name('prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_add');
Route::post('/prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_update')->name('prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_update');
Route::post('/prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_delete')->name('prodi_kinerja_dosen_karya_ilmiah_dtps_yang_disitasi_delete');


Route::get('/prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat', 'LkpsProdiKinerjaDosenController@kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat')->name('prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat');
Route::get('/prodi-file_download_file_bukti_produk_dtps/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_bukti_produk_dtps')->name('prodi-file_download_file_bukti_produk_dtps');
Route::post('/prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_add')->name('prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_add');
Route::post('/prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_update')->name('prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_update');
Route::post('/prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_delete')->name('prodi_kinerja_dosen_produk_jasa_dtps_diadopsi_oleh_industri_masyarakat_delete');



Route::get('/prodi_kinerja_dosen_hki_paten', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_paten')->name('prodi_kinerja_dosen_hki_paten');
Route::get('/prodi-file_download_file_hki/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_hki')->name('prodi-file_download_file_hki');
Route::post('/prodi_kinerja_dosen_hki_paten_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_paten_add')->name('prodi_kinerja_dosen_hki_paten_add');
Route::post('/prodi_kinerja_dosen_hki_paten_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_paten_update')->name('prodi_kinerja_dosen_hki_paten_update');
Route::post('/prodi_kinerja_dosen_hki_paten_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_paten_delete')->name('prodi_kinerja_dosen_hki_paten_delete');



Route::get('/prodi_kinerja_dosen_hki_hak_cipta', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_hak_cipta')->name('prodi_kinerja_dosen_hki_hak_cipta');
Route::get('/prodi-file_download_file_hki_hak_cipta/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_hki_hak_cipta')->name('prodi-file_download_file_hki_hak_cipta');
Route::post('/prodi_kinerja_dosen_hki_hak_cipta_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_hak_cipta_add')->name('prodi_kinerja_dosen_hki_hak_cipta_add');
Route::post('/prodi_kinerja_dosen_hki_hak_cipta_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_hak_cipta_update')->name('prodi_kinerja_dosen_hki_hak_cipta_update');
Route::post('/prodi_kinerja_dosen_hki_hak_cipta_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_hki_hak_cipta_delete')->name('prodi_kinerja_dosen_hki_hak_cipta_delete');


Route::get('/prodi_kinerja_dosen_teknologi_tepat_guna', 'LkpsProdiKinerjaDosenController@kinerja_dosen_teknologi_tepat_guna')->name('prodi_kinerja_dosen_teknologi_tepat_guna');
Route::get('/prodi-file_download_file_teknologi_tepat_guna/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_teknologi_tepat_guna')->name('prodi-file_download_file_teknologi_tepat_guna');
Route::post('/prodi_kinerja_dosen_teknologi_tepat_guna_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_teknologi_tepat_guna_add')->name('prodi_kinerja_dosen_teknologi_tepat_guna_add');
Route::post('/prodi_kinerja_dosen_teknologi_tepat_guna_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_teknologi_tepat_guna_update')->name('prodi_kinerja_dosen_teknologi_tepat_guna_update');
Route::post('/prodi_kinerja_dosen_teknologi_tepat_guna_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_teknologi_tepat_guna_delete')->name('prodi_kinerja_dosen_teknologi_tepat_guna_delete');


Route::get('/prodi_kinerja_dosen_buku_berisbn', 'LkpsProdiKinerjaDosenController@kinerja_dosen_buku_berisbn')->name('prodi_kinerja_dosen_buku_berisbn');
Route::get('/prodi-file_download_file_buku_berisbn/{id}', 'LkpsProdiKinerjaDosenController@file_download_file_buku_berisbn')->name('prodi-file_download_file_buku_berisbn');
Route::post('/prodi_kinerja_dosen_buku_berisbn_add', 'LkpsProdiKinerjaDosenController@kinerja_dosen_buku_berisbn_add')->name('prodi_kinerja_dosen_buku_berisbn_add');
Route::post('/prodi_kinerja_dosen_buku_berisbn_update/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_buku_berisbn_update')->name('prodi_kinerja_dosen_buku_berisbn_update');
Route::post('/prodi_kinerja_dosen_buku_berisbn_delete/{id}', 'LkpsProdiKinerjaDosenController@kinerja_dosen_buku_berisbn_delete')->name('prodi_kinerja_dosen_buku_berisbn_delete');



Route::get('/prodi_penggunaan_dana', 'LkpsProdiPenggunaanDanaController@penggunaan_dana')->name('prodi_penggunaan_dana');
Route::get('/prodi_lihat_penggunaan_dana', 'LkpsProdiPenggunaanDanaController@lihat_penggunaan_dana')->name('prodi_lihat_penggunaan_dana');
Route::post('/prodi_penggunaan_dana_add', 'LkpsProdiPenggunaanDanaController@penggunaan_dana_add')->name('prodi_penggunaan_dana_add');
Route::post('/prodi_penggunaan_dana_update/{id}', 'LkpsProdiPenggunaanDanaController@penggunaan_dana_update')->name('prodi_penggunaan_dana_update');
Route::post('/prodi_penggunaan_dana_delete/{id}', 'LkpsProdiPenggunaanDanaController@penggunaan_dana_delete')->name('prodi_penggunaan_dana_delete');
Route::get('/prodi-file_download_dokumen_penggunaan_dana/{id}', 'LkpsProdiPenggunaanDanaController@file_download_dokumen_penggunaan_dana')->name('prodi-file_download_dokumen_penggunaan_dana');




Route::get('/prodi_pendidikan_kurikulum', 'LkpsProdiPendidikanController@pendidikan_kurikulum')->name('prodi_pendidikan_kurikulum');
Route::get('/prodi_lihat_pendidikan_kurikulum', 'LkpsProdiPendidikanController@lihat_pendidikan_kurikulum')->name('prodi_lihat_pendidikan_kurikulum');
Route::post('/prodi_pendidikan_kurikulum_add', 'LkpsProdiPendidikanController@pendidikan_kurikulum_add')->name('prodi_pendidikan_kurikulum_add');
Route::post('/prodi_pendidikan_kurikulum_update/{id}', 'LkpsProdiPendidikanController@pendidikan_kurikulum_update')->name('prodi_pendidikan_kurikulum_update');
Route::post('/prodi_pendidikan_kurikulum_delete/{id}', 'LkpsProdiPendidikanController@pendidikan_kurikulum_delete')->name('prodi_pendidikan_kurikulum_delete');



Route::get('/prodi_pendidikan_integrasi_kegiatan_penelitian', 'LkpsProdiPendidikanController@pendidikan_integrasi_kegiatan_penelitian')->name('prodi_pendidikan_integrasi_kegiatan_penelitian');
Route::post('/prodi_pendidikan_integrasi_kegiatan_penelitian_add', 'LkpsProdiPendidikanController@pendidikan_integrasi_kegiatan_penelitian_add')->name('prodi_pendidikan_integrasi_kegiatan_penelitian_add');
Route::post('/prodi_pendidikan_integrasi_kegiatan_penelitian_update/{id}', 'LkpsProdiPendidikanController@pendidikan_integrasi_kegiatan_penelitian_update')->name('prodi_pendidikan_integrasi_kegiatan_penelitian_update');
Route::post('/prodi_pendidikan_integrasi_kegiatan_penelitian_delete/{id}', 'LkpsProdiPendidikanController@pendidikan_integrasi_kegiatan_penelitian_delete')->name('prodi_pendidikan_integrasi_kegiatan_penelitian_delete');
Route::get('/prodi-file_download_dokumen_integrasi/{id}', 'LkpsProdiPendidikanController@file_download_dokumen_integrasi')->name('prodi-file_download_dokumen_integrasi');


Route::get('/prodi_pendidikan_kepuasan_mahasiswa', 'LkpsProdiPendidikanController@pendidikan_kepuasan_mahasiswa')->name('prodi_pendidikan_kepuasan_mahasiswa');
Route::get('/prodi_lihat_pendidikan_kepuasan_mahasiswa', 'LkpsProdiPendidikanController@lihat_pendidikan_kepuasan_mahasiswa')->name('prodi_lihat_pendidikan_kepuasan_mahasiswa');
Route::get('/prodi-file_download_dokumen_kepuasan_mhs/{id}', 'LkpsProdiPendidikanController@file_download_dokumen_kepuasan_mhs')->name('prodi-file_download_dokumen_kepuasan_mhs');
Route::post('/prodi_pendidikan_kepuasan_mahasiswa_add', 'LkpsProdiPendidikanController@pendidikan_kepuasan_mahasiswa_add')->name('prodi_pendidikan_kepuasan_mahasiswa_add');
Route::post('/prodi_pendidikan_kepuasan_mahasiswa_update/{id}', 'LkpsProdiPendidikanController@pendidikan_kepuasan_mahasiswa_update')->name('prodi_pendidikan_kepuasan_mahasiswa_update');
Route::post('/prodi_pendidikan_kepuasan_mahasiswa_delete/{id}', 'LkpsProdiPendidikanController@pendidikan_kepuasan_mahasiswa_delete')->name('prodi_pendidikan_kepuasan_mahasiswa_delete');



Route::get('/prodi_penelitian_dtps_yang_melibatkan_mahasiswa', 'LkpsProdiPenelitianController@penelitian_dtps_yang_melibatkan_mahasiswa')->name('prodi_penelitian_dtps_yang_melibatkan_mahasiswa');
Route::post('/prodi_penelitian_dtps_yang_melibatkan_mahasiswa_add', 'LkpsProdiPenelitianController@penelitian_dtps_yang_melibatkan_mahasiswa_add')->name('prodi_penelitian_dtps_yang_melibatkan_mahasiswa_add');
Route::post('/prodi_penelitian_dtps_yang_melibatkan_mahasiswa_update/{id}', 'LkpsProdiPenelitianController@penelitian_dtps_yang_melibatkan_mahasiswa_update')->name('prodi_penelitian_dtps_yang_melibatkan_mahasiswa_update');
Route::post('/prodi_penelitian_dtps_yang_melibatkan_mahasiswa_delete/{id}', 'LkpsProdiPenelitianController@penelitian_dtps_yang_melibatkan_mahasiswa_delete')->name('prodi_penelitian_dtps_yang_melibatkan_mahasiswa_delete');
Route::get('/prodi-file_download_dokumen_penelitian_mhs/{id}', 'LkpsProdiPenelitianController@file_download_dokumen_penelitian_mhs')->name('prodi-file_download_dokumen_penelitian_mhs');


Route::get('/prodi_pkm_dtps_yang_melibatkan_mahasiswa', 'LkpsProdiPengabdianKepadaMasyarakatController@pkm_dtps_yang_melibatkan_mahasiswa')->name('prodi_pkm_dtps_yang_melibatkan_mahasiswa');
Route::post('/prodi_pkm_dtps_yang_melibatkan_mahasiswa_add', 'LkpsProdiPengabdianKepadaMasyarakatController@pkm_dtps_yang_melibatkan_mahasiswa_add')->name('prodi_pkm_dtps_yang_melibatkan_mahasiswa_add');
Route::post('/prodi_pkm_dtps_yang_melibatkan_mahasiswa_update/{id}', 'LkpsProdiPengabdianKepadaMasyarakatController@pkm_dtps_yang_melibatkan_mahasiswa_update')->name('prodi_pkm_dtps_yang_melibatkan_mahasiswa_update');
Route::post('/prodi_pkm_dtps_yang_melibatkan_mahasiswa_delete/{id}', 'LkpsProdiPengabdianKepadaMasyarakatController@pkm_dtps_yang_melibatkan_mahasiswa_delete')->name('prodi_pkm_dtps_yang_melibatkan_mahasiswa_delete');
Route::get('/prodi-file_download_dokumen_pkm_mhs/{id}', 'LkpsProdiPengabdianKepadaMasyarakatController@file_download_dokumen_pkm_mhs')->name('prodi-file_download_dokumen_pkm_mhs');


Route::get('/prodi_ipk_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@ipk_lulusan')->name('prodi_ipk_lulusan');
Route::get('/prodi_lihat_ipk_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_ipk_lulusan')->name('prodi_lihat_ipk_lulusan');
Route::post('/prodi_ipk_lulusan_add', 'LkpsProdiLuaranDanCapaianTridharmaController@ipk_lulusan_add')->name('prodi_ipk_lulusan_add');
Route::post('/prodi_ipk_lulusan_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@ipk_lulusan_update')->name('prodi_ipk_lulusan_update');
Route::post('/prodi_ipk_lulusan_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@ipk_lulusan_delete')->name('prodi_ipk_lulusan_delete');
Route::get('/prodi-file_download_dokumen_ipk_lulusan/{id}', 'LkpsProdiPengabdianKepadaMasyarakatController@file_download_dokumen_ipk_lulusan')->name('prodi-file_download_dokumen_ipk_lulusan');



Route::get('/prodi_prestasi_akademik_mahasiswa', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_akademik_mahasiswa')->name('prodi_prestasi_akademik_mahasiswa');
Route::post('/prodi_prestasi_akademik_mahasiswa_add', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_akademik_mahasiswa_add')->name('prodi_prestasi_akademik_mahasiswa_add');
Route::post('/prodi_prestasi_akademik_mahasiswa_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_akademik_mahasiswa_update')->name('prodi_prestasi_akademik_mahasiswa_update');
Route::post('/prodi_prestasi_akademik_mahasiswa_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_akademik_mahasiswa_delete')->name('prodi_prestasi_akademik_mahasiswa_delete');
Route::get('/prodi-file_download_dokumen_prestasi_akademik/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_prestasi_akademik')->name('prodi-file_download_dokumen_prestasi_akademik');


Route::get('/prodi_prestasi_non_akademik_mahasiswa', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_non_akademik_mahasiswa')->name('prodi_prestasi_non_akademik_mahasiswa');
Route::post('/prodi_prestasi_non_akademik_mahasiswa_add', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_non_akademik_mahasiswa_add')->name('prodi_prestasi_non_akademik_mahasiswa_add');
Route::post('/prodi_prestasi_non_akademik_mahasiswa_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_non_akademik_mahasiswa_update')->name('prodi_prestasi_non_akademik_mahasiswa_update');
Route::post('/prodi_prestasi_non_akademik_mahasiswa_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@prestasi_non_akademik_mahasiswa_delete')->name('prodi_prestasi_non_akademik_mahasiswa_delete');
Route::get('/prodi-file_download_dokumen_prestasi_non_akademik/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_prestasi_non_akademik')->name('prodi-file_download_dokumen_prestasi_non_akademik');



Route::get('/prodi_masa_studi_lulusan_program_d3', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_d3')->name('prodi_masa_studi_lulusan_program_d3');
Route::get('/prodi_lihat_masa_studi_lulusan_program_d3', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_masa_studi_lulusan_program_d3')->name('prodi_lihat_masa_studi_lulusan_program_d3');
Route::post('/prodi_masa_studi_lulusan_program_d3_add', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_d3_add')->name('prodi_masa_studi_lulusan_program_d3_add');
Route::post('/prodi_masa_studi_lulusan_program_d3_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_d3_update')->name('prodi_masa_studi_lulusan_program_d3_update');
Route::post('/prodi_masa_studi_lulusan_program_d3_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_d3_delete')->name('prodi_masa_studi_lulusan_program_d3_delete');
Route::get('/prodi-file_download_dokumen_masastudi_d3/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_masastudi_d3')->name('prodi-file_download_dokumen_masastudi_d3');


Route::get('/prodi_masa_studi_lulusan_program_sarajana_terapan', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_sarajana_terapan')->name('prodi_masa_studi_lulusan_program_sarajana_terapan');
Route::get('/prodi_lihat_masa_studi_lulusan_program_sarjana_terapan', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_masa_studi_lulusan_program_sarajana_terapan')->name('prodi_lihat_masa_studi_lulusan_program_sarjana_terapan');
Route::post('/prodi_masa_studi_lulusan_program_sarajana_terapan_add', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_sarajana_terapan_add')->name('prodi_masa_studi_lulusan_program_sarajana_terapan_add');
Route::post('/prodi_masa_studi_lulusan_program_sarajana_terapan_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_sarajana_terapan_update')->name('prodi_masa_studi_lulusan_program_sarajana_terapan_update');
Route::post('/prodi_masa_studi_lulusan_program_sarajana_terapan_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@masa_studi_lulusan_program_sarajana_terapan_delete')->name('prodi_masa_studi_lulusan_program_sarajana_terapan_delete');
Route::get('/prodi-file_download_dokumen_masastudi_sarajana_terapan/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_masastudi_sarajana_terapan')->name('prodi-file_download_dokumen_masastudi_sarajana_terapan');



Route::get('/prodi_waktu_tunggu_lulusan_program_d3', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_d3')->name('prodi_waktu_tunggu_lulusan_program_d3');
Route::get('/prodi_lihat_waktu_tunggu_lulusan_program_d3', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_waktu_tunggu_lulusan_program_d3')->name('prodi_lihat_waktu_tunggu_lulusan_program_d3');
Route::post('/prodi_waktu_tunggu_lulusan_program_d3_add', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_d3_add')->name('prodi_waktu_tunggu_lulusan_program_d3_add');
Route::post('/prodi_waktu_tunggu_lulusan_program_d3_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_d3_update')->name('prodi_waktu_tunggu_lulusan_program_d3_update');
Route::post('/prodi_waktu_tunggu_lulusan_program_d3_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_d3_delete')->name('prodi_waktu_tunggu_lulusan_program_d3_delete');
Route::get('/prodi-file_download_dokumen_tunggu_d3/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_tunggu_d3')->name('prodi-file_download_dokumen_tunggu_d3');


Route::get('/prodi_waktu_tunggu_lulusan_program_sarajana_terapan', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_sarajana_terapan')->name('prodi_waktu_tunggu_lulusan_program_sarajana_terapan');
Route::get('/prodi_lihat_waktu_tunggu_lulusan_program_sarajana_terapan', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_waktu_tunggu_lulusan_program_sarajana_terapan')->name('prodi_lihat_waktu_tunggu_lulusan_program_sarajana_terapan');
Route::post('/prodi_waktu_tunggu_lulusan_program_sarjana_terapan_add', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_sarjana_terapan_add')->name('prodi_waktu_tunggu_lulusan_program_sarjana_terapan_add');
Route::post('/prodi_waktu_tunggu_lulusan_program_sarjana_terapan_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_sarjana_terapan_update')->name('prodi_waktu_tunggu_lulusan_program_sarjana_terapan_update');
Route::post('/prodi_waktu_tunggu_lulusan_program_sarjana_terapan_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@waktu_tunggu_lulusan_program_sarjana_terapan_delete')->name('prodi_waktu_tunggu_lulusan_program_sarjana_terapan_delete');
Route::get('/prodi-file_download_dokumen_tunggu_sarjana_terapan/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_tunggu_sarjana_terapan')->name('prodi-file_download_dokumen_tunggu_sarjana_terapan');



Route::get('/prodi_kesesuaian_bidang_kerja_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@kesesuaian_bidang_kerja_lulusan')->name('prodi_kesesuaian_bidang_kerja_lulusan');
Route::get('/prodi_lihat_kesesuaian_bidang_kerja_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_kesesuaian_bidang_kerja_lulusan')->name('prodi_lihat_kesesuaian_bidang_kerja_lulusan');
Route::post('/prodi_kesesuaian_bidang_kerja_lulusan_add', 'LkpsProdiLuaranDanCapaianTridharmaController@kesesuaian_bidang_kerja_lulusan_add')->name('prodi_kesesuaian_bidang_kerja_lulusan_add');
Route::post('/prodi_kesesuaian_bidang_kerja_lulusan_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@kesesuaian_bidang_kerja_lulusan_update')->name('prodi_kesesuaian_bidang_kerja_lulusan_update');
Route::post('/prodi_kesesuaian_bidang_kerja_lulusan_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@kesesuaian_bidang_kerja_lulusan_delete')->name('prodi_kesesuaian_bidang_kerja_lulusan_delete');
Route::get('/prodi-file_download_dokumen_kesesuaian_bidang/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_kesesuaian_bidang')->name('prodi-file_download_dokumen_kesesuaian_bidang');



Route::get('/prodi_tempat_kerja_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@tempat_kerja_lulusan')->name('prodi_tempat_kerja_lulusan');
Route::get('/prodi_lihat_tempat_kerja_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_tempat_kerja_lulusan')->name('prodi_lihat_tempat_kerja_lulusan');
Route::post('/prodi_tempat_kerja_lulusan_add', 'LkpsProdiLuaranDanCapaianTridharmaController@tempat_kerja_lulusan_add')->name('prodi_tempat_kerja_lulusan_add');
Route::post('/prodi_tempat_kerja_lulusan_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@tempat_kerja_lulusan_update')->name('prodi_tempat_kerja_lulusan_update');
Route::post('/prodi_tempat_kerja_lulusan_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@tempat_kerja_lulusan_delete')->name('prodi_tempat_kerja_lulusan_delete');
Route::get('/prodi-file_download_dokumen_tempat_kerja_lulusan/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_tempat_kerja_lulusan')->name('prodi-file_download_dokumen_tempat_kerja_lulusan');


Route::get('/prodi_referensi_kepuasan_pengguna_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@referensi_kepuasan_pengguna_lulusan')->name('prodi_referensi_kepuasan_pengguna_lulusan');
Route::post('/prodi_referensi_kepuasan_pengguna_lulusan_add', 'LkpsProdiLuaranDanCapaianTridharmaController@referensi_kepuasan_pengguna_lulusan_add')->name('prodi_referensi_kepuasan_pengguna_lulusan_add');
Route::post('/prodi_referensi_kepuasan_pengguna_lulusan_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@referensi_kepuasan_pengguna_lulusan_update')->name('prodi_referensi_kepuasan_pengguna_lulusan_update');
Route::post('/prodi_referensi_kepuasan_pengguna_lulusan_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@referensi_kepuasan_pengguna_lulusan_delete')->name('prodi_referensi_kepuasan_pengguna_lulusan_delete');
Route::get('/prodi-file_download_dokumen_referensi_kepuasan/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_referensi_kepuasan')->name('prodi-file_download_dokumen_referensi_kepuasan');



Route::get('/prodi_kepuasan_pengguna_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@kepuasan_pengguna_lulusan')->name('prodi_kepuasan_pengguna_lulusan');
Route::get('/prodi_lihat_kepuasan_pengguna_lulusan', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_kepuasan_pengguna_lulusan')->name('prodi_lihat_kepuasan_pengguna_lulusan');
Route::post('/prodi_kepuasan_pengguna_lulusan_add', 'LkpsProdiLuaranDanCapaianTridharmaController@kepuasan_pengguna_lulusan_add')->name('prodi_kepuasan_pengguna_lulusan_add');
Route::post('/prodi_kepuasan_pengguna_lulusan_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@kepuasan_pengguna_lulusan_update')->name('prodi_kepuasan_pengguna_lulusan_update');
Route::post('/prodi_kepuasan_pengguna_lulusan_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@kepuasan_pengguna_lulusan_delete')->name('prodi_kepuasan_pengguna_lulusan_delete');
Route::get('/prodi-file_download_dokumen_kepuasan_pengguna_lulusan/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_kepuasan_pengguna_lulusan')->name('prodi-file_download_dokumen_kepuasan_pengguna_lulusan');



Route::get('/prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa', 'LkpsProdiLuaranDanCapaianTridharmaController@pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')->name('prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa');
Route::get('/prodi_lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa', 'LkpsProdiLuaranDanCapaianTridharmaController@lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa')->name('prodi_lihat_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa');
Route::post('/prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_add', 'LkpsProdiLuaranDanCapaianTridharmaController@pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_add')->name('prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_add');
Route::post('/prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_update')->name('prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_update');
Route::post('/prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_delete')->name('prodi_pagelaran_pameran_prestasi_publikasi_ilmiah_mahasiswa_delete');
Route::get('/prodi-file_download_dokumen_ilmiah_mahasiswa/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_ilmiah_mahasiswa')->name('prodi-file_download_dokumen_ilmiah_mahasiswa');


Route::get('/prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat', 'LkpsProdiLuaranDanCapaianTridharmaController@produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat')->name('prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat');
Route::post('/prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_add', 'LkpsProdiLuaranDanCapaianTridharmaController@produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_add')->name('prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_add');
Route::post('/prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_update')->name('prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_update');
Route::post('/prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_delete')->name('prodi_produk_jasa_mahasiswa_diadopsi_oleh_industri_masyarakat_delete');
Route::get('/prodi-file_download_dokumen_produk_jasa_mahasiswa/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_dokumen_produk_jasa_mahasiswa')->name('prodi-file_download_dokumen_produk_jasa_mahasiswa');


Route::get('/prodi_mahasiswa_hki_paten', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_paten')->name('prodi_mahasiswa_hki_paten');
Route::post('/prodi_mahasiswa_hki_paten_add', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_paten_add')->name('prodi_mahasiswa_hki_paten_add');
Route::post('/prodi_mahasiswa_hki_paten_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_paten_update')->name('prodi_mahasiswa_hki_paten_update');
Route::post('/prodi_mahasiswa_hki_paten_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_paten_delete')->name('prodi_mahasiswa_hki_paten_delete');
Route::get('/prodi-file_download_file_hki_mhs/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_file_hki_mhs')->name('prodi-file_download_file_hki_mhs');



Route::get('/prodi_mahasiswa_hki_hak_cipta', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_hak_cipta')->name('prodi_mahasiswa_hki_hak_cipta');
Route::post('/prodi_mahasiswa_hki_hak_cipta_add', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_hak_cipta_add')->name('prodi_mahasiswa_hki_hak_cipta_add');
Route::post('/prodi_mahasiswa_hki_hak_cipta_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_hak_cipta_update')->name('prodi_mahasiswa_hki_hak_cipta_update');
Route::post('/prodi_mahasiswa_hki_hak_cipta_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_hki_hak_cipta_delete')->name('prodi_mahasiswa_hki_hak_cipta_delete');
Route::get('/prodi-file_download_file_hki_hak_cipta_mhs/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_file_hki_hak_cipta_mhs')->name('prodi-file_download_file_hki_hak_cipta_mhs');



Route::get('/prodi_mahasiswa_teknologi_tepat_guna', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_teknologi_tepat_guna')->name('prodi_mahasiswa_teknologi_tepat_guna');
Route::post('/prodi_mahasiswa_teknologi_tepat_guna_add', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_teknologi_tepat_guna_add')->name('prodi_mahasiswa_teknologi_tepat_guna_add');
Route::post('/prodi_mahasiswa_teknologi_tepat_guna_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_teknologi_tepat_guna_update')->name('prodi_mahasiswa_teknologi_tepat_guna_update');
Route::post('/prodi_mahasiswa_teknologi_tepat_guna_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_teknologi_tepat_guna_delete')->name('prodi_mahasiswa_teknologi_tepat_guna_delete');
Route::get('/prodi-file_download_file_teknologi_tepat_guna_mhs/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_file_teknologi_tepat_guna_mhs')->name('prodi-file_download_file_teknologi_tepat_guna_mhs');


Route::get('/prodi_mahasiswa_buku_berisbn', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_buku_berisbn')->name('prodi_mahasiswa_buku_berisbn');
Route::post('/prodi_mahasiswa_buku_berisbn_add', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_buku_berisbn_add')->name('prodi_mahasiswa_buku_berisbn_add');
Route::post('/prodi_mahasiswa_buku_berisbn_update/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_buku_berisbn_update')->name('prodi_mahasiswa_buku_berisbn_update');
Route::post('/prodi_mahasiswa_buku_berisbn_delete/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@mahasiswa_buku_berisbn_delete')->name('prodi_mahasiswa_buku_berisbn_delete');
Route::get('/prodi-file_download_file_buku_berisbn_mhs/{id}', 'LkpsProdiLuaranDanCapaianTridharmaController@file_download_file_buku_berisbn_mhs')->name('prodi-file_download_file_buku_berisbn_mhs');


Route::get('/submit_lkps_prodi', 'SubmitLkpsProdiController@submit_lkps')->name('submit_lkps_prodi');
Route::post('/submit_lkps_prodi_proses', 'SubmitLkpsProdiController@submit_lkps_proses')->name('submit_lkps_prodi_proses');

