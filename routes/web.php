<?php

use Illuminate\Support\Facades\Route;

\Debugbar::disable();
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
Route::get('/', 'Donasi\HomeController@index')
      ->name('home');
Route::get('/bantuan', 'Donasi\HomeController@bantuan')
      ->name('bantuan');


Route::middleware(['auth', 'user'])->group(function () {
      Route::resource('detail-donasi', 'Donasi\DetailDonasiController');
      Route::get('/detail-donatur/{id}', 'Donasi\DetailDonaturController@index')
            ->name('detail-donatur');
      Route::get('/konfirmasi-donasi/{id}', 'Donasi\KonfirmasiDonasiController@index')
            ->name('konfirmasi-donasi');
      Route::post('/konfirmasi-donasi/create/{id}', 'Donasi\KonfirmasiDonasiController@create')
            ->name('konfirmasi-donasi-create');
      Route::get('/konfirmasi-donasi/{id}/sukses', 'Donasi\KonfirmasiDonasiController@sukses')
            ->name('sukses');
      Route::get('/riwayat-donasi', 'Donasi\RiwayatDonasiController@index')
            ->name('riwayat-donasi');
      Route::get('/settings/{id}', 'SettingsController@settings')
            ->name('settings');
      Route::post('/update-settings/{id}', 'SettingsController@updateSettings')
            ->name('update-settings');
});


