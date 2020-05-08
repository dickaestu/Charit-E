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
      Route::get('/', 'Donasi\HomeController@index')
      ->name('home');

      Route::middleware(['auth','user'])->group(function () {
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
       });


      Route::prefix('admin')
      ->namespace('Admin')
       ->middleware(['auth','admin'])
      ->group(function() {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');
      Route::resource('data-user', 'DataUserController');
      Route::resource('data-aktivitas', 'DataAktivitasController');
      Route::resource('data-jenis-bencana', 'DataJenisBencanaController');
      Route::get('/data-permintaan', 'PermintaanLogistikController@index')
            ->name('data-permintaan-admin');
      Route::get('/data-permintaan/detail/{id}', 'PermintaanLogistikController@detailpermintaan')
            ->name('detail-permintaan-admin');
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
      Route::get('/laporan-data-uang-donasi', 'LapDataUangDonasiController@index')
            ->name('laporan-data-uang-donasi');      
      Route::get('/laporan-jumlah-stok', 'LapJumlahStokController@index')
            ->name('laporan-jumlah-stok');   
      Route::get('/laporan-barang-masuk', 'LapBarangMasukController@index')
            ->name('laporan-barang-masuk');  
      Route::get('/laporan-pembelian-barang', 'LapPembelianBarangController@index')
            ->name('laporan-pembelian-barang'); 
      Route::get('/laporan-jumlah-posko', 'LapJumlahPoskoController@index')
            ->name('laporan-jumlah-posko'); 
      }); 


      Route::prefix('logistik')
      ->namespace('Logistik')
      ->middleware(['auth','logistik'])
      ->group(function() {
      Route::get('/', 'DashboardController@index')
            ->name('dashboard-logistik');
      Route::get('/donasi-masuk', 'DonasiMasukController@index')
            ->name('donasi-masuk-logistik');
      Route::get('/donasi-masuk/{id}/verifikasi-barang', 'DonasiMasukController@verifikasibarang')
            ->name('verifikasi-barang');
      Route::post('/donasi-masuk/{id}/verifikasi-barang/sukses', 'DonasiMasukController@sukses')
            ->name('verifikasi-sukses');
      Route::get('/donasi-masuk/{id}/verifikasi-uang', 'DonasiMasukController@verifikasiuang')
            ->name('verifikasi-uang');
      Route::post('/donasi-masuk/{id}/verifikasi-uang', 'DonasiMasukController@verifikasiuangcreate')
            ->name('verifikasi-uangcreate');
            


      Route::get('/data-uang-donasi', 'DataUangDonasiController@index')
            ->name('data-uang-donasi-logistik');
      Route::resource('data-stok-barang', 'StokBarangController');
    
      Route::get('/data-barang-masuk', 'DataBarangMasukController@index')
            ->name('data-barang-masuk-logistik');
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


      Route::get('/data-pembelian', 'DataPembelianController@index')
            ->name('data-pembelian-logistik');
      Route::get('/transaksi-pemasukan', 'TransaksiPemasukanController@index')
            ->name('transaksi-pemasukan-logistik');
      Route::get('/transaksi-pembelian', 'TransaksiPembelianController@index')
            ->name('transaksi-pembelian-logistik');
      Route::get('/laporan-permintaan', 'LapPermintaanController@index')
            ->name('laporan-permintaan-logistik');
      Route::get('/laporan-donasi-masuk', 'LapDonasiMasukController@index')
            ->name('laporan-donasi-masuk-logistik');
      Route::get('/laporan-uang-donasi', 'LapUangDonasiController@index')
            ->name('laporan-uang-donasi-logistik');
      Route::get('/laporan-stok-barang', 'LapStokBarangController@index')
            ->name('laporan-stok-barang-logistik');
      Route::get('/laporan-pengiriman', 'LapPengirimanController@index')
            ->name('laporan-pengiriman-logistik');
      Route::get('/laporan-pembelian', 'LapPembelianController@index')
            ->name('laporan-pembelian-logistik');
      Route::get('/laporan-barang-masuk', 'LapBarangMasukController@index')
            ->name('laporan-barang-masuk-logistik');
      }); 



      Route::prefix('posko')
      ->namespace('Posko')
      ->middleware(['auth','posko'])
      ->group(function() {
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
Auth::routes(['verify' => true]);

