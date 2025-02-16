<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\JadwalTersediaPendengar;
use App\Models\Pendengar;
use App\Models\PekerjaanPendengar;
use App\Models\PesananKonsultasi;
use App\Models\PivotFavoritPendengar;
use App\Models\PivotFavoritQuest;
use App\Models\PivotKategoriPendengar;
use App\Models\PivotKategoriRatingPendengar;
use App\Models\PivotRatingPendengar;
use App\Models\Quests;
use App\Models\Users;

class UserController extends Controller
{
    public function assignKategoriPendengar(Request $request){
        $validator = Validator::make($request->all(),
            [
                'kategori' => 'required',
            ],
            [
                'kategori.required' => 'Field kategori belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            foreach($request->kategori as $kategori_pendengar){
                $pivot_kategori_pendengar = new PivotKategoriPendengar();
                $pivot_kategori_pendengar->pendengar_id = auth()->user()->id;
                $pivot_kategori_pendengar->kategori_id = Crypt::decryptString($kategori_pendengar);
                $pivot_kategori_pendengar->save();
            }

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

    public function assignPekerjaanPendengar(Request $request){
        $validator = Validator::make($request->all(),
            [
                'nama' => 'required',
                'perusahaan' => 'required',
                'waktu_mulai' => 'required',
            ],
            [
                'nama.required' => 'Field nama belum terisi',
                'perusahaan.required' => 'Field perusahaan belum terisi',
                'waktu_mulai.required' => 'Field waktu mulai belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            $pivot_kategori_pendengar = new PekerjaanPendengar();
            $pivot_kategori_pendengar->pendengar_id = auth()->user()->id;
            $pivot_kategori_pendengar->nama = $request->nama;
            $pivot_kategori_pendengar->perusahaan = $request->perusahaan;
            $pivot_kategori_pendengar->waktu_mulai = $request->waktu_mulai;
            if($request->waktu_selesai){
                $pivot_kategori_pendengar->waktu_selesai = $request->waktu_selesai;
                $pivot_kategori_pendengar->status_current = false;
            }else{
                $pivot_kategori_pendengar->status_current = true;
            }
            $pivot_kategori_pendengar->save();

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

    public function assignJadwalPendengar(Request $request){
        $validator = Validator::make($request->all(),
            [
                'tanggal' => 'required',
            ],
            [
                'tanggal.required' => 'Field tanggal belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            foreach($request->tanggal as $tanggal){
                $pivot_kategori_pendengar = new JadwalTersediaPendengar();
                $pivot_kategori_pendengar->pendengar_id = auth()->user()->id;
                $pivot_kategori_pendengar->tanggal = $tanggal;
                $pivot_kategori_pendengar->save();
            }

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

    public function detail(){
        try {
            if(isset($_GET['identifier'])){
                $user = Users::where('identifier', $_GET['identifier'])->first();
                $pendengar = Pendengar::where('identifier', $_GET['identifier'])->first();

                if ($user) {
                    $user['tipe_user'] = "user";
    
                    unset(
                        $user['id'],
                        $user['password']
                    );

                    $sendResponse = $user;
                }elseif($pendengar){
                    $pendengar['tipe_user'] = "pendengar";
                    $pendengar['kategori'] = $pendengar->pivot_kategori_pendengar;
                    $pendengar['pekerjaan'] = $pendengar->pekerjaan_pendengar;
                    $pendengar['average_rating'] = $pendengar->average_rating;
                    $pendengar['jumlah_konsultasi'] = $pendengar->jumlah_konsultasi;
                    $pendengar['kategori_rating'] = $pendengar->kategori_rating;

                    foreach ($pendengar['pekerjaan'] as $pekerjaan) {
                        unset($pekerjaan['id']);
                        unset($pekerjaan['pendengar_id']);
                    }

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

    public function favoritQuest(){
        try {
            if(isset($_GET['quest_identifier'])){
                $quest = Quests::where('identifier', $_GET['quest_identifier'])->first();

                $pivot_favorit_quest = new PivotFavoritQuest();
                $pivot_favorit_quest->user_id = auth()->user()->id;
                if($quest){
                    $pivot_favorit_quest->quest_id = $quest->id;
                }else{
                    return response()->json(['messages' => 'Quest dengan nomor unik tersebut tidak ditemukan'], 401);
                }
                $pivot_favorit_quest->save();

                $response = [
                    'message' => 'Berhasil favorit quest'
                ];

                return response()->json($response, 200);
            }else{
                return response()->json(['messages' => 'Nomor unik user belum dipasang'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function rating(Request $request){
        $validator = Validator::make($request->all(),
            [
                'rating' => 'required',
                'kategori_rating' => 'required',
            ],
            [
                'rating.required' => 'Field rating belum terisi',
                'kategori_rating.required' => 'Field kategori rating belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }

        try {
            if(isset($_GET['pendengar_identifier']) && isset($_GET['konsultasi_identifier'])){
                $konsultasi = PesananKonsultasi::where('identifier', $_GET['konsultasi_identifier'])->first();
                $pendengar = Pendengar::where('identifier', $_GET['pendengar_identifier'])->first();

                $pivot_rating_pendengar = new PivotRatingPendengar();
                if($konsultasi){
                    $pivot_rating_pendengar->pesanan_konsultasi_id = $konsultasi->id;
                }else{
                    return response()->json(['messages' => 'Konsultasi dengan nomor unik tersebut tidak ditemukan'], 401);
                }
                $pivot_rating_pendengar->user_id = auth()->user()->id;
                if($pendengar){
                    $pivot_rating_pendengar->pendengar_id = $pendengar->id;
                }else{
                    return response()->json(['messages' => 'Pendengar dengan nomor unik tersebut tidak ditemukan'], 401);
                }
                $pivot_rating_pendengar->rating = $request->rating;
                $pivot_rating_pendengar->catatan = $request->catatan;
                $pivot_rating_pendengar->save();

                foreach($request->kategori_rating as $kategori_rating){
                    $pivot_kategori_rating_pendengar = new PivotKategoriRatingPendengar();
                    $pivot_kategori_rating_pendengar->pesanan_konsultasi_id = $konsultasi->id;
                    $pivot_kategori_rating_pendengar->pendengar_id = $pendengar->id;
                    $pivot_kategori_rating_pendengar->kategori_rating_id = Crypt::decryptString($kategori_rating);
                    $pivot_kategori_rating_pendengar->save();
                }

                $response = [
                    'message' => 'Berhasil memberikan rating'
                ];

                return response()->json($response, 200);
            }else{
                return response()->json(['messages' => 'Nomor unik pendengar dan konsultasi belum dipasang'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
