<?php

namespace App\Http\Controllers\Api\Asuransi;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Asuransi\PolisMobil;
use App\Models\Master\Geo\Province;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Setting\Globals\Files;
use App\Models\Asuransi\PolisMobilCek;
use Illuminate\Support\Facades\Storage;
use App\Models\Asuransi\PolisMobilHarga;
use App\Models\Asuransi\PolisMobilNilai;
use App\Models\Asuransi\PolisMobilRider;
use App\Models\Asuransi\PolisMobilClient;
use Illuminate\Support\Facades\Validator;
use App\Models\Asuransi\PolisMobilPayment;
use App\Models\Master\DatabaseMobil\Tahun;
use App\Http\Controllers\Api\BaseController;
use App\Models\Asuransi\PolisMobilModifikasi;
use App\Models\Master\AsuransiMobil\AsuransiMobil;
use App\Models\Master\DataAsuransi\RiderKendaraan;
use App\Models\Master\AsuransiMobil\AsuransiRiderMobil;
use App\Models\Master\DataAsuransi\PertanggunganTambahan;
use App\Models\Master\AsuransiMobil\AsuransiPersentasiMobil;

class AsuransiMobilApiController extends BaseController
{
    public function agentAsuransiMobil(Request $request){
        try{
            $tanggal_akhir_asuransi = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir_asuransi);
            $dataTahunKendaraan = Tahun::find($request->tahun_id);
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            // $tanggal_awal = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal);
            // $tanggal_akhir = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir);

            $tahun_asuransi = $tanggal_akhir_asuransi->format('Y') - $tanggal->format('Y');
            $tahun_kendaraan = now()->format('Y') - $dataTahunKendaraan->tahun;

            $roles = Auth::user()->roles[0]->id;
            $noAsuransi = PolisMobil::generateNoAsuransi();
            $record = new PolisMobil;   
            $record->fill($request->only($record->fillable));
            if($roles == 3){
                $record->user_id = Auth::id();
            }else{
                $record->agent_id = Auth::id();
            }
            $record->no_asuransi = $noAsuransi->no_asuransi;
            $record->harga_asuransi = Self::hitungHargaAsuransiForPenawaran($tahun_kendaraan, $request->nilai_pertanggungan, $tahun_asuransi, $request->asuransi_id, $request->province_id);
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

            $recordClient = new PolisMobilClient;   
            $recordClient->fill($request->only($recordClient->fillable));
            $recordClient->polis_id = $record->id;
            $recordClient->save();
            

            if($dataPertanggungan = $request->input('pertanggungan')){
                // Loop through the "items" array and insert into the database
                foreach ($dataPertanggungan as $item) {
                    $pertanggungan = new PolisMobilHarga();
                    $pertanggungan->polis_id = $record->id;
                    $pertanggungan->pertanggungan_id = $item['pertanggungan_id'];
                    $pertanggungan->harga = $item['harga'];
                    $pertanggungan->save();
                }
            }
            
            if($dataModifikasi = $request->input('modifikasi')){
                foreach ($dataModifikasi as $item) {
                    $modifikasi = new PolisMobilModifikasi();
                    $modifikasi->polis_id = $record->id;
                    $modifikasi->name = $item['name'];
                    $modifikasi->nilai_modifikasi = $item['nilai_modifikasi'];
                    $modifikasi->save();
                }
            }

            if($request->rider){
                foreach($request->rider as $rider){
                    $dataRider = AsuransiRiderMobil::where('asuransi_id', $request->asuransi_id)->where('rider_kendaraan_id',$rider)->first();

                    if(in_array($request->tipe_pemakaian_id, [1,2])){
                        $persentasi_eksisting = $dataRider->pembayaran_persentasi;
                    }else{
                        $persentasi_eksisting = $dataRider->pembayaran_persentasi_komersial;
                    }
            
                    $recordRider = new PolisMobilRider;   
                    $recordRider->polis_id = $record->id;
                    $recordRider->rider_kendaraan_id = $dataRider->id;
                    $recordRider->persentasi_eksisting = $persentasi_eksisting;
                    $recordRider->persentasi_perkalian = 100;
                    $recordRider->harga_pembayaran = Self::hitungHargaPembayaranRider($rider, $request->nilai_pertanggungan);
                    $recordRider->total_harga = Self::hitungTotalHargaRider($rider, $request->nilai_pertanggungan, $request->tipe_pemakaian_id, $request->asuransi_id, $record->id);
                    $recordRider->save();
                }
            }

            $recordPolisUpdateHarga = PolisMobil::find($record->id);
            $recordPolisUpdateHarga->update([
                'harga_rider'=> $recordPolisUpdateHarga->rider->sum('total_harga'),
                'biaya_polis'=> 0,
                'biaya_materai'=> 0,
                'diskon'=> 0,
                'total_harga'=> $recordPolisUpdateHarga->rider->sum('total_harga') + $recordPolisUpdateHarga->harga_asuransi,
                
            ]);
            $recordPolisUpdateHarga->save();
            
            return response()->json([
                'success' => true,
                'message' => "Data Asuransi Berhasil Ditambahkan | status = Penawaran",
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'trace' => $e->getTraceAsString(),
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    // public function tahunAsuransi(Request $request){
    //     $dataTahunKendaraan = Tahun::find($request->tahun_id);
    //     $tahun_asuransi = $tanggal_akhir_asuransi->format('Y') - $tanggal->format('Y');
    //     $tahun_kendaraan = now()->format('Y') - $dataTahunKendaraan->tahun;

    //     $tahun_kendaraan = now()->format('Y') - $dataTahunKendaraan->tahun;
    // }

    public function hitungHargaAsuransiForPenawaran($tahun_kendaraan, $nilai_pertanggungan, $tahun_asuransi, $asuransi_id, $province_id){
        $asuransi = AsuransiMobil::find($asuransi_id);
        $harga_asuransi = 0;
        $asuransiPersentasiPerkalian = 0;
        if($asuransi){
            $persentasi_perkalian = 1;
            if($tahun_kendaraan > 5){
                $index_perkalian = $tahun_kendaraan - 5;
                $loading = 0.05 * $index_perkalian;
                $persentasi_perkalian = $persentasi_perkalian + $loading;
            }

            for ($i = 1; $i  <= $tahun_asuransi; $i ++) { 
                if($nilai_pertanggungan > 0 && $nilai_pertanggungan <=125000000){
                    $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 1')->first();
                }elseif($nilai_pertanggungan > 125000000 && $nilai_pertanggungan <= 200000000){
                    $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 2')->first();
                }elseif($nilai_pertanggungan > 200000000 && $nilai_pertanggungan <= 400000000){
                    $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 3')->first();
                }elseif($nilai_pertanggungan > 400000000 && $nilai_pertanggungan <= 800000000){
                    $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 4')->first();
                }elseif($nilai_pertanggungan > 800000000){
                    $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 5')->first();
                }

                if($province_id){
                    $province = Province::find($province_id);
                    $batas_wilayah = $province->code_wilayah;
                    switch ($batas_wilayah) {
                        case "1":
                            $asuransiPersentasiPerkalian = $asuransiPersentasi->wilayah_satu_bawah;
                            break;
                        case "2":
                            $asuransiPersentasiPerkalian = $asuransiPersentasi->wilayah_dua_bawah;
                            break;
                        case "3":
                            $asuransiPersentasiPerkalian = $asuransiPersentasi->wilayah_tiga_bawah;
                            break;
                        default:
                            $asuransiPersentasiPerkalian = 0;
                            break;
                    }
                }

                if ($i == 1) {
                    $harga_asuransi += $nilai_pertanggungan* ($asuransiPersentasiPerkalian/100);
                } else if ($i == 2) {
                    $harga_asuransi += $nilai_pertanggungan* 0.85 *($asuransiPersentasiPerkalian/100);
                } else if ($i == 3) {
                    $harga_asuransi += $nilai_pertanggungan* 0.75 *($asuransiPersentasiPerkalian/100);
                } else {
                    $harga_asuransi += $nilai_pertanggungan* 0.70 *($asuransiPersentasiPerkalian/100);
                }
            }
            $harga_asuransi = $persentasi_perkalian * $harga_asuransi;
        }
        return $harga_asuransi;
    }

    public function hitungTotalHargaRider($rider_id, $nilai_mobil, $tipe_pemakaian_id, $asuransi_id, $polis_id){
        $asuransiRider = AsuransiRiderMobil::where('asuransi_id', $asuransi_id)->where('rider_kendaraan_id',$rider_id)->first();

        $hargaRider = 0;
        if(!empty($asuransiRider->riderKendaraan->pertanggungan_id)){
            $polisPertanggunganTambahan = PolisMobilHarga::where('polis_id', $polis_id)->where('pertanggungan_id', $asuransiRider->riderKendaraan->pertanggungan_id)->first();
            $harga_perkalian = $polisPertanggunganTambahan->harga;

            if($rider_id == 6){
                if($polisPertanggunganTambahan->harga <= 25000000){
                    $hargaRider = $polisPertanggunganTambahan->harga * 0.01;
                }
        
                if($polisPertanggunganTambahan->harga >= 25000000 && $polisPertanggunganTambahan->harga <= 50000000){
                    $hargaRider = $polisPertanggunganTambahan->harga * 0.005;
                }
        
                if($polisPertanggunganTambahan->harga >= 50000000 && $polisPertanggunganTambahan->harga <= 50000000){
                    $hargaRider = $polisPertanggunganTambahan->harga * 0.0025;
                }
            }elseif($rider_id == 8){
                if($polisPertanggunganTambahan->harga <= 25000000){
                    $hargaRider = $polisPertanggunganTambahan->harga * 0.005;
                }
        
                if($polisPertanggunganTambahan->harga >= 25000000 && $polisPertanggunganTambahan->harga <= 50000000){
                    $hargaRider = $polisPertanggunganTambahan->harga * 0.0025;
                }
        
                if($polisPertanggunganTambahan->harga >= 50000000 && $polisPertanggunganTambahan->harga <= 50000000){
                    $hargaRider = $polisPertanggunganTambahan->harga * 0.00125;
                }
            }else{
                if(in_array($tipe_pemakaian_id, [1,2])){
                    $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi/100) * $harga_perkalian;
                }else{
                    $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi_komersial/100) * $harga_perkalian;
                }
            }
        }else{
            $harga_perkalian = $nilai_mobil;
            if(in_array($tipe_pemakaian_id, [1,2])){
                $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi/100) * $harga_perkalian;
            }else{
                $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi_komersial/100) * $harga_perkalian;
            }
        }

