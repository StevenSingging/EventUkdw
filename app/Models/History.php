<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable = ['user_id','acara_id','judul'];

    public function acaran(){
        return $this->belongsTo(Event::class,'acara_id','id');
    }
    public function usern(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
