<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Quests;

class QuestsController extends Controller
{
    protected $controller_name = 'quest';

    public function get(){
        try {
            $variable = $this->controller_name;
            $$variable = Quests::all();

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
                'judul' => 'required',
                'deskripsi' => 'required',
                'batas_waktu' => 'required',
            ],
            [
                'judul.required' => 'Field judul belum terisi',
                'deskripsi.required' => 'Field deskripsi belum terisi',
                'batas_waktu.required' => 'Field batas waktu belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;
            $$variable = new Quests();
            $$variable->judul = $request->judul;
            $$variable->deskripsi = $request->deskripsi;
            $$variable->batas_waktu = $request->batas_waktu;
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
            $$variable = Quests::findOrFail($decrypted_id);

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
            $$variable = Quests::findOrFail($decrypted_id);
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
