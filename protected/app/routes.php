<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','HomeController@homeIndex');
Route::get('/new-grafik','HomeController@newGrafik');

Route::get('/grafik', array('uses'=>'UmumController@showIndex'));
Route::get('/test-table', array('uses'=>'UmumController@showTestTable'));
Route::group(['prefix'=>'get-data'], function(){
	Route::post('realisasi-skpd', array('uses'=>'UmumController@getRealisasiSkpd'));
});

Route::get('mockup', 'HomeController@indexMockup');
Route::get('kinerja-skpd','HomeController@kinerjaSkpd');
Route::get('kegiatan-skpd','HomeController@kegiatanSkpd');
Route::get('kegiatan-skpd/{skpd}/{tahun}','HomeController@detailKegiatanSkpd');
Route::get('kegiatan-lokasi','HomeController@kegiatanLokasi');

Route::get('hitung-realisasi','DashboardController@hitungRealisasi');

Route::get('login', array('uses' => 'AuthController@showLogin'));
Route::post('login', array('uses' => 'AuthController@doLogin'));
Route::get('logout',array('before' => 'auth', 'uses' => 'AuthController@doLogout'));


Route::group(array('before' => 'auth', 'prefix' => 'emonevpanel'),function() {

	Route::get('/','DashboardController@index');
//sirup
	Route::get('/skpd1', "SirupController@skpd");
	
	// Route::get('/activity', "SirupController@activity");
	Route::get('/package/{idSKPD}/{idProgram}/{idActivity}', "SirupController@package");
	Route::get('/package-list', "SirupController@packageList");
// batas sirup
//perubahan
// Route::get('daftar-paket','PaketController@indexDaftarPaket');

// Route::get('program','ProgramController@indexProgram');

// Route::get('paket_sirup/detail/{id}','PaketController@detailPaketSirup');
// Route::get('kegiatan','KegiatanController@indexKegiatan');
// Route::get('progres-paket','PaketController@indexProgresPaket');
// Route::get('paket-lelang/edit/{id}','PaketController@editPaketLelang');
// Route::post('paket-lelang/update','PaketController@updatePaketLelang');	
// Route::get('progres-lelang/detail/{id}','PaketController@detailProgresLelang');
	// Route::get('realisasi','RealisasiController@indexRealisasi');
	// Route::get('realisasi/edit/{id}','RealisasiController@editRealisasi');
	// Route::post('realisasi/update','RealisasiController@updateRealisasi');
// Route::get('realisasi/detail/{id}','RealisasiController@detailRealisasi');
//disini
Route::get('kegiatan/{id}', 'SirupController@getActivity');
Route::post('kegiatan/updatePagu','SirupController@updatePagu');
Route::get('program', "SirupController@program");
Route::get('kegiatan',"SirupController@activity");
Route::get('paket_sirup','PaketController@paket_sirup');
Route::get('paket_sirup/detail/{id}', "SirupController@packageDetail");
Route::get('progres-paket','SirupController@indexProgresPaket');
Route::get('progres-paket/edit/{id}','SirupController@editProgres');
Route::post('progres-paket/update','SirupController@updateProgres');
Route::get('progres-paket/detail/{id}','SirupController@detailProgres');
Route::get('realisasi','SirupController@realisasiKegiatan');
Route::get('realisasi/edit/{id}','SirupController@editRealisasi');
Route::post('realisasi/update','SirupController@updateRealisasi');
Route::get('realisasi/detail/{id}','SirupController@detailRealisasi');
	
	Route::post('program/insert','ProgramController@insertProgram');
	Route::post('/program/update','ProgramController@updateProgram');
	Route::get('/program/delete','ProgramController@deleteProgram');

	Route::get('apbn','ApbnController@indexApbn');
	Route::get('apbn/create','ApbnController@createApbn');
	Route::post('apbn/create','ApbnController@insertApbn');
	Route::get('/apbn/detail/{id}','ApbnController@detailApbn');
	Route::get('apbn/edit/{id}','ApbnController@editApbn');
	Route::post('apbn/update','ApbnController@updateApbn');
	Route::get('apbn/hapus/{id}','ApbnController@hapusApbn');

	
	Route::get('kegiatan/create','KegiatanController@createKegiatan');
	Route::post('kegiatan/create','KegiatanController@insertKegiatan');
	Route::get('/kegiatan/detail/{id}','KegiatanController@detailKegiatan');
	Route::get('kegiatan/edit/{id}','KegiatanController@editKegiatan');
	Route::post('kegiatan/update','KegiatanController@updateKegiatan');
	Route::get('kegiatan/hapus/{id}','KegiatanController@hapusKegiatan');

	
	// Route::get('daftar-paket/create','PaketController@createDaftarPaket');
	// Route::post('daftar-paket/create','PaketController@insertDaftarPaket');
	// Route::post('cari_paket','PaketController@cari_paket');
	// Route::post('cari_satker','PaketController@cari_satker');
	// Route::get('daftar-paket/detail/{id}','PaketController@detailDaftarPaket');
	// Route::get('daftar-paket/edit/{id}','PaketController@editDaftarPaket');
	// Route::post('daftar-paket/update','PaketController@updateDaftarPaket');
	// Route::get('daftar-paket/hapus/{id}','PaketController@hapusDaftarPaket');
	

	Route::get('paket-lelang','PaketController@indexPaketLelang');
	Route::get('paket-lelang/create','PaketController@createPaketLelang');
	Route::post('paket-lelang/create','PaketController@insertPaketLelang');
	Route::get('paket-lelang/detail/{id}','PaketController@detailPaketLelang');
	
	Route::get('paket-lelang/hapus/{id}','PaketController@hapusPaketLelang');

	

	Route::get('progres-lelang','PaketController@indexProgresLelang');
	Route::get('progres-lelang/create','PaketController@createProgresLelang');
	Route::post('progres-lelang/create','PaketController@insertProgresLelang');
	
	Route::get('progres-lelang/edit/{id}','PaketController@editProgresLelang');
	Route::post('progres-lelang/update','PaketController@updateProgresLelang');
	Route::get('progres-lelang/hapus/{id}','PaketController@hapusProgresLelang');

	
	/* Bagian ini dinonaktifkan dulu karena belum diperlukan
	---------------------------------------------------------
	Route::get('realisasi/create','RealisasiController@createRealisasi');
	Route::post('realisasi/create','RealisasiController@insertRealisasi');
	*/
	
	
	

	Route::get('rencana-realisasi','RealisasiController@indexRencanaRealisasi');
	Route::post('rencana-realisasi','RealisasiController@updateRencanaRealisasi');
	Route::get('grup-deviasi','RealisasiController@indexGrupDeviasi');
	Route::post('grup-deviasi','RealisasiController@updateGrupDeviasi');

	Route::get('pegawai','PegawaiController@indexPegawai');
	Route::get('pegawai/create','PegawaiController@createPegawai');
	Route::post('pegawai/create','PegawaiController@insertPegawai');
	Route::get('pegawai/edit/{id}','PegawaiController@editPegawai');
	Route::post('pegawai/update','PegawaiController@updatePegawai');
	Route::post('pegawai/change-password','PegawaiController@changePassword');
	Route::get('pegawai/hapus/{id}','PegawaiController@hapusPegawai');

	Route::get('akun','PegawaiController@indexAkun');

	Route::get('skpd','DashboardController@indexSkpd');
	Route::post('skpd/insert','DashboardController@insertSkpd');
	Route::post('skpd/update','DashboardController@updateSkpd');
	Route::get('skpd/delete','DashboardController@deleteSkpd');

	Route::get('lokasi','DashboardController@indexLokasi');
	Route::post('lokasi/insert','DashboardController@insertLokasi');
	Route::post('lokasi/update','DashboardController@updateLokasi');
	Route::get('lokasi/delete','DashboardController@deleteLokasi');

	Route::get('api/v1/program/{idSkpd}/{idTahun}','DashboardController@getProgram');
	Route::get('api/v1/kpa/{idSkpd}','DashboardController@getKpa');
	Route::get('api/v1/kegiatan/{idSkpd}/{idTahun}','DashboardController@getKegiatan');
	Route::get('api/v1/paket/{idKegiatan}/{idTahun}','DashboardController@getPaket');
	Route::get('api/v1/lelang/{idSkpd}/{idTahun}','DashboardController@getLelang');

	Route::get('copy-realisasi','DashboardController@indexCopyRealisasi');
	Route::post('copy-realisasi','DashboardController@copyRealisasi');
	Route::get('anggaran-perubahan','DashboardController@indexAnggaranPerubahan');
	Route::post('anggaran-perubahan','DashboardController@copyAnggaranPerubahan');
	Route::get('tahun-baru','DashboardController@indexTahunBaru');
	Route::post('tahun-baru','DashboardController@insertTahunBaru');

	Route::get('summary','SummaryController@indexSummary');
	Route::get('summary/format-a1','SummaryController@formatA1');
	Route::get('summary/format-a2','SummaryController@formatA2');
	Route::get('summary/print_a2','SummaryController@print_a2');
	Route::get('summary/format-a3','SummaryController@formatA3');
	Route::get('summary/print_a3','SummaryController@print_a3');
	Route::get('summary/format-a4','SummaryController@formatA4');
	Route::get('summary/print_a4','SummaryController@print_a4');
	Route::get('summary/format-b','SummaryController@formatB');
	Route::get('summary/print_b','SummaryController@print_b');
	Route::get('summary/format-d','SummaryController@formatD');
	Route::get('summary/print_d','SummaryController@print_d');
	Route::get('summary/format-dk1','SummaryController@formatDK1');
	Route::get('summary/print_dk1','SummaryController@print_dk1');
	Route::get('summary/format-fiskeu','SummaryController@formatRFK');
	Route::get('summary/download','SummaryController@downloadRFK');
	Route::get('summary/tabel1','SummaryController@tabel1');
	Route::get('summary/print_a1','SummaryController@print_a1');
	Route::get('summary/tabel2','SummaryController@tabel2');
	Route::get('summary/print_dk2','SummaryController@print_dk2');

	Route::get('summary/download-pdf-rfk','SummaryController@downloadPdfRfk');
	Route::get('summary/download-excel-rfk','SummaryController@downloadExcelRfk');


	Route::get('summary/test-export-excel','TestingController@testExportExcel');
	Route::get('summary/test-export-pdf','TestingController@testPdf');

});

Route::get('cek/insert-realisasi-awal/{skpd_id}', 'CekController@insertRealisasiAwal');
Route::get('cek/realisasi-skpd/{skpd_id}', 'CekController@realisasiSkpd');
Route::get('cek/realisasi-kab/', 'CekController@realisasiKab');
Route::get('cek/insert-rencana-realisasi/{tahun_id}', 'CekController@insertRencanaRealisasi');
Route::get('cek/copy-realisasi/{skpd_id}/{bulan}', 'CekController@copyRealisasiSkpd');
Route::get('cek/copy-realisasi-keseluruhan', 'CekController@copyRealisasiKeselurahan');
Route::get('cek/delete-realisasi', 'CekController@deleteRealisasi');

Route::get('cek/pagu-pengeluaran', 'CekController@paguPengeluaran');