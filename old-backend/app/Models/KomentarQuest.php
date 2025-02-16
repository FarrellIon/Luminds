<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quests;
use App\Models\Users;

class KomentarQuest extends Model
{
    use HasFactory;

    protected $table = 'komentar_quest';

    public function quest(){
        return $this->belongsTo(Quests::class, 'quest_id');
    }

    public function user(){
        return $this->belongsTo(Users::class, 'user_id');
    }
}
