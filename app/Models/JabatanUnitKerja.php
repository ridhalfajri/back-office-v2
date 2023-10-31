<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanUnitKerja extends Model
{
    protected $table = 'jabatan_unit_kerja';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function jabatan_tukin()
    {
        return $this->belongsTo(JabatanTukin::class);
    }
    public function hirarki_unit_kerja()
    {
        return $this->belongsTo(HirarkiUnitKerja::class);
    }
    public function pegawai_riwayat_jabatan()
    {
        return $this->hasMany(PegawaiRiwayatJabatan::class);
    }
}
