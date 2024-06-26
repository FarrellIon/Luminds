<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JadwalTersediaPendengar;
use App\Models\Konsultasi;
use App\Models\PekerjaanPendengar;
use App\Models\PivotFavoritPendengar;
use App\Models\PivotRatingPendengar;
use App\Models\PivotKategoriPendengar;
use App\Models\ChatKonsultasi;

class Pendengar extends Model
{
    use HasFactory;

    protected $table = 'pendengar';

    public function jadwal_tersedia_pendengar(){
        return $this->hasMany(JadwalTersediaPendengar::class, 'pendengar_id');
    }

    public function konsultasi(){
        return $this->hasMany(Konsultasi::class, 'pendengar_id');
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

    public function chat_konsultasi(){
        return $this->hasMany(ChatKonsultasi::class, 'pendengar_id');
    }
}
