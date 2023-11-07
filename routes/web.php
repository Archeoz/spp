<?php

use App\Http\Controllers\GenerateController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Generator\Dumper\GeneratorDumper;

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
//     return view('loginPetugas');
// });

// Login Page
Route::get('admin',[LoginController::class, 'loginpetugaspage']);
Route::post('postloginadmin',[LoginController::class, 'loginAdmin']);
Route::get('/',[LoginController::class, 'loginsiswapage']);
Route::post('postloginsiswa',[LoginController::class, 'loginSiswa']);

Route::get('dashboard',[IndexController::class, 'index']);

// Logo Out
Route::get('logout',[LoginController::class, 'logout']);

Route::group(['middleware' => ['auth:petugas']],function() {
    Route::group(['middleware' => ['CekLoginPetugas:admin']],function() {
        // Petugas
        Route::get('datapetugaspage',[PetugasController::class,'index']);
        Route::get('registerpetugaspage',[PetugasController::class,'registerpage']);
        Route::post('registerpetugas',[PetugasController::class,'store']);
        Route::get('editpetugaspage/{id}',[PetugasController::class,'editpage']);
        Route::post('editpetugas/{id}',[PetugasController::class,'edit']);
        Route::get('hapuspetugas/{id}', [PetugasController::class,'destroy']);

        // Siswa
        Route::get('datasiswapage',[SiswaController::class, 'index']);
        Route::get('registersiswapage',[SiswaController::class, 'registerpage']);
        Route::post('registersiswa',[SiswaController::class, 'store']);
        Route::get('editsiswapage/{nisn}',[SiswaController::class, 'editpage']);
        Route::post('editsiswa/{nisn}',[SiswaController::class, 'edit']);
        Route::get('hapussiswa/{id}',[SiswaController::class, 'destroy']);

        // Kelas
        Route::get('datakelaspage',[KelasController::class, 'index']);
        Route::get('registerkelaspage',[KelasController::class, 'registerpage']);
        Route::post('registerkelas',[KelasController::class, 'store']);
        Route::get('editkelaspage/{id_kelas}',[KelasController::class, 'editpage']);
        Route::post('editkelas/{id_kelas}',[KelasController::class, 'edit']);
        Route::get('hapuskelas/{id_kelas}',[KelasController::class, 'destroy']);

        // Kompetensi
        Route::get('datakompetensipage',[KompetensiController::class, 'index']);
        Route::get('registerkompetensipage',[KompetensiController::class, 'registerpage']);
        Route::post('registerkompetensi',[KompetensiController::class, 'store']);
        Route::get('editkompetensipage/{id_kompetensi}',[KompetensiController::class, 'editpage']);
        Route::post('editkompetensi/{id_kompetensi}',[KompetensiController::class, 'edit']);
        Route::get('hapuskompetensi/{id_kompetensi}',[KompetensiController::class, 'destroy']);

        // Spp
        Route::get('dataspppage',[SppController::class, 'index']);
        Route::get('registerspppage',[SppController::class, 'registerpage']);
        Route::post('registerspp',[SppController::class, 'store']);
        Route::get('editspppage/{id_spp}',[SppController::class, 'editpage']);
        Route::post('editspp/{id_spp}',[SppController::class, 'edit']);
        Route::get('hapusspp/{id_spp}',[SppController::class, 'destroy']);

        // Pembayaran Spp
        Route::get('tampilpembayaran',[PembayaranController::class, 'tampilnisn']);
        Route::get('registerpembayaranpage',[PembayaranController::class, 'registerpage']);
        Route::post('kirimspp',[PembayaranController::class, 'kirimspp']);

        // History Spp
        Route::get('historipage',[PembayaranController::class,  'show']);

        // Session Spp
        Route::get('ambilspp',[PembayaranController::class, 'buatsession']);
        Route::get('hapussesi/{id_spp}',[PembayaranController::class, 'hapussesi']);
        Route::get('hapussemua',[PembayaranController::class, 'hapussemua']);
        Route::post('kirimnisn',[PembayaranController::class, 'sesinisn']);
        Route::get('batalpembayaran',[PembayaranController::class, 'batalpembayaran']);

        // Session Histori Admin
        Route::get('kirimsesihistorisiswa',[PembayaranController::class, 'sesihistori']);
        Route::get('hapussesihistorisiswa',[PembayaranController::class, 'hapussesihistori']);

        // History Pembayaran
        Route::get('histori',[PembayaranController::class, 'show']);

        // Generate Laporan
        Route::get('tampilgenerate',[GenerateController::class, 'tampilgenerate']);
        Route::get('cetak',[GenerateController::class, 'cetak']);
    });

    Route::group(['middleware' => ['CekLoginPetugas:petugas']],function() {
        // Pembayaran Spp
        Route::get('tampilpembayaranpetugas',[PembayaranController::class, 'tampilnisn']);
        Route::get('registerpembayaranpagepetugas',[PembayaranController::class, 'registerpage']);
        Route::post('kirimnisnpetugas',[PembayaranController::class, 'tampilregister']);
        Route::post('kirimspppetugas',[PembayaranController::class, 'kirimspp']);

        // Session Histori Admin
        Route::get('kirimsesihistorisiswapetugas',[PembayaranController::class, 'sesihistori']);
        Route::get('hapussesihistorisiswapetugas',[PembayaranController::class, 'hapussesihistori']);

        // Session Spp
        Route::get('ambilspppetugas',[PembayaranController::class, 'buatsession']);
        Route::get('hapussesipetugas/{id_spp}',[PembayaranController::class, 'hapussesi']);
        Route::get('hapussemuapetugas',[PembayaranController::class, 'hapussemua']);
        Route::post('kirimnisnpetugas',[PembayaranController::class, 'sesinisn']);
        Route::get('batalpembayaranpetugas',[PembayaranController::class, 'batalpembayaran']);

        // History Pembayaran
        Route::get('historipetugas',[PembayaranController::class, 'show']);
    });

});

// History Pembayaran
Route::get('historisiswa',[PembayaranController::class, 'show']);

Route::group(['middleware' => ['auth:siswa']],function(){

    Route::group(['middleware' => ['CekLoginSiswa:siswa']],function() {

    });
});
