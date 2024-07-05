<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quests;
use App\Models\User;

class PivotFavoritQuest extends Model
{
    use HasFactory;

    protected $table = 'pivot_favorit_quest';

    public function quest(){
        return $this->belongsTo(Quests::class, 'quest_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
