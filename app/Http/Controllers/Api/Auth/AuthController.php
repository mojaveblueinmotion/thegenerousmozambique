<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Asuransi\PolisMobil;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AsuransiMotor\PolisMotor;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Models\AsuransiKendaraan\PolisKendaraan;
use App\Models\AsuransiPerjalanan\PolisPerjalanan;
use App\Models\AsuransiProperti\PolisProperti;
use App\Models\Master\AsuransiMobil\AsuransiMobil;
use App\Models\Master\AsuransiMotor\AsuransiMotor;

class AuthController extends BaseController
{   
    public function signin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => "Invalid Credentials"
            ], 400);
        }else{
            $token = JWTAuth::attempt($credentials);

            return response()->json([
                'success' => true,
                'tokens' => $token,
            ]);
        }
    }

    public function getMe(Request $request)
    {
        if($record = Auth::user()){
            $agent = null;
            foreach ($record->roles as $role) {
                if($role->id == 2){
                    $agent = true;
                    $totalAsuransi = PolisMobil::where('agent_id', Auth::id())->count() + PolisMotor::where('agent_id', Auth::id())->count() + PolisMobil::where('agent_id', Auth::id())->count() + PolisKendaraan::where('agent_id', Auth::id())->count() + PolisProperti::where('agent_id', Auth::id())->count();
                }
            }
            if($agent){
                if(!empty($request->requestGetMe)){
                    $requestGetMe = $request->requestGetMe;
                    switch ($requestGetMe) {
                        case 'asuransiMobil':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Mobil By Agent",
                                'data' => PolisMobil::where('agent_id', Auth::id()),
                            ]);
                            break;
                        case 'asuransiMotor':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Motor By Agent",
                                'data' => PolisMotor::where('agent_id', Auth::id()),
                            ]);
                            break;
                        case 'asuransiProperti':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Properti By Agent",
                                'data' => PolisProperti::where('agent_id', Auth::id()),
                            ]);
                            break;
                        case 'asuransiPerjalanan':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Perjalanan By Agent",
                                'data' => PolisPerjalanan::where('agent_id', Auth::id()),
                            ]);
                            break;
                        default:
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Perjalanan By Agent",
                                'data' => PolisPerjalanan::where('agent_id', Auth::id()),
                            ]);
                            break;

                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => "Data Agent",
                    'data' => User::find(Auth::id()),
                    'jaringan' => $totalAsuransi
                ]);
            }else{
                if(!empty($request->requestGetMe)){
                    $requestGetMe = $request->requestGetMe;
                    switch ($requestGetMe) {
                        case 'asuransiMobil':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Mobil By User",
                                'data' => PolisMobil::where('user_id', Auth::id()),
                            ]);
                            break;
                        case 'asuransiMotor':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Motor By User",
                                'data' => PolisMotor::where('user_id', Auth::id()),
                            ]);
                            break;
                        case 'asuransiProperti':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Properti By User",
                                'data' => PolisProperti::where('user_id', Auth::id()),
                            ]);
                            break;
                        case 'asuransiPerjalanan':
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Perjalanan By User",
                                'data' => PolisPerjalanan::where('user_id', Auth::id()),
                            ]);
                            break;
                        default:
                            return response()->json([
                                'success' => true,
                                'message' => "Data Asuransi Perjalanan By User",
                                'data' => PolisPerjalanan::where('user_id', Auth::id()),
                            ]);
                            break;

                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => "Data User",
                    'data' => User::find(Auth::id()),
                    // with([
                    //     'asuransiMobil', 'asuransiMotor', 'asuransiProperti', 'asuransiPerjalanan',
                    //     'asuransiAgentMobil', 'asuransiAgentMotor', 'asuransiAgentProperti', 'asuransiAgentPerjalanan',
                    //     'asuransiProperti.penutupanPolis',
                    //     ])->
                       
                ]);
            }
            
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Not Authorized',
            ], 400);
        }
    }

    public function signup(Request $request)
    {
        $pass = bcrypt($request->password);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email:rfc,dns|required|unique:sys_users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'phone' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'roles'  => 'required',
            'status'  => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }
        
        // dd($request);
        try{
            $record = new User;
            $record->fill($request->only($record->fillable));
            if ($request->password) {
                $record->password = bcrypt($request->password);
            }
            $record->save();
            if ($record->id != 1) {
                $record->roles()->sync($request->roles ?? null);
            }
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Register'
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'          => 'required|password',
            'new_password'              => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        try{
            // $validator->fails()
            $record = User::find(Auth::id());
            $record->password  = bcrypt($request->new_password);
            $record->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Merubah Password'
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }

}