<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendengar;
use App\Models\Users;

class PivotFavoritPendengar extends Model
{
    use HasFactory;

    protected $table = 'pivot_favorit_pendengar';

    public function pendengar(){
        return $this->belongsToMany(Pendengar::class, 'pendengar_id');
    }

    public function user(){
        return $this->belongsToMany(Users::class, 'user_id');
    }
}
