<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\KomentarQuest;
use App\Models\MasterKategoriQuest;
use App\Models\PivotKategoriQuest;
use App\Models\Quests;

class QuestsController extends Controller
{
    protected $controller_name = 'quest';

    public function get(){
        try {
            $variable = $this->controller_name;
            if(isset($_GET['filter_kategori'])){
                $filter_kategori = $_GET['filter_kategori'];
                if($filter_kategori){
                    $filter_kategori_decrypted = Crypt::decryptString($filter_kategori);
                    $$variable = Quests::with('pivot_kategori_quest.kategori')
                    ->whereHas('pivot_kategori_quest', function($query) use($filter_kategori_decrypted){
                        $query->where('kategori_id', $filter_kategori_decrypted);
                    });
                }else{
                    $$variable = Quests::with('pivot_kategori_quest.kategori');
                }
            }else{
                $$variable = Quests::with('pivot_kategori_quest.kategori');
            }

            if(isset($_GET['filter_sort'])){
                $filter_sort = $_GET['filter_sort'];
                if($filter_sort){
                    if($filter_sort == 'terbaru'){
                        $$variable = $$variable->orderBy('created_at', 'DESC');
                    }elseif($filter_sort == 'terlama'){
                        $$variable = $$variable->orderBy('created_at', 'ASC');
                    }elseif($filter_sort == 'a-to-z'){
                        $$variable = $$variable->orderBy('judul', 'ASC');
                    }elseif($filter_sort == 'z-to-a'){
                        $$variable = $$variable->orderBy('judul', 'DESC');
                    }elseif($filter_sort == 'waktu-sedikit'){
                        $$variable = $$variable->orderByRaw('TIMESTAMPDIFF(SECOND, NOW(), batas_waktu) ASC');
                    }elseif($filter_sort == 'waktu-terbanyak'){
                        $$variable = $$variable->orderByRaw('TIMESTAMPDIFF(SECOND, NOW(), batas_waktu) DESC');
                    }
                }else{
                    $$variable = $$variable->orderBy('created_at', 'desc');
                }
            }else{
                $$variable = $$variable->orderBy('created_at', 'desc');
            }
            $$variable = $$variable->get();

            $$variable = $$variable->map(function($singular){
                $singular['encrypted_id'] = Crypt::encryptString($singular->id);

                foreach ($singular['pivot_kategori_quest'] as $pivot) {
                    $pivot['encrypted_kategori_id'] = Crypt::encryptString($pivot->kategori->id);
                    unset($pivot['id']);
                    unset($pivot['quest_id']);
                    unset($pivot['kategori_id']);
                    unset($pivot['kategori']['id']);
                    unset($pivot['kategori']['input_by']);
                }

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
        $userIsAdmin = Auth::guard('admin')->check();

        $validator = Validator::make($request->all(),
            [
                'judul' => 'required',
                'deskripsi' => 'required',
                'batas_waktu' => 'required',
                'kategori_quest' => 'required',
                'max_partisipan' => ($userIsAdmin) ? 'required' : '',
                'hadiah' => ($userIsAdmin) ? 'required' : '',
            ],
            [
                'judul.required' => 'Field judul belum terisi',
                'deskripsi.required' => 'Field deskripsi belum terisi',
                'batas_waktu.required' => 'Field batas waktu belum terisi',
                'kategori_quest.required' => 'Field kategori quest belum terisi',
                'max_partisipan.required' => 'Field max partisipan belum terisi',
                'hadiah.required' => 'Field hadiah belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;
            $$variable = new Quests();
            $$variable->identifier = $this->randomNumber();
            $$variable->judul = $request->judul;
            $$variable->deskripsi = $request->deskripsi;
            $$variable->batas_waktu = $request->batas_waktu;
            if(Auth::guard('users')->user()){
                $$variable->user_id = auth()->user()->id;
            }else{
                $$variable->admin_id = auth()->user()->id;
            }
            if($userIsAdmin){
                $$variable->max_partisipan = $request->max_partisipan;
                $$variable->hadiah = $request->hadiah;
            }
            $$variable->save();

            foreach($request->kategori_quest as $kategori_quest){
                $pivot_kategori_quest = new PivotKategoriQuest();
                $pivot_kategori_quest->quest_id = $$variable->id;
                $pivot_kategori_quest->kategori_id = Crypt::decryptString($kategori_quest);
                $pivot_kategori_quest->save();
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
    
    public function update(Request $request, $encrypted_id){
        DB::beginTransaction();

        try {
            $decrypted_id = Crypt::decryptString($encrypted_id);
            $variable = $this->controller_name;
            $$variable = Quests::findOrFail($decrypted_id);

            $$variable->judul = $request->judul;
            $$variable->deskripsi = $request->deskripsi;
            $$variable->batas_waktu = $request->batas_waktu;
            if(Auth::guard('users')->user()){
                $$variable->user_id = auth()->user()->id;
            }else{
                $$variable->admin_id = auth()->user()->id;
            }
            $$variable->save();

            PivotKategoriQuest::where('quest_id', $$variable->id)->delete();
            foreach($request->kategori_quest as $kategori_quest){
                $pivot_kategori_quest = new PivotKategoriQuest();
                $pivot_kategori_quest->quest_id = $$variable->id;
                $pivot_kategori_quest->kategori_id = Crypt::decryptString($kategori_quest);
                $pivot_kategori_quest->save();
            }

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
            PivotKategoriQuest::where('quest_id', $$variable->id)->delete();
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

    public function postComment(Request $request){
        $validator = Validator::make($request->all(),
            [
                'komentar' => 'required',
            ],
            [
                'komentar.required' => 'Field komentar belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }

        if(isset($_GET['quest_identifier'])){
            DB::beginTransaction();

            try {
                $quest_obj = Quests::where('identifier', $_GET['quest_identifier'])->first();

                $variable = $this->controller_name;
                $$variable = new KomentarQuest();
                $$variable->identifier = $this->randomNumberKomentar();
                if($quest_obj){
                    $$variable->quest_id = $quest_obj->id;
                }else{
                    return response()->json(['messages' => 'Quest dengan nomor unik tersebut tidak ditemukan'], 401);
                }
                $$variable->user_id = auth()->user()->id;
                $$variable->komentar = $request->komentar;
                $$variable->status_terbaik = false;
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
        }else{
            return response()->json(['messages' => 'Nomor unik user belum dipasang'], 401);
        }
    }

    public function markAsBest(Request $request){
        $userIsAdmin = Auth::guard('admin')->check();

        if(isset($_GET['comment_identifier'])){
            DB::beginTransaction();

            try {
                $komentar_quest = KomentarQuest::where('identifier', $_GET['comment_identifier'])->first();

                if($komentar_quest){
                    if($userIsAdmin){
                        if($komentar_quest->quest->admin_id != auth()->user()->id){
                            return response()->json(['messages' => 'Anda bukan pembuat quest ini'], 401);
                        }
                    }else{
                        if($komentar_quest->quest->user_id != auth()->user()->id){
                            return response()->json(['messages' => 'Anda bukan pembuat quest ini'], 401);
                        }
                    }

                    KomentarQuest::where('quest_id', $komentar_quest->quest->id)
                    ->update(['status_terbaik' => false]);

                    $komentar_quest->status_terbaik = true;
                    $komentar_quest->save();
                }else{
                    return response()->json(['messages' => 'Quest dengan nomor unik tersebut tidak ditemukan'], 401);
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
        }else{
            return response()->json(['messages' => 'Nomor unik user belum dipasang'], 401);
        }
    }

    public function randomNumber(){
        $number = rand(1, 999999999);
        if(Quests::where('identifier', $number)->exists()){
            return randomNumber();
        }
        return $number;
    }

    public function randomNumberKomentar(){
        $number = rand(1, 999999999);
        if(KomentarQuest::where('identifier', $number)->exists()){
            return randomNumberKomentar();
        }
        return $number;
    }
}
