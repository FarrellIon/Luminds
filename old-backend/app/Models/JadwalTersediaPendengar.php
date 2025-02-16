<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTersediaPendengar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tersedia_pendengar';

    public function pendengar(){
        return $this->belongsTo(Pendengar::class, 'pendengar_id');
    }
}
