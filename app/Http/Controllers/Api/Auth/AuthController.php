<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
   
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

    public function getMe()
    {
        if(Auth::user()){
            return response()->json([
                'success' => true,
                'message' => "Data User",
                'data' => User::with([
                    'asuransiMobil', 'asuransiMotor', 'asuransiProperti', 'asuransiPerjalanan',
                    'asuransiAgentMobil', 'asuransiAgentMotor', 'asuransiAgentProperti', 'asuransiAgentPerjalanan',
                    'asuransiProperti.penutupanPolis',
                    ])->find(Auth::id()),
            ]);
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
            'roles'  => 'required'
        ]);
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
                'success' => false,
                'message' => 'Berhasil Register'
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 400);
        }
    }
   
}