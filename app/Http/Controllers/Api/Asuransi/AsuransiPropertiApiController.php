<?php

namespace App\Http\Controllers\Api\Asuransi;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Master\Geo\City;
use App\Http\Controllers\Controller;
use App\Models\Setting\Globals\Files;
use Illuminate\Support\Facades\Validator;
use App\Models\AsuransiProperti\PolisProperti;
use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\AsuransiProperti\PolisPropertiCek;
use App\Models\AsuransiProperti\PolisPropertiNilai;
use App\Models\AsuransiProperti\PolisPropertiPayment;
use App\Models\AsuransiProperti\PolisPropertiPenutupan;
use App\Models\AsuransiProperti\PolisPropertiPerlindungan;
use App\Models\AsuransiProperti\PolisPropertiSurroundingRisk;
use App\Models\Master\AsuransiProperti\KelasBangunan;
use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use App\Models\Master\AsuransiProperti\SurroundingRisk;

class AsuransiPropertiApiController extends Controller
{
    public function agentAsuransiProperti(Request $request){
        try{
            if ($request->has('penawaran')) {
                $noAsuransi = PolisProperti::generateNoAsuransi();
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
                    $pertanggungan->nilai_pertanggungan = $item['nilai_pertanggungan'];
                    $pertanggungan->save();
                }
            }
            if($dataSurrounding = $request->input('surroundingRisk')){
                // Loop through the "items" array and insert into the database
                foreach ($dataSurrounding as $item) {
                    $surrounding = new PolisPropertiSurroundingRisk();
                    $surrounding->polis_id = $record->id;
                    $surrounding->surrounding_risk_id = $item;
                    $surrounding->save();
                }
            }
            $dataVarPenawaran = $request->input('penawaran');
            $okupasi = Okupasi::find($dataVarPenawaran['okupasi_id']);
            $city = City::find($dataVarPenawaran['city_id']);
            $kelasBangunan = KelasBangunan::find($dataVarPenawaran['kelas_bangunan_id']);
            $konstruksi = KonstruksiProperti::find($dataVarPenawaran['konstruksi_id']);
            $zona_gempabumi = null;
            
            switch ($city->zona) {
                case 1:
                    $zona_gempabumi = $konstruksi->zona_satu;
                    break;

                case 2:
                    $zona_gempabumi = $konstruksi->zona_dua;
                    break;

                case 3:
                    $zona_gempabumi = $konstruksi->zona_tiga;
                    break;

                case 4:
                    $zona_gempabumi = $konstruksi->zona_empat;
                    break;

                case 5:
                    $zona_gempabumi = $konstruksi->zona_lima;
                    break;
                
                default:
                    $zona_gempabumi = $konstruksi->zona_satu;
                    break;
            }
            $harga_pertanggungan = $record->detailNilai->sum('nilai_pertanggungan') + $dataVarPenawaran['nilai_bangunan'];

            if($dataPerlindungan = $request->input('perlindungan')){
                foreach ($dataPerlindungan as $item) {
                    if(in_array($item, [1])){
                        continue;
                    }

                    if($item == 2){ // Gempa Bumi
                        if(in_array($okupasi->code, [2976, 29761])){
                            $persentasi = $zona_gempabumi;
                            $harga = ($harga_pertanggungan *  $zona_gempabumi) / 1000;
                        }
                    }
                    if($item == 3){ // Banjir
                        if(in_array($city->province_id, [16, 11, 12])){
                            $harga = ($harga_pertanggungan * 0.050) / 100; 
                            $persentasi = 0.050;
                        }else{
                            $harga = ($harga_pertanggungan * 0.045) / 100; 
                            $persentasi = 0.045;
                        }
                    }

                    if($item == 4){ // Kebakaran
                        if($kelasBangunan->id == 1){
                            $harga = ($harga_pertanggungan * $okupasi->tarif_konstruksi_satu) / 1000; 
                            $persentasi = $okupasi->tarif_konstruksi_satu;
                        }elseif($kelasBangunan->id == 2){
                            $harga = ($harga_pertanggungan * $okupasi->tarif_konstruksi_dua) / 1000; 
                            $persentasi = $okupasi->tarif_konstruksi_dua;
                        }else{
                            $harga = ($harga_pertanggungan * $okupasi->tarif_konstruksi_tiga) / 1000; 
                            $persentasi = $okupasi->tarif_konstruksi_tiga;
                        }
                    }
                    if($item == 5){
                        $persentasi = 0.0001;
                        $harga = ($harga_pertanggungan * 0.0001) / 100; 
                    }
    
                    if($item == 6){
                        $persentasi = 0.0001;
                        $harga = ($harga_pertanggungan * 0.0001) / 100; 
                    }
                    
                    if(in_array($item, [4,2])){
                        $persentasi_perkalian = 0.001;
                    }else{
                        $persentasi_perkalian = 0.01;
                    }
                    $perlindungan = new PolisPropertiPerlindungan();
                    $perlindungan->polis_id = $record->id;
                    $perlindungan->perlindungan_id = $item;
                    $perlindungan->persentasi_eksisting = $persentasi;
                    
                    $perlindungan->persentasi_perkalian = $persentasi_perkalian;
                    $perlindungan->harga_pembayaran = $harga_pertanggungan;
                    $perlindungan->total_harga = $harga;
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
                    'penutupanPolis',
                    'district',
                    'agent',
                    'user',
                    'detailCek',
                    'detailNilai',
                    'detailPayment',
                    'detailPerlindungan',
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

    public function getKelasBangunan(Request $request){
        try{
            if(!empty($request->name)){
                $data = KelasBangunan::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = KelasBangunan::all();
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

    public function getSurroundingRisk(Request $request){
        try{
            if(!empty($request->name)){
                $data = SurroundingRisk::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = SurroundingRisk::all();
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

    public function getPreviewHargaAsuransi(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'okupasi_id' => 'required',
                'konstruksi_id' => 'required',
                'city_id' => 'required',
                'perlindungan' => 'required',
                'harga_pertanggungan' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }
            $okupasi_id = $request->okupasi_id;
            $konstruksi_id = $request->konstruksi_id;
            $city_id = $request->city_id;
            $perlindungan = $request->perlindungan; //Array
            $harga_pertanggungan = $request->harga_pertanggungan;

            $okupasi = Okupasi::find($okupasi_id);
            $city = City::find($city_id);
            $konstruksi = KonstruksiProperti::find($konstruksi_id);
            $zona_gempabumi = null;

            switch ($city->zona) {
                case 1:
                    $zona_gempabumi = $konstruksi->zona_satu;
                    break;

                case 2:
                    $zona_gempabumi = $konstruksi->zona_dua;
                    break;

                case 3:
                    $zona_gempabumi = $konstruksi->zona_tiga;
                    break;

                case 4:
                    $zona_gempabumi = $konstruksi->zona_empat;
                    break;

                case 5:
                    $zona_gempabumi = $konstruksi->zona_lima;
                    break;
                
                default:
                    $zona_gempabumi = $konstruksi->zona_satu;
                    break;
            }
            $harga_preview = [];
            foreach ($perlindungan as $value) {
                $harga = 0;
                $name = '';
                $rumus = '';
                if($value == 2){ // Gempa Bumi
                    if(in_array($okupasi->code, [2976, 29761])){
                        $harga = ($harga_pertanggungan *  $zona_gempabumi) / 1000;
                    }
                    $rumus = "(" . $zona_gempabumi / 10 . "% x " . number_format($harga_pertanggungan) . ")";
                    $name = "Gempa Bumi";
                    $harga_preview[] = ['name' => $name, 'harga' => $harga, 'rumus' => $rumus];
                }
                if($value == 3){ // Banjir
                    if(in_array($city->province_id, [16, 11, 12])){
                        $harga = ($harga_pertanggungan * 0.050) / 100; 
                        $rumus = "(0.050% x " . number_format($harga_pertanggungan) . ")";
                    }else{
                        $harga = ($harga_pertanggungan * 0.045) / 100; 
                        $rumus = "(0.045% x " . number_format($harga_pertanggungan) . ")";
                    }
                    $name = "Banjir";
                    $harga_preview[] = ['name' => $name, 'harga' => $harga, 'rumus' => $rumus];
                }
                if($value == 4){ // Kebakaran
                    if($konstruksi_id == 1){
                        $harga = ($harga_pertanggungan * $okupasi->tarif_konstruksi_satu) / 1000; 
                        $rumus = "(" . $okupasi->tarif_konstruksi_satu / 10 . "% x " . number_format($harga_pertanggungan) . ")";
                    }elseif($konstruksi_id == 2){
                        $harga = ($harga_pertanggungan * $okupasi->tarif_konstruksi_dua) / 1000; 
                        $rumus = "(" . $okupasi->tarif_konstruksi_dua / 10 . "% x " . number_format($harga_pertanggungan) . ")";
                    }else{
                        $harga = ($harga_pertanggungan * $okupasi->tarif_konstruksi_tiga) / 1000; 
                        $rumus = "(" . $okupasi->tarif_konstruksi_tiga / 10 . "% x " . number_format($harga_pertanggungan) . ")";
                    }
                    $name = "Kebakaran";
                    $harga_preview[] = ['name' => $name, 'harga' => $harga, 'rumus' => $rumus];
                }
                if($value == 1){
                    $name = "Banjir, Angin Topan, Badai dan Kerusakan Akibat Air (FSTWD)";
                    $harga = ($harga_pertanggungan * 0.0001) / 100; 
                    $rumus = "(0.0001% x " . number_format($harga_pertanggungan) . ")";
                    
                    $harga_preview[] = ['name' => $name, 'harga' => $harga, 'rumus' => $rumus];

                    $name = "Kerusuhan, Pemogokan, Pengrusakan harta benda akibat tindakan jahat serta Huru Hara (Riot,Strike,Malicious Damage,Civil Commotion /RSMDCC)";
                    $harga = ($harga_pertanggungan * 0.0001) / 100;
                    $rumus = "(0.0001% x " . number_format($harga_pertanggungan) . ")";
                    $harga_preview[] = ['name' => $name, 'harga' => $harga, 'rumus' => $rumus];
                }
            }

            $harga_collection = collect($harga_preview);
            $total_harga = $harga_collection->sum('harga');

            return response()->json([
                'success' => true,
                'data' => $harga_collection,
                'total_harga' => $total_harga
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'trace' => $e->getTrace(),
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function getAllPolisProperti(Request $request){
        try {
            if (empty(auth()->user())) {
                return response()->json([
                    'success' => false,
                    'message' => "User belum login!",
                ], 400);
            }
            $data = PolisProperti::where('user_id', auth()->user()->id);

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
    
    public function getPolisPropertiSpesifik(Request $request){
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
            $data = PolisProperti::
            with([
                'province',
                'okupasi',
                'perlindungan',
                'konstruksi',
                'city',
                'penutupanPolis',
                'district',
                'agent',
                'user',
                'detailCek',
                'detailNilai',
                'detailSurrounding',
                'detailSurrounding.surroundingRisk',
                'detailPayment',
                'detailPerlindungan',
                'detailPerlindungan.perlindungan',
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