        return $hargaRider;
    }

    public function hitungHargaPembayaranRider($rider_id, $nilai_mobil){
        $asuransiRider = AsuransiRiderMobil::find($rider_id);
        if(!empty($asuransiRider->riderKendaraan->pertanggungan_id)){
            $polisPertanggunganTambahan = PolisMobilHarga::where('pertanggungan_id', $asuransiRider->riderKendaraan->pertanggungan_id)->first();
            $harga_perkalian = $polisPertanggunganTambahan->harga;
        }else{
            $harga_perkalian = $nilai_mobil;
        }

        return $harga_perkalian;
    }

    public function getAsuransiByRider(Request $request){
        $rider_id = $request->rider_id;

        try{
            if(!empty($rider_id)){
                $idAsuransi = AsuransiRiderMobil::whereIn('rider_kendaraan_id', $rider_id)->groupBy('asuransi_id')->select('asuransi_id')->get()->toArray();
                $data = AsuransiMobil::whereIn('id', $idAsuransi)->get();
            }else{
                $data = AsuransiMobil::all();
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

    public function getAllRiderMobil(Request $request){
        try{
            if(!empty($request->id)){
                $data = RiderKendaraan::where('pertanggungan_id', null)->orWhereIn('pertanggungan_id', $request->id)->get();
            }else{
                $data = RiderKendaraan::where('pertanggungan_id', null)->get();
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

    public function getRiderByAsuransiId(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }

            $id = $request->id;
            $data = AsuransiMobil::with([
                'perusahaanAsuransi',
                'intervalPembayaran',
                'kategoriAsuransi',
                'rider',
                'rider.riderKendaraan',
                'persentasi',
            ])->find($id);
    
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

    public function agentPenawaranAsuransiMobil(Request $request){
        try{
            $record = PolisMobil::where('no_asuransi', $request->no_asuransi)->first();
            $record->update([
                'status' => 'pending'
            ]);
            $record->save();
            $recordPayment = new PolisMobilPayment;   
            $recordPayment->fill($request->only($recordPayment->fillable));
            $recordPayment->polis_id = $record->id;
            $recordPayment->save();

            // if ($request->files) {
            //     foreach($request->files as $nama_file => $arr){
            //         foreach ($request->file($nama_file) as $key => $file) {
            //             // Get the base64 data portion of the string
            //             $base64Data = substr($file, strpos($file, ',') + 1);
    
            //             // Decode the base64 data to binary
            //             $imageData = base64_decode($base64Data);
    
            //             // Generate a unique file name
            //             $fileName = Carbon::now()->format('Ymdhisu')
            //                 . md5($file->getClientOriginalName())
            //                 . '.png'; // You can choose the appropriate file extension
    
            //             // Specify the storage disk (in this example, we use the 'public' disk)
            //             $disk = 'public';
    
            //             // Specify the storage path where you want to save the image
            //             $storagePath = 'files/' . $fileName;
    
            //             // Use the storeAs method to save the binary data as an image file
            //             $success = file_put_contents(storage_path().'/app/public/files/'.$fileName, $imageData);
    
            //             $sys_file = new Files;
            //             $sys_file->target_id    = $record->id;
            //             $sys_file->target_type  = PolisMobil::class;
            //             $sys_file->module       = 'asuransi.polis-mobil';
            //             $sys_file->file_name    = $fileName;
            //             $sys_file->file_path    = $success;
            //             $sys_file->file_size    = strlen($imageData); // Get the size of the image data
            //             $sys_file->flag         = $nama_file;
            //             $sys_file->save();
            //         }
            //     }
            // }
            if ($request->files) {
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
            }

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
            ], 400);
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
        }
        // if ($request->files) {
        //     foreach($request->files as $nama_file => $arr){
        //         foreach ($request->file($nama_file) as $key => $file) {
        //             // Get the base64 data portion of the string
        //             $base64Data = substr($file, strpos($file, ',') + 1);

        //             // Decode the base64 data to binary
        //             $imageData = base64_decode($base64Data);

        //             // Generate a unique file name
        //             $fileName = Carbon::now()->format('Ymdhisu')
        //                 . md5($file->getClientOriginalName())
        //                 . '.png'; // You can choose the appropriate file extension

        //             // Specify the storage disk (in this example, we use the 'public' disk)
        //             $disk = 'public';

        //             // Specify the storage path where you want to save the image
        //             $storagePath = 'files/' . $fileName;

        //             // Use the storeAs method to save the binary data as an image file
        //             $success = file_put_contents(storage_path().'/app/public/files/'.$fileName, $imageData);

        //             $sys_file = new Files;
        //             $sys_file->target_id    = $record->id;
        //             $sys_file->target_type  = PolisMobil::class;
        //             $sys_file->module       = 'asuransi.polis-mobil';
        //             $sys_file->file_name    = $fileName;
        //             $sys_file->file_path    = $success;
        //             $sys_file->file_size    = strlen($imageData); // Get the size of the image data
        //             $sys_file->flag         = $nama_file;
        //             $sys_file->save();
        //         }
        //     }
        // }

        return response()->json([
            'success' => true,
            'data' => $record->files,
        ]);
    }

    public function getHargaLengkapAsuransiMobil(Request $request){
        $asuransi_id = $request->asuransi_id;
        $province_id = $request->province_id;
        $tahun_kendaraan = $request->tahun_kendaraan;
        $nilai_pertanggungan = $request->nilai_pertanggungan;
        $tahun_asuransi = $request->tahun_asuransi;

        try{
            $asuransiMobil = AsuransiMobil::find($asuransi_id);
            $harga_asuransi = 0;
            if($asuransiMobil){
                $persentasi_perkalian = 1;
                if($tahun_kendaraan > 5){
                    $index_perkalian = $tahun_kendaraan - 5;
                    $loading = 0.05 * $index_perkalian;
                    $persentasi_perkalian = $persentasi_perkalian + $loading;
                }

                for ($i = 1; $i  <= $tahun_asuransi; $i ++) { 
                    if($nilai_pertanggungan > 0 && $nilai_pertanggungan <=125000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 1')->first();
                    }elseif($nilai_pertanggungan > 125000000 && $nilai_pertanggungan <= 200000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 2')->first();
                    }elseif($nilai_pertanggungan > 200000000 && $nilai_pertanggungan <= 400000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 3')->first();
                    }elseif($nilai_pertanggungan > 400000000 && $nilai_pertanggungan <= 800000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 4')->first();
                    }elseif($nilai_pertanggungan > 800000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('kategori', 'Kategori 5')->first();
                    }

                    if($province_id){
                        $province = Province::find($province_id);
                        $batas_wilayah = $province->code_wilayah;
                        switch ($batas_wilayah) {
                            case "1":
                                $asuransiPersentasi = $asuransiPersentasi->wilayah_satu_bawah;
                                break;
                            case "2":
                                $asuransiPersentasi = $asuransiPersentasi->wilayah_dua_bawah;
                                break;
                            case "3":
                                $asuransiPersentasi = $asuransiPersentasi->wilayah_tiga_bawah;
                                break;
                            default:
                                $asuransiPersentasi = 0;
                                break;
                        }
                    }

                    if ($i == 1) {
                        $harga_asuransi += $nilai_pertanggungan* ($asuransiPersentasi/100);
                    } else if ($i == 2) {
                        $harga_asuransi += $nilai_pertanggungan* 0.85 *($asuransiPersentasi/100);
                    } else if ($i == 3) {
                        $harga_asuransi += $nilai_pertanggungan* 0.75 *($asuransiPersentasi/100);
                    } else {
                        $harga_asuransi += $nilai_pertanggungan* 0.70 *($asuransiPersentasi/100);
                    }
                }
                $asuransiMobil->harga_asuransi = $persentasi_perkalian * $harga_asuransi;
            }
                
            // ================================
            // if(!empty($rider_id)){
            //     $asuransiRider = AsuransiRiderMobil::where('asuransi_id', $asuransi_id)->whereIn('rider_kendaraan_id', $rider_id)->get();
            //     $asuransiRider->each(function ($model) use ($tahun_kendaraan, $nilai_pertanggungan, $tahun_asuransi, $province_id) {
            //         $hargaRider = 0;
            //         if(!empty($model->riderKendaraan->pertanggungan_id)){
            //             $polisPertanggunganTambahan = PolisMobilHarga::where('polis_id', $polis_id)->where('pertanggungan_id', $asuransiRider->riderKendaraan->pertanggungan_id)->first();
            //             $harga_perkalian = $polisPertanggunganTambahan->harga;

            //             if($rider_id == 6){
            //                 if($polisPertanggunganTambahan->harga <= 25000000){
            //                     $hargaRider = $polisPertanggunganTambahan->harga * 0.01;
            //                 }
                    
            //                 if($polisPertanggunganTambahan->harga >= 25000000 && $polisPertanggunganTambahan->harga <= 50000000){
            //                     $hargaRider = $polisPertanggunganTambahan->harga * 0.005;
            //                 }
                    
            //                 if($polisPertanggunganTambahan->harga >= 50000000 && $polisPertanggunganTambahan->harga <= 50000000){
            //                     $hargaRider = $polisPertanggunganTambahan->harga * 0.0025;
            //                 }
            //             }elseif($rider_id == 8){
            //                 if($polisPertanggunganTambahan->harga <= 25000000){
            //                     $hargaRider = $polisPertanggunganTambahan->harga * 0.005;
            //                 }
                    
            //                 if($polisPertanggunganTambahan->harga >= 25000000 && $polisPertanggunganTambahan->harga <= 50000000){
            //                     $hargaRider = $polisPertanggunganTambahan->harga * 0.0025;
            //                 }
                    
            //                 if($polisPertanggunganTambahan->harga >= 50000000 && $polisPertanggunganTambahan->harga <= 50000000){
            //                     $hargaRider = $polisPertanggunganTambahan->harga * 0.00125;
            //                 }
            //             }else{
            //                 if(in_array($tipe_pemakaian_id, [1,2])){
            //                     $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi/100) * $harga_perkalian;
            //                 }else{
            //                     $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi_komersial/100) * $harga_perkalian;
            //                 }
            //             }
            //         }else{
            //             $harga_perkalian = $nilai_mobil;
            //             if(in_array($tipe_pemakaian_id, [1,2])){
            //                 $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi/100) * $harga_perkalian;
            //             }else{
            //                 $hargaRider = 1 * ($asuransiRider->pembayaran_persentasi_komersial/100) * $harga_perkalian;
            //             }
            //         }
            //     });
            // }else{
            //     $riderAsuransi = null;
            // }
    
            return response()->json([
                'success' => true,
                'data' => $asuransiMobil
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function getHargaAsuransiMobil(Request $request){
        $validator = Validator::make($request->all(), [
            'tahun_kendaraan' => 'required',
            'nilai_pertanggungan' => 'required',
            'tahun_asuransi' => 'required',
            'province_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $tahun_kendaraan = $request->tahun_kendaraan;
        $nilai_pertanggungan = $request->nilai_pertanggungan;
        $tahun_asuransi = $request->tahun_asuransi;
        $rider_id = $request->rider_id;
        $province_id = $request->province_id;

        try{
            if(!empty($rider_id)){
                // $idAsuransi = AsuransiRiderMobil::whereIn('rider_kendaraan_id', $rider_id)->groupBy('asuransi_id')->select('asuransi_id')->get()->toArray();
                // $idAsuransi = AsuransiRiderMobil::where(function ($query) use ($rider_id) {
                //     foreach ($rider_id as $riderId) {
                //         $query->where('rider_kendaraan_id', $riderId);
                //     }
                // })
                // ->groupBy('asuransi_id')
                // ->select('asuransi_id')
                // ->get()
                // ->toArray();
                // $asuransiMobil = AsuransiMobil::whereHas('persentasi')
                // ->whereHas('rider', function($q) use($rider_id){
                //     $q->whereIn('rider_kendaraan_id', $rider_id);
                // })->get();
                $asuransiMobil = AsuransiMobil::whereHas('rider', function ($query) use ($rider_id) {
                    $query->whereIn('rider_kendaraan_id', $rider_id);
                }, '=', count($rider_id))->get();
            }else{
                $asuransiMobil = AsuransiMobil::whereHas('persentasi')->get();
            }
            $asuransiMobil->each(function ($model) use ($tahun_kendaraan, $nilai_pertanggungan, $tahun_asuransi, $province_id) {
                $harga_asuransi = 0;
                $persentasi_perkalian = 1;
                if($tahun_kendaraan > 5){
                    $index_perkalian = $tahun_kendaraan - 5;
                    $loading = 0.05 * $index_perkalian;
                    $persentasi_perkalian = $persentasi_perkalian + $loading;
                }

                for ($i = 1; $i  <= $tahun_asuransi; $i ++) { 
                    if($nilai_pertanggungan > 0 && $nilai_pertanggungan <=125000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('asuransi_id', $model->id)->where('kategori', 'Kategori 1')->first();
                    }elseif($nilai_pertanggungan > 125000000 && $nilai_pertanggungan <= 200000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('asuransi_id', $model->id)->where('kategori', 'Kategori 2')->first();
                    }elseif($nilai_pertanggungan > 200000000 && $nilai_pertanggungan <= 400000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('asuransi_id', $model->id)->where('kategori', 'Kategori 3')->first();
                    }elseif($nilai_pertanggungan > 400000000 && $nilai_pertanggungan <= 800000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('asuransi_id', $model->id)->where('kategori', 'Kategori 4')->first();
                    }elseif($nilai_pertanggungan > 800000000){
                        $asuransiPersentasi = AsuransiPersentasiMobil::where('asuransi_id', $model->id)->where('kategori', 'Kategori 5')->first();
                    }

                    if($province_id){
                        $province = Province::find($province_id);
                        $batas_wilayah = $province->code_wilayah;
                        switch ($batas_wilayah) {
                            case "1":
                                $asuransiPersentasi = $asuransiPersentasi->wilayah_satu_bawah;
                                break;
                            case "2":
                                $asuransiPersentasi = $asuransiPersentasi->wilayah_dua_bawah;
                                break;
                            case "3":
                                $asuransiPersentasi = $asuransiPersentasi->wilayah_tiga_bawah;
                                break;
                            default:
                                $asuransiPersentasi = 0;
                                break;
                        }
                    }

                    if ($i == 1) {
                        $harga_asuransi += $nilai_pertanggungan* ($asuransiPersentasi/100);
                    } else if ($i == 2) {
                        $harga_asuransi += $nilai_pertanggungan* 0.85 *($asuransiPersentasi/100);
                    } else if ($i == 3) {
                        $harga_asuransi += $nilai_pertanggungan* 0.75 *($asuransiPersentasi/100);
                    } else {
                        $harga_asuransi += $nilai_pertanggungan* 0.70 *($asuransiPersentasi/100);
                    }
                }
                $model->harga_asuransi = $persentasi_perkalian * $harga_asuransi;
            });
    
            return response()->json([
                'success' => true,
                'data' => $asuransiMobil,
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'trace' => $e->getTraceAsString(),
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function getAllPertanggunganTambahanMobil(Request $request){
        try{
            if(!empty($request->name)){
                $data = PertanggunganTambahan::where('name', 'like', '%' . $request->name . '%')->get();
            }else{
                $data = PertanggunganTambahan::all();
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

    // public function getRiderMobilByPertanggunganId(Request $request){
    //     try{
    //         if(!empty($request->id)){
    //             $data = RiderKendaraan::where('pertanggungan_id', $request->id)->get();
    //         }else{
    //             $data = PertanggunganTambahan::all();
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'data' => $data,
    //         ]);
    //     }catch(Exception $e){
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e
    //         ], 400);
    //     }
    // }

    // public function getRiderByPertanggungan(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         // 'pertanggungan_id' => 'required|array',
    //         'tipe_pemakaian_id' => 'required',
    //         'asuransi_id' => 'required',
    //     ]);
        
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors(),
    //         ], 400);
    //     }

    //     $pertanggungan_id = $request->pertanggungan_id;
    //     $asuransi_id = $request->asuransi_id;
    //     $tipe_pemakaian_id = $request->tipe_pemakaian_id;

    //     try{
    //         if(in_array($tipe_pemakaian_id, [1,2])){
    //             $rider = AsuransiRiderMobil::grid()
    //             ->whereHas(
    //                 'riderKendaraan',
    //                 function ($q) use ($pertanggungan_id) {
    //                     $q->whereIn('pertanggungan_id', $pertanggungan_id);
    //                     $q->orWhere('pertanggungan_id', null);
    //                 }
    //             )
    //             ->where('asuransi_id', $asuransi_id)
    //             ->with('riderKendaraan:id,name,pertanggungan_id')
    //             ->get()
    //             ->makeHidden(['creator', 'updater','pembayaran_persentasi_komersial']);
    //         }else{
    //             $rider = AsuransiRiderMobil::grid()
    //             ->whereHas(
    //                 'riderKendaraan',
    //                 function ($q) use ($pertanggungan_id) {
    //                     $q->whereIn('pertanggungan_id', $pertanggungan_id);
    //                     $q->orWhere('pertanggungan_id', null);
    //                 }
    //             )
    //             ->where('asuransi_id', $asuransi_id)
    //             ->select(['id','pembayaran_persentasi_komersial'])
    //             ->with('riderKendaraan:id,name,pertanggungan_id')
    //             ->get()
    //             ->makeHidden(['creator', 'updater','pembayaran_persentasi']);
    //         }
    
    //         return response()->json([
    //             'success' => true,
    //             'data' => $rider,
    //         ]);
    //     }catch(Exception $e){
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e
    //         ], 400);
    //     }
    // }

    public function getRiderMobilDefault(Request $request){
        $validator = Validator::make($request->all(), [
            'tipe_pemakaian_id' => 'required',
            'asuransi_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $asuransi_id = $request->asuransi_id;
        $tipe_pemakaian_id = $request->tipe_pemakaian_id;

        try{
            if(in_array($tipe_pemakaian_id, [1,2])){
                $rider = AsuransiRiderMobil::grid()
                ->whereHas(
                    'riderKendaraan',
                    function ($q) {
                        $q->where('pertanggungan_id', null);
                    }
                )
                ->where('asuransi_id', $asuransi_id)
                ->with('riderKendaraan:id,name,pertanggungan_id')
                ->get()
                ->makeHidden(['creator', 'updater','pembayaran_persentasi_komersial']);
            }else{
                $rider = AsuransiRiderMobil::grid()
                ->whereHas(
                    'riderKendaraan',
                    function ($q) {
                        $q->where('pertanggungan_id', null);
                    }
                )
                ->where('asuransi_id', $asuransi_id)
                ->select(['id','pembayaran_persentasi_komersial'])
                ->with('riderKendaraan:id,name,pertanggungan_id')
                ->get()
                ->makeHidden(['creator', 'updater','pembayaran_persentasi']);
            }
    
            return response()->json([
                'success' => true,
                'data' => $rider,
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function getPolisMobilSpesifik(Request $request){
        try {
            $data = PolisMobil::
            with([
                'detailCek.merk',
                'detailCek.tahun',
                'detailCek.tipeMobil',
                'detailCek.seri',
                'detailCek.kodePlat',
                'detailCek.tipeKendaraan',
                'detailCek.tipePemakaian',
                'detailCek.luasPertanggungan',
                'detailCek.kondisiKendaraan',
                'rider.rider.riderKendaraan',
                'rider.rider',
                'rider',
                'detailNilai',
                'detailPayment',
                'asuransi',
                'detailHarga',
                'detailHarga.pertanggungan',
                'detailClient.province',
                'detailClient.city',
                'detailClient.district',
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
