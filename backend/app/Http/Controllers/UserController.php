<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Pendengar;
use App\Models\PivotFavoritPendengar;
use App\Models\Users;

class UserController extends Controller
{
    public function detail(){
        try {
            if(isset($_GET['identifier'])){
                $user = Users::where('identifier', $_GET['identifier'])->first();
                $pendengar = Pendengar::where('identifier', $_GET['identifier'])->first();

                if ($user) {
                    $user['tipe_user'] = "user";
    
                    unset(
                        $user['id']
                    );

                    $sendResponse = $user;
                }elseif($pendengar){
                    $pendengar['tipe_user'] = "pendengar";
    
                    unset(
                        $pendengar['id']
                    );

                    $sendResponse = $pendengar;
                }else{
                    return response()->json(['messages' => 'Pengguna dengan nomor unik tersebut tidak ditemukan'], 401);
                }

                $response = [
                    'data' => $sendResponse
                ];

                return response()->json($response, 200);
            }else{
                return response()->json(['messages' => 'Nomor unik user belum dipasang'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function favoritPendengar(){
        try {
            if(isset($_GET['pendengar_identifier'])){
                $pendengar = Pendengar::where('identifier', $_GET['pendengar_identifier'])->first();

                $pivot_favorit_pendengar = new PivotFavoritPendengar();
                $pivot_favorit_pendengar->user_id = auth()->user()->id;
                if($pendengar){
                    $pivot_favorit_pendengar->pendengar_id = $pendengar->id;
                }else{
                    return response()->json(['messages' => 'Pendengar dengan nomor unik tersebut tidak ditemukan'], 401);
                }
                $pivot_favorit_pendengar->save();

                $response = [
                    'message' => 'Berhasil favorit pendengar'
                ];

                return response()->json($response, 200);
            }else{
                return response()->json(['messages' => 'Nomor unik user belum dipasang'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
