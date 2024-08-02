<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use GetStream\StreamChat\Client;
use App\Models\PesananKonsultasi;

class ChatKonsultasiController extends Controller
{
    public function getToken(){
        $server_client = new Client(env('GETSTREAM_API_KEY'), env('GETSTREAM_SECRET'));
        $token = $server_client->createToken("farrell_user");

        return $token;
    }

    public function sendChat(Request $request){
        try {
            if(isset($_GET['konsultasi_identifier'])){
                $pesanan_konsultasi = PesananKonsultasi::where('identifier', $_GET['konsultasi_identifier'])->first();

                if(!$pesanan_konsultasi){
                    return response()->json(['errors' => 'Konsultasi dengan nomor unik ini tidak ditemukan'], 401);
                }
            }else{
                return response()->json(['errors' => 'Belum memasukkan nomor unik konsultasi'], 401);
            }

            if(Auth::guard('users')->check()){
                if(Auth::guard('users')->user()->username != $pesanan_konsultasi->user->username){
                    return response()->json(['errors' => 'Anda tidak punya akses ke chat ini'], 401);
                }
            }elseif(Auth::guard('pendengar')->check()){
                if(Auth::guard('pendengar')->user()->username != $pesanan_konsultasi->pendengar->username){
                    return response()->json(['errors' => 'Anda tidak punya akses ke chat ini'], 401);
                }
            }

            $client = new Client(env('GETSTREAM_API_KEY'), env('GETSTREAM_SECRET'));
            $nama_user = $pesanan_konsultasi->user->username.'_user';
            $nama_pendengar = $pesanan_konsultasi->pendengar->username.'_pendengar';
            $nama_channel = "Konsultasi-".$nama_user.'-'.$nama_pendengar;
            $channel = $client->Channel("messaging", $nama_channel, ['members' => [$nama_user, $nama_pendengar]]);

            $image = $request->file('image');

            $toBeSent = [
                "text" => $request->pesan,
            ];

            if($image){
                $toBeSent["attachments"] = [
                    [
                        "type" => "image",
                        "asset_url" => "https://bit.ly/2K74TaG",
                        "thumb_url" => "https://bit.ly/2Uumxti",
                    ]
                ];
            }
            
            if(Auth::guard('users')->check()){
                $channel->sendMessage($toBeSent, $nama_user);
            }elseif(Auth::guard('pendengar')->check()){
                $channel->sendMessage($toBeSent, $nama_pendengar);
            }else{
                return response()->json(['errors' => 'Belum login dengan akun yang benar'], 401);
            }

            $response = [
                'message' => 'Berhasil kirim pesan'
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
