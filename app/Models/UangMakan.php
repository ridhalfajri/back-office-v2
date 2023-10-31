<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangMakan extends Model
{
    use HasFactory;
    protected $table = 'uang_makan';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }
    public function pegawai_riwayat_umak()
    {
        return $this->hasMany(PegawaiRiwayatUmak::class);
    }
}
