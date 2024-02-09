<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\MasterController;
use App\Http\Controllers\Api\Auth\MasterMotorController;
use App\Http\Controllers\Setting\User\ProfileController;
use App\Http\Controllers\Api\Auth\UserRegisterController;
use App\Http\Controllers\Api\Asuransi\AsuransiMobilApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiMotorApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiErectionApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiPropertiApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiKontraktorApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiMarineHullApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiPerjalananApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiKendaraanLainnyaApiController;
use App\Http\Controllers\Api\CustomModule\ModuleApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
// Route::post('register', [AuthController::class, 'signup']);

Route::get('selectAgent', [MasterController::class, 'selectAgent']);

Route::get('selectAsuransiMobil', [MasterController::class, 'selectAsuransiMobil']);
Route::get('selectMerkMobil', [MasterController::class, 'selectMerkMobil']);
Route::get('selectTahunMobil/{seri_id}', [MasterController::class, 'selectTahunMobil']);
Route::get('selectTipeMobil', [MasterController::class, 'selectTipeMobil']);
Route::get('selectSeriMobil/{merk_id}', [MasterController::class, 'selectSeriMobil']);
Route::get('selectTipeKendaraan', [MasterController::class, 'selectTipeKendaraan']);

Route::get('selectTipePemakaian', [MasterController::class, 'selectTipePemakaian']);
Route::get('selectLuasPertanggungan', [MasterController::class, 'selectLuasPertanggungan']);
Route::get('selectKondisiKendaraan', [MasterController::class, 'selectKondisiKendaraan']);
Route::get('selectKodePlat', [MasterController::class, 'selectKodePlat']);

Route::get('selectProvince', [MasterController::class, 'selectProvince']);
Route::get('selectCity/{id}', [MasterController::class, 'selectCity']);
Route::get('selectDistrict/{id}', [MasterController::class, 'selectDistrict']);
Route::get('selectVillage/{id}', [MasterController::class, 'selectVillage']);

Route::get('selectRiderLainnya', [MasterController::class, 'selectRiderLainnya']);

// DATA LAINNYA
Route::get('selectBlog', [MasterController::class, 'selectBlog']);
Route::get('selectFaq', [MasterController::class, 'selectFaq']);


