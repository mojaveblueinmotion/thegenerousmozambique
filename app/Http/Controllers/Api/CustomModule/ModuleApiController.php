<?php

namespace App\Http\Controllers\Api\CustomModule;

use Exception;
use Illuminate\Http\Request;
use App\Models\CustomModule\Module;
use App\Http\Controllers\Controller;
use App\Models\CustomModule\ModuleData;
use Illuminate\Support\Facades\Validator;

class ModuleApiController extends Controller
{

    public function module()
    {
        try{
            $data = Module::with('details')->get();
    
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    } 

    public function moduleSpecific($api)
    {
        try{
            $data = Module::with('details')->where('api', $api)->get();
    
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function moduleSpecificPost($api, Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'data' => 'required',
            ]);                
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }
            $data = Module::with('details')->where('api', $api)->first();
            if(empty($data)){
                return response()->json([
                    'success' => false,
                    'message' => "Menu tidak ditemukan!",
                ], 404);
            }
            $noAsuransi = ModuleData::generateNoAsuransi();
            $record = new ModuleData;
            $record->module_id = $data->id;
            $record->data = $request->data;
            $record->user_id = auth()->user()->id;
            $record->no_asuransi = $noAsuransi->no_asuransi;
            $record->no_max = $noAsuransi->no_max;
            $record->status = 'penawaran';
            $record->save();
    
            return response()->json([
                'success' => true,
                'message' => "Data berhasil dimasukkan!",
                'data' => $record,
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
                'message-advanced' => $e->getMessage(),
            ], 400);
        }
    }

    public function getSpecificCustomData($api)
    {
        try{
            $data = ModuleData::with('module')->where('user_id', auth()->user()->id)
                ->whereHas('module', function ($q) use ($api){
                    $q->where('api', $api);
                })->first();
            
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }
}
