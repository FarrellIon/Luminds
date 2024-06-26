<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Konsultasi;
use App\Models\Users;

class RiwayatKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_konsultasi';

    public function konsultasi(){
        return $this->belongsToMany(Konsultasi::class, 'konsultasi_id');
    }

    public function user(){
        return $this->belongsToMany(Users::class, 'user_id');
    }
}
