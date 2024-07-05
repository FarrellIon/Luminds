<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterKategoriRating;
use App\Models\Pendengar;

class PivotKategoriRatingPendengar extends Model
{
    use HasFactory;

    protected $table = 'pivot_kategori_rating_pendengar';

    public function kategori_rating(){
        return $this->belongsTo(MasterKategoriRating::class, 'kategori_rating_id');
    }

    public function pendengar(){
        return $this->belongsTo(Pendengar::class, 'pendengar_id');
    }
}
