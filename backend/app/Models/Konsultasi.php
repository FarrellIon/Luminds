<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendengar;
use App\Models\Users;
use App\Models\RiwayatKonsultasi;
use App\Models\ChatKonsultasi;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    public function pendengar(){
        return $this->belongsToMany(Pendengar::class, 'pendengar_id');
    }

    public function user(){
        return $this->belongsToMany(Users::class, 'user_id');
    }

    public function riwayat_konsultasi(){
        return $this->hasMany(RiwayatKonsultasi::class, 'konsultasi_id');
    }

    public function chat_konsultasi(){
        return $this->hasMany(ChatKonsultasi::class, 'konsultasi_id');
    }
}
