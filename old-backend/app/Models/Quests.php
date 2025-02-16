<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\KomentarQuest;
use App\Models\Users;
use App\Models\PivotKategoriQuest;
use App\Models\PivotFavoritQuest;

class Quests extends Model
{
    use HasFactory;

    protected $table = 'quests';

    public function komentar_quest(){
        return $this->hasMany(KomentarQuest::class, 'quest_id');
    }

    public function pivot_kategori_quest(){
        return $this->hasMany(PivotKategoriQuest::class, 'quest_id');
    }

    public function pivot_favorit_quest(){
        return $this->hasMany(PivotFavoritQuest::class, 'quest_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function user(){
        return $this->belongsTo(Users::class, 'user_id');
    }
}