Route::middleware(['jwt.verify'])->group( function () {
    Route::get('getMe', [AuthController::class, 'getMe']);
    // Perjalanan
    Route::post('agentAsuransiPerjalanan', [AsuransiPerjalananApiController::class, 'agentAsuransiPerjalanan']);
    Route::post('agentPenawaranAsuransiPerjalanan', [AsuransiPerjalananApiController::class, 'agentPenawaranAsuransiPerjalanan']);
    Route::post('testFilesPerjalanan', [AsuransiPerjalananApiController::class, 'testFilesPerjalanan']);
    
    // Motor
    Route::post('agentAsuransiMotor', [AsuransiMotorApiController::class, 'agentAsuransiMotor']);
    Route::post('agentPenawaranAsuransiMotor', [AsuransiMotorApiController::class, 'agentPenawaranAsuransiMotor']);
    Route::post('testFilesMotor', [AsuransiMotorApiController::class, 'testFilesMotor']);
    
    // Mobil
    Route::post('agentAsuransiMobil', [AsuransiMobilApiController::class, 'agentAsuransiMobil']);
    Route::post('agentPenawaranAsuransiMobil', [AsuransiMobilApiController::class, 'agentPenawaranAsuransiMobil']);
    Route::post('testFiles', [AsuransiMobilApiController::class, 'testFiles']);

    // Kendaraan Lainnya
    Route::post('agentAsuransiKendaraanLainnya', [AsuransiKendaraanLainnyaApiController::class, 'agentAsuransiKendaraanLainnya']);
    Route::post('agentPenawaranAsuransiKendaraanLainnya', [AsuransiKendaraanLainnyaApiController::class, 'agentPenawaranAsuransiKendaraanLainnya']);
    Route::post('testFiles', [AsuransiKendaraanLainnyaApiController::class, 'testFiles']);
    
    // Properti
    Route::post('agentAsuransiProperti', [AsuransiPropertiApiController::class, 'agentAsuransiProperti']);
    Route::post('agentPenawaranAsuransiProperti', [AsuransiPropertiApiController::class, 'agentPenawaranAsuransiProperti']);
    Route::post('penutupanAsuransiProperti', [AsuransiPropertiApiController::class, 'penutupanAsuransiProperti']);

    // User
    Route::post('profile/change-password', [AuthController::class, 'updatePassword']);

    // ASURANSI KONTRAKTOR
    Route::post('agentAsuransiKontraktor', [AsuransiKontraktorApiController::class, 'agentAsuransiKontraktor']);
    Route::post('agentPenawaranAsuransiKontraktor', [AsuransiKontraktorApiController::class, 'agentPenawaranAsuransiKontraktor']);
    Route::get('getPolisKontraktorSpesifik', [AsuransiKontraktorApiController::class, 'getPolisKontraktorSpesifik']);
    Route::get('getAllPolisKontraktor', [AsuransiKontraktorApiController::class, 'getAllPolisKontraktor']);

    // ASURANSI ERECTION
    Route::post('agentAsuransiErection', [AsuransiErectionApiController::class, 'agentAsuransiErection']);
    Route::post('agentPenawaranAsuransiErection', [AsuransiErectionApiController::class, 'agentPenawaranAsuransiErection']);
    Route::get('getPolisErectionSpesifik', [AsuransiErectionApiController::class, 'getPolisErectionSpesifik']);
    Route::get('getAllPolisErection', [AsuransiErectionApiController::class, 'getAllPolisErection']);

     // ASURANSI MARINE HULL
     Route::post('agentAsuransiMarineHull', [AsuransiMarineHullApiController::class, 'agentAsuransiMarineHull']);
     Route::post('agentPenawaranAsuransiMarineHull', [AsuransiMarineHullApiController::class, 'agentPenawaranAsuransiMarineHull']);
     Route::get('getPolisMarineHullSpesifik', [AsuransiMarineHullApiController::class, 'getPolisMarineHullSpesifik']);
     Route::get('getAllPolisMarineHull', [AsuransiMarineHullApiController::class, 'getAllPolisMarineHull']);


    //  CUSTOM MODULE 
    Route::get('module', [ModuleApiController::class, 'module']);
    Route::get('moduleSpecific/{api}', [ModuleApiController::class, 'moduleSpecific']);
    Route::get('getSpecificCustomData/{api}', [ModuleApiController::class, 'getSpecificCustomData']);
    Route::post('moduleSpecific/{api}', [ModuleApiController::class, 'moduleSpecificPost']);
});

// Properti
Route::get('selectAsuransiProperti', [MasterController::class, 'selectAsuransiProperti']);
Route::get('selectOkupasi/{okupasi}', [MasterController::class, 'selectOkupasi']);
Route::get('selectKonstruksiProperti/{konstruksi}', [MasterController::class, 'selectKonstruksiProperti']);
Route::get('selectPerlindunganProperti/{perlindungan}', [MasterController::class, 'selectPerlindunganProperti']);

// Motor
Route::get('selectAsuransiMotor', [MasterMotorController::class, 'selectAsuransiMotor']);
Route::get('selectMerkMotor', [MasterMotorController::class, 'selectMerkMotor']);
Route::get('selectTahunMotor/{seri_id}', [MasterMotorController::class, 'selectTahunMotor']);
Route::get('selectTipeMotor', [MasterMotorController::class, 'selectTipeMotor']);
Route::get('selectSeriMotor/{merk_id}', [MasterMotorController::class, 'selectSeriMotor']);


