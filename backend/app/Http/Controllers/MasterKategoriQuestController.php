<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\MasterKategoriQuest;

class MasterKategoriQuestController extends Controller
{
    protected $controller_name = 'kategori_quest';

    public function get(){
        try {
            $variable = $this->controller_name;
            $$variable = MasterKategoriQuest::all();

            $$variable = $$variable->map(function($singular){
                $singular['encrypted_id'] = Crypt::encryptString($singular->id);
                $singular['icon'] = Storage::url($singular->icon);

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
                'icon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'color_code' => 'required',
            ],
            [
                'nama.required' => 'Field nama belum terisi',
                'icon.required' => 'Field icon belum terisi',
                'icon.image' => 'Icon harus file gambar',
                'icon.mimes' => 'File icon harus berkestensi jpeg, png, ataupun jpg',
                'icon.max' => 'File icon harus berukuran dibawah 2MB',
                'color_code.required' => 'Field color code belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;

            //Store image
            $icon = $request->file('icon');
            $path = $icon->store('kategori-quest/icons', 'public');
            
            $$variable = new MasterKategoriQuest();
            $$variable->nama = $request->nama;
            $$variable->icon = $path;
            $$variable->color_code = $request->color_code;
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
            $$variable = MasterKategoriQuest::findOrFail($decrypted_id);

            //Delete and store image
            Storage::disk('public')->delete($$variable->icon);
            $icon = $request->file('icon');
            $path = $icon->store('kategori-quest/icons', 'public');
            
            $$variable->nama = $request->nama;
            $$variable->icon = $path;
            $$variable->color_code = $request->color_code;
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
            $$variable = MasterKategoriQuest::findOrFail($decrypted_id);
            Storage::disk('public')->delete($$variable->icon);
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