Route::prefix('admin')
      ->namespace('Admin')
      ->middleware(['auth', 'admin'])
      ->group(function () {
            Route::get('/', 'DashboardController@index')
                  ->name('dashboard');
            Route::resource('data-user', 'DataUserController');
            Route::resource('data-aktivitas', 'DataAktivitasController');
            Route::resource('data-jenis-bencana', 'DataJenisBencanaController');
            Route::get('/data-permintaan', 'PermintaanLogistikController@index')
                  ->name('data-permintaan-admin');
            Route::get('/data-permintaan/detail/{id}', 'PermintaanLogistikController@detailpermintaan')
                  ->name('detail-permintaan-admin');
            Route::get('/laporan-pengiriman/detail/{id}', 'LapPengirimanLogistikController@detailpengiriman')
                  ->name('detail-pengiriman-admin');
            Route::get('/laporan-penerimaan/detail/{id}', 'LapPenerimaanLogistikController@detailpenerimaan')
                  ->name('detail-penerimaan-admin');
            Route::post('/data-permintaan/verifikasi/{id}', 'PermintaanLogistikController@verifikasi')
                  ->name('verifikasi-permintaan');
            Route::post('/data-permintaan/tolak/{id}', 'PermintaanLogistikController@tolak')
                  ->name('tolak-permintaan');
            Route::get('/data-info-posko', 'InfoPoskoController@index')
                  ->name('data-info-posko');
            Route::get('/data-info-posko/detail-sub-posko/{id}', 'InfoPoskoController@detailsubposko')
                  ->name('detail-data-subposko');

            Route::get('/laporan-donasi-masuk', 'DonasiMasukController@index')
                  ->name('laporan-donasi-masuk');
            Route::get('/laporan-permintaan', 'LapPermintaanLogistikController@index')
                  ->name('laporan-permintaan');
            Route::get('/laporan-pengiriman', 'LapPengirimanLogistikController@index')
                  ->name('laporan-pengiriman');
            Route::get('/laporan-penerimaan', 'LapPenerimaanLogistikController@index')
                  ->name('laporan-penerimaan');

            Route::get('/laporan-jumlah-stok', 'LapJumlahStokController@index')
                  ->name('laporan-jumlah-stok');
            Route::get('/laporan-barang-masuk', 'LapBarangMasukController@index')
                  ->name('laporan-barang-masuk');
            Route::get('/laporan-pembelian-barang', 'LapPembelianBarangController@index')
                  ->name('laporan-pembelian-barang');
            Route::get('/laporan-aktivitas-donasi', 'LapAktivitasDonasiController@index')
                  ->name('laporan-aktivitas-donasi');

            // Export PDF
            // Route::get('/export-pdf-donasi-masuk','DonasiMasukController@export')
            //       ->name('export-donasi-masuk-admin');
            // Route::get('/export-pdf-permintaan-logistik','LapPermintaanLogistikController@export')
            //       ->name('export-permintaan-logistik-admin');
            // Route::get('/export-pdf-pengiriman-logistik','LapPengirimanLogistikController@export')
            //       ->name('export-pengiriman-logistik-admin');
            Route::get('/export-pdf-penerimaan-logistik', 'LapPenerimaanLogistikController@export')
                  ->name('export-penerimaan-logistik-admin');
            // Route::get('/export-pdf-data-uang-masuk','LapDataUangDonasiController@export')
            //       ->name('export-data-uang-masuk-admin');
            // Route::get('/export-pdf-stok-barang','LapJumlahStokController@export')
            //       ->name('export-jumlah-stok-barang-admin');      
            // Route::get('/export-pdf-barang-masuk','LapBarangMasukController@export')
            //       ->name('export-barang-masuk-admin');   
            Route::get('/export-pdf-info-posko', 'InfoPoskoController@export')
                  ->name('export-info-posko-admin');
            Route::get('/export-pdf-aktivitas-donasi', 'LapAktivitasDonasiController@export')
                  ->name('export-aktivitas-donasi-admin');

            // Export PDF berdasarkan bulan
            // Route::post('/export-pdf-donasi-masuk-bulan','DonasiMasukController@exportBulan')
            //       ->name('export-donasi-masuk-admin-bulan');
            // Route::post('/export-pdf-permintaan-logistik-bulan','LapPermintaanLogistikController@exportBulan')
            //       ->name('export-permintaan-logistik-bulan-admin');
            // Route::post('/export-pdf-pengiriman-logistik-bulan','LapPengirimanLogistikController@exportBulan')
            //       ->name('export-pengiriman-logistik-admin-bulan');
            Route::post('/export-pdf-penerimaan-logistik-bulan', 'LapPenerimaanLogistikController@exportBulan')
                  ->name('export-penerimaan-logistik-admin-bulan');
            // Route::post('/export-pdf-data-uang-masuk-bulan','LapDataUangDonasiController@exportBulan')
            //       ->name('export-data-uang-masuk-admin-bulan');
            // Route::post('/export-pdf-barang-masuk-bulan','LapBarangMasukController@exportBulan')
            //       ->name('export-barang-masuk-admin-bulan');
            Route::post('/export-pdf-info-posko-bulan', 'InfoPoskoController@exportBulan')
                  ->name('export-info-posko-admin-bulan');

            // Export Detail
            // Route::get('/export-detail-permintaan/{id}','LapPermintaanLogistikController@exportDetail')
            // ->name('print-detail-permintaan-admin');
            // Route::get('/export-detail-pengiriman/{id}','LapPengirimanLogistikController@exportDetail')
            // ->name('print-detail-pengiriman-admin');
            Route::get('/export-detail-penerimaan/{id}', 'LapPenerimaanLogistikController@exportDetail')
                  ->name('print-detail-penerimaan-admin');

            // Export Lain-lain
            Route::get('/export-sub-posko/{id}', 'InfoPoskoController@exportSubPosko')
                  ->name('print-sub-posko-admin');
            Route::post('/export-info-posko-bencana', 'InfoPoskoController@exportBencana')
                  ->name('print-info-posko-bencana-admin');
            Route::post('/export-aktivitas-donasi-bencana', 'LapAktivitasDonasiController@exportBencana')
                  ->name('print-aktivitas-donasi-bencana-admin');

            // Ajax Url
            Route::get('getdatadonasi', [
                  'uses' => 'DonasiMasukController@getdatadonasi',
                  'as' => 'ajax.get.data.donasi'
            ]);
            Route::get('getpermintaanlogistik', [
                  'uses' => 'LapPermintaanLogistikController@getpermintaan',
                  'as' => 'ajax.get.permintaan.logistik'
            ]);
            Route::get('getpengirimanlogistik', [
                  'uses' => 'LapPengirimanLogistikController@getpengiriman',
                  'as' => 'ajax.get.pengiriman.logistik'
            ]);
            Route::get('getpenerimaanlogistik', [
                  'uses' => 'LapPenerimaanLogistikController@getpenerimaan',
                  'as' => 'ajax.get.penerimaan.logistik'
            ]);
            Route::get('getdatauangmasuk', [
                  'uses' => 'LapDataUangDonasiController@getdatauang',
                  'as' => 'ajax.get.data.uang.masuk'
            ]);
            Route::get('getstokbarang', [
                  'uses' => 'LapJumlahStokController@getstokbarang',
                  'as' => 'ajax.get.jumlah.stok.barang'
            ]);
            Route::get('getbarangmasuk', [
                  'uses' => 'LapBarangMasukController@getbarangmasuk',
                  'as' => 'ajax.get.barang.masuk'
            ]);

            Route::get('getinfoposko', [
                  'uses' => 'InfoPoskoController@getinfoposko',
                  'as' => 'ajax.get.info.posko'
            ]);
            Route::get('getdataaktivitas', [
                  'uses' => 'LapAktivitasDonasiController@getdataaktivitas',
                  'as' => 'ajax.get.data.aktivitas.donasi'
            ]);
      });


