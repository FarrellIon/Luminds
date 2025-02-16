<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendengar;

class PekerjaanPendengar extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan_pendengar';

    public function pendengar(){
        return $this->belongsTo(Pendengar::class, 'pendengar_id');
    }
}
