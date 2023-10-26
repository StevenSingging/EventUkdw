<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran_Acara extends Model
{
    protected $table = 'pendaftaran_acaras';
    protected $fillable = ['user_id','acara_id','status'];

    public function acarap(){
        return $this->belongsTo(Acara::class,'acara_id');
    }
    public function userp(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function pembayaran(){
        return $this->hasOne(Pembayaran::class, 'pendaftaran_id');
    }
}
