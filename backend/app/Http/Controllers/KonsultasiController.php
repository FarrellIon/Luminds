<?php

namespace App\Http\Controllers;

use GetStream\StreamChat\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Pendengar;
use App\Models\PesananKonsultasi;
use App\Models\ReportKonsultasi;
use App\Models\Users;

class KonsultasiController extends Controller
{
    protected $controller_name = 'konsultasi';

    public function listPendengar(){
        try {
            $variable = $this->controller_name;
            $$variable = Pendengar::all();

            $$variable = $$variable->map(function($singular){
                $singular['encrypted_id'] = Crypt::encryptString($singular->id);

                unset(
                    $singular['id'],
                    $singular['password']
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
    
    public function listUser(){
        try {
            $variable = $this->controller_name;
            $$variable = Users::all();

            $$variable = $$variable->map(function($singular){
                $singular['encrypted_id'] = Crypt::encryptString($singular->id);

                unset(
                    $singular['id'],
                    $singular['password']
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

    public function pesanKonsultasi(Request $request){
        $validator = Validator::make($request->all(),
            [
                'waktu_konsultasi' => 'required',
            ],
            [
                'waktu_konsultasi.required' => 'Field waktu konsultasi belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            $variable = $this->controller_name;

            if(isset($_GET['pendengar_identifier'])){
                $pendengar = Pendengar::where('identifier', $_GET['pendengar_identifier'])->first();

                if(!$pendengar){
                    return response()->json(['errors' => 'Pendengar dengan nomor unik ini tidak ditemukan'], 401);
                }
            }else{
                return response()->json(['errors' => 'Belum memasukkan nomor unik pendengar'], 401);
            }

            $this->purchase($pendengar->harga_per_layanan);

            $$variable = new PesananKonsultasi();
            $$variable->identifier = $this->randomNumber();
            $$variable->user_id = auth()->user()->id;
            $$variable->pendengar_id = $pendengar->id;
            $$variable->status = 'menunggu_approval';
            $$variable->waktu_konsultasi = $request->waktu_konsultasi;
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

    public function reportKonsultasi(Request $request){
        $validator = Validator::make($request->all(),
            [
                'alasan_report' => 'required',
            ],
            [
                'alasan_report.required' => 'Field alasan report belum terisi',
            ]
        );
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()], 401);
        }
        
        DB::beginTransaction();

        try {
            if(isset($_GET['konsultasi_identifier'])){
                $pesanan_konsultasi = PesananKonsultasi::where('identifier', $_GET['konsultasi_identifier'])->first();

                if(!$pesanan_konsultasi){
                    return response()->json(['errors' => 'Konsultasi dengan nomor unik ini tidak ditemukan'], 401);
                }
            }else{
                return response()->json(['errors' => 'Belum memasukkan nomor unik konsultasi'], 401);
            }
            
            $variable = $this->controller_name;
            $$variable = new ReportKonsultasi();
            $$variable->user_id = auth()->user()->id;
            $$variable->pesanan_konsultasi_id = $pesanan_konsultasi->id;
            $$variable->alasan_report = $request->alasan_report;
            $$variable->save();

            $response = [
                'message' => 'Berhasil report'
            ];

            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function riwayatKonsultasi(Request $request){
        try {
            $variable = $this->controller_name;
            $$variable = PesananKonsultasi::orderBy('created_at', 'desc')
            ->where('user_id', auth()->user()->id)
            ->get();

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

    public function setujuiKonsultasi(Request $request){
        DB::beginTransaction();

        try {
            if(isset($_GET['konsultasi_identifier'])){
                $pesanan_konsultasi = PesananKonsultasi::where('identifier', $_GET['konsultasi_identifier'])->first();

                if(!$pesanan_konsultasi){
                    return response()->json(['errors' => 'Konsultasi dengan nomor unik ini tidak ditemukan'], 401);
                }
            }else{
                return response()->json(['errors' => 'Belum memasukkan nomor unik konsultasi'], 401);
            }
            
            if($pesanan_konsultasi->pendengar_id == auth()->user()->id){
                if($pesanan_konsultasi->status == 'menunggu_approval'){
                    $pesanan_konsultasi->status = 'menunggu_jadwal';
                    $pesanan_konsultasi->save();
                }else{
                    return response()->json(['errors' => 'Konsultasi ini sudah disetujui'], 401);
                }
            }else{
                return response()->json(['errors' => 'Anda tidak punya akses untuk konsultasi ini'], 401);
            }

            $nama_user = Auth::guard('users')->user()->username.'_user';
            $nama_pendengar = $pesanan_konsultasi->pendengar->username.'_pendengar';
            $nama_channel = "Konsultasi-".$nama_user.'-'.$nama_pendengar;
            $client = new Client(env('GETSTREAM_API_KEY'), env('GETSTREAM_SECRET'));
            $client->upsertUsers([['id' => $nama_user, 'role' => 'user'], ['id' => $nama_pendengar, 'role' => 'admin']]);
            $channel = $client->Channel("messaging", $nama_channel, ['members' => [$nama_user, $nama_pendengar]]);
            $channel->create($nama_channel);

            $response = [
                'message' => 'Berhasil setujui'
            ];

            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function tolakKonsultasi(Request $request){
        DB::beginTransaction();

        try {
            if(isset($_GET['konsultasi_identifier'])){
                $pesanan_konsultasi = PesananKonsultasi::where('identifier', $_GET['konsultasi_identifier'])->first();

                if(!$pesanan_konsultasi){
                    return response()->json(['errors' => 'Konsultasi dengan nomor unik ini tidak ditemukan'], 401);
                }
            }else{
                return response()->json(['errors' => 'Belum memasukkan nomor unik konsultasi'], 401);
            }
            
            if($pesanan_konsultasi->pendengar_id == auth()->user()->id){
                if($pesanan_konsultasi->status == 'menunggu_approval'){
                    $pesanan_konsultasi->status = 'ditolak';
                    $pesanan_konsultasi->save();
    
                    $this->refund($pesanan_konsultasi->pendengar->harga_per_layanan, $pesanan_konsultasi->user_id);
                }else{
                    return response()->json(['errors' => 'Konsultasi ini sudah ditolak'], 401);
                }
            }else{
                return response()->json(['errors' => 'Anda tidak punya akses untuk konsultasi ini'], 401);
            }

            $response = [
                'message' => 'Berhasil tolak'
            ];

            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function randomNumber(){
        $number = rand(1, 999999999999);
        if(PesananKonsultasi::where('identifier', $number)->exists()){
            return randomNumber();
        }
        return $number;
    }
    
    public function purchase($amount){
        if(auth()->user()->token - $amount <= 0){
            return response()->json(['errors' => 'Token anda tidak cukup'], 401);
        }else{
            auth()->user()->token -= $amount;
            auth()->user()->save();
        }
    }

    public function refund($amount, $user_id){
        $user = Users::find($user_id);

        if(!$user){
            return response()->json(['errors' => 'User dalam konsultasi ini tidak ditemukan'], 401);
        }

        $user->token += $amount;
        $user->save();
    }
}
