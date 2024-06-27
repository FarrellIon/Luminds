<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\MasterKategoriQuest;
use App\Models\MasterKategoriRating;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';

    public function kategori_quest(){
        return $this->belongsTo(MasterKategoriQuest::class, 'admin_id');
    }
    
    public function kategori_rating(){
        return $this->belongsTo(MasterKategoriRating::class, 'admin_id');
    }

    
}
