<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\MasterKategoriQuest;
use App\Models\MasterKategoriRating;
use App\Models\Quests;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'admin';

    public function kategori_quest(){
        return $this->hasMany(MasterKategoriQuest::class, 'input_by');
    }
    
    public function kategori_rating(){
        return $this->hasMany(MasterKategoriRating::class, 'input_by');
    }

    public function quests(){
        return $this->hasMany(Quests::class, 'user_id');
    }
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
