<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\KomentarQuest;
use App\Models\PesananKonsultasi;
use App\Models\Quests;
use App\Models\PivotFavoritPendengar;
use App\Models\PivotRatingPendengar;
use App\Models\PivotFavoritQuest;
use App\Models\RiwayatKonsultasi;
use App\Models\ChatKonsultasi;


class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    public function komentar_quest(){
        return $this->hasMany(KomentarQuest::class, 'user_id');
    }

    public function pesanan_konsultasi(){
        return $this->hasMany(PesananKonsultasi::class, 'user_id');
    }
    
    public function quests(){
        return $this->hasMany(Quests::class, 'user_id');
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

    public function report_konsultasi(){
        return $this->hasMany(ChatKonsultasi::class, 'user_id');
    }
}
