<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\PivotKategoriRatingPendengar;

class MasterKategoriRating extends Model
{
    use HasFactory;

    protected $table = 'master_kategori_rating';

    public function pivot_kategori_rating_pendengar(){
        return $this->hasMany(PivotKategoriRatingPendengar::class, 'kategori_rating_id');
    }

    public function input_by(){
        return $this->belongsTo(Admin::class, 'input_by');
    }
}
