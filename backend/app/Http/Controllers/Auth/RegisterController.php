<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Pendengar;
use App\Models\Users;

class RegisterController extends Controller
{
    protected $controller_name = 'akun';

    public function register(Request $request){
        if(isset($_GET['level_akun'])){
            $level_akun = $_GET['level_akun'];
        }else{
            return response()->json(['messages' => 'Level akun belum ditentukan'], 401);
        }

        if($level_akun == 'admin'){
            $validator = Validator::make($request->all(),
                [
                    'email' => 'required',
                    'password' => 'required',
                ],
                [
                    'email.required' => 'Field email belum terisi',
                    'password.required' => 'Field password belum terisi',
                ]
            );
        }
        
        if($level_akun == 'pendengar'){
            $validator = Validator::make($request->all(),
                [
                    'username' => 'required',
                    'deskripsi' => 'required',
                    'lokasi' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'nomor_hp' => 'required',
                    'birthdate' => 'required|date',
                    'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'username.required' => 'Field username belum terisi',
                    'deskripsi.required' => 'Field deskripsi belum terisi',
                    'lokasi.required' => 'Field lokasi belum terisi',
                    'email.required' => 'Field email belum terisi',
                    'password.required' => 'Field password belum terisi',
                    'nomor_hp.required' => 'Field nomor HP belum terisi',
                    'birthdate.required' => 'Field tanggal lahir belum terisi',
                    'birthdate.date' => 'Field tanggal lahir bukan tanggal yang valid',
                    'profile_picture.required' => 'Field profile picture belum terisi',
                    'profile_picture.image' => 'Profile picture harus file gambar',
                    'profile_picture.mimes' => 'File profile picture harus berkestensi jpeg, png, ataupun jpg',
                    'profile_picture.max' => 'File profile picture harus berukuran dibawah 2MB',
                ]
            );
        }

        if($level_akun == 'user'){
            $validator = Validator::make($request->all(),
                [
                    'username' => 'required',
                    'deskripsi' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'nomor_hp' => 'required',
                    'birthdate' => 'required|date',
                    'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'username.required' => 'Field username belum terisi',
                    'deskripsi.required' => 'Field deskripsi belum terisi',
                    'email.required' => 'Field email belum terisi',
                    'password.required' => 'Field password belum terisi',
                    'nomor_hp.required' => 'Field nomor HP belum terisi',
                    'birthdate.required' => 'Field tanggal lahir belum terisi',
                    'birthdate.date' => 'Field tanggal lahir bukan tanggal yang valid',
                    'profile_picture.required' => 'Field profile picture belum terisi',
                    'profile_picture.image' => 'Profile picture harus file gambar',
                    'profile_picture.mimes' => 'File profile picture harus berkestensi jpeg, png, ataupun jpg',
                    'profile_picture.max' => 'File profile picture harus berukuran dibawah 2MB',
                ]
            );
        }

        if(!$validator){
            return response()->json(['errors' => 'Level akun masih belum valid'], 401);
        }
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;

            if($level_akun == 'admin'){
                $$variable = new Admin();
                $$variable->email = $request->email;
                $$variable->password = Hash::make($request->password);
            }
            
            if($level_akun == 'pendengar'){
                //Store image
                $icon = $request->file('profile_picture');
                $path = $icon->store('account/pendengar', 'public');

                $$variable = new Pendengar();
                $$variable->username = $request->username;
                $$variable->deskripsi = $request->deskripsi;
                $$variable->lokasi = $request->lokasi;
                $$variable->email = $request->email;
                $$variable->password = Hash::make($request->password);
                $$variable->nomor_hp = $request->nomor_hp;
                $$variable->birthdate = $request->birthdate;
                $$variable->profile_picture = $path;
            }

            if($level_akun == 'user'){
                //Store image
                $icon = $request->file('profile_picture');
                $path = $icon->store('account/users', 'public');

                $$variable = new Users();
                $$variable->username = $request->username;
                $$variable->deskripsi = $request->deskripsi;
                $$variable->email = $request->email;
                $$variable->password = Hash::make($request->password);
                $$variable->nomor_hp = $request->nomor_hp;
                $$variable->birthdate = $request->birthdate;
                $$variable->profile_picture = $path;
            }
            $$variable->save();

            $response = [
                'message' => 'Berhasil menginput data'
            ];

            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}