Route::prefix('logistik')
      ->namespace('Logistik')
      ->middleware(['auth', 'logistik'])
      ->group(function () {
            Route::get('/', 'DashboardController@index')
                  ->name('dashboard-logistik');
            Route::get('/donasi-masuk', 'DonasiMasukController@index')
                  ->name('donasi-masuk-logistik');
            Route::get('/donasi-masuk/{id}/verifikasi-barang', 'DonasiMasukController@verifikasibarang')
                  ->name('verifikasi-barang');
            Route::post('/donasi-masuk/{id}/verifikasi-barang/sukses', 'DonasiMasukController@sukses')
                  ->name('verifikasi-sukses');

            Route::resource('data-stok-barang', 'StokBarangController');


            Route::get('/data-barang-masuk', 'DataBarangMasukController@index')
                  ->name('data-barang-masuk-logistik');
            Route::get('/data-barang-masuk/create', 'DataBarangMasukController@create')
                  ->name('data-barang-masuk-logistik.create');
            Route::post('/data-barang-masuk', 'DataBarangMasukController@store')
                  ->name('data-barang-masuk-logistik.store');
            Route::get('/data-permintaan', 'DataPermintaanController@index')
                  ->name('data-permintaan-logistik');
            Route::get('/data-permintaan/detail/{id}', 'DataPermintaanController@detailpermintaan')
                  ->name('detail-permintaan-logistik');
            Route::get('/buat-pengiriman/{id}', 'DataPengirimanController@create')
                  ->name('create-pengiriman');
            Route::post('/buat-pengiriman/{id}/proses/{id_pengiriman}', 'DataPengirimanController@prosestambah')
                  ->name('proses-tambah-pengiriman');

            Route::get('/data-pengiriman', 'DataPengirimanController@index')
                  ->name('data-pengiriman-logistik');
            Route::get('/data-pengiriman/detail/{id}', 'DataPengirimanController@detailpengiriman')
                  ->name('detail-pengiriman-logistik');

            Route::get('/laporan-permintaan', 'LapPermintaanController@index')
                  ->name('laporan-permintaan-logistik');
            Route::get('/laporan-donasi-masuk', 'LapDonasiMasukController@index')
                  ->name('laporan-donasi-masuk-logistik');
            Route::get('/laporan-stok-barang', 'LapStokBarangController@index')
                  ->name('laporan-stok-barang-logistik');
            Route::get('/laporan-pengiriman', 'LapPengirimanController@index')
                  ->name('laporan-pengiriman-logistik');
            Route::get('/laporan-barang-masuk', 'LapBarangMasukController@index')
                  ->name('laporan-barang-masuk-logistik');



            // Export PDF
            Route::get('/export-pdf-donasi-masuk', 'DonasiMasukController@export')
                  ->name('export-donasi-masuk');
            Route::get('/export-pdf-permintaan-logistik', 'LapPermintaanController@export')
                  ->name('export-permintaan-logistik');
            Route::get('/export-pdf-pengiriman-logistik', 'LapPengirimanController@export')
                  ->name('export-pengiriman-logistik');
            Route::get('/export-pdf-stok-barang', 'LapStokBarangController@export')
                  ->name('export-stok-barang');
            Route::get('/export-pdf-barang-masuk', 'LapBarangMasukController@export')
                  ->name('export-barang-masuk');

            // Export PDF berdasarkan bulan
            Route::post('/export-pdf-donasi-masuk-bulan', 'DonasiMasukController@exportBulan')
                  ->name('export-donasi-masuk-bulan');
            Route::post('/export-pdf-permintaan-logistik-bulan', 'LapPermintaanController@exportBulan')
                  ->name('export-permintaan-logistik-bulan');
            Route::post('/export-pdf-pengiriman-logistik-bulan', 'LapPengirimanController@exportBulan')
                  ->name('export-pengiriman-logistik-bulan');
            Route::post('/export-pdf-barang-masuk-bulan', 'LapBarangMasukController@exportBulan')
                  ->name('export-barang-masuk-bulan');

            // Export Detail
            Route::get('/export-detail-permintaan/{id}', 'LapPermintaanController@exportDetail')
                  ->name('print-detail-permintaan');
            Route::get('/export-detail-pengiriman/{id}', 'LapPengirimanController@exportDetail')
                  ->name('print-detail-pengiriman');

            // Export Lain-lain
            Route::post('/export-donasi-masuk-bencana', 'DonasiMasukController@exportBencana')
                  ->name('print-donasi-masuk-bencana');

            // Ajax Url
            Route::get('getdatadonasi', [
                  'uses' => 'DonasiMasukController@getdatadonasi',
                  'as' => 'ajax.donasi.masuk'
            ]);
            Route::get('getpermintaanlogistik', [
                  'uses' => 'LapPermintaanController@getpermintaan',
                  'as' => 'ajax.get.permintaan'
            ]);
            Route::get('getpengirimanlogistik', [
                  'uses' => 'LapPengirimanController@getpengiriman',
                  'as' => 'ajax.get.pengiriman'
            ]);
            Route::get('getdatauangmasuk', [
                  'uses' => 'LapUangDonasiController@getdatauang',
                  'as' => 'ajax.get.uang.masuk'
            ]);
            Route::get('getstokbarang', [
                  'uses' => 'LapStokBarangController@getstokbarang',
                  'as' => 'ajax.get.stok.barang'
            ]);
            Route::get('getbarangmasuk', [
                  'uses' => 'LapBarangMasukController@getbarangmasuk',
                  'as' => 'ajax.barang.masuk'
            ]);
            Route::get('getpengeluaran', [
                  'uses' => 'LapPengeluaranUangController@getpengeluaran',
                  'as' => 'ajax.pengeluaran'
            ]);
      });



