<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KomentarQuest;
use App\Models\Konsultasi;
use App\Models\PivotFavoritPendengar;
use App\Models\PivotRatingPendengar;
use App\Models\PivotFavoritQuest;
use App\Models\RiwayatKonsultasi;
use App\Models\ChatKonsultasi;


class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function komentar_quest(){
        return $this->hasMany(KomentarQuest::class, 'user_id');
    }
    
    public function konsultasi(){
        return $this->hasMany(Konsultasi::class, 'user_id');
    }

    public function pivot_favorit_pendengar(){
        return $this->hasMany(PivotFavoritPendengar::class, 'user_id');
    }

    public function pivot_rating_pendengar(){
        return $this->hasMany(PivotRatingPendengar::class, 'user_id');
    }

    public function pivot_favorit_quest(){
        return $this->hasMany(PivotFavoritQuest::class, 'user_id');
    }

    public function riwayat_konsultasi(){
        return $this->hasMany(RiwayatKonsultasi::class, 'user_id');
    }

    public function chat_konsultasi(){
        return $this->hasMany(ChatKonsultasi::class, 'user_id');
    }
}
