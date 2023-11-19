<?php

namespace App\Http\Controllers\Api\Asuransi;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Setting\Globals\Files;
use App\Models\AsuransiProperti\PolisProperti;
use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\AsuransiProperti\PolisPropertiCek;
use App\Models\AsuransiProperti\PolisPropertiNilai;
use App\Models\AsuransiProperti\PolisPropertiPayment;
use App\Models\AsuransiProperti\PolisPropertiPenutupan;
use App\Models\AsuransiProperti\PolisPropertiPerlindungan;
use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;

class AsuransiPropertiApiController extends Controller
{
    public function agentAsuransiProperti(Request $request){
        try{
            $noAsuransi = PolisProperti::generateNoAsuransi();
            if ($request->has('penawaran')) {
                // Get the data under 'penawaran' key
                $datapenawaran = $request->input('penawaran');
                $record = new PolisProperti;   
                $record->fill($datapenawaran);
                $record->no_asuransi = $noAsuransi->no_asuransi;
                $record->no_max = $noAsuransi->no_max;
                $record->status = 'penawaran';
                $record->save();
            }

            if ($request->files) {
                foreach($request->files as $nama_file => $arr){
                    foreach ($request->file($nama_file) as $key => $file) {
                        // dd(53, $file->getClientOriginalName());
                        $file_path = Carbon::now()->format('Ymdhisu')
                            . md5($file->getClientOriginalName())
                            . '/' . $file->getClientOriginalName();
        
                        $sys_file = new Files;
                        $sys_file->target_id    = $record->id;
                        $sys_file->target_type  = PolisPropertiNilai::class;
                        $sys_file->module       = 'asuransi.polis-properti';
                        $sys_file->file_name    = $file->getClientOriginalName();
                        $sys_file->file_path    = $file->storeAs('files', $file_path, 'public');
                        // $temp->file_type = $file->extension();
                        $sys_file->file_size = $file->getSize();
                        $sys_file->flag = $nama_file;
                        $sys_file->save();
                    }
                }
            }

            if($dataPertanggungan = $request->input('pertanggungan')){
                // Loop through the "items" array and insert into the database
                foreach ($dataPertanggungan as $item) {
                    $pertanggungan = new PolisPropertiNilai();
                    $pertanggungan->polis_id = $record->id;
                    $pertanggungan->nama_pertanggungan = $item['nama_pertanggungan'];
                    $pertanggungan->harga_pertanggungan = $item['harga_pertanggungan'];
                    $pertanggungan->save();
                }
            }
            
            if($dataPerlindungan = $request->input('perlindungan')){
                foreach ($dataPerlindungan as $item) {
                    $perlindungan = new PolisPropertiPerlindungan();
                    $perlindungan->polis_id = $record->id;
                    $perlindungan->name = $item['name'];
                    $perlindungan->nilai_perlindungan = $item['nilai_perlindungan'];
                    $perlindungan->save();
                }
            }

            return response()->json([
                'success' => true,
                'data' => $record->load([
                    'province',
                    'okupasi',
                    'perlindungan',
                    'konstruksi',
                    'city',
                    'district',
                    'agent',
                    'user',
                    'detailCek',
                    'detailNilai',
                    'detailPayment',
                    'asuransi'
                ])->toArray(),
                'message' => "Data Asuransi Berhasil Ditambahkan | status = Penawaran",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function agentPenawaranAsuransiProperti(Request $request){
        try{
            $record = PolisProperti::where('no_asuransi', $request->no_asuransi)->first();
            $record->update([
                'status' => 'pending'
            ]);
            $record->save();

            $recordPayment = new PolisPropertiPayment;   
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
                        $sys_file->target_type  = PolisProperti::class;
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

    public function penutupanAsuransiProperti(Request $request){
        try{
            $recordPenutupan = new PolisPropertiPenutupan;   
            $recordPenutupan->fill($request->only($recordPenutupan->fillable));
            $recordPenutupan->status = 'pending';
            $recordPenutupan->save();

            if ($request->files) {
                foreach($request->files as $nama_file => $arr){
                    foreach ($request->file($nama_file) as $key => $file) {
                        // dd(53, $file->getClientOriginalName());
                        $file_path = Carbon::now()->format('Ymdhisu')
                            . md5($file->getClientOriginalName())
                            . '/' . $file->getClientOriginalName();
        
                        $sys_file = new Files;
                        $sys_file->target_id    = $recordPenutupan->id;
                        $sys_file->target_type  = PolisPropertiPenutupan::class;
                        $sys_file->module       = 'asuransi.polis-properti-penutupan';
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
                'message' => "Data Penutupan Asuransi Properti Berhasil Dikirim | status = pending",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function getOkupasi(Request $request){
        try{
            if(!empty($request->name)){
                $data = Okupasi::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = Okupasi::all();
            }

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

    public function getKonstruksiProperti(Request $request){
        try{
            if(!empty($request->name)){
                $data = KonstruksiProperti::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = KonstruksiProperti::all();
            }

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

    public function getPerlindunganProperti(Request $request){
        try{
            if(!empty($request->name)){
                $data = PerlindunganProperti::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = PerlindunganProperti::all();
            }

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