Route::prefix('posko')
      ->namespace('Posko')
      ->middleware(['auth', 'posko'])
      ->group(function () {
            Route::resource('/info-posko', 'InfoPoskoController');
            Route::resource('/sub-posko', 'SubPoskoController');
            Route::get('/', 'DataPermintaanController@index')
                  ->name('data-permintaan');
            Route::get('/data-permintaan/tambah', 'DataPermintaanController@tambah')
                  ->name('tambah-permintaan');
            Route::post('/data-permintaan/tambah/{id}/proses', 'DataPermintaanController@prosestambah')
                  ->name('proses-tambah-permintaan');
            Route::get('/data-permintaan/detail-permintaan/{id}', 'DataPermintaanController@detailpermintaan')
                  ->name('detail-permintaan');
            Route::post('/data-permintaan/hapus/{id}', 'DataPermintaanController@hapus')
                  ->name('hapus-data-permintaan');
            Route::get('/buat-laporan-penerimaan/{id}', 'PenerimaanBarangController@create')
                  ->name('tambah-laporan-penerimaan');
            Route::post('/buat-laporan-penerimaan/create/{id_penerimaan}/{id}', 'PenerimaanBarangController@store')
                  ->name('store');
            Route::get('/detail-laporan-penerimaan/{id}', 'PenerimaanBarangController@detailpenerimaan')
                  ->name('detail-penerimaan-posko');
      });
// Auth::routes(['verify' => true]);
Auth::routes();
