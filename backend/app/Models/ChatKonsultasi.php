<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Konsultasi;
use App\Models\Users;
use App\Models\Pendengar;

class ChatKonsultasi extends Model
{
    use HasFactory;

    public function konsultasi(){
        return $this->belongsToMany(Konsultasi::class, 'konsultasi_id');
    }

    public function user(){
        return $this->belongsToMany(Users::class, 'user_id');
    }

    public function pendengar(){
        return $this->belongsToMany(Pendengar::class, 'pendengar_id');
    }
}
