<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MasterKategoriQuest;
use App\Models\MasterKategoriRating;
use App\Models\Quests;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    public function kategori_quest(){
        return $this->belongsTo(MasterKategoriQuest::class, 'admin_id');
    }
    
    public function kategori_rating(){
        return $this->belongsTo(MasterKategoriRating::class, 'admin_id');
    }

    public function quests(){
        return $this->hasMany(Quests::class, 'user_id');
    }
}
