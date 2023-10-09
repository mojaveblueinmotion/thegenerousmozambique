<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\MasterController;
use App\Http\Controllers\Api\Auth\MasterMotorController;
use App\Http\Controllers\Api\Auth\UserRegisterController;
use App\Http\Controllers\Api\Asuransi\AsuransiMobilApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiMotorApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiPropertiApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiPerjalananApiController;
use App\Http\Controllers\Api\Asuransi\AsuransiKendaraanLainnyaApiController;
use App\Http\Controllers\Setting\User\ProfileController;

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

