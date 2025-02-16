<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PesananKonsultasi;
use App\Models\Users;
use App\Models\Pendengar;

class ChatKonsultasi extends Model
{
    use HasFactory;

    public function pesanan_konsultasi(){
        return $this->belongsTo(PesananKonsultasi::class, 'pesanan_konsultasi_id');
    }

    public function user(){
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function pendengar(){
        return $this->belongsTo(Pendengar::class, 'pendengar_id');
    }
}
