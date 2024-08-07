<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendengar;
use App\Models\Users;

class PivotRatingPendengar extends Model
{
    use HasFactory;

    protected $table = 'pivot_rating_pendengar';

    public function pendengar(){
        return $this->belongsTo(Pendengar::class, 'pendengar_id');
    }

    public function user(){
        return $this->belongsTo(Users::class, 'user_id');
    }
}
