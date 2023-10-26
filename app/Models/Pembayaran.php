<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $fillable = ['user_id','acara_id','pendaftaran_id','tanggal_pembayaran','jumlah_pembayaran','bukti_pembayaran','status_pembayaran'];

    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran_Acara::class,'pendaftaran_id');
    }
}
