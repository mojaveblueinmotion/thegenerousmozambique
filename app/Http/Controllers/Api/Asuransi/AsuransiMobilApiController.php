<?php

namespace App\Http\Controllers\Api\Asuransi;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Asuransi\PolisMobil;
use App\Http\Controllers\Controller;
use App\Models\Setting\Globals\Files;
use App\Models\Asuransi\PolisMobilCek;
use App\Models\Asuransi\PolisMobilNilai;
use App\Models\Asuransi\PolisMobilClient;
use App\Models\Asuransi\PolisMobilPayment;
use App\Http\Controllers\Api\BaseController;
use App\Models\Asuransi\PolisMobilRider;
use App\Models\Master\AsuransiMobil\AsuransiRiderMobil;
use Illuminate\Support\Facades\Storage;

class AsuransiMobilApiController extends BaseController
{
    public function agentAsuransiMobil(Request $request){
        try{
            $noAsuransi = PolisMobil::generateNoAsuransi();
            $record = new PolisMobil;   
            $record->fill($request->only($record->fillable));
            $record->no_asuransi = $noAsuransi->no_asuransi;
            $record->no_max = $noAsuransi->no_max;
            $record->status = 'penawaran';
            $record->save();

            $recordCek = new PolisMobilCek;   
            $recordCek->fill($request->only($recordCek->fillable));
            $recordCek->polis_id = $record->id;
            $recordCek->save();
            
            $recordNilai = new PolisMobilNilai;   
            $recordNilai->fill($request->only($recordNilai->fillable));
            $recordNilai->polis_id = $record->id;
            $recordNilai->save();

            if($request->rider){
                foreach($request->rider as $rider){
                    $dataRider = AsuransiRiderMobil::find($rider);
                    $recordRider = new PolisMobilRider;   
                    $recordRider->polis_id = $record->id;
                    $recordRider->rider_kendaraan_id = $rider;
                    $recordRider->persentasi_eksisting = $dataRider->pembayaran_persentasi;
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
                'message' => AsuransiRiderMobil::find(3)
            ]);
        }
    }

    public function agentPenawaranAsuransiMobil(Request $request){
        try{
            $record = PolisMobil::where('no_asuransi', $request->no_asuransi)->first();
            $record->update([
                'status' => 'pending'
            ]);
            $record->save();

            $recordClient = new PolisMobilClient;   
            $recordClient->fill($request->only($recordClient->fillable));
            $recordClient->polis_id = $record->id;
            $recordClient->save();

            $recordPayment = new PolisMobilPayment;   
            $recordPayment->fill($request->only($recordPayment->fillable));
            $recordPayment->polis_id = $record->id;
            $recordPayment->save();

            // if ($request->files) {
                foreach($request->files as $nama_file => $arr){
                    foreach ($request->file($nama_file) as $key => $file) {
                        // dd(53, $file->getClientOriginalName());
                        $file_path = Carbon::now()->format('Ymdhisu')
                            . md5($file->getClientOriginalName())
                            . '/' . $file->getClientOriginalName();
        
                        $sys_file = new Files;
                        $sys_file->target_id    = $record->id;
                        $sys_file->target_type  = PolisMobil::class;
                        $sys_file->module       = 'asuransi.polis-mobil';
                        $sys_file->file_name    = $file->getClientOriginalName();
                        $sys_file->file_path    = $file->storeAs('files', $file_path, 'public');
                        // $temp->file_type = $file->extension();
                        $sys_file->file_size = $file->getSize();
                        $sys_file->flag = $nama_file;
                        $sys_file->save();
                    }
                }
            // }

            // if ($request->files) {
            //     foreach ($request->files as $nama_file => $arr) {
            //         foreach ($request->file($nama_file) as $key => $file) {
            //             // Check if the file is a base64 encoded string
            //             if (Str::startsWith($file, 'data:image')) {
            //                 // Get the base64 data portion of the string
            //                 $base64Data = substr($file, strpos($file, ',') + 1);
            
            //                 // Decode the base64 data to binary
            //                 $imageData = base64_decode($base64Data);
            
            //                 // Generate a unique file name
            //                 $fileName = Carbon::now()->format('Ymdhisu')
            //                     . md5($file->getClientOriginalName())
            //                     . '.png'; // You can choose the appropriate file extension
            
            //                 // Specify the storage path where you want to store the image
            //                 $storagePath = 'public/files/' . $fileName;
            
            //                 // Save the image to the storage path
            //                 File::put(storage_path($storagePath), $imageData);
            
            //                 $sys_file = new Files;
            //                 $sys_file->target_id    = $record->id;
            //                 $sys_file->target_type  = PolisMobil::class;
            //                 $sys_file->module       = 'asuransi.polis-mobil';
            //                 $sys_file->file_name    = $fileName;
            //                 $sys_file->file_path    = $storagePath;
            //                 $sys_file->file_size    = strlen($imageData); // Get the size of the image data
            //                 $sys_file->flag         = $nama_file;
            //                 $sys_file->save();
            //             } else {
            //                 // dd(53, $file->getClientOriginalName());
            //                 $file_path = Carbon::now()->format('Ymdhisu')
            //                 . md5($file->getClientOriginalName())
            //                 . '/' . $file->getClientOriginalName();
        
            //                 $sys_file = new Files;
            //                 $sys_file->target_id    = $record->id;
            //                 $sys_file->target_type  = PolisMobil::class;
            //                 $sys_file->module       = 'asuransi.polis-mobil';
            //                 $sys_file->file_name    = $file->getClientOriginalName();
            //                 $sys_file->file_path    = $file->storeAs('files', $file_path, 'public');
            //                 // $temp->file_type = $file->extension();
            //                 $sys_file->file_size = $file->getSize();
            //                 $sys_file->flag = $nama_file;
            //                 $sys_file->save();
            //             }
            //         }
            //     }
            // }            

            return response()->json([
                'success' => true,
                'message' => "Data Asuransi Berhasil Diupdate | status = pending",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function testFiles(Request $request)
    {
        $noAsuransi = PolisMobil::generateNoAsuransi();
        
        $record = new PolisMobil;   
        $record->fill($request->only($record->fillable));
        $record->no_asuransi = $noAsuransi->no_asuransi;
        $record->no_max = $noAsuransi->no_max;
        $record->status = 'penawaran';
        $record->save();

        if ($request->files) {
            foreach($request->files as $nama_file => $arr){
                foreach ($request->file($nama_file) as $key => $file) {
                    // Get the base64 data portion of the string
                    $base64Data = substr($file, strpos($file, ',') + 1);

                    // Decode the base64 data to binary
                    $imageData = base64_decode($base64Data);

                    // Generate a unique file name
                    $fileName = Carbon::now()->format('Ymdhisu')
                        . md5($file->getClientOriginalName())
                        . '.png'; // You can choose the appropriate file extension

                    // Specify the storage disk (in this example, we use the 'public' disk)
                    $disk = 'public';

                    // Specify the storage path where you want to save the image
                    $storagePath = 'files/' . $fileName;

                    // Use the storeAs method to save the binary data as an image file
                    $success = file_put_contents(storage_path().'/app/public/files/'.$fileName, $imageData);

                    $sys_file = new Files;
                    $sys_file->target_id    = $record->id;
                    $sys_file->target_type  = PolisMobil::class;
                    $sys_file->module       = 'asuransi.polis-mobil';
                    $sys_file->file_name    = $fileName;
                    $sys_file->file_path    = $success;
                    $sys_file->file_size    = strlen($imageData); // Get the size of the image data
                    $sys_file->flag         = $nama_file;
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
