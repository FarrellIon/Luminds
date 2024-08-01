<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::guard('admin')->check()){
            return response()->json(['messages' => 'Anda sudah login sebagai admin, silahkan logout terlebih dahulu'], 500);
        }
        if(Auth::guard('pendengar')->check()){
            return response()->json(['messages' => 'Anda sudah login sebagai pendengar, silahkan logout terlebih dahulu'], 500);
        }
        if(Auth::guard('users')->check()){
            return response()->json(['messages' => 'Anda sudah login sebagai user, silahkan logout terlebih dahulu'], 500);
        }
        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email belum diisi',
                'password.required' => 'Password belum diisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['messages' => $validator->errors()->all()], 401);
        }

        if(isset($_GET['level_akun'])){
            $level_akun = $_GET['level_akun'];
        }else{
            return response()->json(['messages' => 'Level akun belum ditentukan'], 401);
        }
        $credentials = $request->only('email', 'password');

        if($level_akun == 'admin'){
            if($token = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                session()->save();
                return $this->respondWithToken($token);
            }
        }
        
        if($level_akun == 'pendengar'){
            if($token = Auth::guard('pendengar')->attempt(['email' => $request->email, 'password' => $request->password])){
                session()->save();
                return $this->respondWithToken($token);
            }
        }

        if($level_akun == 'user'){
            if($token = Auth::guard('users')->attempt(['email' => $request->email, 'password' => $request->password])){
                session()->save();
                return $this->respondWithToken($token);
            }
        }
    
        return response()->json(['messages' => 'Gagal login, silahkan cek kembali email dan password yang dimasukkan'], 500);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        if(Auth::guard('panitia')->check()){
            return $this->respondWithToken(Auth::guard('panitia')->refresh());
        }elseif(Auth::guard('umum')->check()){
            return $this->respondWithToken(Auth::guard('umum')->refresh());
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        if(Auth::guard('admin')->check()){
            $expires_in = Auth::guard('admin')->factory()->getTTL() * 60;
        }elseif(Auth::guard('pendengar')->check()){
            $expires_in = Auth::guard('pendengar')->factory()->getTTL() * 60;
        }elseif(Auth::guard('users')->check()){
            $expires_in = Auth::guard('users')->factory()->getTTL() * 60;
        }else{
            return response()->json(['messages' => 'Terjadi kesalahan'], 500);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expires_in
        ]);
    }

    public function logout()
    {
        try{
            if(Auth::guard('users')->check()){
                Auth::guard('users')->logout();
            }elseif(Auth::guard('admin')->check()){
                Auth::guard('admin')->logout();
            }elseif(Auth::guard('pendengar')->check()){
                Auth::guard('pendengar')->logout();
            }else{
                return response()->json(['messages' => 'Anda belum login'], 500);
            }
            return response()->json(['messages' => 'Berhasil logout'], 200);
        }catch(Exception $e){
            return response()->json(['messages' => 'Gagal logout'], 500);
        }
    }
}