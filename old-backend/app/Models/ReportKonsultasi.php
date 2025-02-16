<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PesananKonsultasi;
use App\Models\Users;

class ReportKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'report_konsultasi';

    public function pesanan_konsultasi(){
        return $this->belongsTo(PesananKonsultasi::class, 'pesanan_konsultasi_id');
    }

    public function user(){
        return $this->belongsTo(Users::class, 'user_id');
    }
}
