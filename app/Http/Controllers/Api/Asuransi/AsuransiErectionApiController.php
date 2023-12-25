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

class AsuransiErectionApiController extends Controller
{
    public function agentAsuransiErection(Request $request){
        try{
            $validator = Validator::make($request->input('penawaran'), [
                'judul_kontrak' => 'required',
                'lokasi_proyek' => 'required',
                'nama_prinsipal' => 'required',
                'alamat_prinsipal' => 'required',
                'nama_kontraktor' => 'required',
                'alamat_kontraktor' => 'required',
                'nama_subkontraktor' => 'required',
                'alamat_subkontraktor' => 'required',
                'nama_pabrik' => 'required',
                'alamat_pabrik' => 'required',
                'nama_perusahaan' => 'required',
                'alamat_perusahaan' => 'required',
                'nama_insinyur' => 'required',
                'alamat_insinyur' => 'required',
                'no_pemohon' => 'required',
                'no_tertanggung' => 'required',
                'keterangan' => 'required',
                'awal_periode' => 'required',
                'lama_prapenyimpanan' => 'required',
                'awal_pekerjaan' => 'required',
                'lama_pekerjaan' => 'required',
                'lama_pengujian' => 'required',
                'jenis_perlindungan' => 'required',
                'penghentian_asuransi' => 'required',
                'pekerjaan_konstruksi_sebelumnya' => 'required',
                'pekerjaan_konstruksi_kontraktor' => 'required',
                'perluasan' => 'required',
                'status_operasi' => 'required',
                'pekerjaan_sipil' => 'required',
                'pekerjaan_subkontraktor' => 'required',
                'resiko_kebakaran' => 'required',
                'resiko_ledakan' => 'required',
                'perairan_terdekat' => 'required',
                'jarak_perairan' => 'required',
                'air_rendah' => 'required',
                'rata_rata_air' => 'required',
                'tingkat_tertinggi_air' => 'required',
                'rata_rata_air_lokasi' => 'required',
                'musim_hujan_awal' => 'required',
                'musim_hujan_akhir' => 'required',
                'curah_hujan_perjam' => 'required',
                'curah_hujan_perhari' => 'required',
                'curah_hujan_perbulan' => 'required',
                'bahaya_badai' => 'required',
                'bahaya_gempa' => 'required',
                'riwayat_volkanik' => 'required',
                'status_gempa' => 'required',
                'bangunan_gempa' => 'required',
                'loss_tertinggi' => 'required',
                'perlindungan_peralatan' => 'required',
                'deskripsi_pernyataan' => 'required',
                'perlindungan_mesin' => 'required',
                'perlindungan_sekitaran' => 'required',
                'deskripsi_sekitaran' => 'required',
                'tanggung_jawab_pihak_ketiga' => 'required',
                'deskripsi_pihak_ketiga' => 'required',
                'perlindungan_libur' => 'required',
                'perlindungan_udara' => 'required',
                'deskripsi_perlindungan' => 'required',
                'jumlah_diasuransikan' => 'required',
            ]);                
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }
            if ($request->has('penawaran')) {
                $roles = Auth::user()->roles[0]->id;
                $noAsuransi = PolisErection::generateNoAsuransi();
                
                // Get the data under 'penawaran' key
                $datapenawaran = $request->input('penawaran');
                $record = new PolisErection;   
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
                        $sys_file->target_type  = PolisErection::class;
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
                    $kontraktorItem = new PolisErectionItem();
                    $kontraktorItem->polis_id = $record->id;
                    $kontraktorItem->item_id = $item['item_id'];
                    $kontraktorItem->harga = $item['harga'];
                    $kontraktorItem->save();
                }
            }

            return response()->json([
                'success' => true,
                'data' => $record->load([
                    'itemErection',
                    'itemErection.item',
                ])->toArray(),
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

    public function getAllPolisErection(Request $request){
        try {
            if (empty(auth()->user())) {
                return response()->json([
                    'success' => false,
                    'message' => "User belum login!",
                ], 400);
            }
            $data = PolisErection::where('user_id', auth()->user()->id);

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
    
    public function getPolisErectionSpesifik(Request $request){
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
            $data = PolisErection::
            with([
                'itemErection',
                'itemErection.item',
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