// Perjalanan
Route::get('selectAsuransiPerjalanan', [MasterController::class, 'selectAsuransiPerjalanan']);

Route::get('selectKategoriAsuransi', [MasterController::class, 'selectKategoriAsuransi']);

// Umum
Route::get('selectPertanggunganTambahan', [MasterController::class, 'selectPertanggunganTambahan']);

// Preview Harga Rider Mobil 
Route::post('getHargaAsuransiMobil', [AsuransiMobilApiController::class, 'getHargaAsuransiMobil']);
Route::get('getAllPertanggunganTambahanMobil', [AsuransiMobilApiController::class, 'getAllPertanggunganTambahanMobil']);
Route::post('getRiderByPertanggungan', [AsuransiMobilApiController::class, 'getRiderByPertanggungan']);
Route::get('getRiderMobilDefault', [AsuransiMobilApiController::class, 'getRiderMobilDefault']);

Route::get('getPolisMobilSpesifik', [AsuransiMobilApiController::class, 'getPolisMobilSpesifik']);
Route::post('getAsuransiByRider', [AsuransiMobilApiController::class, 'getAsuransiByRider']);

Route::post('getAllRiderMobil', [AsuransiMobilApiController::class, 'getAllRiderMobil']);
Route::post('getRiderByAsuransiId', [AsuransiMobilApiController::class, 'getRiderByAsuransiId']);
Route::get('getHargaLengkapAsuransiMobil', [AsuransiMobilApiController::class, 'getHargaLengkapAsuransiMobil']);


// Preview Harga Rider Motor 
Route::post('getHargaAsuransiMotor', [AsuransiMotorApiController::class, 'getHargaAsuransiMotor']);
Route::get('getAllPertanggunganTambahanMotor', [AsuransiMotorApiController::class, 'getAllPertanggunganTambahanMotor']);
Route::get('getRiderMotorDefault', [AsuransiMotorApiController::class, 'getRiderMotorDefault']);

Route::get('getPolisMotorSpesifik', [AsuransiMotorApiController::class, 'getPolisMotorSpesifik']);
Route::post('getAsuransiByRiderMotor', [AsuransiMotorApiController::class, 'getAsuransiByRiderMotor']);

Route::post('getAllRiderMotor', [AsuransiMotorApiController::class, 'getAllRiderMotor']);
Route::post('getRiderByAsuransiIdMotor', [AsuransiMotorApiController::class, 'getRiderByAsuransiIdMotor']);
Route::get('getHargaLengkapAsuransiMotor', [AsuransiMotorApiController::class, 'getHargaLengkapAsuransiMotor']);

// ASURANSI PROPERTI
Route::get('getOkupasi', [AsuransiPropertiApiController::class, 'getOkupasi']);
Route::get('getSurroundingRisk', [AsuransiPropertiApiController::class, 'getSurroundingRisk']);
Route::get('getKelasBangunan', [AsuransiPropertiApiController::class, 'getKelasBangunan']);
Route::get('getKonstruksiProperti', [AsuransiPropertiApiController::class, 'getKonstruksiProperti']);
Route::get('getPerlindunganProperti', [AsuransiPropertiApiController::class, 'getPerlindunganProperti']);
Route::post('getPreviewHargaAsuransi', [AsuransiPropertiApiController::class, 'getPreviewHargaAsuransi']);
Route::get('getPolisPropertiSpesifik', [AsuransiPropertiApiController::class, 'getPolisPropertiSpesifik']);
Route::get('getAllPolisProperti', [AsuransiPropertiApiController::class, 'getAllPolisProperti']);


// ASURANSI KONTRAKTOR
Route::get('getItemKontraktor', [AsuransiKontraktorApiController::class, 'getItemKontraktor']);
Route::get('getSubsoil', [AsuransiKontraktorApiController::class, 'getSubsoil']);


// ASURANSI ERECTION
Route::get('getItemErection', [AsuransiErectionApiController::class, 'getItemErection']);

