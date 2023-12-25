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
use App\Models\AsuransiProperti\PolisProperti;
use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\AsuransiProperti\PolisPropertiCek;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\AsuransiKontraktor\PolisKontraktor;
use App\Models\AsuransiKontraktor\PolisKontraktorItem;
use App\Models\AsuransiProperti\PolisPropertiNilai;
use App\Models\AsuransiProperti\PolisPropertiPayment;
use App\Models\Master\AsuransiProperti\KelasBangunan;
use App\Models\AsuransiProperti\PolisPropertiPenutupan;
use App\Models\Master\AsuransiProperti\SurroundingRisk;
use App\Models\Master\AsuransiKontraktor\ItemKontraktor;
use App\Models\AsuransiProperti\PolisPropertiPerlindungan;
use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use App\Models\AsuransiProperti\PolisPropertiSurroundingRisk;

class AsuransiKontraktorApiController extends Controller
{
    public function agentAsuransiKontraktor(Request $request){
        try{
            $validator = Validator::make($request->input('penawaran'), [
                'asuransi_id' => 'nullable|numeric',
                'judul_kontrak' => 'required',
                'lokasi_proyek' => 'required',
                'nama_prinsipal' => 'required',
                'alamat_prinsipal' => 'required',
                'nama_kontraktor' => 'required',
                'alamat_kontraktor' => 'required',
                'nama_subkontraktor' => 'required',
                'alamat_subkontraktor' => 'required',
                'nama_insinyur' => 'required',
                'alamat_insinyur' => 'required',
                'lebar_dimensi' => 'required',
                'tinggi_dimensi' => 'required',
                'kedalaman_dimensi' => 'required',
                'rentang_dimensi' => 'required',
                'jumlah_lantai' => 'required',
                'metode_konstruksi' => 'required',
                'jenis_pondasi' => 'required',
                'bahan_konstruksi' => 'required',
                'kontraktor_berpengalaman' => 'required|integer',
                'awal_periode' => 'required',
                'lama_proses_konstruksi' => 'required',
                'tanggal_penyelesaian' => 'required',
                'periode_pemeliharaan' => 'required',
                'pekerjaan_subkontraktor' => 'required',
                'fire_explosion' => 'required|integer',
                'flood_inundation' => 'required|integer',
                'landslide_storm_cyclone' => 'required|integer',
                'blasting_work' => 'required|integer',
                'volcanic_tsunami' => 'required|integer',
                'observed_earthquake' => 'required|integer',
                'regulasi_struktur' => 'required|integer',
                'standar_rancangan' => 'required|integer',
                'subsoil_id' => 'required',
                'patahan_geologi' => 'required|integer',
                'perairan_terdekat' => 'required',
                'jarak_perairan' => 'required',
                'level_air' => 'required',
                'rata_rata_air' => 'required',
                'tingkat_tertinggi_air' => 'required',
                'tanggal_tercatat' => 'required',
                'musim_hujan_awal' => 'required',
                'musim_hujan_akhir' => 'required',
                'curah_hujan_perjam' => 'required',
                'curah_hujan_perhari' => 'required',
                'curah_hujan_perbulan' => 'required',
                'bahaya_badai' => 'required',
                'biaya_tambahan_lembur' => 'required|integer',
                'tanggung_jawab_pihak_ketiga' => 'required|integer',
                'asuransi_terpisah_tpl' => 'required|integer',
                'rincian_bangunan' => 'required',
                'status_struktur_bangunan' => 'required|integer',
            ]);                
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }
            if ($request->has('penawaran')) {
                $roles = Auth::user()->roles[0]->id;
                $noAsuransi = PolisKontraktor::generateNoAsuransi();
                
                // Get the data under 'penawaran' key
                $datapenawaran = $request->input('penawaran');
                $record = new PolisKontraktor;   
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
                        $sys_file->target_type  = PolisKontraktor::class;
                        $sys_file->module       = 'asuransi.polis-kontraktor';
                        $sys_file->file_name    = $file->getClientOriginalName();
                        $sys_file->file_path    = $file->storeAs('files', $file_path, 'public');
                        // $temp->file_type = $file->extension();
                        $sys_file->file_size = $file->getSize();
                        $sys_file->flag = $nama_file;
                        $sys_file->save();
                    }
                }
            }

            if($dataKontraktorItem = $request->input('item')){
                // Loop through the "items" array and insert into the database
                foreach ($dataKontraktorItem as $item) {
                    $kontraktorItem = new PolisKontraktorItem();
                    $kontraktorItem->polis_id = $record->id;
                    $kontraktorItem->item_id = $item['item_id'];
                    $kontraktorItem->harga = $item['harga'];
                    $kontraktorItem->save();
                }
            }

            return response()->json([
                'success' => true,
                'data' => $record->load([
                    'subsoil',
                    'itemKontraktor',
                    'itemKontraktor.item',
                ])->toArray(),
                'message' => "Data Asuransi Berhasil Ditambahkan | status = Penawaran",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                // 'trace' => $e->getTrace(),
                'message' => $e->getMessage(),
                'message' => $e
            ], 400);
        }
    }

    public function agentPenawaranAsuransiKontraktor(Request $request){
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

    public function getSubsoil(Request $request){
        try{
            if(!empty($request->name)){
                $data = Subsoil::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = Subsoil::all();
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
    
    public function getItemKontraktor(Request $request){
        try{
            if(!empty($request->name)){
                $data = ItemKontraktor::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = ItemKontraktor::all();
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

    public function getAllPolisKontraktor(Request $request){
        try {
            if (empty(auth()->user())) {
                return response()->json([
                    'success' => false,
                    'message' => "User belum login!",
                ], 400);
            }
            $data = PolisKontraktor::where('user_id', auth()->user()->id);

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
    
    public function getPolisKontraktorSpesifik(Request $request){
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
            $data = PolisKontraktor::
            with([
                'subsoil',
                'itemKontraktor',
                'itemKontraktor.item',
            ])->find($request->id);

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
