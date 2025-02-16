<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\JadwalTersediaPendengar;
use App\Models\PesananKonsultasi;
use App\Models\PekerjaanPendengar;
use App\Models\PivotFavoritPendengar;
use App\Models\PivotRatingPendengar;
use App\Models\PivotKategoriRatingPendengar;
use App\Models\PivotKategoriPendengar;
use App\Models\ChatKonsultasi;

class Pendengar extends Authenticatable
{
    use HasFactory;

    protected $table = 'pendengar';
    protected $appends = ['average_rating', 'jumlah_konsultasi', 'kategori_rating'];

    public function jadwal_tersedia_pendengar(){
        return $this->hasMany(JadwalTersediaPendengar::class, 'pendengar_id');
    }

    public function pesanan_konsultasi(){
        return $this->hasMany(PesananKonsultasi::class, 'pendengar_id');
    }

    public function pekerjaan_pendengar(){
        return $this->hasMany(PekerjaanPendengar::class, 'pendengar_id');
    }

    public function pivot_favorit_pendengar(){
        return $this->hasMany(PivotFavoritPendengar::class, 'pendengar_id');
    }

    public function pivot_rating_pendengar(){
        return $this->hasMany(PivotRatingPendengar::class, 'pendengar_id');
    }

    public function pivot_kategori_pendengar(){
        return $this->hasMany(PivotKategoriPendengar::class, 'pendengar_id');
    }

    public function pivot_kategori_rating_pendengar(){
        return $this->hasMany(PivotKategoriRatingPendengar::class, 'pendengar_id');
    }

    public function chat_konsultasi(){
        return $this->hasMany(ChatKonsultasi::class, 'pendengar_id');
    }

    public function getAverageRatingAttribute(){
        return $this->pivot_rating_pendengar->avg('rating');
    }

    public function getJumlahKonsultasiAttribute(){
        return $this->pivot_rating_pendengar->count();
    }

    public function getKategoriRatingAttribute(){
        $pivot_kategori_rating_pendengar = PivotKategoriRatingPendengar::where('pendengar_id', $this->id)
        ->select('kategori_rating_id')
        ->distinct()
        ->get();

        $data = [];

        foreach($pivot_kategori_rating_pendengar as $key => $pivot){
            $jumlah_rating = PivotKategoriRatingPendengar::where('pendengar_id', $this->id)
            ->where('kategori_rating_id', $pivot->kategori_rating_id)
            ->count();
    
            $jumlah_konsultasi = $this->pivot_rating_pendengar->count();
    
            if($jumlah_konsultasi > 0){
                $percentage = $jumlah_rating / $jumlah_konsultasi * 100;
            }else{
                $percentage = 0;
            }
            
            $data[$key]['kategori'] = $pivot->kategori_rating->nama;
            $data[$key]['persentase'] = $percentage;
        }

        return $data;
    }
}
