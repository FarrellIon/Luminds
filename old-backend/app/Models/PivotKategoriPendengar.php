<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Pendengar;

class PivotKategoriPendengar extends Model
{
    use HasFactory;

    protected $table = 'pivot_kategori_pendengar';

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function pendengar(){
        return $this->belongsTo(Pendengar::class, 'pendengar_id');
    }
}
