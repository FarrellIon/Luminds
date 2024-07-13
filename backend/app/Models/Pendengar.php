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
}
