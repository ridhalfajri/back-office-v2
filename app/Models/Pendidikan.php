<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'pendidikan';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function tingkat_pendidikan ()
    {
        return $this->belongsTo(TingkatPendidikan::class);
    }
    public function pegawai_riwayat_pendidikan()
    {
        return $this->hasMany(PegawaiRiwayatPendidikan::class);
    }
    public function pegawai_anak()
    {
        return $this->hasMany(PegawaiAnak::class);
    }
    public function pegawai_suami_istri()
    {
        return $this->hasMany(PegawaiSuamiIstri::class);
    }
}
