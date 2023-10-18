<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\Master\Geo\City;
use App\Models\Master\Geo\Village;
use App\Models\Master\Geo\District;
use App\Models\Master\Geo\Province;
use App\Http\Controllers\Controller;
use App\Models\Master\DatabaseMobil\Merk;
use App\Models\Master\DatabaseMobil\Seri;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\DatabaseMobil\Tahun;
use App\Http\Controllers\Api\BaseController;
use App\Models\Master\DatabaseMobil\KodePlat;
use App\Models\Master\DatabaseMobil\TipeMobil;
use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\Master\AsuransiMobil\AsuransiMobil;
use App\Models\Master\AsuransiMobil\TipePemakaian;
use App\Models\Master\AsuransiMotor\AsuransiMotor;
use App\Models\Master\DatabaseMobil\TipeKendaraan;
use App\Models\Master\AsuransiMobil\KondisiKendaraan;
use App\Models\Master\AsuransiMobil\LuasPertanggungan;
use App\Models\Master\AsuransiProperti\AsuransiProperti;
use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use App\Models\Master\AsuransiPerjalanan\AsuransiPerjalanan;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use App\Models\Master\DataAsuransi\KategoriAsuransi;
use App\Models\Master\DataAsuransi\PertanggunganTambahan;
use App\Models\Master\DataAsuransi\RiderKendaraan;
use App\Models\Master\DataAsuransi\RiderKendaraanLainnya;

class MasterController extends BaseController
{
    public function selectAgent(){
        try{
            $record =  User::whereHas(
                'roles',
                function ($q) {
                    $q->where('id', 2);
                }
            )->get();

            return response()->json([
                'success' => true,
                'message' => "Data Agent",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectAsuransiMobil(Request $request){
        try{
            $record =  AsuransiMobil::with(['rider.riderKendaraan'])->get();

            if(!empty($request->id)){
                $record =  AsuransiMobil::with('rider')->find($request->id);
            }
            return response()->json([
                'success' => true,
                'message' => "Data Asuransi Mobil",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectMerkMobil(Request $request){
        try{
            if(!empty($request->merk)){
                $record =  Merk::where('name', 'like', '%' . $request->merk . '%')->get();

            }else{
                $record =  Merk::where('status', 'populer')->limit(5)->get();
            }

            return response()->json([
                'success' => true,
                'message' => "Data Merk Mobil",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectRiderLainnya(){
        try{
            $record =  RiderKendaraanLainnya::all();

            return response()->json([
                'success' => true,
                'message' => "Data Rider Lainnya",
                'data' => $record
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }
    
    public function selectSeriMobil($merk_id){
        try{
            $record =  Seri::where('merk_id', $merk_id)->get();

            return response()->json([
                'success' => true,
                'message' => "Data Seri Mobil",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectTahunMobil($seri_id){
        try{
            $record =  Tahun::where('seri_id', $seri_id)->get();

            return response()->json([
                'success' => true,
                'message' => "Data Tahun Mobil",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectTipeMobil(){
        try{
            $record =  TipeMobil::all();

            return response()->json([
                'success' => true,
                'message' => "Data Tipe Mobil",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }


    public function selectTipeKendaraan(){
        try{
            $record =  TipeKendaraan::all();

            return response()->json([
                'success' => true,
                'message' => "Data Tipe Kendaraan",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectTipePemakaian(){
        try{
            $record =  TipePemakaian::all();

            return response()->json([
                'success' => true,
                'message' => "Data Tipe Pemakaian Kendaraan",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectLuasPertanggungan(){
        try{
            $record =  LuasPertanggungan::all();

            return response()->json([
                'success' => true,
                'message' => "Data Luas Pertanggungan",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectKategoriAsuransi(){
        try{
            $record =  KategoriAsuransi::all();

            return response()->json([
                'success' => true,
                'message' => "Data Kategori Asuransi",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectPertanggunganTambahan(){
        try{
            $record =  PertanggunganTambahan::all();

            return response()->json([
                'success' => true,
                'message' => "Data Pertanggungan Tambahan",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectKondisiKendaraan(){
        try{
            $record =  KondisiKendaraan::all();

            return response()->json([
                'success' => true,
                'message' => "Data Kondisi Kendaraan",
                'data' => $record
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectKodePlat(){
        try{
            $record =  KodePlat::all();

            return response()->json([
                'success' => true,
                'message' => "Data Kode Plat",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectProvince(){
        try{
            $record =  Province::all();

            return response()->json([
                'success' => true,
                'message' => "Data Provinsi",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectCity($id){
        try{
            $record =  City::where('province_id', $id)->get();

            return response()->json([
                'success' => true,
                'message' => "Data Kota",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectDistrict($id){
        try{
            $record =  District::where('city_id', $id)->get();

            return response()->json([
                'success' => true,
                'message' => "Data Kecamatan",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectVillage($id){
        try{
            $record =  Village::where('district_id', $id)->get();

            return response()->json([
                'success' => true,
                'message' => "Data Kelurahan",
                'data' => $record,

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    // Asuransi Properti
    public function selectAsuransiProperti(){
        try{
            $record =  AsuransiProperti::all();

            return response()->json([
                'success' => true,
                'message' => "Data Asuransi Properti",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectOkupasi($okupasi){
        try{
            $record =  Okupasi::where('name', 'like', '%' . $okupasi . '%')->get();

            return response()->json([
                'success' => true,
                'message' => "Data Okupasi",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectKonstruksiProperti($konstruksi){
        try{
            $record =  KonstruksiProperti::where('name', 'like', '%' . $konstruksi . '%')->get();

            return response()->json([
                'success' => true,
                'message' => "Data Konstruksi Properti",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectPerlindunganProperti($perlindungan){
        try{
            $record =  PerlindunganProperti::where('name', 'like', '%' . $perlindungan . '%')->get();

            return response()->json([
                'success' => true,
                'message' => "Data Perlindungan Properti",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function selectRiderKendaraan($rider){
        try{
            $record =  RiderKendaraan::with('pertanggungan')->where('name', 'like', '%' . $rider . '%')->get();

            return response()->json([
                'success' => true,
                'message' => "Data Rider Kendaraan",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }


    // Perjalanan
    public function selectAsuransiPerjalanan(){
        try{
            $record =  AsuransiPerjalanan::all();

            return response()->json([
                'success' => true,
                'message' => "Data Asuransi Perjalanan",
                'data' => $record

            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }
}
