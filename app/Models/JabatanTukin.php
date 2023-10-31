<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanTukin extends Model
{
    protected $table = 'jabatan_tukin';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function tukin()
    {
        return $this->belongsTo(Tukin::class);
    }
    public function jenis_jabatan()
    {
        return $this->belongsTo(JenisJabatan::class);
    }
    public function jabatan_unit_kerja()
    {
        return $this->hasMany(JabatanUnitKerja::class);
    }
}
