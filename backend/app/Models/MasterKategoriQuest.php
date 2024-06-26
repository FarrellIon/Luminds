<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PivotKategoriQuest;
use App\Models\PivotKategoriPendengar;

class MasterKategoriQuest extends Model
{
    use HasFactory;

    protected $table = 'master_kategori_quest';

    public function pivot_kategori_quest(){
        return $this->hasMany(PivotKategoriQuest::class, 'kategori_id');
    }

    public function pivot_kategori_pendengar(){
        return $this->hasMany(PivotKategoriPendengar::class, 'kategori_id');
    }
}
