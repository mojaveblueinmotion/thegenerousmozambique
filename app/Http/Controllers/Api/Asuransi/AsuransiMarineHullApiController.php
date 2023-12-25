<?php

namespace App\Http\Controllers\Api\Asuransi;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Master\Geo\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\Globals\Files;
use Illuminate\Support\Facades\Validator;
use App\Models\AsuransiErection\PolisErection;
use App\Models\AsuransiProperti\PolisProperti;
use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\AsuransiProperti\PolisPropertiCek;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\AsuransiErection\PolisErectionItem;
use App\Models\AsuransiKontraktor\PolisKontraktor;
use App\Models\AsuransiMarineHull\PolisMarineHull;
use App\Models\AsuransiProperti\PolisPropertiNilai;
use App\Models\Master\AsuransiErection\ItemErection;
use App\Models\AsuransiProperti\PolisPropertiPayment;
use App\Models\Master\AsuransiProperti\KelasBangunan;
use App\Models\AsuransiKontraktor\PolisKontraktorItem;
use App\Models\AsuransiProperti\PolisPropertiPenutupan;
use App\Models\Master\AsuransiProperti\SurroundingRisk;
use App\Models\Master\AsuransiKontraktor\ItemKontraktor;
use App\Models\AsuransiProperti\PolisPropertiPerlindungan;
use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use App\Models\AsuransiProperti\PolisPropertiSurroundingRisk;

class AsuransiMarineHullApiController extends Controller
{
    public function agentAsuransiMarineHull(Request $request){
        try{
            $validator = Validator::make($request->input('penawaran'), [
                'nama_lengkap' => 'required',
                'alamat' => 'required',
                'nama_kreditur' => 'required',
                'alamat_kreditur' => 'required',
                'detail_kepentingan' => 'required',
                'lokasi_yard' => 'required',
                'nilai_maks_yard' => 'required',
                'konstruksi_bangunan' => 'required',
                'deskripsi_keamanan' => 'required',
                'deskripsi_kebakaran' => 'required',
                'jenis_kapal_dibuat' => 'required',
                'keterangan_yard' => 'required',
                'status_subkontraktor' => 'required',
                'perlindungan_subkontraktor' => 'required',
                'jadwal_pembangunan' => 'required',
                'cara_peluncuran' => 'required',
                'tempat_uji' => 'required',
                'detail_transportasi' => 'required',
                'ketersediaan_survey' => 'required',
                'tanggal_awal' => 'required',
                'tanggal_akhir' => 'required',
                'jenis_kapal' => 'required',
                'perkiraan_nilai' => 'required',
                'metode_konstruksi' => 'required',
                'material_konstruksi' => 'required',
                'panjang' => 'required',
                'berat' => 'required',
                'status_penerimaan' => 'required',
                'keterangan_penerimaan' => 'required',
                'lama_perusahaan' => 'required',
                'tahun_pengalaman' => 'required',
                'kualifikasi_tim' => 'required',
                'status_klaim' => 'required',
                'jatuh_tempo' => 'required',
                'nama_perusahaan_asuransi' => 'required',
                'status_penolakan' => 'required',
                'keterangan_penolakan' => 'required',
                'deskripsi_survey' => 'required',
            ]);                
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }
            if ($request->has('penawaran')) {
                $roles = Auth::user()->roles[0]->id;
                $noAsuransi = PolisMarineHull::generateNoAsuransi();
                
                // Get the data under 'penawaran' key
                $datapenawaran = $request->input('penawaran');
                $record = new PolisMarineHull;   
                $record->fill($datapenawaran);
                if($roles == 3){
                    $record->user_id = Auth::id();
                }else{
                    $record->agent_id = Auth::id();
                }
                $record->tanggal = now()->format('d/m/Y');
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
                        $sys_file->target_type  = PolisMarineHull::class;
                        $sys_file->module       = 'asuransi.polis-marine-hull';
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
                'data' => $record->toArray(),
                'message' => "Data Asuransi Berhasil Ditambahkan | status = Penawaran",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'trace' => $e->getTrace(),
                'message' => $e->getMessage(),
                'message' => $e
            ], 400);
        }
    }

    public function agentPenawaranAsuransiErection(Request $request){
        try{
            $record = PolisKontraktor::where('no_asuransi', $request->no_asuransi)->first();
            $record->update([
                'status' => 'pending'
            ]);
            $record->save();

            $recordPayment = new PolisKontraktorPayment;   
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
                        $sys_file->target_type  = PolisKontraktor::class;
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
    
    public function getItemErection(Request $request){
        try{
            if(!empty($request->name)){
                $data = ItemErection::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = ItemErection::all();
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

    public function getAllPolisMarineHull(Request $request){
        try {
            if (empty(auth()->user())) {
                return response()->json([
                    'success' => false,
                    'message' => "User belum login!",
                ], 400);
            }
            $data = PolisMarineHull::where('user_id', auth()->user()->id);

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }
    
    public function getPolisMarineHullSpesifik(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }
            $data = PolisMarineHull::find($request->id);

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }
}
