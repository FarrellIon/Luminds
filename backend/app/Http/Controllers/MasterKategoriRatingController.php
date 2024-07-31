<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\MasterKategoriRating;

class MasterKategoriRatingController extends Controller
{
    protected $controller_name = 'kategori_rating';

    public function get(){
        try {
            $variable = $this->controller_name;
            $$variable = MasterKategoriRating::all();

            $$variable = $$variable->map(function($singular){
                $singular['encrypted_id'] = Crypt::encryptString($singular->id);

                unset(
                    $singular['id']
                );

                return $singular;
            });

            $response = [
                'data' => $$variable
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
    
    public function insert(Request $request){
        $validator = Validator::make($request->all(),
            [
                'nama' => 'required',
            ],
            [
                'nama.required' => 'Field nama belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;
            $$variable = new MasterKategoriRating();
            $$variable->nama = $request->nama;
            $$variable->input_by = auth()->user()->id;
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
    
    public function update(Request $request, $encrypted_id){
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;
            $decrypted_id = Crypt::decryptString($encrypted_id);
            $$variable = MasterKategoriRating::findOrFail($decrypted_id);

            $$variable->nama = $request->nama;
            $$variable->input_by = auth()->user()->id;
            $$variable->save();

            $response = [
                'message' => 'Berhasil mengupdate data'
            ];

            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
    
    public function destroy($encrypted_id){
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;
            $decrypted_id = Crypt::decryptString($encrypted_id);
            $$variable = MasterKategoriRating::findOrFail($decrypted_id);
            $$variable->delete();

            $response = [
                'message' => 'Berhasil menghapus data'
            ];

            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
