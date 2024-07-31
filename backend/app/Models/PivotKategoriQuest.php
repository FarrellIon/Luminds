<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterKategoriQuest;
use App\Models\Quests;

class PivotKategoriQuest extends Model
{
    use HasFactory;

    protected $table = 'pivot_kategori_quest';

    public function kategori(){
        return $this->belongsTo(MasterKategoriQuest::class, 'kategori_id');
    }

    public function quest(){
        return $this->belongsTo(Quests::class, 'quest_id');
    }
}