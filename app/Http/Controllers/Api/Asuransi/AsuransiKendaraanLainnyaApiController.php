<?php

namespace App\Http\Controllers\Api\Asuransi;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\AsuransiKendaraan\PolisKendaraan;
use App\Http\Controllers\Controller;
use App\Models\Setting\Globals\Files;
use App\Models\AsuransiKendaraan\PolisKendaraanCek;
use App\Models\AsuransiKendaraan\PolisKendaraanPayment;
use App\Http\Controllers\Api\BaseController;
use App\Models\AsuransiKendaraan\PolisKendaraanRider;
use App\Models\Master\AsuransiMobil\AsuransiRiderMobil;
use App\Models\Master\DataAsuransi\RiderKendaraanLainnya;
use Illuminate\Support\Facades\Storage;

class AsuransiKendaraanLainnyaApiController extends BaseController
{
    public function agentAsuransiKendaraanLainnya(Request $request){
        try{
            $noAsuransi = PolisKendaraan::generateNoAsuransi();
            $record = new PolisKendaraan;   
            $record->fill($request->only($record->fillable));
            $record->no_asuransi = $noAsuransi->no_asuransi;
            $record->no_max = $noAsuransi->no_max;
            $record->status = 'penawaran';
            $record->save();

            $recordCek = new PolisKendaraanCek;   
            $recordCek->fill($request->only($recordCek->fillable));
            $recordCek->polis_id = $record->id;
            $recordCek->save();

            if($request->rider){
                foreach($request->rider as $rider){
                    $dataRider = RiderKendaraanLainnya::find($rider);
                    $recordRider = new PolisKendaraanRider;   
                    $recordRider->polis_id = $record->id;
                    $recordRider->rider_kendaraan_id = $rider;
                    $recordRider->persentasi_eksisting = $dataRider->persentasi_pembayaran;
                    $recordRider->save();
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Data Asuransi Berhasil Ditambahkan | status = Penawaran",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function agentPenawaranAsuransiKendaraanLainnya(Request $request){
        try{
            $record = PolisKendaraan::where('no_asuransi', $request->no_asuransi)->first();
            $record->update([
                'status' => 'pending'
            ]);
            $record->save();

            $recordPayment = new PolisKendaraanPayment;   
            $recordPayment->fill($request->only($recordPayment->fillable));
            $recordPayment->polis_id = $record->id;
            $recordPayment->save();

            if ($request->files) {
                foreach($request->files as $nama_file => $arr){
                    foreach ($request->file($nama_file) as $key => $file) {
                        // dd(53, $file->getClientOriginalName());
                        $file_path = Carbon::now()->format('Ymdhisu')
                            . md5($file->getClientOriginalName())
                            . '/' . $file->getClientOriginalName();
        
                        $sys_file = new Files;
                        $sys_file->target_id    = $record->id;
                        $sys_file->target_type  = PolisKendaraan::class;
                        $sys_file->module       = 'asuransi.polis-mobil';
                        $sys_file->file_name    = $file->getClientOriginalName();
                        $sys_file->file_path    = $file->storeAs('files', $file_path, 'public');
                        // $temp->file_type = $file->extension();
                        $sys_file->file_size = $file->getSize();
                        $sys_file->flag = $nama_file;
                        $sys_file->save();
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Data Asuransi Berhasil Diupdate | status = pending",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function testFiles(Request $request)
    {
        $noAsuransi = PolisKendaraan::generateNoAsuransi();
        $record = new PolisKendaraan;   
        $record->fill($request->only($record->fillable));
        $record->no_asuransi = $noAsuransi->no_asuransi;
        $record->no_max = $noAsuransi->no_max;
        $record->status = 'penawaran';
        $record->save();

        if ($request->files) {
            foreach($request->files as $nama_file => $arr){
                foreach ($request->file($nama_file) as $key => $file) {
                    // dd(53, $file->getClientOriginalName());
                    $file_path = Carbon::now()->format('Ymdhisu')
                        . md5($file->getClientOriginalName())
                        . '/' . $file->getClientOriginalName();
    
                    $sys_file = new Files;
                    $sys_file->target_id    = $record->id;
                    $sys_file->target_type  = PolisKendaraan::class;
                    $sys_file->module       = 'asuransi.polis-mobil';
                    $sys_file->file_name    = $file->getClientOriginalName();
                    $sys_file->file_path    = $file->storeAs('files', $file_path, 'public');
                    // $temp->file_type = $file->extension();
                    $sys_file->file_size = $file->getSize();
                    $sys_file->flag = $nama_file;
                    $sys_file->save();
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => $request->rangkamobil,
            'data' => $record->files,
        ]);
    }
}
