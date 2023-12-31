<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $table = 'events';
    protected $fillable = ['jenis_acara','nama_acara','warna','deskripsi','waktu_mulai','waktu_selesai','lokasi','harga_dosen','harga_mhs','harga_umum','harga_staff','batas_pendaftaran','gambar','terbuka_untuk','penganggung_jawab','kuota','status'];

    public function riwayat()
    {
        return $this->hasMany(History::class, 'acara_id');
    }

    public function acarap()
    {
        return $this->hasMany(Pendaftaran_Acara::class, 'acara_id');
    }

    public function panitiaa(){
        return $this->belongsTo(User::class,'penanggung_jawab');
    }
}
